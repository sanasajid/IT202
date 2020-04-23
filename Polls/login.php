<html>
	<head>
		<title>My Project - Login</title>
	<style>
	body{
		//background-color: rgba(192,192,192,0.3);
		//background-image: url('https://media.giphy.com/media/Cv7wrQjYcd6hO/giphy.gif');
		background-image: url(bg1.jpg);
		height: 100%;
        	background-position: center;
       		background-repeat: no-repeat;
        	background-size: cover;

		color: black; 
		}
		.center{
			text-align: center;
		}
	</style>
	
	</head>
	<body>
		<!-- This is how you comment -->
		<form name="loginform" id="myForm" method="POST"
	<div class="center">
	<p>
	<br>
			<label for="email">Email: </label> <br>
			<input type="email" id="email" name="email" placeholder=
			"Enter email"/>  <br>
	<br>
			<label for="pass">Password: </label> <br>
			<input type="password" name="password" placeholder=
			"Enter password"/> <br>
			
			<div>&nbsp;</div>
			<input type="submit" value="Login" onClick="document.location.href='https://web.njit.edu/~ss3968/IT202/Polls/main.php'"/>	
	</p>
	</div>
		</form>
	</body>
</html>
<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); 

if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
	$pass = $_POST['password'];
	$email = $_POST['email'];

	//lets hash it 
	//$pass = password_hash($pass, PASSWORD_BCRYPT);
	//echo "<br>$pass<br>"; 
	//its hashed
	require("config.php");
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("SELECT id,password,email from `Users` where email = :email LIMIT 1");
      
	$params = array(":email"=> $email);
        $stmt->execute($params);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	if($result) {
		$userpassword = $result['password'];
		//this is the wrong way $pass = password_hash($pass, PASSWORD_BCRYPT);
		//if($pass == $userpassword)
		//this is the correct way please lookup password_verify online 

		if(password_verify($pass, $userpassword)) {
			$id = $result['id'];
			//echo "You logged in with id of " . $result['id'];
			echo "Welcome back!";
			//echo "<pre>" . var_export($result,true) . "</pre>";
			$stmt = $db->prepare("SELECT r.id, r.role_name from `Roles` r JOIN `UserRoles` ur on r.id = ur.role_id where ur.user_id = :id");
			$stmt->execute(array(":id"=>$id));	
			$roles = $stmt->fetchALL(PDO::FETCH_ASSOC);
			//$user = array(":id" => $result['id']);
			if(!$roles) {
				$roles = array();
			}	
			$user = array(
				"id" => $result['id'], 
				"email" => $result['email'],
				"roles" => array(0=>"admin",1=>"user"));
		
			$_SESSION['user'] = $user; 

			//our table 
			//roles column
				//can handle 1 role
				//can be tweaked to handle multiple roles 
				//user,admin,reader,writer 
			//create table roles 
				//id
				//role name 
				//user_id (pretend we didn't user here)
			//create table user_roles 
				//id
				//role_id
				//user_id 

			//echo "Session: <pre>" . var_export($_SESSION, true) . "</pre>";
		}
		else {
			echo "Failed to login, invalid password";
		}
	}
	else {
		echo "Invalid email"; 
	}
		

	} 

	catch(Exception $e){
		echo $e->getMessage();
		exit();
	}

}//endif checking form variables 
?>

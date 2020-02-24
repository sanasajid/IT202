<html>
	<head>
		<title>My Project - Register</title>
		<style>
		body{
			background-color: rgba(192,192,192,0.3);
			color: black; 
		}
		.center{
			text-align: center;
		}
		</style>
		<script> 
			function doValidations(form) {
				let isValid = true; 
				if(!verifyEmail(form)) {
					isValid = false; 
				}
				if(!verifyPasswords(form)){
					isValid = false; 
				}
				return isValid; 
			}
			function verifyEmail(form) {
				let ee = document.getElementById("email_error");
				if(form.email.value.trim().length == 0){
					ee.innerText = "Please enter an email address";
					return false; 
				}
				else{
					ee.innerText == "";
					return true; 
				}
			}
			function verifyPasswords(form) {
				let pe = document.getElementById("password_error")
				if(form.password.value.length == 0 || form.confirm.value.length == 0){
					//alert("you must enter a password and confirmation password");
					pe.innerText = "You must enter a password and confirmation password";
					return false; 
				}
				if(form.password.value != form.confirm.value) {
					//alert("uhh you made a typo");
					pe.innerText = "Passwords don't match, please try again"; 
					return false;
				}
				pe.innerText = "";
				return true;
			} 		
							
		</script>
	</head>
	<body onload="findFormsOnLoad();">
		<!-- This is how you comment -->
		<form name="regform" id="myForm" method="POST"
				onsubmit="return doValidations(this)">
		
		<div class="center">
		<p>
		<br>
			<label for="email">Email: </label> <br>
			<input type="email" id="email" name="email" placeholder=
			"Enter email"/> <br> 
			<span id="email_error"></span> 
		
		<br>
			<label for="pass">Password: </label> <br>
			<input type="password" name="password" placeholder=
			"Enter password"/> <br>
		
		<br>
			<label for="conf">Confirm Password: </label> <br>
			<input type="password" id="conf" name="confirm"/> <br>
			<span id="password_error"></span> 
		
		   
			<div>&nbsp;</div>
			<input type="submit" value="Let's get started!"/>
		</p>
		</div>	
		
			
		</form>
		<?php if(isset($msg)):?>
			<span><?php echo $msg;?></span> 
		<?php endif;?>
	</body>
</html>
<?php 

if(!empty($_REQUEST)){
	echo "Request:<pre>" . var_export($_REQUEST, true) . "</pre>";
}
if(!empty($_GET)){
	echo "GET:<pre>" . var_export($_GET, true) . "</pre>";
}
if(!empty($_POST)){
	echo "POST:<pre>" . var_export($_POST, true) . "</pre>";
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['email']) 
	&& isset($_POST['password'])
	&& isset($_POST['confirm'])){ //start if checking form variables 
	$pass = $_POST['password'];
	$conf = $_POST['confirm'];
	if($pass != $conf){ //start if for comparing passwords
		//echo "All good, 'registering user'";
		$msg = "The passwords don't match";
	} //endif for comparing passwords 
	else{
		//echo "What's wrong with you? Learn to type";
		//exit();
		$msg = "You are now registered!"; 
	
	$pass = password_hash($pass, PASSWORD_BCRYPT);
	echo "<br>$pass<br>"; 
	require("config.php");
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("INSERT INTO `Users`
                        (email, password) VALUES
                        (:email, :password)"
			);
	$email = $_POST['email'];
	$params = array(":email"=> $email, ":password"=> $pass);
        $stmt->execute($params);
	echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";

	} 

	catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}

}//endif checking form variables 
?>

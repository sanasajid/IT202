<?php 
session_start();
$poll_id = -1;
	if(isset($_GET['poll_id'])){
		$poll_id = $_GET['poll_id'];
	}
	else{
		echo "<br>Poll ID not set in URL; line 8 in file<br>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	 <meta charset="UTF-8">
            <link rel="stylesheet" href="css/style.css">
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}

.column {
  float: right;
  width: 25%;
  padding-right: 10px;
}
.row::after {
  content: "";
  clear: both;
  display: table;
  
}
.text-block {
  position: center;
  color: black;
  padding-left: 20px;
  padding-right: 1px;
}

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


img {
  float:none; 
  border-radius: 50%;
}

p{
  font-family: Comic Sans MS, cursive, sans-serif;
  font-size: 350%;
  text-align: center;
  padding-top: .25mm; 
}

.center{
	text-align: center;  
}
</style>
<body>
<ul>
  <li><a href="https://web.njit.edu/~ss3968/IT202/Polls/login.php">Log in</a></li>
  <li><a href="https://web.njit.edu/~ss3968/IT202/Polls/register.php">Register</a></li>
  <li style="float:right"><a href="https://web.njit.edu/~ss3968/IT202/Polls/profile.php">My Profile</a></li>
</ul>

<p> <img src="anothermonkey.jpg" height= "80" width= "80" style="vertical-align:middle">poll monkey</p


            <div class="container">
        
                <form method="post">
                    <textarea placeholder='Add Your Comment' name="comment"></textarea>
                    <div class="btn">
                        <input type="submit" name="submit" value='Comment'>
                        <button id='clear'>Cancel</button>
                    </div>
                </form>
            </div>
	<script src='plugin.js'></script>  
  
 </body>
</head>

</html>

<?php

require("config.php");
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	$db = new PDO($connection_string, $dbuser, $dbpass);
	if(isset($_POST['submit'])){
		
	$comment = $_POST['comment']; 
	$sql = "INSERT INTO Comments (comments_string, poll_id) VALUES (:comment, :poll_id)";
	$params = array(":comment" =>$comment, ":poll_id" =>$poll_id);
	$stmt = $db->prepare($sql);
	$r = $stmt->execute($params);
	//echo var_export($stmt->errorInfo(), true);
	echo "<br>Comment submitted and inserted, must SELECT from comments table to display; line 140<br>";
	echo $comment; 
}
	
if(isset($_POST['answerPoll'])){
	$poll_id = -1;
	$answer_id = -1;
	$user_id = -1; 
	if(isset($_POST['poll_id'])){
		$poll_id = $_POST['poll_id'];
	}
	else{
		echo "<br>Form submitted without poll_id; line 146<br>";
	}
	if(isset($_POST['answer'])){
		$answer_id = $_POST['answer'];
	}
	else{
		echo "<br>Form submitted without answer; line 152<br>";
	}
	
	if(isset($_SESSION['user']) && isset($_SESSION['user']['id'])){
		$user_id = $_SESSION['user']['id'];
	}
	else{
		echo "<br>User isn't logged in or couldn't find user id from session; line 162<br>";
	}
	if($user_id > -1 && $poll_id > -1 && $answer_id > -1){
		$stmt = $db->prepare("INSERT INTO Responses (poll_id, answer_id, user_id) VALUES(:poll_id, :answer_id, :user_id)");
			$stmt->execute(array(":poll_id"=>$poll_id, ":answer_id"=>$answer_id, ":user_id"=>$user_id));
		echo "<br>Response Error info: " . var_export($stmt->errorInfo(), true) . "<br>";
	}
	else{
		echo "<br>Missing one of the required values for the submission; line 171<br>";
	}	

}
	
if($poll_id > -1){
	//require_once("config.php");
	//$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	//$db = new PDO($connection_string, $dbuser, $dbpass);
	//$poll_id = $_GET['poll_id'];
	$stmt = $db->prepare("SELECT * FROM Questions WHERE poll_id = :poll_id AND is_approved = 1");
	$stmt->execute(array(":poll_id"=>$poll_id));
	$question_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//echo "<pre>" . var_export($results, true) . "</pre>";
	$stmt = $db->prepare("SELECT * FROM Answers WHERE poll_id = :poll_id");
	$stmt->execute(array(":poll_id"=>$poll_id));
	$answer_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//echo "<pre>" . var_export($results, true) . "</pre>";
        
}		
// "SELECT answer_id, COUNT(user_id) as total FROM Responses where poll_id=:poll_id GROUP BY answer_id ORDER BY total DESC"


?>
<?php if(isset($question_results)): ?>
<?php foreach($question_results as $result):?>
<div>
<label> <?php echo $result['question_text']?> </label>
</div>
<?php endforeach; ?>
<?php endif; ?>

<form id="answer_form" method="POST">

<?php if(isset($answer_results)): ?>
<?php foreach($answer_results as $result):?>
<div>
<label> <?php echo $result['answer_text']?> </label>
<input type="radio" name="answer" 
value="<?php echo $result['id']?>" />
</div>
<?php endforeach; ?>
<?php endif; ?>
	<input name="poll_id" type="hidden" value="<?php echo $_GET['poll_id']?>"/>=
	<input type="submit" value="answer" name="answerPoll"/>
</form>
	
    
    

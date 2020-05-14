<html>
	<head>
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
		.center{
			text-align: center;
			padding-top: 15px;
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

	</style>
	
	</head>
<body>

<ul>
  <li><a href="https://web.njit.edu/~ss3968/IT202/Polls/login.php">Log in</a></li>
  <li><a href="https://web.njit.edu/~ss3968/IT202/Polls/register.php">Register</a></li>
  <li style="float:right"><a href="https://web.njit.edu/~ss3968/IT202/Polls/profile.php">My Profile</a></li>
</ul>

<p> <img src="anothermonkey.jpg" height= "80" width= "80" style="vertical-align:middle">poll monkey</p


</body>
</html>

<?php
//add_question.php

//must be admin
//if(!empty($_SESSION['user']['role_id'] != 'admin')){ header("Location: main.php");}
//$user_id = $_SESSION['user']['id'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);

session_start();
$user_id = -1;  
if(isset($_SESSION['user']) && isset($_SESSION['user']['id'])){
	$user_id = $_SESSION['user']['id'];
}
if($user_id == -1){
	die(header("Location:login.php"));
}


/* if(isset($_POST['submit'])){
	$user_id = 1; */

//must be logged in
//if(!isset($_SESSION['user'])){ header("Location: login.php");}

//Step 1: fetch data
if(isset($_POST['submit'])){
$question = $_POST['question_text'];
$answers = $_POST['answer_text'];//this will be an array
$category = $_POST['category'];

//Step 2: find highest poll id so we can inc by 1
$answerBundleId= -1;
//TODO get latest bundle id
$sql_get_bundle_id = "SELECT MAX(poll_id) as newid from Questions";
$stmt = $db->prepare($sql_get_bundle_id);
$stmt->execute();
$answerBundleId = (int)$stmt->fetch(PDO::FETCH_ASSOC)["newid"];
$answerBundleId += 1;

//Step 3: extract answers and prepare dynamic query
//TODO prepare and insert answers
$answer_sql = "INSERT INTO Answers (user_id, answer_text, poll_id) VALUES";
$i =0;
//build sql dynamically
foreach($answers as $answer){
	if($i > 0){
		$answer_sql .= ",";
	}
	$answer_sql .= " (:user_id, :answer$i, :poll_id)";
	$i++;
}

$answer_sql .= "";
//TODO Left here for reference, remove later
//echo "<pre>" . $answer_sql . "</pre>";
$stmt = $db->prepare($answer_sql);
//these can be out of the loop because we only need to set them once
$stmt->bindValue(":user_id", $user_id);
$stmt->bindValue(":poll_id", $answerBundleId);
$i =0;
foreach($answers as $answer){
	//need a second loop since we prepare query first, then we need the $stmt ref for bindvalue
	$stmt->bindValue(":answer$i", $answer);
	$i++;
}
$stmt->execute();
$recordId = $db->lastInsertId();
//Step 4: Tell question table about answer table's new bundle and record question
//don't know if we need the above or just $answerBundleId
//TODO insert new question referring to new answer bundle
$stmt = $db->prepare("INSERT INTO Questions(poll_id, question_text, user_id,category) 
VALUES (:answer_id, :question_text, :user_id, :category)");
$stmt->execute(array(":answer_id"=>$answerBundleId, ":question_text"=>$question, ":user_id"=>$user_id, ":category"=>$category));
//echo var_export($stmt->errorInfo(), true);
echo "Submitted for approval";
}

?>
<form method="POST">
		<input name="question_text" type="text" placeholder="What do you want to ask?"/> 
		<input name="answer_text[]" type="text" placeholder="Potential answer 1"/> 
		<input name="answer_text[]" type="text" placeholder="Potential answer 2"/>
		<input name="answer_text[]" type="text" placeholder="Potential answer 3"/>
		<input name="category" type="text" placeholder="category"/>
		<input type="submit" value="Ask Away" name="submit"/>
</form>




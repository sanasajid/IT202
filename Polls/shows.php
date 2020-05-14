<?php 
$poll_id = $_GET['poll_id'];
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

if(isset($_POST['submit'])){

require("config.php");
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$comment = $_POST['comment']; 
	$sql = "INSERT INTO Comments (comments_string, poll_id) VALUES (:comment, :poll_id)";
	$params = array(":comment" =>$comment, ":poll_id" =>$poll_id);
	$stmt = $db->prepare($sql);
	$r = $stmt->execute($params);
	//echo var_export($stmt->errorInfo(), true);
	echo $comment; 
	
	
	
}

	
    
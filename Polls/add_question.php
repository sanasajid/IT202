<?php
//add_question.php

//must be logged in
if(!isset($_SESSION['user_id'])){ header("Location: login.php");}
//must be admin
if(!empty($_SESSION['user_id']['role_id'] != 'admin')){ header("Location: main.php");}

$user_id = $_SESSION['user_id']['id'];

if(isset($_POST['submit'])){
	$question = $_POST['q'];
	$answers = $_POST['a'];//this will be an array
	$sql = "INSERT INTO Questions (question, answers) VALUES ($answers)";
	$i = 0;
	$params = array();
	foreach ($answers as $a){
		if($i > 2){
			$sql .= ",";
		}
	//prepare placeholders
	$sql .= "(:q, :a$i)";
	//push values to our params array
	array_push($params, array(":q"=>$question, ":a$i"=> $a));
		$i++;
	}
	$sql .= "";
	$stmt = $db->prepare($sql);
	$r = $stmt->execute($params);
}

?>
<form method="POST">
<input name="q" type="text" placeholder="What are you gonna ask?"/>
<input name="a[]" type="text" placeholder="Potential answer 1"/>
<input name="a[]" type="text" placeholder="Potential answer 2"/>
<input name="a[]" type="text" placeholder="Potential answer 3"/>
<input type="submit" value="Ask Away" name="submit"/>
</form>

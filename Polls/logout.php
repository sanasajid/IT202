<?php 
session_start();
session_unset();
session_destroy();

//echo "Come back soon!";

//echo var_export($_SESSION, true);
//get session cookie and delete/clear it for this session
if(ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	//clones then destroys since it makes its lifetime 
	//negative (in the past) 
	setcookie(session_name(), '',time() - 4200,
		$params["path"],$params["domain"],
		$params["secure"],$params["httponly"]
	);
}
?>

<html>
<head>
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


<div class="center">
	<p>Logged out, come back soon!</p>
</div>
</body>
</html> 

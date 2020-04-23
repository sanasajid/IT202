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
	<p>My Profile</p>

<div class="left">
       	<div class="text-block"> 
	<a href="https://web.njit.edu/~ss3968/IT202/Polls/logout.php">Log Out</a>
    	</div>
<div class="left">
       	<div class="text-block"> 
	<a href="https://web.njit.edu/~ss3968/IT202/Polls/main.php">Home Page</a>
    	</div>
</div>
</body>
</html>



<form method="POST">
<input name="q" type="text" placeholder="What do you want to ask?"/>
<input name="a[]" type="text" placeholder="option 1"/>
<input name="a[]" type="text" placeholder="option 2"/>
<input type="submit" value="Ask Away" name="submit"/>
</form>

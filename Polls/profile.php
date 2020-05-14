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

<div class="center">
	<h1>My Profile</h1>
</div>
<div class="left">
	<div class="text-block">
	<a href="https://web.njit.edu/~ss3968/IT202/Polls/add_question.php">Submit a poll</a>
	</div>
<div class="reset">
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
			
			<label for="newpass">Reset password: </label> <br>
			<input type="password" name="reset" placeholder=
			"New Password"/> <br>



</div>
</body>
</html>


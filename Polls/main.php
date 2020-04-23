<!DOCTYPE html>
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
/*p.b {
  font-family: Comic Sans MS, cursive, sans-serif;
  font-size: 350%;
  text-align: center;
  padding-top: 20px; 
}
*/
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
<!-- <p class="b">poll monkey</p> -->
<!-- <img src="anothermonkey.jpg" height= "80" width= "80"/> -->

<ul>
  <li><a href="https://web.njit.edu/~ss3968/IT202/Polls/login.php">Log in</a></li>
  <li><a href="https://web.njit.edu/~ss3968/IT202/Polls/register.php">Register</a></li>
  <li style="float:right"><a href="https://web.njit.edu/~ss3968/IT202/Polls/profile.php">My Profile</a></li>
</ul>

<div class="center">
	<form name="form1" method="post" action="searchresults.php">
		<input name="search" type="text" size="40" maxlength="50"/> 
		<input type="submit" name="Submit" value="Search"/>
	</form>

</div>

<p> <img src="anothermonkey.jpg" height= "80" width= "80" style="vertical-align:middle">poll monkey</p

<div class="row">

  <div class="column">
    <img src="friendsdiff.jpg" alt="TV shows" style="width:60%"> 
    	<div class="text-block"> 
	<a href="https://web.njit.edu/~ss3968/IT202/Polls/shows.php">TV SHOWS</a>
    	</div>
  </div>

  <div class="column">
    <img src="food.jpg" alt="Food" style="width:70%">
    	<div class="text-block">
    	<a href="https://web.njit.edu/~ss3968/IT202/Polls/food.php">FOOD</a>
    	</div>
  </div>

  <div class="column">
    <img src="billboard.jpg" alt="Music" style="width:60%">
    <div class="text-block">
    	<a href="https://web.njit.edu/~ss3968/IT202/Polls/music.php">MUSIC</a>
    	</div>
  </div>

</div>

</body>
</html> 

<html>
<head>
<style>

.column {
  float: left;
  width: 25%;
  padding: 70px;
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
	background-image: url('https://media.giphy.com/media/Cv7wrQjYcd6hO/giphy.gif');
	color: black; 
}

.center{
	text-align: center;  
}
</style>
</head>
<body> 

<div class="center">
	<form name="form1" method="post" action="searchresults.php">
		<input name="search" type="text" size="40" maxlength="50"/> 
		<input type="submit" name="Submit" value="Search"/>
	</form>

</div>

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

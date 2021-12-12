<?php session_start();?> 
<link rel = "stylesheet" href="style.css">
<link rel = "stylesheet" href = "style2.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poiret+One">
	<div id = "nav">
	<ul>
	<li><a href = index.php>Home</a></li>
	<li><div class = "dropdown">
		<button class = "dropbtn">Rate</button>
		<div class = "dropdown-content">
		<a href = "rateteacher.php">Rate Teacher</a>
		<a href = "rateclass.php">Rate Class</a>	
		</div>
		</div></li>
	<li><a href = "transcript.php">Transcript</a></li>
	<li><a href = "classes.php">Classes</a></li>
	<?php $user = $_SESSION['user'];
    if(isset($_SESSION['user'])){
		 $username = $_SESSION["user"];
		 $userid = getUserIDUsername($username);
		 //echo $userid;
		 //echo "<h3>Hey $username!</h3>";
		?>
  <li><a href = "logout.php">Log Out</a></li>
		<?php }else{ ?>
	 <li><a href = "login.php">Log In</a></li>	
		<?php } ?>
	</ul>
	<h1>Title</h1>	
</div>
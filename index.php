<?php
session_start();
include('functions.php');
include('header.php');
?>
<!DOCTYPE html>
<?php if(isset($_SESSION['user'])){
	include('transcript.php');}else{
	?>
<html>
<head>
	<title>Class Central</title>	
</head>
<body>
	<div id="index">
		<div class="box">
			<p>Our program will help students with their scheduling problems, and help ease the burden placed on busy counselors. With our program, students will be able to see what classes they need to take in order to graduate, view other student's ratings of classes and teachers, and rate the classes and teachers that they have. The program will help students get a clearer idea of what they need to take and what they want to take, which will make their counselor's jobs much easier. </p>
		</div>
		<div class="announcements">
			<p>Our Story: Our names are Hadley, Eva, Fiona, and Margaret, and we are juniors at Wilson High School. The problem related to education that we wanted to address is course scheduling. Our experiences with scheduling our classes in the past have been inefficient, time consuming, and stress-inducing. Our counselors have to deal with 300 students who don't know what's going on, and it makes the whole process very difficult for them, and us. </p>
		</div>
		<div class = "blockphoto">
			<img src="buildingblockbig.png">
		</div>
	</div>
</body>
<footer> Copyright @ Us 2021</footer>
	<?php }?>
</html>
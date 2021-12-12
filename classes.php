<?php
include('header.php');
include('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Title</title>	
</head>
<body>
	<h2>Classes</h2>
	<p>Select all the classes you have passed to create your personalized transcript</p>
	<form name="select_classes" action="select.php" method="post">
		<p class="droptop">Art Classes:</p>
		<?php 
			$art = GetArtClasses($userid);
			if (count($art)>0) {
				ShowArtSelect($ClassName, $ClassID);
			}
		?>
</body>
</html>
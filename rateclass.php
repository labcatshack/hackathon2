<!DOCTYPE html>
<?php
include("functions.php");
?>
<head>
<title>Rate</title>
</head>
<body>
	<?php include("header.php");?>
	<div class = "TeacherForm">
		<!--margaret and fiona work on the inpuyt form-->
	</div>
	<div class = "TeacherRate">
		<p>add your own rating <a href = "classform.php">here!</a></p>
		<h1>Overall Classes</h1>
		<?php
		$ratings = getClassRatings();
		//print_r($ratings);
		//class ratings as a whole
		foreach($ratings as $rating){
			list($classid, $classname, $academyid, $credits, $ap, $honors, $classrating, $gradereq) = $rating;
			if ($classrating != 0){
				echo "<div class = 'rating'>";
				echo "<h3>".$classname."</h3>";
				if($ap == 1){
					echo "<p>AP Class</p>";
				}
				if($honors == 1){
					echo "<p>Honors</p>";
				}
			  if($gradereq = 1){
					echo "<p>Graduation Requirement: ".$credits." credits</p>";
				echo "<h2>Rating: ".$classrating."/10<h2>";
				echo "</div>";
				}
			}	
		}
		?>
	</div>
</body>
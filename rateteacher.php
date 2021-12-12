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
		<h1>Overall Teachers</h1>
		<p>Add your own rating <a href = "teacherform.php">here!</a></p>
		<?php
		$tratings = getTeacherRating();
		print_r($ratings);
		echo "<div class = 'ratingsbox'>";
		foreach($tratings as $trating){
			list($teacherid, $teacher, $rating, $academy, $tcategoryid) = $trating;
			//echo $tcategoryid;
			if ($rating != 0){
				echo "<div class = 'rating'>";
					echo "<h3>".$teacher."</h3>";
					if($academy != 0){
						list($academyid, $academyname, $description) = getAcademyInfo($academy);
						echo "<p>".$academyname."</p>";
					}
				if($tcategoryid != 0){
					list($categoryid, $category) = getCategoryInfo($tcategoryid);
					echo $category." teacher";
				}
		  echo "<h2>Rating: ". $rating."/5</h2>";
			echo "</div>";
			}
		}
		?>
	</div>
	</div>
</body>
</html>
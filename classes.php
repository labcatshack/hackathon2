<?php
session_start();
include('functions.php');
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Title</title>	
</head>
<body>
	<h2>Classes</h2>
	<p>Select all the classes you have passed to create your personalized transcript</p>
  <?php
	$classids = array();
	if (isset($_POST['submit'])){
			//echo "hello";
			if(!empty($_POST['Class'])){;
			 	foreach($_POST['Class'] as $id){
				//echo $id;
				array_push($classids, $id);
				//array_push($quizids, $id);
			  //return $quizids;
				//$_SESSION["QuizIds"] = $quizids;
			 }
			}	
		}
	foreach($classids as $classid){
 		$sql = "INSERT INTO CompletedClasses(CompClassID, ClassID, UserID) VALUES(NULL, '$classid', '$userid')";
		//echo $sql;
		$result = runQuery($sql);
		//insert classes with user id
		//transcript + graduation progress
	}
	?>
	<form name="select_classes" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
			<div class = 'tform'>
		<!--<p class="droptop">Art Classes:</p>-->
		<?php 
			/*$art = GetArtClasses($userid);
			if (count($art)>0) {
				ShowArtSelect($ClassName, $ClassID);
			}*/
		$categories = getAllCategories();
		foreach($categories as $category){
			echo "<div class = 'categorybox'>";
			list($categoryid, $categoryname) = $category;
			echo "<h3> $categoryname </h3>";
			$classes = getClassesCategory($categoryid);
			foreach($classes as $class){
				list($classid, $classname, $academyid, $credits, $ap, $honors, $classrating, $gradereq) = $class;
				echo "<input type = 'checkbox' name = 'Class[]' value = '$classid' id = '$classid'>$classname</input><br>";
			}
			echo "</div>";
		}
		?>
		</div>
				<input type = "submit" value = "submit" name = "submit" class = "submitbutton"></input>
	</form>
</body>
</html>
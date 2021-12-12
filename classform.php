<?php session_start();
include('functions.php');
//refresh on category
//choose teacher/
//chose number
?>
<!DOCTYPE html>
<head>
	<title>Rate Your Teacher</title>
</head>
<body>
<?php include("header.php");?>
<script>
	function refresh_my_page(){
		//alert("hello");
		var Category = document.getElementById('Category').value;
		//alert(Category);
		window.location = "classform.php?CategoryID="+Category;
	}

</script>
	<?php $currenturl=$_SERVER['REQUEST_URI'];
	$url_components=parse_url($currenturl);
	parse_str($url_components['query'], $params);
	$formcategoryid = $params['CategoryID'];
	?>
	<div class = 'overallform'>
		<h1>Select a category to begin ranking classes!</h1>
	 <form method="get" name = "LoginForm" action = "processdate.php?CategoryID=<?php echo $formcategoryid;?>">
		<?php $categorys = getAllCategories();
		 ?>
		<select name = "Categories" id = "Category" onchange = "refresh_my_page()">
			<option value = "select">Select One</option>
			<?php
			foreach ($categorys as $category){
			list($categoryid, $categoryname) = $category;
			?>
			<option value = "<?php echo $categoryid; ?>"><?php echo $categoryname;?></option>
			<?php } ?>
		 </select>
		 <div class = "classratingbox">
		 <?php 
		 if($formcategoryid){
			 $classes = getClassesCategory($formcategoryid);
			 foreach($classes as $class){
				 list($classid, $classname, $academyid, $credits, $ap, $honors, $classrating, $gradereq) = $class; 
				 ?>
		  <div class = "classrating">
				<h2><?php echo $classname; ?></h2>
		 	<?php echo "<td class='center'>";
				echo "<a href='processdate.php?classid=$classid&userid=$userid&rating=1'><i class='fas fa-apple-alt'></i></a>";
				echo "<a href='processdate.php?classid=$classid&userid=$userid&rating=2'><i class='fas fa-apple-alt'></i></a>";
				echo "<a href='processdate.php?classid=$classid&userid=$userid&rating=3'><i class='fas fa-apple-alt'></i></a>";
				echo "<a href='processdate.php?classid=$classid&userid=$userid&rating=4'><i class='fas fa-apple-alt'></i></a>";
				echo "<a href='processdate.php?classid=$classid&userid=$userid&rating=5'><i class='fas fa-apple-alt'></i></a>";
        echo "</td>"; ?>
				<p>Current Class Rating:<?php echo $classrating;?>/5</p>
				<?php if($ap == 1){
					 echo "<p>AP Class</p>";
				 }
				 if($honors == 1){
					 echo "<p>Honors Class</p>";
				 }
				 if($academyid != 0){
					 list($academyid, $academyname, $description) = getAcademyInfo($academyid);
					 echo "<p> $academyname </p>";
				 }
				 ?>
			 </div>
			 <?php }
		 }?>
		 </div>
	</form>
	</div>
</body>
</html>
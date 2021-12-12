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
		window.location = "teacherform.php?CategoryID="+Category;
	}

</script>
	<?php $currenturl=$_SERVER['REQUEST_URI'];
	$url_components=parse_url($currenturl);
	parse_str($url_components['query'], $params);
	$formcategoryid = $params['CategoryID'];
	$msg = $params['msg'];
	//echo $formcategoryid;
	if ($msg == 1){
		echo "<p class = 'updatemsg'>your rating has been updated, select a category to rate again!</p>";
	}else{
		echo "<p class = 'updatemsg'>select a category to begin rating!</p>";
	}
	?>
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
			 $teachers = getTeachersCategory($formcategoryid);
			 foreach($teachers as $teacher){
				 list($teacherid, $teachername, $rating, $academyid, $categoryid) = $teacher; 
				 ?>
		  <div class = "classrating">
				<h2><?php echo $teachername; ?></h2>
		 	<?php echo "<td class='center'>";
				echo "<a href='processdate.php?teacherid=$teacherid&userid=$userid&rating=1'><i class='fas fa-apple-alt'></i></a>";
				echo "<a href='processdate.php?teacherid=$teacherid&userid=$userid&rating=2'><i class='fas fa-apple-alt'></i></a>";
				echo "<a href='processdate.php?teacherid=$teacherid&userid=$userid&rating=3'><i class='fas fa-apple-alt'></i></a>";
				echo "<a href='processdate.php?teacherid=$teacherid&userid=$userid&rating=4'><i class='fas fa-apple-alt'></i></a>";
				echo "<a href='processdate.php?teacherid=$teacherid&userid=$userid&rating=5'><i class='fas fa-apple-alt'></i></a>";
        echo "</td>"; ?>
				<p>Current Class Rating:<?php echo $rating;?>/10</p>
				<?php 
				 if($academyid != 0){
					 list($academyid, $academyname, $description) = getAcademyInfo($academyid);
					 echo "<p> $academyname teacher </p>";
				 }
				 ?>
			 </div>
			 <?php }
		 }?>
		 </div>
	</form>
</body>
</html>
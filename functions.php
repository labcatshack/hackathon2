<?php

function connect_db() {
  $server = 'localhost';
  $user = 'wibstuff_hack';
  $pwd = 'H@ckath0n';
  $db = 'wibstuff_hackathon';
  $conn = new mysqli($server, $user, $pwd, $db);
  if ($conn->connect_error) {
    return false;
  }
  else {
  	return $conn;
  }
}

function checkLogin($username, $password){
  $conn = connect_db();
	//echo $password;
  $checkloginsql = "SELECT Password FROM User WHERE Username = '".$username."'";
	//echo $checkloginsql."<br>";
  $result = $conn->query($checkloginsql);
  if($result){
    $row = $result->fetch_row();
    $dbpass = $row[0];
		//echo "pass is $password and hashed is $dbpass<br>";
    if(password_verify($password, $dbpass)){
		//	echo "true";
      return True;
    }else{
			//echo "fale";
      return False;
    }
  }
}

function clean_input($str){
  $conn = connect_db();
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    $str = $conn->real_escape_string($str);
	$conn->close();
  return $str;  
}

function UsernameExists($username){
  $conn = connect_db();
	//echo "hello";
  $sqlusercount = "SELECT COUNT(*) from User where Username = '$username'";  
  $count = mysqli_fetch_array(mysqli_query($conn, $sqlusercount));
  if ($count[0]>0){
		//echo "exists";
    return True;
  }else{
		//echo "dna";
    return False;
  }
}

function runQuery($sql){
  $conn = connect_db();
  $result = $conn->query($sql);
  //echo "your halfway through the query";
  if($result){
    //echo "before result";
		//print_r($result);
    return $result;
  }else{
    die("Sorry, we could not run the query.");
    //echo "are you dead";
  }
}

function getClassRatings(){
	$rclasses = array();
	$sql = "SELECT ClassID, ClassName, AcademyID, Credits, AP, Honors, ClassRating, GradRequirement FROM Classes";
	//echo $sql;
	$result = runQuery($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_array()){
			$classid = $row["ClassID"];
			$classname = $row["ClassName"];
			$academyid = $row["AcademyID"];
			$credits = $row["Credits"];
			$ap = $row["AP"];
			$honors = $row["Honors"];
			$classrating = $row["ClassRating"];
			$gradereq = $row["GradRequirement"];
			array_push($rclasses, array($classid, $classname, $academyid, $credits, $ap, $honors, $classrating, $gradereq));
		}
	}
	return $rclasses;
}

function getTeacherInfo($teacherid){
	$sql = "SELECT TeacherID, Teacher, TeacherRating, AcademyID, CategoryID FROM Teacher WHERE TeacherID = '".$teacherid."'";
  $result = runQuery($sql);
	if($result->num_rows>0){
		if($row = $result->fetch_array()){
			$teacherid = $row["TeacherID"];
			$teacher = $row["Teacher"];
			$rating = $row["TeacherRating"];
			$academy = $row["AcademyID"];
			$category = $row["CategoryID"];
		}
	}
	return array($teacherid, $teacher, $rating, $rating, $academy, $category);
}

function getClassInfo($classid){
$sql = "SELECT ClassID, ClassName, AcademyID, Credits, AP, Honors, ClassRating, GradRequirement FROM Classes WHERE ClassID = '".$classid."'";
  $result = runQuery($sql);
	if($result->num_rows>0){
		if($row = $result->fetch_array()){
			$classid = $row["ClassID"];
			$classname = $row["ClassName"];
			$academyid = $row["AcademyID"];
			$credits = $row["Credits"];
			$ap = $row["AP"];
			$honors = $row["Honors"];
			$classrating = $row["ClassRating"];
			$gradreq = $row["GradRequirement"];
		}
	}
	return array($classid, $classname, $academyid, $credits, $ap, $honors, $classrating, $gradereq);
}

function getAcademyInfo($academyid){
	$sql = "SELECT AcademyID, Academy, Description FROM Academy WHERE AcademyID = '".$academyid."'";
  $result = runQuery($sql);
	if($result->num_rows>0){
		if($row = $result->fetch_array()){
			$academyid = $row["AcademyID"];
			$academyname = $row["Academy"];
			$description = $row["Description"];
		}
	}
	return array($academyid, $academyname, $description);
}

function getCategoryInfo($categoryid){
	$sql = "SELECT CategoryID, Category FROM Category WHERE CategoryID = '".$categoryid."'";
  $result = runQuery($sql);
	if($result->num_rows>0){
		if($row = $result->fetch_array()){
			$categoryid = $row["CategoryID"];
			$category = $row["Category"];
		}
	}
	return array($categoryid, $category);
}

function getTeacherRating(){
	$tratings = array();
	$sql = "SELECT TeacherID, Teacher, TeacherRating, AcademyID, CategoryID FROM Teacher";
	//echo $sql;
	$result = runQuery($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_array()){
			$teacherid = $row["TeacherID"];
			$teacher = $row["Teacher"];
			$rating = $row["TeacherRating"];
			$academy = $row["AcademyID"];
			$category = $row["CategoryID"];
			array_push($tratings, array($teacherid, $teacher, $rating, $academy, $category));
		}
	return $tratings;
	}
}

function getAllCategories(){
	$categories = array();
	$sql = "SELECT CategoryID, Category FROM Category";
	//echo $sql;
	$result = runQuery($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_array()){
			$categoryid = $row["CategoryID"];
			$categoryname = $row["Category"];
			array_push($categories, array($categoryid, $categoryname));
		}
		return $categories;
	}
}

function GetArtClasses($userid) {
	$conn = connect_db();
	$artsql = "SELECT ClassID, ClassName FROM Classes WHERE CategoryID = 8";
	$artresult = runQuery($artsql);
	$art = array();
	if ($artresult -> num_rows >0) {
		while ($artrow = $artresult -> fetch_array()) {
			$art[$artrow['ClassID']] = $artrow['ClassName'];
		}
	}
	return $art;
}

function ShowArtSelect($ClassName, $ClassID) {
	echo "<select name='assign_art'>";
	echo "<option value=0>Select Art Classes</option>";
	foreach ($rt as $key=>$value){ 
		if ($key == $ClassID){
			echo "<option value='$key' selected>$value</option>";
		}
		else {?>
			<option value="<?php echo $key; ?>"><?php echo $value;?></option>
		<?php
			}
	}
	echo "</select>";
}

function getClassesCategory($categoryid){
	$classes = array();
	$sql = "SELECT ClassID, ClassName, AcademyID, Credits, AP, Honors, ClassRating, GradRequirement, CategoryID FROM Classes WHERE CategoryID = '".$categoryid."'";
  $result = runQuery($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_array()){
			$classid = $row["ClassID"];
			$classname = $row["ClassName"];
			$academyid = $row["AcademyID"];
			$credits = $row["Credits"];
			$ap = $row["AP"];
			$honors = $row["Honors"];
			$classrating = $row["ClassRating"];
			$gradreq = $row["GradRequirement"];
			array_push($classes, array($classid, $classname, $academyid, $credits, $ap, $honors, $classrating, $gradereq));
		}
		return $classes;
	}
}

function getUserIDUsername($username){
	$sql = "SELECT UserID FROM User WHERE UserName = '".$username."'";
	$result = runQuery($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_array()){
			$userid = $row["UserID"];
		}
	}
	return $userid;
}

function findAvgClass($classid){
$avgsql = "SELECT AVG(ClassRating) as AVG FROM ClassRatings WHERE ClassID = '".$classid."'";
//echo $avgsql;
$avgresult = runQuery($avgsql);
if($avgresult->num_rows>0){
	while($row = $avgresult->fetch_array()){
	 $avg = $row["AVG"];
	}
}
return $avg;
}

function getTeachersCategory($categoryid){
	$teachers = array();
	$sql = "SELECT TeacherID, Teacher, TeacherRating, AcademyID, CategoryID FROM Teacher WHERE CategoryID = '".$categoryid."'";
	//echo $sql;
	$result = runQuery($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_array()){
			$teacherid = $row["TeacherID"];
			$teacher = $row["Teacher"];
			$rating = $row["TeacherRating"];
			$academyid = $row["AcademyID"];
			$categoryid = $row["CategoryID"];
			array_push($teachers, array($teacherid, $teacher, $rating, $academyid, $categoryid));
		}
	}
 return $teachers;
}
?>
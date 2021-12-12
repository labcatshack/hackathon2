<?php
session_start();
include('functions.php');
include('header.php');
$classid = 	$_GET['classid'];
$teacherid = $_GET['teacherid'];
$userID = $_GET['userid'];
$rating = $_GET['rating'];
if($classid){
$sql = "INSERT INTO ClassRatings(ClassRating, UserID, ClassID) VALUES ('$rating', '$userid', '$classid')";
$result = runQuery($sql);
if($result){
$avg = findAvgClass($classid);
$roundedavg = round($avg, 2);
$updatesql = "UPDATE Classes SET ClassRating = '".$roundedavg."' WHERE ClassID = '".$classid."'";
$updateresult = runQuery($updatesql);
if($updateresult){
echo "<script type='text/javascript'>window.top.location='rateclass.php';</script>";
}
}
}
if($teacherid){
	//echo "hello";
	$sql = "INSERT INTO TeacherRatings(TeacherRatingID, TeacherID, UserID, TeacherRating) VALUES (NULL, '$teacherid', '$userid', '$rating')";
	//echo $sql;
$result = runQuery($sql);
if($result){
$avg = findAvgTeacher($teacherid);
$roundedavg = round($avg, 2);
$updatesql = "UPDATE Teacher SET TeacherRating = '".$roundedavg."' WHERE TeacherID = '".$teacherid."'";
$updateresult = runQuery($updatesql);
if($updateresult){
	echo "hello";
echo "<script type='text/javascript'>window.top.location='rateteacher.php';</script>";
}
}
}
?>
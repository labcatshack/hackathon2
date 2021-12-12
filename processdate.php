<?php
session_start();
include('functions.php');
include('header.php');
$classid = 	$_GET['classid'];
$userID = $_GET['userid'];
$rating = $_GET['rating'];

$sql = "INSERT INTO ClassRatings(ClassRating, UserID, ClassID) VALUES ('$rating', '$userid', '$classid')";
$result = runQuery($sql);
if($result){
$avg = findAvgClass($classid);
$roundedavg = round($avg);
$updatesql = "UPDATE Classes SET ClassRating = '".$roundedavg."' WHERE ClassID = '".$classid."'";
$updateresult = runQuery($updatesql);
if($updateresult){
echo "<script type='text/javascript'>window.top.location='classform.php?msg=1';</script>";
}
}
?>
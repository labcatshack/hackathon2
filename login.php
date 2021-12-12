<!DOCTYPE html>
<?php include
	('functions.php');
?>
<head>
	<title>Log In</title>
</head>
<body>
	<?php include ('header.php');?>
	<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $valid = True;
    $err_msg = "";
    $username = clean_input($_POST['Username']);
    $password = clean_input($_POST['Password']);
    $valid = checkLogin($username, $password);
	if($valid){
    $_SESSION["user"] = "$username";
		echo  "<script type='text/javascript'>window.top.location='http://wibstuff.com/hackathon2/index.php';</script>"; exit;
  }else{
    $err_msg = "Your login information was not correct. Please try again or create a new account.";
  }
}
  ?>
    <div id="loginform">
      <h2 class="loginheader">Have an Account? Welcome Back! </h2>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" name = "LoginForm" onsubmit = "return validateForm()">
        <p class="inputp">Username: <input type="text" name="Username" class="inputbutton" value = "<?php echo htmlspecialchars($username);?>" required></p>
        <p class="inputp">Password: <input type="password" name="Password" class="inputbutton" value = "<?php echo htmlspecialchars($password);?>" required></p>
        <br><input type="submit" value="Login" class="submitbutton">
      </form>
          <tr><td class = "errclass"><?php echo $err_msg;?></td></tr>
			<div id = "createlink">
          <a href = "createnewuser.php" class = "connectlink">Don't have an account? Create one here!</a>
			</div>
			
  </div>   
</body>



<!DOCTYPE html>
<head>
	<title>Create An Account</title>
</head>
<?php include
	('functions.php');
?>
<body>
	<?php include ('header.php');?>
  <?php
	connect_db(); 
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = clean_input($_POST['FirstName']);
    $lastname = clean_input($_POST['LastName']);
    $email = clean_input($_POST['Email']);
		$academy = clean_input($_POST['Academy']);
		$gradyear = clean_input($_POST['GradYear']);
    $username = clean_input($_POST['Username']);
    $password = clean_input($_POST['Password']);
		//echo $password;
    $confirmpassword = clean_input($_POST['ConfirmPassword']);
    $username_err = $password_err = "";
    $valid = True;    
		if($academy != "None"){
			$sql = "SELECT AcademyID FROM Academy WHERE Academy LIKE '".$academy."'";
			//echo $sql;
			$academyresult = runQuery($sql);
			if($academyresult->num_rows>0){
        while($row = $academyresult->fetch_array()){
            $academyid = "".$row['AcademyID']."";
       	 }
    	}
		}else{
			$academyid = -1;
		}
		echo $academyid;
    if(UsernameExists($username)){
      $username_err = "Sorry that username already exists. Create a new one or login if it seems familiar!";
      $valid = False;
    }elseif ($password != $confirmpassword){
      $password_err = "Your passwords don't match, silly.";
      $valid = False;
    }
   if($valid){
     $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
		 //echo $hashed_pwd;
     $sql = "INSERT INTO User(UserID, UserName, Password, Email, FirstName, LastName, GradYear, AcademyID) VALUES(NULL, '$username', '$hashed_pwd', '$email','$firstname', '$lastname', '$gradyear', $academyid)";
		 //echo $sql;
     if(runQuery($sql)){
       $_SESSION["user"] = "$username";
      echo "<script type='text/javascript'>window.top.location='http://wibstuff.com/hackathon2/index.php';</script>"; exit;
    
      }
    }
  }                    
?> 
<div id="newuserform">
      <h2 class=loginheader> New User? Welcome!</h2>
      <form action="<?php echo($_SERVER['PHP_SELF']);?>" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit = "return verifyPasswords()" method="post" name="NewUser"> 
        <p class="inputp">First Name: <input type="text" name="FirstName" class="inputbutton" value = "<?php echo htmlspecialchars($firstname);?>" required></p>
        <?php echo $firstname_err;?>
        <p class="inputp">Last Name: <input type="text" name="LastName" class="inputbutton" value = "<?php echo htmlspecialchars($lastname);?>" required></p>
        <?php echo $lastname_err;?>
        <p class="inputp">Email: <input type="email" name="Email" class="inputbutton" value = "<?php echo htmlspecialchars($email);?>" required></p>
        <?php echo $email_err;?>
				<p class="inputp">Username: <input type="text" name="Username" class="inputbutton" value = "<?php echo htmlspecialchars($username);?>" required> </p>
        <?php echo $username_err;?>
				<p class="inputp">GradYear: <input type="text" name="GradYear" class="inputbutton" value = "<?php echo htmlspecialchars($gradyear);?>" required></p>
        <?php echo $gradyear_err;?>
				<p>Academy: <select name ="Academy" value = "<?php echo htmlspecialchars($academy);?>" required>
					<option value = 'None'>None</option>
					<option value = 'Academic Athletic Acheivement'>Academic Athletic Acheivement (AAA)</option>
					<option value = "Academy of Finance">Academy of Finance</option></p>
					<option value = 'Academy of Hospitality and Tourism'>Academy of Hospitality and Tourism</option>
					<option value = "Creative Media Academy">Creative Media Academy</option></p>
					<option value = 'JROTC Leadership Academy'>JROTC Leadership Academy</option>
					<option value = "Engineering">Academy of Engineering</option></p>
					<option value = 'WISP'>Wilson International Studies Program</option>
					<option value = "Academy of Health Sciences">Academy of Health Sciences</option></p>
					<option value = 'Academy of Environmental Science'>Academy of Environmental Science</option>
					<option value = "Academy of Information Technology">Academy of Informational Technology</option></p>
				</select>
        <p class="inputp">New Password: <input type="password" name="Password" class="inputbutton" value = "<?php echo htmlspecialchars($password);?>" required> </p>
        <?php echo $password_err;?>
        <p class="inputp">Confirm Password: <input type="password" name="ConfirmPassword" class="inputbutton" value = "<?php echo htmlspecialchars($confirmpassword);?>" required</p>
        <?php echo $confirmpassword_err;?>
          <br><input type="submit" value="Sign Me Up!" class="submitbutton">
      </form>
  <a href = "login.php" class = "connectlink">Already have an account? Sign in here!</a>
    </div>
  </html>
</body>
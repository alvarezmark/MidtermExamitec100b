<?php
	$Fullname = "localhost";
	$Email = "root";
	$Password="";
	
	$errors = array();
	
	//connect to the database
	$dbConn = mysqli_connect($Fullname,$Email,$Password);
	
	//if the register button is clicked
	if (isset($_POST['fname']) && isset($_POST['email'])
    && isset($_POST['psw'])){		
		function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
		$fullname = validate($_POST['fname']);
		$email = validate($_POST['email']);
		$password = validate($_POST['psw']);
		$user_data = 'fname='. $fullname. '&email='. $email;

		// ensure that form fields are filled properly
		if (empty($Fullname)) {
		header("Location: account.php?error=User Name is required&$user_data");
	    exit();
		
}
	else if(empty($email)){
        header("Location: registration.php?error=Password is required&$user_data");
	    exit();
	}
	
	else if(empty($Password)){
        header("Location: registration.php?error=Name is required&$user_data");
	    exit();
	}
		else if (strlen($Password)<=7){
	header("Location: registration.php?error=Password is atleast 8 characters&$user_data");
	    exit();
}
	else if(!preg_match("#[A-Z]+#",$Password)) {
		header("Location: registration.php?error=Password needs 1 Uppercase&$user_data");
	    exit();
	}
	else if(!preg_match("#[a-z]+#",$Password)){
		header("Location: registration.php?error=Password needs 1 Lowercase&$user_data");
	    exit();
	}
	else if(!preg_match("#[0-9]+#",$Password)){
		header("Location: registration.php?error=Password needs 1 Number&$user_data");
	    exit();
	}
	elseif(!preg_match("#[\W]+#",$Password))  {
		header("Location: registration.php?error=Password needs 1 Special Character&$user_data");
	    exit();
	}
	
		else if(filter_var($Email, FILTER_VALIDATE_EMAIL) == false){
			header("Location: registration.php?error=Invalid Email&$user_data");
	    exit();
		}

		
		else 
		{
			$sql = "INSERT INTO users (fullname,email,password) VALUES ('$fullname', '$email', '$password')";
			$result = mysqli_query($dbConn,$sql);
			if ($result) {
           	 header("Location: registration.php?success=Registration Successful");
	         exit();
           }else {
	           	header("Location: registration.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Form</title>
      <style type="text/css">
		#main{
			background-color:white;
			width: 600px;
			height: 300px;
			border-radius: 30px;
		}
		h1{
			color: black;
			background-color: none;
			border-top-right-radius: 30px;
			border-top-left-radius: 30px;
		}
		.text{
			background-color: black;
			color: black;
			width: 250;
			font-weight: bold;
			font-size: 20px;
			border: none;
			text-align: center;
		}
		.text:focus{
			outline: none;
		}
		hr{
			width: 250px;
			margin-top: 0px !important;
		}
		#sub{
			width: 250px;
			height: 30px;
			background-color: #5f5;
			border: none;
		}
		html{
		background:url('libre.jfif') no-repeat center center fixed;
		-webkit-background-size:cover;
		-moz-background-size:cover;
		-o-background-size:cover;
		background-size: cover;
		}
				input {
			width: 200px;
			margin-top: 20px;
			background: transparent;
			outline: none;
			padding: 10px;
			font-size: 13px;
			border-radius: 30px;
			box-shadow: 0 0 4px #fff;
			transition: box-shadow 0.5s ease;
		}
</style>
</head>
<body>
	<body>
		
		
		<title>Account</title>
			<form action="server.php" method="post">
				<center> 
		<table>
				<h1>Register</h1>
				<p>Please fill in this form to create an account.</p>
				<hr>
				<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
		

			<div class="input-group"><label for="Fullname"><b>Username</b></label>
				
				<?php if (isset($_GET['fname'])) { ?>
               <input type="text" name="fname"  placeholder="Username" value="<?php echo $_GET['fname']; ?>"><br>
          <?php }
				else{ ?>
               <input type="text" 
                      name="fname" 
                      placeholder="Username"><br>
          <?php }?> </div>
			<div class="input-group">
				<label for="email"><b>Email</b></label>
				
				  <?php if (isset($_GET['email'])) { ?>
               <input type="text" 
                      name="email" 
                      placeholder="Email"
                      value="<?php echo $_GET['email']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="email" 
                      placeholder="Email"><br>
          <?php }?>
					</div>
				<div class="input-group">
				<label for="psw"><b>Password</b></label>
				<input type="password"
                 name="psw" 
                 placeholder="Password"><br>
</div>
          
				
				<hr>
			<div class="input-group">
				<button type="submit">Register</button>
				<p>Already have an account? <a href="Login.php">Sign in</a>.</p> 
				</div>
				</div>
</center>
  </table>
			</form>

		</body>
</html>	
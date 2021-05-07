<?php
	$fname = "localhost";
	$email = "root";
	$pass="";
	$db_name="registration";
	$errors = array();
	
	//connect to the database
	$dbConn = mysqli_connect($fname,$email,$pass,$db_name);
	
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
		if (empty($fullname)) {
		header("Location: registration.php?error=User Name is required&$user_data");
	    exit();
		
}
	else if(empty($email)){
        header("Location: registration.php?error=Password is required&$user_data");
	    exit();
	}
	
	else if(empty($password)){
        header("Location: registration.php?error=Name is required&$user_data");
	    exit();
	}
		else if (strlen($password)<7){
	header("Location: registration.php?error=Password is atleast 8 characters&$user_data");
	    exit();
}
	
	
	else if(!preg_match("#[A-Z]+#",$password)) {
		header("Location: registration.php?error=Password needs 1 Uppercase&$user_data");
	    exit();
	}
	else if(!preg_match("#[a-z]+#",$password)){
		header("Location: registration.php?error=Password needs 1 Lowercase&$user_data");
	    exit();
	}
	else if(!preg_match("#[0-9]+#",$password)){
		header("Location: registration.php?error=Password needs 1 Number&$user_data");
	    exit();
	}
	elseif(!preg_match("#[\W]+#",$password))  {
		header("Location: registration.php?error=Password needs 1 Special Character&$user_data");
	    exit();
	}
	
		else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
			header("Location: registration.php?error=Invalid Email&$user_data");
	    exit();
		}

		
		else 
		{
			$sql = "INSERT INTO users (fullname,email,password) VALUES ('$fullname', '$email', '$password')";
			$result = mysqli_query($dbConn,$sql);
			if ($result) {
           	 header("Location: Login.php?success=Registration Successful");
	         exit();
           }else {
	           	header("Location: registration.php?error=unknown error occurred&$user_data");
		        exit();

           }
		}

	}
?>

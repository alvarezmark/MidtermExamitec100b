<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['re_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['re_password']);
	

	$user_data = 'uname'. $uname;
$activity="ChangePassword";
	 $duration = floor(time()/(60*5));
	srand($duration);
	 date_default_timezone_set('Asia/Manila');
	 $currentDate = date('Y-m-d H:i:s');
	 $currentDate_timestamp = strtotime($currentDate);
	$endDate_months = strtotime("+5 minutes", $currentDate_timestamp);
	 $packageEndDate = date('Y-m-d H:i:s', $endDate_months);
	$_SESSION["current"] = $currentDate;
        $_SESSION["expired"] = $packageEndDate;

		
		
	
	if (empty($uname)) {
		header("Location: changpass.php?error=User Name is required&$user_data");
	    exit();
		
}
	else if(empty($pass)){
        header("Location: changpass.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: changpass.php?error=Confirm Password is required&$user_data");
	    exit();
	}


	else if($pass !== $re_pass){
        header("Location: changpass.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}
else if (strlen($pass)<=7){
	header("Location: changpass.php?error=Password is atleast 8 digits&$user_data");
	    exit();
}
	
	
	else if(!preg_match("#[A-Z]+#",$pass)) {
		header("Location: changpass.php?error=Password must contain 1Upper CASE&$user_data");
	    exit();
	}
	else if(!preg_match("#[a-z]+#",$pass)){
		header("Location: changpass.php?error=Password must contain 1lower CASE&$user_data");
	    exit();
	}
	else if(!preg_match("#[0-9]+#",$pass)){
		header("Location: changpass.php?error=Password must contain Number&$user_data");
	    exit();
	}
	elseif(!preg_match("#[\W]+#",$pass))  {
		header("Location: changpass.php?error=Password must contain Special Character&$user_data");
	    exit();
	}
	
		
	



	else{

		
       

	    $sql = "SELECT * FROM users WHERE username='$uname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) <1) {
			header("Location: changpass.php?error=No username found!&$user_data");
	        exit();
		}else {
			 $sql3="INSERT INTO acts (id,username,activity,time) VALUES ('', '$uname','$activity','$currentDate')";
           $sql2 = "UPDATE `users` SET `password`='$pass' WHERE `username`='$uname'";
			
           $result2 = mysqli_query($conn, $sql2);
			 $result3 = mysqli_query($conn, $sql3);
			
           if ($result2&&$result3) {
           	 header("Location: changpass.php?success=Your password has been updated successfully");
			
	         exit();
           }else {
	            	header("Location: changpass.php?error=unknown error occurred&$user_data");
			   
          
		        exit();
           }
		}
	}
}


else{
	header("Location: changpass.php");
	exit();
}
?>	
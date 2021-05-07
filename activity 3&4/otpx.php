<?php
session_start(); 

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "test_db";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (isset($_POST['num1']) && isset($_SESSION['username']))  {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	
	   return $data;
	}

	$num1 = validate($_POST['num1']);
		$activity="LogIn";
	 $duration = floor(time()/(60*5));
	srand($duration);
	 date_default_timezone_set('Asia/Manila');
	 $currentDate = date('Y-m-d H:i:s');
	 $currentDate_timestamp = strtotime($currentDate);
	$endDate_months = strtotime("+5 minutes", $currentDate_timestamp);
	 $packageEndDate = date('Y-m-d H:i:s', $endDate_months);
	$_SESSION["current"] = $currentDate;
        $_SESSION["expired"] = $packageEndDate;
	

	$user_data = 'otp='. $num1;
	if (empty($num1)) {
		header("Location: otp.php?error=OTP is required&$user_data");
	    exit();}
	
       else{

	    $sql = "SELECT * FROM bopols WHERE otp='$num1' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result)<=0) {
			header("Location: otp.php?error=Invalid otp&$user_data");
		}
		     
            else {
           
	           	header("Location:home.php?Success=OTP verified&$user_data");
				$sql2="INSERT INTO acts (id,username,activity,time) VALUES ('', '{$_SESSION['username']}','$activity','$currentDate')";
				$result2 = mysqli_query($conn, $sql2);
		        exit();
           
			}
		   }
			}
else{
	header("Location: otp.php");
	exit();
}
?>
<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>SAMPLE LOGIN</title>
	<style type="text/css">
		#main{
			background-color: #333;
			width: 600px;
			height: 300px;
			border-radius: 30px;
		}
		h1{
			color: black;
			background-color: white;
			border-top-right-radius: 30px;
			border-top-left-radius: 30px;
		}
		.text{
			background-color: #333;
			color: white;
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
		background:url('pts.jpg') no-repeat center center fixed;
		-webkit-background-size:cover;
		-moz-background-size:cover;
		-o-background-size:cover;
		background-size: cover;
		}
	</style>
</head>
<body>
	<center>	
		<div id= "main">
				<h1>LOGIN</h1>
		
		
			<form  method="post">
			
			<label for="uname">Username:</label>
			<input type="text" id="uname" name="uname"><br><br>
			<label for="pwd">Password:</label>
			<input type="password" id="pwd" name="pwd"><br><br><br>
			<input type="submit" name="submit" value="Submit"><br><br>
		<p>No Account? <a href="registration.php">Sign Up</a>.</p> 
			</form>
		</div>
	</center>
</body>
</html>

<center>
<?php
	if (isset($_POST['submit'])) {
		$un=$_POST['uname'];
		$pw=$_POST['pwd'];

		if ($un==("ADMIN") && $pw==("ADMIN123")) {
			header("location:login.html");
			exit();
		}
		else{
			echo "Invalid Username/Password";
		}
	}

?>
</center>
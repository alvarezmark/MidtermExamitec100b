<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
		<style>
		body{
			margin: 0;
			padding: 0;
			background-color: #c0fefc;
			background-position: center;
			font-family: 'Poppins', sans-serif;
		}
		.boxer{
			width: 320px;
			height: 400px;
			
			color: white;
			top: 50%;
			left: 50%;
			position: absolute;
			transform: translate(-50%, -50%);
			box-sizing: border-box;
			padding: 30px 30px;
		}
		.pik{
			width: 100px;
			height: 100px;
			border-radius: 50%;
			position: absolute;
			top: -50px;
			left: calc(50% - 50px);
		}
		.h1{
			margin: 0;
			padding: 0 0 20px;
			text-align: center;
			font-size: 22px;
			color: white;
		}
		.boxer p {
			margin: 0;
			padding: 0;
			font-weight: bold;
		}
		.boxer input{
			width: 100%;
			margin-bottom: 20px;
		}
		.boxer input[type="text"], input[type="password"]{
			border: none;
			border-bottom: 1px solid #fff;
			background: transparent;
			outline: none;
			height: 40px;
			color: black;
			font-size: 16px;	
		}
		.boxer input[type="submit"]{
			border: none;
			outline: none;
			height: 40px;
			background: #5b6d5b;
			color: #fff;
			font-size: 18px;
			border border-radius: 20px;
		}
</style>
</head>
<body>
     <form action="login.php" method="post">
     	<div class="boxer">
            <center><img src="pic1.jfif" width="60%" height="60%"></center>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<input type="text" name="uname" placeholder="Username"><br>

     	<input type="password" name="password" placeholder="Password"><br>
            
        <input type="submit" value="Login">
<a href="logout.php" class="ca"></a><br/><br>
			<a href="changpass.php" class="ca">Forgot Password</a><br><br>
     	    
          
     </form>
</body>
</html>
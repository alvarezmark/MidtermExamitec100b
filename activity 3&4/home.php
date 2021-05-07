
<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<style>
	body{
			margin: 0;
			padding: 0;
			background-color:none;
		
			font-family: 'Poppins', sans-serif
			background-repeat: no-repeat;		}
    h1 {
            width:500px;
            margin: 0 auto;
            background: gray;
            text-align: center;
        }
        [type="submit"]{
			border: none;
			outline: none;
			height: 40px;
			background: gray;
			color: #fff;
			font-size: 18px;
			border border-radius: 20px;
		}
        
		
		</style>
	<title>HOME</title>
	
</head>
<body>
	
     <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
	
   <h1><center><button>  <a href="logout.php">Logout</a> </button></center><br/></h1>
	<h1><center><button type="submit">  <a href="display.php" >View Activity</a> </button></center></h1>

</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>                            		                            
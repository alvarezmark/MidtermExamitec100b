<?php 
session_start();
  
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style type="text/css">
        html{
        background:url('we.jfif') no-repeat center center fixed;
        -webkit-background-size:cover;
        -moz-background-size:cover;
        -o-background-size:cover;
        background-size: cover;
        }
    </style>
</head>
<body>
    
    <div class="page-header">
      
    </div>
    <p>
       
      <center>  <a href="logout.php" class="btn btn-danger">Sign Out</a></center>
    </p>
    
</body>
</html>
<?php 

session_start(); 

if(!isset($_SESSION["verify"]) || $_SESSION["verify"] !== true){
    header("location: login.php");
    exit;
}
 
require_once "config.php";


$code_err = "";
$_SESSION["code_access"] = true;



if(isset($_POST['login']))
{ 
    if(empty(trim($_POST["code"]))){
        echo "<script>alert('PLEASE ENTER CODE');</script>";
    } else{ 

        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d H:i:s');
        $currentDate_timestamp = strtotime($currentDate);
        $code = $_POST['code'];
        

        $id_code = mysqli_query($link,"SELECT * FROM code WHERE code='$code' AND id_code=id_code") or die('Error connecting to MySQL server');
        $count = mysqli_num_rows($id_code);


        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'test';

        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT expiration FROM code where code='$code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                echo "<div style='display: none;'>"."Expiration: " . $row["expiration"]. "<br>";
                echo $currentDate."<br></div>";
                if(($row["expiration"]) >($currentDate)){

                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;                            
                    header("location: welcome.php");

                }
                else{
                    echo "<script>alert('EXPIRED CODE ERROR');</script>";
                }
            }
          } else {
            echo "<script>alert('WRONG CODE ERROR');</script>";
          }

          $conn->close();
    }
    
    mysqli_close($link);
}
?>
  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification</title>
   <style type="text/css">
        html{
        background:url('go.jfif') no-repeat center center fixed;
        -webkit-background-size:cover;
        -moz-background-size:cover;
        -o-background-size:cover;
        background-size: cover;
        }
    </style>
</head>  
<body>
    
    <div class="wrapper">
        <h2>Verification</h2>
        
        
        <form role="form" method="post">

                <div class="form-group">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control">
                   
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary">LOGIN</button><BR>
                    <a class="" style=" color: white;" href="random.php" target="_blank">GET CODE</a>
                </div>

                
        </form>

    
</body>
</html>



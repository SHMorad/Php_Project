<?php
session_start([
    "cookie_lifetime"=>300, //5minutes
]);
$error =false;

if(isset($_POST['username']) && isset($_POST['password'])){
    if('admin' == $_POST['username'] && 'd033e22ae348aeb5660fc2140aec35850c4da997' ==sha1($_POST['password'])){
        $_SESSION['loggedin'] = true;
    }else{
        $error=true;
        $_SESSION['loggedin'] =false;
    }
}

if(isset($_POST['logout'])){
    $_SESSION['loggedin'] =false;
    session_destroy();
    header("Location:auth.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <style>
        body{
            margin-top:30px;
        }
    </style>
</head>

<body>
  <div class="container">
    <div class="row">
        <div class="column colmun-60 colmun-offset-20">
            <h2>Simple Auth Example</h2>
        </div>
    </div>
    <div class="row">
        <div class="column colmun-60 colmun-offset-20">
            <?php
            
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==true){
                   echo "<p>Hello Admin, Welcome</p>";
                }else{
                   echo "<p>Hello Stranger, Login Below</p>";
                }      
            ?>
            
        </div>
    </div>
    <div class="row">
        <div class="column colmun-60 colmun-offset-20">
             <?php 
            if($error){
                echo "<h4>UserName or Password didn't match..!</h4>";
            }

             if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] ==false){
             ?>
            <form action="" method="POST">
                <label for="username">UserName</label>
                <input type="text" name="username" placeholder="Enter Your UserName">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Entder Your Password">
                <button type="submit" name="submit">Log In</button>
            </form>
            <?php }else{ 
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="logout" value="1">
                <button type="submit" class="button-secondary" name="logout">Log Out</button>
            </form>
            <?php 
            }
         
            ?>
        </div>
    </div>


  </div>




</body>
</html>
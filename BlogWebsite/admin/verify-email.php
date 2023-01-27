<?php
include_once "../libeary/Session.php";
Session::init();
include_once "../libeary/Database.php";
$db= new Database();



if(isset($_GET['token'])){
    $token =$_GET['token'];
    $query = "SELECT v_token, v_status FROM users WHERE v_token='$token'";
    $result = $db->select($query);

    if($result !=false){
        $row = mysqli_fetch_assoc($result);
        if($row['v_status'] ==0){
            $click_token = $row['v_token'];
            $update_status = "UPDATE users SET v_status='1' WHERE v_token='$click_token'";
            $update_result = $db->update($update_status);
            if($update_result){
                $_SESSION['status']="Your Account Hase Been Varified Successfully";
                header("Location:login.php");

            }else{
                $_SESSION['status']="Varification Faild";
                header("Location:login.php");

            }

        }else{
            $_SESSION['status'] ="This Email Already Varified Please LogIn";
            header("Location:login.php");
        }

    }else{
        $_SESSION['status'] = "This Token Does Not Exists";
        header("Location:login.php");
    }
}else{
    $_SESSION['status'] ="Not Allowed";
    header("Location:login.php");
}


?>
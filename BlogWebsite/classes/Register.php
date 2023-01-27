<?php
include_once "../libeary/Database.php";
include_once "../helpers/Formate.php";

include_once "../PHPmailer/PHPMailer.php";
include_once "../PHPmailer/SMTP.php";
include_once "../PHPmailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Register{
    public $db;
    public $fr;
    public function __construct(){
        $this->db =new Database();
        $this->fr = new Formate();
    }
    public function AddUser($data){
        function send_varify($name, $email, $v_token){
            /* $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPAuth = true;

            $mail->Host = 'smtp.gmail.com';
            $mail->Username = 'www.morad5526@gmail.com';
            $mail->Password = 'jndofzeaalhspnab';

            $mail->SMTPSecure = "tls";
            $mail->port = 587;

            $mail->setFrom("www.morad5226@gmail.com", $name);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Email Varification From Web Master';

            $email_template = "
            <h2>You Have Register With Wen Master</h2>
            <h5>Verify Your Email Address To LogIn Please Click The Link Below</h5>
            <a href='http://localhost/PhpByHasinHayder/Php_Project/BlogWebsite/admin/verify-email.php?token=$v_token'>Click Here</a>
            ";

            $mail->Body = $email_template;
            $mail->send(); */

            $post =false;
            $reachable ='';
            // Curl request
            $ar =array(
                'to_email'=> $email
            );
            $post_data =json_encode($ar);

            // prepare new Curl resource

            $crl = curl_init('https://api.reacher.email/v0/check_email');
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLINFO_HEADER_OUT, true);
            curl_setopt($crl,CURLOPT_POST, true);
            curl_setopt($crl, CURLOPT_POSTFIELDS,$post_data);

            // SET http header for post request
            curl_setopt($crl, CURLOPT_HTTPHEADER,array(
                'content-Type:application/json',
                // 'authorization : bbc96d5e-9d54-11ed-bedf-f73f2d8f00b6'
                'authorization : v_token'

            ));
            $result = curl_exec($crl);
            print_r($result);




        }
       
        $name = $this->fr->validation($data['name']);
        $phone = $this->fr->validation($data['phone']);
        $email = $this->fr->validation($data['email']);
        $password = $this->fr->validation(md5($data['password']));
        $v_token = md5(rand());

       
        // if(isset($name, $phone, $email, $password)){
        if(empty($name) || empty($phone) || empty($email) || empty($password)){
            $error = "Fild Must Not Be Empty";
            return $error;
        }else{
            $e_query= "SELECT * FROM users WHERE email='$email'";
            $check_email = $this->db->select($e_query);
    
            if($check_email){
                $error = "This Email Is Already Exisit";
                return $error;
                header("Location:register.php");
            }else{
                $insert_query = "INSERT INTO users(username,email,phone,password,v_token) VALUES('$name', '$email', '$phone', '$password', '$v_token')";

                $insert_row = $this->db->insert($insert_query);

                if($insert_row){
                    send_varify($name, $email, $v_token);
                    $success= "Registetion successFully Done.Please Check Your Email inbox for varifi Email";
                    return $success;

                }else{
                    $error = "Registetion Failed";
                    return $error;
                }
            }
        }
    }

    // }



}

?>
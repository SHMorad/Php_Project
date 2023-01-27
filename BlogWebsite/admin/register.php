<?php
include_once "../classes/Register.php";
 $re = new Register();
 if($_SERVER['REQUEST_METHOD']=='POST'){
  $AddUser= $re->AddUser($_POST);
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registetion Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
        .h-custom {
        height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
        .h-custom {
        height: 100%;
        }
}
    </style>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="./assets/images/register.gif" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        
        <form action='' method='POST'>
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-twitter"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-linkedin-in"></i>
            </button>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div>
          <?php
        if(isset($AddUser)){
        ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php
            echo $AddUser;
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
        }
        ?>

          <!-- Name input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="form3Example3">Name</label>
            <input type="text" name="name" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter Your Name" />
          </div>
          <!-- phone input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="form3Example3">Phone</label>
            <input type="number" name="phone" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter Your Phone Number" />
          </div>
          <!-- Email input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
          <label class="form-label" for="form3Example4">Password</label>
            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" />
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" name="logInBtn" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Sign Up</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">You have an account? <a href="login.php"
                class="link-danger">LogIn</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
<?php
  session_start();
  require_once('../database/db.php');

  if(isset($_SESSION['usernameExists'])){
    if($_SESSION['usernameExists']){
      echo "<script type='text/javascript'>alert('Username already Exists');</script>";
      unset($_SESSION['usernameExists']);
    }
  }
  if(isset($_SESSION['noData'])){
    if($_SESSION['noData']){
      echo "<script type='text/javascript'>alert('The form was incomplete');</script>";
      unset($_SESSION['noData']);
    }
  }

?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/favicon.ico" />
    <title>A.F.A Printing Services & More</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row text-center">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/big/poster1.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <img src="../assets/images/big/icon.png" alt="wrapkit">
                        <h2 class="mt-3 text-center">Sign Up for Free</h2>
                        <form id="reg-form" class="mt-4" method="post" action="../database/register_customer.php">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input id="name" class="form-control" type="text" placeholder="full name" name="full_name">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input id="phone" class="form-control" type="text" placeholder="phone number" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input id="email" class="form-control" type="email" placeholder="email address" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input id="username" class="form-control" type="text" placeholder="username" name="username" >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input id="pass" class="form-control" type="password" placeholder="password" name="password">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input id="cpass" class="form-control" type="password" placeholder="confirm password" name="confirm_password">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label id="label"></label>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <button type="button" onclick="doIt()" class="btn btn-block btn-dark">Sign Up</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Already have an account? <a href="./authentication-login1.php" class="text-danger">Sign In</a>
                                </div>
                                <div class="col-lg-12 text-center mt-2">
                                    Want to work with us? <a href="./authentication-register-emps.php" class="text-danger">Sign Up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();

        function doIt(){
          var fullname = document.getElementById('name');
          var phone = document.getElementById('phone');
          var email = document.getElementById('email');
          var username = document.getElementById('username');
          var password = document.getElementById('pass');
          var cpassword = document.getElementById('cpass');
          var label = document.getElementById('label');

          // console.log(fullname.value);

          if(password.value!==cpass.value){
            label.innerHTML= "Passwords don't match.";
          }
          if(cpassword.value===""){
            label.innerHTML= "Please confirm your password.";
          }
          if(password.value===""){
            label.innerHTML= "Please enter a password.";
          }
          if(username.value===""){
            label.innerHTML= "Please fill in your username.";
          }
          if(email.value===""){
            label.innerHTML= "Please fill in your email.";
          }
          if(phone.value===""){
            label.innerHTML= "Please fill in your phone.";
          }
          if(fullname.value===""){
            label.innerHTML= "Please fill in your full name.";
          }

          if(fullname.value!=="" && phone.value!=="" && email.value!=="" && username.value!=="" && password.value!=="" && cpassword.value!=="" && password.value===cpass.value){
            // console.log("success");
            document.getElementById("reg-form").submit();
          }








        }

    </script>
</body>

</html>

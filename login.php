<?php
require_once 'inc/session.php';
 if (!empty($_SESSION['fkl'])) {
     header('location: index.php');
    }

if (isset($_POST['btn'])) {
    $login->adminLogin();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="vendors/metro4/css/metro-all.min.css">
    <link rel="stylesheet" href="css/index.css">

    <title>Login</title>
</head>
<body class="m4-cloak h-vh-100 d-flex flex-justify-center flex-align-center">
    <div class="login-box">
        <form class="bg-white p-4"
              action=""
              method="POST"
              data-clear-invalid="2000"
              data-on-error-form="invalidForm"
        >
            <img src="images/logo110x51.png" class="place-right mt-4-minus mr-6-minus">
            <h1 class="mb-0">Login</h1>
            <div class="text-muted mb-4">Sign in to start your session</div>
            <div class="form-group">
                <input type="number" name="fkl" required data-role="input" placeholder="012000" data-append="<span class='mif-envelop'>" data-validate="required">
                <span class="invalid_feedback">Please enter a valid email address</span>
            </div>
            <div class="form-group">
                <input type="password" required name="password" data-role="input" placeholder="Password" data-append="<span class='mif-key'>" data-validate="required">
                <span class="invalid_feedback">Please enter a password</span>
            </div>
            <div class="form-group d-flex flex-align-center flex-justify-between">
                <!-- <input type="checkbox" data-role="checkbox" data-caption="Remember Me"> -->
                <button type="submit" name="btn" class="button success">Sign In</button>
            </div>
            
            <!-- <div class="form-group border-top bd-default pt-2">
                <a href="#" class="d-block" style="text-decoration: none;">I forgot my password</a>
               
            </div> -->
        </form>
    </div>


    <script src="vendors/jquery/jquery-3.4.1.min.js"></script>
    <script src="vendors/metro4/js/metro.min.js"></script>
    <script>
        function invalidForm(){
            var form  = $(this);
            form.addClass("ani-ring");
            setTimeout(function(){
                form.removeClass("ani-ring");
            }, 1000);
        }
    </script>
</body>
</html>
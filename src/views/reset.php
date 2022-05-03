<?php
session_start();

require __DIR__ . '/../csrf.php';
require __DIR__ . '/db.php';

if(isset($_SESSION['name'])) {
    header('Location: /');
}

if(!isset($_GET['email'])) {
    header('Location: /login');
}

$success;

if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_NUMBER_INT);
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $statement->execute(array(filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL)));
    if($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($code === $result[0]['code'] && time() <= $result[0]['expiration']) {
            $success= true;
        } else {
            $success = false;
        }
    }
    else {
        $success = false;
    }
}

if(isset($_POST['reset']) && CSRF::validateToken($_POST['token'])) {
    $password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_DEFAULT);
    $statement = $pdo->prepare("UPDATE users SET password=?, code=?, expiration=? WHERE email=?");
    $statement->execute(array($password, 0, 0, filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL)));
    header('Location: /login');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Yem Yem | Reset Password</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Yem-Yem Supermarket">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Yem-Yem">
  <meta name="generator" content="Yem-Yem Supermarket">
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="views/images/favicon.png" />
  
  <link rel="stylesheet" href="views/plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="views/plugins/bootstrap/css/bootstrap.min.css">
  
  <!-- Animate css -->
  <link rel="stylesheet" href="views/plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="views/plugins/slick/slick.css">
  <link rel="stylesheet" href="views/plugins/slick/slick-theme.css">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="views/css/style.css">

</head>

<body id="body">

<section class="forget-password-page account">
  <div class="container">
    <div class="row">
        <?php if(isset($success)): ?>
            <?php if($success): ?>
                <div class="col-md-6 col-md-offset-3">
                    <div class="block text-center">
                        <form class="text-left clearfix" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>" >
                            <?php CSRF::csrfInputField() ?>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Enter new password">
                            </div>
                            <div class="text-center">
                                <button name="reset" type="submit" class="btn btn-main text-center" >Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info alert-common alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="tf-ion-android-checkbox-outline"></i>Code Invalid/Expired
                </div>
            <?php endif ?>
        <?php else: ?>
            <div class="col-md-6 col-md-offset-3">
                <div class="block text-center">
                <form class="text-left clearfix" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
                    <p>Enter the code sent to your email.</p>
                    <?php CSRF::csrfInputField() ?>
                    <div class="form-group">
                    <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Enter code">
                    </div>
                    <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-main text-center">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        <?php endif ?>
    </div>
  </div>
</section>

   <!-- 
    Essential Scripts
    =====================================-->
    
    <!-- Main jQuery -->
    <script src="views/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="views/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap Touchpin -->
    <script src="views/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Video Lightbox Plugin -->
    <script src="views/plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
    <!-- Count Down Js -->
    <script src="views/plugins/syo-timer/build/jquery.syotimer.min.js"></script>

    <!-- slick Carousel -->
    <script src="views/plugins/slick/slick.min.js"></script>
    <script src="views/plugins/slick/slick-animation.min.js'"></script>

    <!-- Main Js File -->
    <script src="views/js/script.js"></script>
    


  </body>
  </html>
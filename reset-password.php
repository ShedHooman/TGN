<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])) {
    // Mendapatkan id dan level dari sesi
    $user_id = $_SESSION['user_id'];
     
  }else{
     $user_id = '';
    };

if(isset($_POST['submit'])){
 
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $prev_pass = $_POST['prev_pass'];
    $new_pass = sha1($_POST['new_pass']);filter_var($new_pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
 
    if($new_pass != $cpass){
       $message[] = 'confirm password not matched!';
    }else{
       if($new_pass != $prev_pass){
          $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
          $update_admin_pass->execute([$cpass, $user_id]);
          $message[] = 'password updated successfully! <a href="user_login.php">Kembali ke Login</a>';
       }else{
          $message[] = 'please enter a new password!';
       }
    }
    
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forgot Your Password Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Yummy
  * Indated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Update Password</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="Sign-in.php">Sign In</a></li>
            <li>Update Password</li>
          </ol>
        </div>

      </div>
    </div>
    <!-- End Breadcrumbs -->

<!-- ======= Forgot Password Form ======= -->
    <section class="sample-page"> 
      <div class="container" data-aos="fade-up">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                  <h2 class="text-uppercase text-center mb-5">Update Password</h2>

                  <form action="" method="post">
                   <input type="hidden" name="name" value="<?= $fetch_profile["name"]; ?>">
                   <input type="hidden" name="email" value="<?= $fetch_profile["email"]; ?>">
                   <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">

                    <div class="form-outline mb-4">
                        <label class="form-label" for="new_pass">Enter your new password</label>
                        <input type="password" name="new_pass" class="form-control form-control-lg" />
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="cpass">Confirm your new password</label>
                        <input type="password" name="cpass" class="form-control form-control-lg" />
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn-register">Confirm</button>
                    </div>

                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- End Form -->


  </main><!-- End #main -->

  <!-- Footer Includer -->
  <?php include 'components/footer.php'; ?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
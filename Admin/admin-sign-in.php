<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
  
}else{
  $user_id = '';
};

if(isset($_POST['submit'])){

  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING); 
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND password = ?");
  $select_user->execute([$username, $pass]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if($select_user->rowCount() > 0){
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_level'] = $row['level'];
    header('location:index.php');
  }else{
    $message[] = 'incorrect username or password!';
  }

}

?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Parfume TGN </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <section class="sample-page"> 
      <div class="container" data-aos="fade-up">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                <a href="../index.php" class="text-body-warning"><u><- Back to Homepage</u></a>
                  <h2 class="text-uppercase text-center mt-3 mb-5">Admin Sign In</h2>
                  <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="username">User Name</label>
                        <input type="text" name="username" class="form-control form-control-lg" />
                    </div>

                    <div class="form-outline mb-3">
                        <label class="form-label" for="pass">Password</label>
                        <input type="password" name="pass" class="form-control form-control-lg" />
                    </div>

                    <p class="text-center text-muted mt-1 mb-4">Forgot your Password? <a href="#"
                          class="fw-bold text-body"><u>Click here</u></a></p>

                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary">Sign In</button>
                    </div>

                    <p class="text-center text-muted mt-4 mb-0">Dont have an account? <a href="#"
                          class="fw-bold text-body"><u>Sign Up here</u></a></p>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Sign In -->
  </main><!-- End #main -->
</body>

</html>
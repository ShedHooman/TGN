<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_level'])) {
  // Mendapatkan id dan level dari sesi
  $user_id = $_SESSION['user_id'];
  $user_level = $_SESSION['user_level'];
   
}else{
   $user_id = '';
   $user_level = '';
   header('location:sign-in.php');
    exit(); // Pastikan untuk keluar dari skrip setelah header redirect
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Purchase Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon1.png" rel="icon">
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

  <!-- Header Includer -->
  <?php include 'components/header.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>My Purchase</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>My Purchase</li>
          </ol>
        </div>

      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Section ======= -->
    <section style="background-color: #eee;">
    <div class="container py-5">

<?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?>
        <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
            <div class="card shadow-0 border rounded-3">
            <div class="card-body">
                <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                    <div class="bg-image hover-zoom">
                    <img src="assets/img/Logo-TGN.png" class="w-100" />
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                    Placed on: <h5><?= $fetch_orders['placed_on']; ?></h5>
                    <div class="mt-1 mb-0 text-muted small">
                    Product: <span><?= $fetch_orders['total_products']; ?></span>
                    </div>
                    <p class="text-truncate mb-4 mb-md-0">
                    Name: <?= $fetch_orders['name']; ?>
                    </p>
                    <p class="text-truncate mb-4 mb-md-0">
                    Email: <?= $fetch_orders['email']; ?>
                    </p>
                    <p class="text-truncate mb-4 mb-md-0">
                    Address: <?= $fetch_orders['address']; ?>
                    </p>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                    <div class="d-flex flex-row align-items-center mb-1">
                    <h4 class="mb-1 me-1"><?= $fetch_orders['payment_status']; ?></h4>
                    </div>
                    <h6 class="text-success">Rp <?= $fetch_orders['total_price']; ?>,-</h6>
                    <div class="d-flex flex-column mt-4">
                    <a href="purchase-history-details.php?pid=<?= $fetch_orders['id'];?>" class="btn btn-primary btn-sm" type="button">Details</a>
                    <button class="btn btn-outline-danger btn-sm mt-2" type="button">
                        Ask for Refund
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
<?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
?>
        
    </div>
    </section><!-- End Section -->

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
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
          <h2>My Purchase Details</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="purchase-history.php">My Purchase</a></li>
            <li>My Purchase Details</li>
          </ol>
        </div>

      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Section ======= -->
    <section style="background-color: #eee;">
    <div class="container-fluid">
<?php
    $pid = $_GET['pid'];
    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?"); 
     $select_orders->execute([$pid]);
    if($select_orders->rowCount() > 0){
      while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
        
?>
      <div class="container">
        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center py-3">
          <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #<?= $fetch_orders['id']; ?></h2>
        </div>

        <!-- Main content -->
        <div class="row">
          <div class="col-lg-8">
            <!-- Details -->
            <div class="card mb-4">
              <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                  <div>
                    <span class="me-3"><?= $fetch_orders['placed_on']; ?></span>
                    <span class="me-3">#<?= $fetch_orders['id']; ?></span>
                    <span class="me-3"><?= $fetch_orders['method']; ?></span>
                    <span class="badge rounded-pill bg-info"><?= $fetch_orders['payment_status']; ?></span>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i class="bi bi-download"></i> <span class="text">Invoice</span></button>
                    <div class="dropdown">
                      <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex mb-2">
                          <div class="flex-shrink-0">
                            <img src="assets/img/favicon1.png" alt="" width="35" class="img-fluid">
                          </div>
                          <div class="flex-lg-grow-1 ms-3">
                            <h6 class="small mb-0"><a href="#" class="text-reset"><?= $fetch_orders['total_products']; ?></a></h6>
                            <span class="small">Color: White</span>
                          </div>
                        </div>
                      </td>
                      <td>1</td>
                      <td class="text-end">Rp <?= $fetch_orders['total_price']; ?>,-</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2">Shipping Fee</td>
                      <td class="text-end">Rp 0,-</td>
                    </tr>
                    <tr class="fw-bold">
                      <td colspan="2">TOTAL</td>
                      <td class="text-end">Rp <?= $fetch_orders['total_price']; ?>,-</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <!-- Payment -->
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <h3 class="h6">Payment Method</h3>
                    <p><?= $fetch_orders['method']; ?> <br>
                    Total: Rp <?= $fetch_orders['total_price']; ?>,- <span class="badge bg-success rounded-pill">PAID</span></p>
                  </div>
                  <div class="col-lg-6">
                    <h3 class="h6">Billing address</h3>
                    <address>
                      <strong><?= $fetch_orders['name']; ?></strong><br>
                      <?= $fetch_orders['address']; ?><br>
                      <?= $fetch_orders['address2']; ?><br>
                      Phone Num:  <?= $fetch_orders['number']; ?>
                    </address>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            
            <div class="card mb-4">
              <!-- Shipping information -->
              <div class="card-body">
                <h3 class="h6">Shipping Information</h3>
                <strong>JNE</strong>
                <span><a href="#" class="text-decoration-underline" target="_blank">FF#######890</a> <i class="bi bi-box-arrow-up-right"></i> </span>
                <hr>
                <h3 class="h6">Address</h3>
                <address>
                  <strong><?= $fetch_orders['name']; ?></strong><br>
                  <?= $fetch_orders['address']; ?><br>
                  <?= $fetch_orders['address2']; ?><br>
                  Phone Num:  <?= $fetch_orders['number']; ?>
                </address>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
    }
    }else{
        echo '<p class=>belum ada produk yang ditambahkan!</p>';
    }
?>
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
<!DOCTYPE html>
<html lang="en">

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
  <style>
  .vertical-table {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .vertical-table thead,
    .vertical-table tbody {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .vertical-table tbody {
        overflow-y: auto;
    }
  </style>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <?= include 'header.php' ?>
  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Produk</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Penjualan</li>
          <li class="breadcrumb-item active">Produk</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
          <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
          <div class="card-body">
                  <h5 class="card-title">Penjualan <span>| Saat ini</span></h5>
                  <?php
                      // Fungsi untuk menghitung pemasukan dalam bentuk persentase
                      function calculateIncomePercentage($conn) {
                      // Inisialisasi total_completes
                      $total_completes = 0;

                      // Hitung total pemasukan yang telah terverifikasi
                      $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ? AND placed_on >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
                      $select_completes->execute(['completed']);

                      if ($select_completes->rowCount() > 0) {
                        while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
                          $total_completes += $fetch_completes['total_price'];
                        }
                      }

                      // Hitung total pemasukan selama satu bulan terakhir
                      $select_total = $conn->prepare("SELECT SUM(total_price) AS total FROM `orders` WHERE placed_on >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
                      $select_total->execute();
                      $fetch_total = $select_total->fetch(PDO::FETCH_ASSOC);
                      $total_all = $fetch_total['total'];

                      // Hitung persentase
                      if ($total_all > 0) {
                      $percentage = ($total_completes / $total_all) * 100;
                      return $percentage;
                      } else {
                        return 0;
                      }
                    }

                      // Panggil fungsi untuk mendapatkan persentase pemasukan
                      $income_percentage = calculateIncomePercentage($conn);
                  ?>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                      $select_orders = $conn->prepare("SELECT * FROM `orders`");
                      $select_orders->execute();
                      $number_of_orders = $select_orders->rowCount();
                      $income_class = ($income_percentage > 0) ? 'text-success small pt-1 fw-bold' : 'text-danger small pt-1 fw-bold';
                    ?>
                      <h6><?= $number_of_orders; ?></h6>
                      <span class="<?= $income_class; ?>"><?=$income_percentage;?>%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            

         <!-- Special title treatmen -->
         <div class="card text-center">
            <div class="card-header">
              <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                <h5 class="card-title">List Produk</h5>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <p class="card-text">Tap the Button below to add Product.</p>
              <a href="penjualan-add-produk.php" class="btn btn-primary">Add Product</a>
            </div>
          </div><!-- End Special title treatmen -->
<?php 
    // delete
    if(isset($_POST['delete'])){
      $id = $_POST['id'];
      $delete_produk = $conn->prepare("DELETE FROM products WHERE id = ?");
      $delete_produk->execute([$id]);
    }

    // Read produucts
    $select_query = "SELECT * FROM `products`";
    $result = $conn->query($select_query);
    if ($result->rowCount() > 0) {
        while ($fetch_product = $result->fetch(PDO::FETCH_ASSOC)) {
?>
        <!-- Card with an image on left -->
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="../assets/img/menu/<?= $fetch_product['image'];?>" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Product ID: #<?= $fetch_product['id'];?></h5>
                  <p class="card-text">Name : <?= $fetch_product['name'];?></p>
                  <p class="card-text">Price:  Rp <?= number_format($fetch_product['price'], 0, ',', '.');?>,-</p>
                  <p class="card-text">Category: <?= $fetch_product['categories'];?></p>
                  <p class="card-text">ingredient: <?= $fetch_product['ingredient'];?></p>
                  <p class="card-text">Details: <?= $fetch_product['details'];?></p>
                  <p class="card-text">
                    <a href="penjualan-edit-produk.php?uid=<?= $fetch_product ['id'];?>" class="btn btn-success">Update</a> 
                    <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $fetch_product['id']; ?>">
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                  </p>

                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->
<?php
    }
      } else { 
?>
      <tr><td colspan='12'>No data found</td></tr>;
<?php
      }
?>
    </section>

  </main><!-- End #main -->

  <?= include 'footer.php';?>

</body>

</html>
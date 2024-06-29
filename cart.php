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
}

if(isset($_POST['delete'])){
    $cart_id = $_POST['cart_id'];
    $delete_cart_item = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
    $delete_cart_item = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    header('location:cart.php');
    exit(); // Pastikan untuk keluar dari skrip setelah header redirect
}

if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $qty = filter_var($_POST['qty'], FILTER_VALIDATE_INT); // Ganti filter menjadi FILTER_VALIDATE_INT
    if($qty !== false && $qty > 0 && $qty <= 99){ // Periksa apakah qty adalah angka bulat antara 1 dan 99
        $update_qty = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $update_qty->execute([$qty, $cart_id]);
        $message[] = 'cart quantity updated';
    } else {
        $message[] = 'Invalid quantity value';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TGN - My Cart</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon1.png" rel="icon">
  <link href="assets/img/favicon1.png" rel="apple-touch-icon">

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

</head>

<body>

  <!-- Header Includer -->
  <?php include 'components/header.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>My Cart Page</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>My Cart</li>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->  

  <!-- ======= Cart Form Section ======= -->
<section class="h-100" style="background-color: #eee;">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                    <div>
                        <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i
                                    class="bi bi-angle-down mt-1"></i></a></p>
                    </div>
                </div>
                <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <form action="" method="post" class="box">
                            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">

                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img
                                                src="./assets/img/menu/<?= $fetch_cart['image']; ?>"
                                                class="img-fluid rounded-3" alt="<?= $fetch_cart['name']; ?>">
                                        </div>

                                        <div class="col-md-3 col-lg-3 col-l-3">
                                            <p class="lead fw-normal mb-2"><?= $fetch_cart['name']; ?></p>
                                            <p><span class="text-muted">Size: </span>/- ml</p>
                                        </div>

                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <input id="form1" min="0" name="qty"
                                                   value="<?= $fetch_cart['quantity']; ?>" type="number"
                                                   class="form-control form-control-sm"/>
                                            <button type="submit" class="btn btn-warning" name="update_qty">
                                                <i class="bi bi-pencil-square fa-md"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0">Rp.<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>
                                                /-</h5>
                                        </div>

                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <button type="submit" class="btn btn-danger" name="delete">
                                                <i class="bi bi-trash-fill fa-md"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php
                        // Update kolom sold pada tabel product berdasarkan name dari tabel cart
                        $cart_id = $fetch_cart['id'];
                        $qty = $fetch_cart['quantity'];

                        $select_product = $conn->prepare("SELECT name FROM products WHERE name = ?");
                        $select_product->execute([$fetch_cart['name']]);
                        $product_exists = $select_product->rowCount() > 0;

                        if ($product_exists) {
                            $update_product = $conn->prepare("UPDATE products SET sold = sold + ? WHERE name = ?");
                            $update_product->execute([$qty, $fetch_cart['name']]);
                        }
                        // Akhir dari kode pembaruan kolom sold pada tabel product
                        $grand_total += $sub_total;
                    }
                } else {
                    echo '<p class="empty">keranjang Anda kosong</p>';
                }
                ?>
                <div class="card mb-5">
                    <div class="card-body p-4">
                        <div class="float-end">
                            <p class="mb-0 me-5 d-flex align-items-center">
                                <span class="md text me-2">Shipment:</span> <span
                                    class="lead fw-normal">Free</span>
                            </p>
                            <p class="mb-0 me-5 d-flex align-items-center">
                                <span class="md text me-2">Order total:</span> <span
                                    class="lead fw-normal">Rp.<?= $grand_total; ?>/-</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="index.php#catalogue" type="button"
                       class="btn btn-light btn-md me-2">Continue shopping</a>
                    <a href="checkout.php" type="button"
                       class="btn btn-primary btn-md <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Go to
                        Checkout</a>
                </div>

            </div>
        </div>
    </div>
</section><!-- End Cart Form Section -->

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
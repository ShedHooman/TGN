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

if(isset($_POST['order'])){

  $name = $_POST['firstname'].' '. $_POST['lastname'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $method = $_POST['method']. ' - '. $_POST['cc-name'] .', '. $_POST['cc-number'] .', '. $_POST['cc-expiration'] .', '. $_POST['cc-cvv'];
  $method = filter_var($method, FILTER_SANITIZE_STRING);
  $address = $_POST['address'] .', '. $_POST['city'] .', '. $_POST['country'] .' - '. $_POST['zip'];
  $address = filter_var($address, FILTER_SANITIZE_STRING);
  $address2 = $_POST['address2']; 
  $address2 = filter_var($address2, FILTER_SANITIZE_STRING);
  $total_products = $_POST['total_products'];
  $total_price = $_POST['total_price'];

  $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
  $check_cart->execute([$user_id]);

  if($check_cart->rowCount() > 0){

     $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, address2, total_products, total_price) VALUES(?,?,?,?,?,?,?,?,?)");
     $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $address2, $total_products, $total_price]);

     $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
     $delete_cart->execute([$user_id]);

     $message[] = 'order placed successfully!';
  }else{
     $message[] = 'your cart is empty';
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TGN - Checkout</title>
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
  <link href="assets/css/checkout.css" rel="stylesheet">

</head>

<body>

  <!-- Header Includer -->
  <?php include 'components/header.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Checkout Page</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="cart.php">My Cart</a></li>
            <li>Checkout</li>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
    <div class="container">
    <div class="row g-5">
      <!-- ======= Check Cart ======= -->
      <?php
      $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $count_cart_items->execute([$user_id]);
      $total_cart_counts = $count_cart_items->rowCount();
      ?>
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill"><?= $total_cart_counts; ?></span>
        </h4>
        <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
          while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
            $total_products = implode($cart_items);
            $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
        ?>
        
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?= $fetch_cart['name']; ?></h6>
              <small class="text-body-secondary">Qty: <?= $fetch_cart['quantity']; ?></small>
            </div>
            <span class="text-body-secondary">Rp.<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span>
          </li>

        <?php
          }
        }else{
          echo '<p class="empty">Your cart is empty!</p>';
       }
        ?>

          <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
            <div class="text-success">
              <h6 class="my-0">Shipment Fees</h6>
              <small>Free</small>
            </div>
            <span class="text-success">Rp.0</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (IDR)</span>
            <strong>Rp.<?= $grand_total; ?></strong>
          </li>
        </ul>

      </div>
      <!-- ======= Payment Form ======= -->
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Billing address</h4>
        <form action="" method="POST" class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" name="firstname" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" name="lastname" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
              </div>
            </div>

            <div class="col-12">
              <label for="number" class="form-label">Phone Number</label>
              <input type="text" class="form-control" name="number" placeholder="+62 12345678" required>
              <div class="invalid-feedback">
                Please enter your Phone Number.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
              <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <select class="form-select" name="country" id="country" required>
                <option value="">Choose...</option>
                <option>Indonesia</option>
                <option>Singapore</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">City</label>
              <input class="form-control" name="city" id="city" required>

              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" name="zip" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="method" value="credit" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="debit" name="method" value="debit" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Debit card</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="method" value="paypal" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required>
              <small class="text-body-secondary">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">

          <!-- ======= holds cart ======= -->
          <input type="hidden" name="total_products" value="<?= $total_products; ?>">
          <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value=""> 

          <button class="w-100 btn btn-primary btn-lg <?= ($grand_total > 1)?'':'disabled'; ?>" name="order" type="submit">Place an order</button>
        </form><!-- End Payment Form -->
      </div>
    </div>
    </div>
    </section>

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
  <script src="assets/js/checkout.js"></script>


</body>

</html>
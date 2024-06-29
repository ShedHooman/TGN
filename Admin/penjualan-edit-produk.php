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
<?php 
if(isset($_POST['submit'])){

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);
    $categories = filter_var($_POST['categories'], FILTER_SANITIZE_STRING);
    $ingredient = filter_var($_POST['ingredient'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);

 
    $update_profile = $conn->prepare("UPDATE `products` SET name = ?, details = ?, categories = ?, ingredient = ?, price = ?, image = ? WHERE id = ?");
    $update_profile->execute([$name, $details, $categories, $ingredient, $price, $image, $id]);
}
?>
  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Update Produk</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Penjualan</li>
          <li class="breadcrumb-item"><a href="penjualan-list-produk.php">Produk</a></li>
          <li class="breadcrumb-item active">Update Produk</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
    <div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body pb-0">
            <h1 class="card-title">Update Produk<span></span></h1>
            <div class="card-body">

<?php
    $uid = $_GET['uid'];
    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
    $select_product->execute([$uid]);
    if($select_product->rowCount() > 0){
      while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
    ?>
<!-- Update Form -->
<form action="" method="post" class="row g-3">
        <input type="hidden" name="id" value="<?= $fetch_product['id']; ?>">
        <div class="col-12">
            <label for='name'>Name</label>
            <input type='text' class='form-control' id='name' name='name' value='<?= $fetch_product ['name']; ?>'>
        </div>
        <div class="col-12">
            <label for='price'>Price</label>
            <input type='text' class='form-control' id='price' name='price' value='<?= $fetch_product ['price']; ?>'>
        </div>
        <div class='form-group'>
            <label for='categories'>Categories</label>
            <select class='form-control' id='categories' name='categories'>
                <option selected disabled='<?= $fetch_product ['categories']; ?>'><?= $fetch_product ['categories']; ?></option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
        </div>
        <div class="col-12">
            <label for='ingredient'>Ingredient</label>
            <input type='text' class='form-control' id='ingredient' name='ingredient' value='<?= $fetch_product ['ingredient']; ?>'>
        </div>
        <div>
        <label for='details'>Details</label>
            <input type='text' class='form-control' id='details' name='details' value='<?= $fetch_product ['details']; ?>'>
        </div>
        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </div>
</form><!-- Vertical Form -->
<?php    
    }
    } else { 
?>
    <tr><td colspan='12'>No data found</td></tr>;
<?php
    }
?>
            </div>
        </div>
    </div>
</div>

</section>

  </main><!-- End #main -->

  <?= include 'footer.php';?>

</body>

</html>
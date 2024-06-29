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

    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = sha1($_POST['pass']);
    $phone= filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $level = filter_var($_POST['level'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $about = filter_var($_POST['about'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $user_id = filter_var($_POST['users_id'], FILTER_SANITIZE_STRING);

 
    $update_profile = $conn->prepare("UPDATE `users` SET fullname = ?, username = ?, email = ?, password = ?, phone = ?, level = ?, status = ?, about = ?, address = ? WHERE id = ?");
    $update_profile->execute([$fullname, $username, $email, $password, $phone, $level, $status, $about, $address, $user_id]);
 }
?>
  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Update User Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item"><a href="users-tabel-admin.php">Management Admin</a></li>
          <li class="breadcrumb-item active">Update User Admin</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
    <div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body pb-0">
            <h1 class="card-title">Update User Admin<span></span></h1>
            <div class="card-body">

<?php
    $uid = $_GET['uid'];
    $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?"); 
    $select_users->execute([$uid]);
    if($select_user->rowCount() > 0){
      while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
    ?>
<!-- Update Form -->
<form action="" method="post" class="row g-3">
        <input type="hidden" name="users_id" value="<?= $fetch_users['id']; ?>">
        <div class="col-12">
            <label for='fullname'>Fullname</label>
            <input type='text' class='form-control' id='fullname' name='fullname' value='<?= $fetch_users ['fullname']; ?>'>
        </div>
        <div class="col-12">
            <label for='username'>Name</label>
            <input type='text' class='form-control' id='username' name='username' value='<?= $fetch_users ['username']; ?>'>
        </div>
        <div class="col-12">
            <label for='email'>Name</label>
            <input type='email' class='form-control' id='email' name='email' value='<?= $fetch_users ['email']; ?>'>
        </div>
        <div class="col-12">
            <label for='phone'>Telepon</label>
            <input type='phone' class='form-control' id='phone' name='phone' value='<?= $fetch_users ['phone']; ?>'>
        </div>
        <div class="col-12">
        <label for='password'>Password</label>
            <input type='password' class='form-control' id='password' name='password' value='<?= $fetch_users ['password']; ?>'>
        </div>

        <div class='form-group'>
            <label for='level'>Level</label>
            <select class='form-control' id='level' name='level'>
                <option selected disabled ='<?= $fetch_users ['level']; ?>'><?= $fetch_users ['level']; ?></option>
                <option value='Super Admin'>Super Admin</option>
                <option value='Customer Service'>Customer Service</option>
                <option value='Marketing'>Marketing</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='status'>Status</label>
            <select class='form-control' id='status' name='status'>
                <option selected disabled='<?= $fetch_users ['status']; ?>'><?= $fetch_users ['status']; ?></option>
                <option value='Active'>Active</option>
                <option value='Disabled'>Disabled</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='about'>About</label>
            <input type='text' class='form-control' id='about' name='about' value='<?= $fetch_users ['about']; ?>'>
        </div>
        <div class='form-group'>
            <label for='address'>Address</label>
            <input type='text' class='form-control' id='address' name='address' value='<?= $fetch_users ['address']; ?>'>
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
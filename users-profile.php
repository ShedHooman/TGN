<?php

include 'components/connect.php';

//mulai sesi
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_level'])) {
  // Mendapatkan id dan level dari sesi
  $user_id = $_SESSION['user_id'];
  $user_level = $_SESSION['user_level'];
   
}else{
   $user_id = '';
   $user_level = '';
    header('Country:sign-in.php');
    exit(); // Pastikan untuk keluar dari skrip setelah header redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TGN - Index</title>
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
  <link href=" assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href=" assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href=" assets/vendor/aos/aos.css" rel="stylesheet">
  <link href=" assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href=" assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href=" assets/css/main.css" rel="stylesheet">
  
</head>

<body>

  <!-- ======= Header ======= -->
    <!-- Header Includer -->
    <?php include 'components/header.php'; ?>
  <!-- End Header -->

  <main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>My Profile</h2>
      <ol>
        <li><a href="index.php">Home</a></li>
        <li>Settings</li>
      </ol>
    </div>

  </div>
</div><!-- End Breadcrumbs --> 
      <?php
// Logika update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $country = $_POST['country'];
  $address = $_POST['address'];
  $about = $_POST['about'];

  $update_profile = $conn->prepare("UPDATE `users` SET fullname = ?, username = ?, phone = ?, email = ?, country = ?, address = ?, about = ? WHERE id = ?");
  $update_profile->execute([$fullname, $username, $phone, $email, $country, $address, $about, $user_id]);

  if ($update_profile) {
      header("Location: users-profile.php");
      exit();
  } else {
      echo "Failed to update profile. Please try again.";
  }
}

// Ambil data profil
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);

if ($select_profile->rowCount() > 0) {
  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

  if ($fetch_profile && is_array($fetch_profile)) {
      $about = $fetch_profile["about"];
      $fullname = $fetch_profile['fullname'];
      $name = $fetch_profile['username'];
      $job = $fetch_profile['job'];
      $country = $fetch_profile['country'];
      $address = $fetch_profile['address'];
      $phone = $fetch_profile['phone'];
      $email = $fetch_profile['email'];
      $level = $fetch_profile['level'];
  }
}
?>
    <section class="section profile">
    <div class="container-xl px-4 mt-4">
 
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img src="Admin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h3><?= $fullname; ?></h3>
              <h5><?= $level; ?></h5>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <!-- Form Group (Fullname)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputFullname">Fullname</label>
                            <input class="form-control" id="inputFullname" name="fullname" type="text" placeholder="<?= $fullname; ?>" value="<?= $fullname; ?>">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input class="form-control" id="inputUsername" name="username" type="text" placeholder="<?= $name; ?>" value="<?= $name; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone Number</label>
                                <input class="form-control" id="inputPhone"name="phone" type="text" placeholder="<?= $phone; ?>" value="<?= $phone; ?>">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (email, country)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmail">Email address</label>
                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="<?= $email; ?>" value="<?= $email; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputcountry">Country</label>
                                <input class="form-control" id="inputcountry" name="country" type="text" placeholder="<?= $country; ?>" value="<?= $country; ?>">
                            </div>
                        </div>
                        <!-- Form (Address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputaddress">Address</label>
                            <input class="form-control" id="inputaddress" name="address" type="text" placeholder="<?= $address; ?>" value="<?= $address; ?>">
                        </div>

                        <!-- Form (About)-->
                        <div class="mb-3">
    <label class="small mb-1" for="inputabout">About</label>
    <textarea class="form-control" id="inputabout" rows="5" name="about" placeholder="<?= $about; ?>"><?= $about; ?></textarea>
</div>

                  
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="save_changes">Save changes</button>
                        <a href="forgot-password.php" for="inputChangesPassword" class="btn btn-warning">Changes Password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Telu Gusti Noir</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://Krisna Putra Fachri.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://Krisna Putra Fachri.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://Krisna Putra Fachri.com/">Krisna Putra Fachri</a>
    </div>
  </footer><!-- End Footer -->


</body>
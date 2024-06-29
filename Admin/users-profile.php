<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - NiceAdmin Bootstrap Template</title>
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
</head>

<body>

  <!-- ======= Header ======= -->
  <?= include 'header.php' ?>
  <!-- End Header -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <?= 
        // Set nilai kolom sesuai data pengguna yang sedang login
        
        $about = $fetch_user['about'];
        $fullname = $fetch_user['fullname'];
        $name = $fetch_user['username'];
        $job = $fetch_user['job'];
        $country = $fetch_user['country'];
        $address = $fetch_user['address'];
        $phone = $fetch_user['phone'];
        $email = $fetch_user['email'];
        $level =$fetch_user['level'];
        ?>
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?= $fullname; ?></h2>
              <h3><?= $level; ?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                 <p class="small fst-italic"><?= $about; ?></p>
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Full Name</div>
                  <div class="col-lg-9 col-md-8"><?= $name; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Pekerjaan</div>
                  <div class="col-lg-9 col-md-8"><?= $job; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Warga Negara</div>
                  <div class="col-lg-9 col-md-8"><?= $country; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8"><?= $address; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8"><?= $phone; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?= $email; ?></div>
                </div>
          </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <?php
                // include 'components/connect.php';
                // session_start();

                // CRUD Operations
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['create_profile'])) {
                // Create Profile (INSERT)
                // Add necessary validation and sanitization before database insertion
                $insert_query = "INSERT INTO `users` (fullName, about, job, country, address, phone, email)
                             VALUES (?, ?, ?, ?, ?, ?, ?)";
                $insert_params = [
                $_POST['fullName'],
                $_POST['about'],
                $_POST['job'],
                $_POST['country'],
                $_POST['address'],
                $_POST['phone'],
                $_POST['email']
              ];

               $insert_profile = $conn->prepare($insert_query);
               $insert_success = $insert_profile->execute($insert_params);

              if ($insert_success) {
                 $message[] = 'Profile created successfully!';
                } else {
                  $message[] = 'Failed to create profile!';
                }
              } elseif (isset($_POST['upload_profile'])) {
                // Update Profile (UPDATE)
                  $user_id = $_SESSION['user_id'];

                 // Manage profile image
                // Add necessary validation and sanitization before database update
               $image = $_FILES['profile_image']['name'];
               $image_size = $_FILES['profile_image']['size'];
               $image_tmp_name = $_FILES['profile_image']['tmp_name'];
               $image_folder = 'assets/img/user-profile/' . $image; // Updated path

                // Update users table
                $update_query = "UPDATE `users` SET profile_image = ?, fullName = ?, about = ?, job = ?, country = ?, address = ?, phone = ?, email = ?
                         WHERE id = ?";
        $update_params = [
            $image_folder, // Updated column
            $_POST['fullName'],
            $_POST['about'],
            $_POST['job'],
            $_POST['country'],
            $_POST['address'],
            $_POST['phone'],
            $_POST['email'],
            $user_id
        ];

        $update_profile = $conn->prepare($update_query);
        $update_success = $update_profile->execute($update_params);

        if ($update_success) {
            if ($image_size > 0) {
                if ($image_size > 2000000) {
                    $message[] = 'Image size is too large!';
                } else {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'Profile image uploaded successfully!';
                }
            }
        } else {
            $message[] = 'Failed to update profile!';
        }
    }
}

              // Fetch user data for displaying in the form
              $user_id = $_SESSION['user_id'];
              $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
              $select_user->execute([$user_id]);
              $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
              ?>
    <!-- Profile Edit Form -->
    <form action="" method="post" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
        <!--  -->
        <div class="col-md-8 col-lg-9">
            <img src="assets/img/profile-img.jpg" alt="Profile">
            <div class="pt-2">
                <label for="profile_image" class="btn btn-primary btn-sm" title="Upload new profile image">
                    <i class="bi bi-upload" value="Update"></i> 
                    <input type="file" name="profile_image" id="profile_image" accept="image/jpg, image/jpeg, image/png, image/webp" style="display: none;" required>
                </label>
                <a href="#" class="btn btn-danger btn-sm" value="Delete" title="Remove my profile image"><i class="bi bi-trash"></i></a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
        <div class="col-md-8 col-lg-9">
            <input name="fullName" type="text" class="form-control" id="fullName" value="<?= $fullname; ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="about" class="col-md-4 col-lg-3 col-form-label">Tentang Saya</label>
        <div class="col-md-8 col-lg-9">
            <textarea name="about" class="form-control" id="about" style="height: 100px"><?= $about; ?></textarea>
        </div>
    </div>

    <div class="row mb-3">
        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Pekerjaan</label>
        <div class="col-md-8 col-lg-9">
            <input name="job" type="text" class="form-control" id="Job" value="<?= $job; ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Warga Negara</label>
        <div class="col-md-8 col-lg-9">
            <input name="country" type="text" class="form-control" id="Country" value="<?= $country; ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
        <div class="col-md-8 col-lg-9">
            <input name="address" type="text" class="form-control" id="Address" value="<?= $address; ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
        <div class="col-md-8 col-lg-9">
            <input name="phone" type="text" class="form-control" id="Phone" value="<?= $phone; ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
        <div class="col-md-8 col-lg-9">
            <input name="email" type="email" class="form-control" id="Email" value="<?= $email; ?>">
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary" value="Create" name="create_profile">Create Profile</button>
        <button type="submit" class="btn btn-primary" value="Update" name="upload_profile">Save Changes</button>
        <button type="submit" class="btn btn-danger" value="Delete" name="delete_profile">Delete Profile</button>
    </div>
</form>
<!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
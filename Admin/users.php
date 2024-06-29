<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - User </title>
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
  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Daftar User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Daftar Semua User</li>
          <!-- <li class="breadcrumb-item active">Riwayat Penjualan</li> -->
        </ol>
        <!-- Button trigger modal for Users -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
<button type="button" class="btn btn-primary me-md-2" data-bs-toggle="modal" data-bs-target="#usersModal">
    Add User or Admin
</button>

<!-- Button trigger modal for Karyawan -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#karyawanModal">
    Add Karyawan
</button>
</div>

<!-- Modal for Users -->
<div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Users Form -->
                <form action="users-process_users.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" maxlength="21" required>
            </div>

            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" maxlength="21" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Disable">Disable</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-select" id="level" name="level" required>
                    <option value="consument">Consument</option>
                    <option value="Customer Service">Customer Service</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Super Admin">Super Admin</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="about" class="form-label">About</label>
                <input type="text" class="form-control" id="about" name="about">
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country" required>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Singapura">Singapura</option>
                    <option value="Jepang">Jepang</option>
                    <option value="Rusia">Rusia</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" maxlength="255"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Karyawan -->
<div class="modal fade" id="karyawanModal" tabindex="-1" aria-labelledby="karyawanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="karyawanModalLabel">Add Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Karyawan Form -->
                <form action="users-process_karyawan.php" method="post">
    <div class="mb-3">
        <label for="nameKaryawan" class="form-label">Name</label>
        <input type="text" class="form-control" id="nameKaryawan" name="name" maxlength="21" required>
    </div>

    <div class="mb-3">
        <label for="fullnameKaryawan" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullnameKaryawan" name="fullname" maxlength="21" required>
    </div>

    <div class="mb-3">
        <label for="emailKaryawan" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailKaryawan" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
    </div>

    <div class="mb-3">
        <label for="phoneKaryawan" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phoneKaryawan" name="phone">
    </div>

    <div class="mb-3">
        <label for="statusKaryawan" class="form-label">Status</label>
        <select class="form-select" id="statusKaryawan" name="status" required>
            <option value="Active">Active</option>
            <option value="Disable">Disable</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="passwordKaryawan" class="form-label">Password</label>
        <input type="password" class="form-control" id="passwordKaryawan" name="password" required>
    </div>

    <div class="mb-3">
        <label for="levelKaryawan" class="form-label">Level</label>
        <select class="form-select" id="levelKaryawan" name="level" required>
            <option value="Customer Service">Customer Service</option>
            <option value="Marketing">Marketing</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="aboutKaryawan" class="form-label">About</label>
        <select class="form-select" id="aboutKaryawan" name="about" required>
            <option value="Karyawan">Karyawan</option>
            <option value="Staff">Staff</option>
            <option value="Junior Manager">Junior Manager</option>
            <option value="Manager">Manager</option>
            <option value="Senior Manager">Senior Manager</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="jobKaryawan" class="form-label">Job</label>
        <select class="form-select" id="jobKaryawan" name="job" required>
            <option value="Karyawan">Karyawan</option>
            <option value="Staff">Staff</option>
            <option value="Junior Manager">Junior Manager</option>
            <option value="Manager">Manager</option>
            <option value="Senior Manager">Senior Manager</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="countryKaryawan" class="form-label">Country</label>
        <select class="form-select" id="countryKaryawan" name="country" required>
            <option value="Indonesia">Indonesia</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Singapura">Singapura</option>
            <option value="Jepang">Jepang</option>
            <option value="Rusia">Rusia</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="addressKaryawan" class="form-label">Address</label>
        <textarea class="form-control" id="addressKaryawan" name="address" maxlength="255"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Add Karyawan</button>
</form>
            </div>
        </div>
    </div>
</div>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
              <h5 class="card-title">Total User</h5>
              <?php
                    $select_users = $conn->prepare("SELECT * FROM `users` WHERE `level` IN ('consument') ");
                    $select_users->execute();
                    $number_of_users = $select_users->rowCount()
                   ?>
              <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    
                  <h6><?= $number_of_users; ?></h6>

                  <span>Semua User</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                
                <h5 class="card-title">Karyawan</h5>
                
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check-fill"></i>
                  </div>
                  <div class="ps-3">
                  <?php
                   $select_karyawan = $conn->prepare("SELECT * FROM `karyawan`");
                   $select_karyawan->execute();
                   $number_of_karyawan = $select_karyawan->rowCount()
                  ?>
                  <h6><?= $number_of_karyawan; ?></h6>
                  <span>Semua Karyawan</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">
    <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Total Admin TGN</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <div class="ps-3">
                    <?php
                    $select_admin = $conn->prepare("SELECT * FROM `users` WHERE `level` IN ('admin', 'super admin', 'marketing') ");
                    $select_admin->execute();
                    $number_of_admin = $select_admin->rowCount()
                   ?>
                    <h6><?= $number_of_admin; ?></h6>
                    <span>Semua Admin</span>
                  </div>
                </div>
              </div>
            </div>
          </div>


</section>

  </main><!-- End #main -->

  <?= include 'footer.php';?>

</body>

</html>
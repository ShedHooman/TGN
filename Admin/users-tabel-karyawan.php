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
  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Management Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Management Karyawan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
    <div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body pb-0">
            <h1 class="card-title">Management Karyawan<span></span></h1>
            <div class="card-body">
            <?php
    // Create

//delete
if(isset($_POST['delete'])){
    $karyawan_id = $_POST['id'];
    $delete_karyawan = $conn->prepare("DELETE FROM karyawan WHERE id = ?");
    $delete_karyawan->execute([$karyawan_id]);
}
?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                     <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col" class="col-0">ID</th>
                                <th scope="col" class="col-1">Fullname</th>
                                <th scope="col" class="col-1">Name</th>
                                <th scope="col" class="col-0">Email</th>
                                <th scope="col" class="col-1">Telepon</th>
                                <th scope="col" class="col-1">Status</th>
                                <th scope="col" class="col-1">Level</th>
                                <th scope="col" class="col-1">Pekerjaan</th>
                                <th scope="col" class="col-2">About</th>
                                <th scope="col" class="col-2">Alamat</th>
                                <th scope="col" class="col-0">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
<?php 
// Read
$select_query = "SELECT * FROM `karyawan`";
$result = $conn->query($select_query);

if ($result->rowCount() > 0) {
    while ($fetch_karyawan = $result->fetch(PDO::FETCH_ASSOC)) {
?>
        <tr>
        <td><?= $fetch_karyawan ['id'];?></td>
        <td><?= $fetch_karyawan ['fullname'];?></td>
        <td><?= $fetch_karyawan ['name'];?></td>
        <td><?= $fetch_karyawan ['email'];?></td>
        <td><?= $fetch_karyawan ['phone'];?></td>
        <td><?= $fetch_karyawan ['status'];?></td>
        <td><?= $fetch_karyawan ['level'];?></td>
        <td><?= $fetch_karyawan ['about'];?></td>
        <td><?= $fetch_karyawan ['job'];?></td>
        <td><?= $fetch_karyawan ['address'];?></td>
        <td>
        <form action="" method="post">
        <a href="users-edit-karyawan.php?uid=<?= $fetch_karyawan ['id'];?>" class="btn btn-success ri-edit-box-fill"></a>
        <input type="hidden" name="id" value="<?= $fetch_karyawan['id']; ?>">
        <button type="submit" name="delete"  class="btn btn-danger"><i class="ri-delete-bin-2-line"></i></button>
        </form>
        </td>
        </tr>
        <?php
        
    }
} else { 
    ?>
    <tr><td colspan='12'>No data found</td></tr>;
<?php
}
?>
 </tbody>
                    </table>
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


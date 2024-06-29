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
      <h1>Riwayat Penjualan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Penjualan</li>
          <li class="breadcrumb-item active">Riwayat Penjualan</li>
        </ol>
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
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                
                <h5 class="card-title">Pendapatan <span>| Bulan Ini</span></h5>
                
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                  <?php
                  $total_completes = 0;
                  $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                  $select_completes->execute(['completed']);
                    if($select_completes->rowCount() > 0){
                     while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                          $total_completes += $fetch_completes['total_price'];
                     }
                    }
                    $income_class = ($income_percentage > 0) ? 'text-success small pt-1 fw-bold' : 'text-danger small pt-1 fw-bold';
                  ?>
                    <h6><span>Rp</span><?= number_format($total_completes, 0, ',', '.'); ?><span>/-</span></h6>
                    <span class="<?= $income_class; ?>"><?=$income_percentage;?>%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>
              </div>
            </div>

            <div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body pb-0">
            <h3 class="card-title">Riwayat Transaksi saat ini<span></span></h3>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                     <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col" class="col-2">Transaksi dilakukan</th>
                                <th scope="col" class="col-2">Nama</th>
                                <th scope="col" class="col-2">Nomor Telepon</th>
                                <th scope="col" class="col-2">Alamat</th>
                                <th scope="col" class="col-1">Total Produk</th>
                                <th scope="col" class="col-1">Harga Total</th>
                                <th scope="col" class="col-1">Bayar Menggunakan</th>
                                <th scope="col" class="col-1">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Update Payment Status
                            if(isset($_POST['update_payment'])){
                                $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_STRING);
                                $payment_status = filter_var($_POST['payment_status'], FILTER_SANITIZE_STRING);

                                $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
                                $update_status->execute([$payment_status, $order_id]);
                              }

                            //delete
                            if(isset($_POST['delete'])){
                                $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_STRING);
                                
                                $delete_order = $conn->prepare("DELETE FROM orders WHERE id = ?");
                                $delete_order->execute([$order_id]);
                              }

                            
                            $select_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY id DESC");
                            $select_orders->execute();
                            if ($select_orders->rowCount() > 0) {
                                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <tr>
                                        <td><?= $fetch_orders['placed_on']; ?></td>
                                        <td><?= $fetch_orders['name']; ?></td>
                                        <td><?= $fetch_orders['number']; ?></td>
                                        <td><?= $fetch_orders['address']; ?></td>
                                        <td><?= $fetch_orders['total_products']; ?></td>
                                        <td>Rp.<?= number_format($fetch_orders['total_price'], 0, ',', '.'); ?></td>
                                        <td><?= $fetch_orders['method']; ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                                                <select name="payment_status" class="form-select">
                                                    <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Confirmed">Confirmed</option>
                                                    <option value="Completed">Completed</option>
                                                    <option value="Canceled">Canceled</option>

                                                </select>
                                                <div class="btn-group" role="group" aria-label="Tindakan">
                                                    <button type="submit" class="btn btn-success" name="update_payment"><i class="ri-edit-box-fill"></i></button>
                                                    <button type="submit" class="btn btn-danger" name="delete" onclick="return confirm('delete this order?');"><i class="ri-delete-bin-2-line"></i></a>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="8" class="empty">belum ada pesanan yang dilakukan!</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


     
                <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
              <div class="card-body">
                 <h5 class="card-title">History penjualan terbaru <span> </span></h5>
                  <?php
                  $select_orders = $conn->prepare("SELECT * FROM `orders`");
                  $select_orders->execute();
                    if ($select_orders->rowCount() > 0) {
                  $counter = 1; }
                  ?>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Total Product</th>
                      <th scope="col">Harga Total</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                    $status_class = '';

                    switch ($fetch_orders['payment_status']) {
                        case 'Completed':
                            $status_class = 'badge bg-success';
                            break;
                        case 'Pending':
                              $status_class = 'badge bg-warning';
                              break;
                        case 'Canceled':
                            $status_class = 'badge bg-danger';
                            break;
                        case 'Confirmed':
                            $status_class = 'badge bg-primary';
                            break;
                    }
                ?>
                    <tr>
                        <th scope="row"><a href="#"><span><?= $counter; ?></span></a></th>
                        <td><span><?= $fetch_orders['name']; ?></span></td>
                        <td><a href="#" class="text-primary"><?= $fetch_orders['total_products']; ?></a></td>
                        <td><span>Rp.<?= number_format($fetch_orders['total_price'], 0, ',', '.'); ?>/-</span></td>
                        <td><span class="status pembayaran <?= $status_class; ?>"><?= $fetch_orders['payment_status']; ?></span></td>
                    </tr>
                <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
              </div>
            </div>
          </div>

          <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Hari ini</a></li>
                    <li><a class="dropdown-item" href="#">Bulan ini</a></li>
                    <li><a class="dropdown-item" href="#">Tahun ini</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                <h5 class="card-title">Penjualan Terbanyak <span>| Hari ini</span></h5>

                 <table class="table table-borderless">
                 <thead>
                 <tr>
                  <th scope="col">Gambar</th>
                  <th scope="col">Produk</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Terjual</th>
                  <th scope="col">Pendapatan</th>
                 </tr>
                </thead>
                <tbody>

              <?php
            // Ambil data produk dari database
            $select_products = $conn->query("SELECT * FROM products");

            while ($product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                // Lokasi gambar
                $image_location = "../assets/img/menu/{$product['image']}";

                // Hitung total pendapatan (harga satuan * jumlah terjual)
                $formatted_price = number_format($product['price']);
                $formatted_earnings = number_format($product['price'] * $product['sold']);
            ?>

                <tr>
                    <th scope="row"><a href="#"><img src="<?= $image_location; ?>" alt=""></a></th>
                    <td><a href="#" class="text-primary fw-bold"><?= $product['name']; ?></a></td>
                    <td><?= $formatted_price; ?></td>
                    <td class="fw-bold"><?= $product['sold']; ?></td>
                    <td><?= $formatted_earnings; ?></td>
                </tr>

            <?php } // Tutup while loop ?>

            </tbody>
            </table>
          </div>

          </div>
    </section>

  </main><!-- End #main -->

  <?= include 'footer.php';?>

</body>

</html>
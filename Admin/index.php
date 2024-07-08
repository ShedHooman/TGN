<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard Admin - Parfume TGN </title>
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                    <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                    <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                  </ul>
                </div>

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
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

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
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

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

                <div class="card-body">
                  <h5 class="card-title">Pelanggan <span>| Tahun Ini</span></h5>

                  <?php
function calculateConsumentPercentage($conn) {
    // Hitung jumlah users level "consument"
    $select_consument = $conn->prepare("SELECT COUNT(*) AS consument_count FROM `users` WHERE level = 'consument'");
    $select_consument->execute();
    $fetch_consument = $select_consument->fetch(PDO::FETCH_ASSOC);
    $consument_count = $fetch_consument['consument_count'];

   
?>

<div class="d-flex align-items-center">
    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        <i class="bi bi-people"></i>
    </div>
    <div class="ps-3">
        <h6><?= isset($consument_count) ? $consument_count : 0; ?></h6>
        <?=
         // Hitung persentase users level "consument"
    $total_users = $consument_count; // Total users dengan level "consument"

    if ($total_users > 0) {
        $percentage_consument = ($consument_count / $total_users) * 100;
        return $percentage_consument;
    } else {
        return 0;
    }
}

// Panggil fungsi untuk mendapatkan persentase users level "consument"
$consument_percentage = calculateConsumentPercentage($conn);

// Tentukan class untuk bagian "kosong" berdasarkan nilai $consument_percentage
$consument_class = ($consument_percentage > 0) ? 'text-success small pt-1 fw-bold' : 'text-danger small pt-1 fw-bold';

// Tentukan teks untuk bagian "pertumbuhan" berdasarkan perubahan jumlah users level "consument"
$growth_text = '';
if ($consument_percentage > 0) {
    // Jika ada pertumbuhan
    $growth_text = 'Pertumbuhan';
} elseif ($consument_percentage < 0) {
    // Jika ada kemunduran
    $growth_text = 'Kemunduran';
} else {
    // Jika tidak ada pertumbuhan
    $growth_text = 'Tidak ada pertumbuhan';
}
        ?>
        <span class="<?= $consument_class; ?>">%</span><span class="text-muted small pt-2 ps-1"><?= $growth_text; ?></span>
    </div>
</div>

                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Laporan <span>/Hari Ini</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Penjualan',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Pendapatan',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Pelanggan',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                 <h5 class="card-title">History penjualan terbaru <span>| Hari Ini</span></h5>
                  <?php
                  $select_orders = $conn->prepare("SELECT * FROM `orders`");
                  $select_orders->execute();
                    if ($select_orders->rowCount() > 0) {
                  $counter = 1; }
                  ?>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
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
                        <td><a href="components-history-pesanan.php" class="text-primary"><?= $fetch_orders['total_products']; ?></a></td>
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

              <!-- End Recent Sales -->

            <!-- Top Selling -->
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
<!-- End Top Selling -->
              </div>
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Aktivitas Terbaru <span>| Hari ini</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Pembelian berhasil <a href="#" class="fw-bold text-dark">nama_user</a> nama_produk
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Pembelian dibatalkan konsumen
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 hrs</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Pembelian nama_produk <a href="#" class="fw-bold text-dark">sedang berjalan</a>
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">1 day</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Isi aja sendiri <a href="#" class="fw-bold text-dark">namanya</a> isi sendiri
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 days</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    Pembelian nama_produk menunggu pembayaran
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">4 weeks</div>
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    Bingung ini apa
                  </div>
                </div><!-- End activity item-->

              </div>

            </div>
          </div><!-- End Recent Activity -->

          <!-- Budget Report -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Budget Report <span>| This Month</span></h5>

              <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                    legend: {
                      data: ['Allocated Budget', 'Actual Spending']
                    },
                    radar: {
                      // shape: 'circle',
                      indicator: [{
                          name: 'Sales',
                          max: 6500
                        },
                        {
                          name: 'Administration',
                          max: 16000
                        },
                        {
                          name: 'Information Technology',
                          max: 30000
                        },
                        {
                          name: 'Customer Support',
                          max: 38000
                        },
                        {
                          name: 'Development',
                          max: 52000
                        },
                        {
                          name: 'Marketing',
                          max: 25000
                        }
                      ]
                    },
                    series: [{
                      name: 'Budget vs spending',
                      type: 'radar',
                      data: [{
                          value: [4200, 3000, 20000, 35000, 50000, 18000],
                          name: 'Allocated Budget'
                        },
                        {
                          value: [5000, 14000, 28000, 26000, 42000, 21000],
                          name: 'Actual Spending'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Budget Report -->

          <!-- Website Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Website Traffic <span>| Today</span></h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Access From',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [{
                          value: 1048,
                          name: 'Search Engine'
                        },
                        {
                          value: 735,
                          name: 'Direct'
                        },
                        {
                          value: 580,
                          name: 'Email'
                        },
                        {
                          value: 484,
                          name: 'Union Ads'
                        },
                        {
                          value: 300,
                          name: 'Video Ads'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Website Traffic -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <?= include 'footer.php';?>

</body>

</html>
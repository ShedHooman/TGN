<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

    <!-- Batas atas navbar Penjualan -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Penjualan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="penjualan-history-pesanan.php">
          <i class="bi bi-circle"></i><span>Riwayat Transaksi</span>
        </a>
        <a href="penjualan-list-produk.php">
          <i class="bi bi-circle"></i><span>Produk</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav 1-->

  <!-- Batas atas navbar Users -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="users.php">
          <i class="bi bi-circle"></i><span>Users</span>
        </a>
      </li>
      <li>
        <a href="users-tabel-konsumen.php">
          <i class="bi bi-circle"></i><span>User Konsumen</span>
        </a>
      </li>
      <li>
        <a href="users-tabel-karyawan.php">
          <i class="bi bi-circle"></i><span>User Karyawan</span>
        </a>
      </li>
      <li>
        <a href="users-tabel-admin.php">
          <i class="bi bi-circle"></i><span>User Admin</span>
        </a>
      </li>
      
    </ul>
  </li>
  <!-- Batas bawah navbar 2 -->

  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.php">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

  

</ul>

</aside><!-- End Sidebar-->
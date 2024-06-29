<?php
?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/Logo-TGN.png" alt="">
        <!-- <h1>TGN Parfum<span>.</span></h1> -->
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php#hero">Home</a></li>
          <li><a href="catalog.php">Catalogue</a></li>
          <li><a href="index.php#about">About</a></li>
          <li><a href="index.php#new">Blog</a></li>
          <li><a href="index.php#staff">Staff</a></li>
          <li><a href="index.php#gallery">Gallery</a></li>
          <li><a href="index.php#contact">Contact</a></li>
          <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="cart.php">My Cart</a></li>
              <li><a href="purchase-history.php">My Purchase</a></li>
              <li><a href="users-profile.php">Setting</a></li>
              <li><a href="components/user-sign-out.php">Sign Out</a></li>
            </ul>
          </li>

          

          </li>
        </ul>
      </nav><!-- End navbar -->
      <?php
      //fetch data user
      $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_profile->execute([$user_id]);
      if($select_profile->rowCount() > 0){
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      $user_level = $_SESSION['user_level'];                
        if($user_level != 'consument'){
      ?>
          <text class="bilek">Hello, <a href="./admin"><?= $fetch_profile["username"]; ?></a>
      <?php
        }else{
      ?>
          <text class="bilek">Hello, <?= $fetch_profile["username"]; ?></a>
      <?php
        }
      }else{
      ?>
        <a class="btn-book-a-table" href="sign-in.php">Sign In</a>
       <?php
      }
      ?><!-- End Profile-->
      
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>


    </div>
  </header><!-- End Header -->
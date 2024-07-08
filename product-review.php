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
};

if(isset($_POST['add_review'])) {
  if($user_id == ''){
    header('location:sign-in.php');
  }else{
    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $rating = $_POST['rating'];
    $rating = filter_var($rating, FILTER_SANITIZE_STRING);
    $user_review = $_POST['user_review'];
    $user_review = filter_var($user_review, FILTER_SANITIZE_STRING);
    
  // Example of inserting into a reviews table
  $insert_review = $conn->prepare("INSERT INTO reviews (user_id, pid, name, username, rating, review, date_added) VALUES (?, ?, ?, ?, ? , ?, NOW())");
  $insert_review->execute([$user_id, $pid, $name, $username, $rating, $user_review]);

  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>[Template] Sample Inner Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .progress-label-left {
            float: left;
            margin-right: 0.5em;
            line-height: 1em;
        }
        .progress-label-right {
            float: right;
            margin-left: 0.3em;
            line-height: 1em;
        }
        .star-light {
            color:#e9ecef;
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
    </style>

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- Header Includer -->
  <?php include 'components/header.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Sample Inner Page</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Sample Inner Page</li>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container" data-aos="fade-up">
      
      <!-- ======= Product Rating Section ======= -->
      <?php
        $pid = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
        $select_products->execute([$pid]);
        if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
        
      ?>
          <div class="container">
            <div class="card">
              <div class="card-header"><?= $fetch_product['name'];?></div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 text-center">
                        <img src="./assets/img/menu/<?= $fetch_product['image'];?>" alt="phone" width="230">
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary form-control mt-3">Rate/Review This Product</button>
                    </div>
                    
                  <div class="col-sm-4 text-center">
                    <h1 class="text-warning mt-4 mb-4">
                      <b><span id="average_rating">0.0</span> / 5</b>
                    </h1>
                    <div class="mb-3 text-warning">
                      <i class="bi-star-fill"></i>
                      <i class="bi-star-fill"></i>
                      <i class="bi-star-fill"></i>
                      <i class="bi-star-half"></i>
                      <i class="bi-star"></i>

                    </div>
                    <h3><span id="total_review">0</span> Review</h3>
                  </div>
                  <div class="col-sm-4">
                    <p>
                        <div class="progress-label-left"><b>5</b> <i class="bi-star-fill text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                    </p>

                    <p>
                        <div class="progress-label-left"><b>4</b> <i class="bi-star-fill text-warning"></i></div>
                                  
                        <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                      </div>               
                      </p>
                    <p>
                        <div class="progress-label-left"><b>3</b> <i class="bi-star-fill text-warning"></i></div>
                                  
                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                        </div>               
                    </p>

                    <p>
                        <div class="progress-label-left"><b>2</b> <i class="bi-star-fill text-warning"></i></div>
                          
                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                        </div>               
                    </p>

                    <p>
                        <div class="progress-label-left"><b>1</b> <i class="bi-star-fill text-warning"></i></div>
                                  
                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                        </div>               
                    </p>

                  </div>
                </div>
              </div>
            </div>

            <!-- review form-->
            <div id="review_modal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Submit Review</h5>
                        </div>
                        <form id="add_review" method="POST">
                            <div class="modal-body">
                                <h4 class="text-center mt-2 mb-4">
                                    <i class="bi-star-fill star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                                    <i class="bi-star-fill star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                                    <i class="bi-star-fill star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                                    <i class="bi-star-fill star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                                    <i class="bi-star-fill star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                                </h4>
                                <div class="form-group">
                                    <label for="user_review">Comment:</label>
                                    <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                                </div>
                                <input type="hidden" name="pid" id="pid" value="<?= $fetch_product["id"]; ?>">
                                <input type="hidden" name="name" id="name" value="<?= $fetch_product["name"]; ?>">
                                <input type="hidden" name="username" id="username" value="<?= $fetch_profile["username"]; ?>">
                                <input type="hidden" name="rating" id="rating" value="0">
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="btn btn-primary" id="save_review" name="add_review">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
              }
              }else{
                  echo '<p class=>belum ada produk yang ditambahkan!</p>';
              }
            ?>

              <h3 class="mt-3 ml-4">Product Reviews:</h3>
            </div>

          </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- Footer Includer -->
  <?php include 'components/footer.php'; ?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>


  <!-- jQuery Library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script>
    $(document).ready(function() {
      
      //Mengaktifkan Modal
      $('#add_review').click(function(){
      $('#review_modal').modal('show');
      });

      //Menyalakan bintang saat mouse mendekat
      $(document).on('mouseenter', '.submit_star', function(){
        var rating = $(this).data('rating');
        reset_background();
        for(var count = 1; count <= rating; count++)
        {
          $('#submit_star_'+count).addClass('text-warning');
        }
      });
      function reset_background()
      {
        for(var count = 1; count <= 5; count++)
        {
          $('#submit_star_'+count).addClass('star-light');
          $('#submit_star_'+count).removeClass('text-warning');
        }
      }

      //mematikan bintang saat mouse menjauh
      $(document).on('mouseleave', '.submit_star', function(){
        reset_background();
        for(var count = 1; count <= rating_data; count++)
        {
          $('#submit_star_'+count).removeClass('star-light');
          $('#submit_star_'+count).addClass('text-warning');
        }
      });

      //Menyalakan bintang saat mouse ditekan
      $(document).on('click', '.submit_star', function(){
          rating_data = $(this).data('rating');
          $('#rating').val(rating_data);
      });
    });
  </script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>


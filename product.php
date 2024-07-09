
<?php
include 'components/connect.php';

// Mulai sesi
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_level'])) {
    // Mendapatkan id dan level dari sesi
    $user_id = $_SESSION['user_id'];
    $user_level = $_SESSION['user_level'];

} else {
    $user_id = '';
    $user_level = '';
}

if(isset($_POST['add_to_cart'])){
    if($user_id == ''){
        header('location:sign-in.php');
    }else{
 
       $pid = $_POST['pid'];
       $pid = filter_var($pid, FILTER_SANITIZE_STRING);
       $name = $_POST['name'];
       $name = filter_var($name, FILTER_SANITIZE_STRING);
       $price = $_POST['price'];
       $price = filter_var($price, FILTER_SANITIZE_STRING);
       $image = $_POST['image'];
       $image = filter_var($image, FILTER_SANITIZE_STRING);
       $qty = $_POST['qty'];
       $qty = filter_var($qty, FILTER_SANITIZE_STRING);
 
       $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
       $check_cart_numbers->execute([$name, $user_id]);
 
       if($check_cart_numbers->rowCount() > 0){
          $message[] = 'already added to cart!';
       }else{
          $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
          $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
          header('location:cart.php');
          
       }
    }
}

// Mengambil data product dengan id dari page sebelumnya
$pid = $_GET['pid'];
$select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
$select_products->execute([$pid]);

// mengambil data review 
$reviews = $conn->prepare("SELECT rating, COUNT(*) as count FROM reviews WHERE pid = ? GROUP BY rating");
$reviews->execute([$pid]);

// Initialize review counts
$review_counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
$total_reviews = 0;

while ($row = $reviews->fetch(PDO::FETCH_ASSOC)) {
    $review_counts[$row['rating']] = $row['count'];
    $total_reviews += $row['count'];
}

// counting  average rating
$average_rating = 0;
$total_rating = 0;
foreach ($review_counts as $rating => $count) {
    $total_rating += $rating * $count;
}
if ($total_reviews > 0) {
    $average_rating = $total_rating / $total_reviews;
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Product Details</title>
        <!-- Favicon-->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
 
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/main.css" rel="stylesheet">

        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


</head>
<body>
    <!-- Header Includer -->
    <?php include 'components/header.php'; ?>

    <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Product Details</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="catalog.php">Catalogue</a></li>
            <li>Product Details</li>
          </ol>
        </div>

      </div>
    </div>
    <!-- End Breadcrumbs -->
    
    <!-- Header-->

    <!-- ======= Product Section ======= -->

      <?php
        if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){ 
      ?>
    <section class="py-5">
        <form action="" method="post">  
            <input type="hidden" name="id_user" value="<?= $fetch_profile['id']; ?>">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="./assets/img/menu/<?= $fetch_product['image'];?>" alt="...." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-<?= $fetch_product['id'];?></div>
                        <h1 class="display-5 fw-bolder"><?= $fetch_product['name'];?></h1>
                        <div class="fs-5 mb-2">
                            <span>Rp. <?= $fetch_product['price']; ?>,00</span>
                        </div>
                        <!-- Rating Bintang -->
                        <a href="product-review.php?pid=<?= $fetch_product['id'];?>" class="no-style-link" title="Check Reviews">
                            <div class="d-flex justify-large text-warning mb-3">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <?php if ($i <= round($average_rating)) : ?>
                                    <div class="bi-star-fill"></div>
                                <?php elseif ($i - $average_rating < 1) : ?>
                                    <div class="bi-star-half"></div>
                                <?php else : ?>
                                    <div class="bi-star"></div>
                                <?php endif; ?>
                            <?php endfor; ?>
                            </div>
                        </a>
                        <div class="mb-4">
                            <span>Ingredient: </span>
                            <p class="lead"><?= $fetch_product['ingredient']; ?></p>                                                                                                                                                                                                
                        </div>
                            <span>Description: </span>
                            <p class="lead"><?= $fetch_product['details']; ?></p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" name="qty" type="num" value="1" style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="add_to_cart" title="Add to cart">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- Related items section-->
    <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                
                <?php 
                    // Read produucts
                    // 1. Produk Terlaris
                    $stmt = $conn->prepare("SELECT * FROM products ORDER BY sold DESC LIMIT 4");
                    $stmt->execute();
                    $best_selling_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // 2. Produk di Keranjang
                    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                    $stmt->execute([$user_id]);
                    $cart_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // 3. Rekomendasi Berdasarkan Preferensi Aroma (Contoh sederhana)
                    $stmt = $conn->prepare("SELECT p.* FROM products p
                                            INNER JOIN cart c ON p.name = c.name
                                            WHERE c.user_id = ?
                                            GROUP BY p.id
                                            ORDER BY COUNT(*) DESC 
                                            LIMIT 4");
                    $stmt->execute([$user_id]);
                    $recommended_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // 4. Produk dengan Rating Tertinggi
                    $stmt = $conn->prepare("SELECT p.*, AVG(r.rating) as avg_rating FROM products p
                                            INNER JOIN reviews r ON p.id = r.pid
                                            GROUP BY p.id
                                            ORDER BY avg_rating DESC 
                                            LIMIT 4");
                    $stmt->execute();
                    $top_rated_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Gabungkan semua produk tanpa duplikat
                    $all_products = [];

                    // Fungsi untuk memeriksa duplikat
                    function isDuplicateProduct($product, $products) {
                        foreach ($products as $existing_product) {
                            if ($product['id'] == $existing_product['id']) {
                                return true;
                            }
                        }
                        return false;
                    }

                    // Tambahkan produk terlaris
                    foreach ($best_selling_products as $product) {
                        if (!isDuplicateProduct($product, $all_products)) {
                            $all_products[] = $product;
                        }
                    }

                    // Tambahkan produk di keranjang
                    foreach ($cart_products as $product) {
                        if (!isDuplicateProduct($product, $all_products)) {
                            $all_products[] = $product;
                        }
                    }

                    // Tambahkan rekomendasi berdasarkan preferensi aroma
                    foreach ($recommended_products as $product) {
                        if (!isDuplicateProduct($product, $all_products)) {
                            $all_products[] = $product;
                        }
                    }

                    // Tambahkan produk dengan rating tertinggi
                    foreach ($top_rated_products as $product) {
                        if (!isDuplicateProduct($product, $all_products)) {
                            $all_products[] = $product;
                        }
                    }

                    // Hanya ambil 4 produk pertama
                    $all_products = array_slice($all_products, 0, 4);

                    // Jika kurang dari 3 produk, tambahkan produk random
                    if (count($all_products) < 4) {
                        $stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT ?");
                        $stmt->execute([4 - count($all_products)]);
                        $random_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $all_products = array_merge($all_products, $random_products);
                    }

                    // Tampilkan produk rekomendasi
                    foreach ($all_products as $fetch_product) {
                ?>

                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/menu/<?= $fetch_product['image'];?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $fetch_product['name']; ?></h5>
                                    <!-- Product price-->
                                    Rp <?= $fetch_product['price']; ?>,00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" title="Go to product detail" href="product.php?pid=<?= $fetch_product['id'];?>">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        </section>
      <?php
                
      }
      }else{
          echo '<p class=>belum ada produk yang ditambahkan!</p>';
      }
      ?>
        <!-- Footer Includer -->
        <?php include 'components/footer.php'; ?>

        <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TGN Premium Parfume</title>
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
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

  <!-- Header Includer -->
  <?php include 'components/header.php'; ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">Enjoy Your Fragrance<br>All Day</h2>
          <p data-aos="fade-up" data-aos-delay="100">Take a chance for satisfying results. every activity you do has a great influence on encouragement, such as using TGN perfume which will start every occasion with a very extraordinary</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="catalog.php" class="btn-book-a-table">Order Now</a>
            <a href="https://www.youtube.com/watch?v=rZKZb5WqWNA" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="assets/img/parfum.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <p>Learn More <span>About Us</span></p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-7 position-relative about-img" style="background-image: url(assets/img/about.jpg) ;" data-aos="fade-up" data-aos-delay="150">
            <div class="call-us position-absolute">
              <h4>Order Now</h4>
              <p>+62 8222999 1239</p>
            </div>
          </div>
          <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
              TGN Parfume is a fragrant liquid typically made from essential oils extracted from flowers, spices, fruits, and other aromatic substances. It is mixed with a solvent, such as alcohol or water, to create a pleasant and long-lasting scent.
              </p>
              <ul>
                <li><i class="bi bi-check2-all"></i> The initial scents perceived immediately after applying the perfume. They are usually light and evaporate quickly. Examples include citrus, floral, and fruity notes.</li>
                <li><i class="bi bi-check2-all"></i> These scents emerge just before the top notes dissipate. They are often more rounded and contribute to the perfume's full body. Examples include floral, spicy, and herbal notes.</li>
                <li><i class="bi bi-check2-all"></i> he final and longest-lasting scents that appear once the perfume has dried. They provide depth and stability to the overall fragrance. Examples include woody, musky, and oriental notes.</li>
              </ul>
              <p>
              TGN Parfume are classified based on their concentration of aromatic compounds, which influences their strength and longevity.
              </p>

              <div class="position-relative mt-4">
                <img src="assets/img/about-1.jpg" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=rZKZb5WqWNA" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="why-box">
              <h3>Why Choose TGN ?</h3>
              <p>
              Choosing to wear perfume can be a personal preference, and people may have various reasons for using it. Here are some common reasons why individuals choose to wear perfume:
              </p>
            </div>
          </div><!-- End Why Box -->

          <div class="col-lg-8 d-flex align-items-center">
            <div class="row gy-4">

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-clipboard-data"></i>
                  <h4>Enhancing Personal Fragrance</h4>
                  <p>Cone of the primary reasons for wearing perfume is to enhance one's personal fragrance. Perfume can add a pleasant and appealing scent to an individual's natural body odor.</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-gem"></i>
                  <h4>Boosting Confidence</h4>
                  <p>Wearing a fragrance that one enjoys can boost confidence and create a positive self-image. Feeling good about how one smells can contribute to overall self-esteem.</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-inboxes"></i>
                  <h4>Expressing Individuality</h4>
                  <p>Perfume is a form of self-expression, and the choice of fragrance can convey aspects of an individual's personality, style, and preferences. It becomes a part of someone's personal identity.</p>
                </div>
              </div><!-- End Icon Box -->

            </div>
          </div>

        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Stats Counter Section ======= (ga bisa ke ganti gambarnya <; ) -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="zoom-out">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>
              <p>Clients</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="2" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div><!-- End Stats Item -->
          
          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter"></span>
              <p>Workers</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>
    </section>
    <!-- End Stats Counter Section -->

  

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Testimonials</h2>
          <p>What Are They <span>Saying About Us</span></p>
        </div>

        <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        This TGN perfume has incredible longevity! The scent remains noticeable all day without the need for reapplication.
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Prilly Latuconsina</h3>
                      <h4>Artis</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="assets/img/testimonials/testimonials-prilly.jpg" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        I wore this perfume on my wedding day, and every time I catch a whiff of its scent, it brings back beautiful memories.
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Gading Martin</h3>
                      <h4>Aktor &amp; Artis</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="assets/img/testimonials/testimonials-gading.jpg" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        My favorite celebrity always wears this perfume, so I decided to give it a try. Turns out, I love it!
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Boy Wiliam</h3>
                      <h4>Youtuber</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="assets/img/testimonials/testimonials-boy.jpg" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        The scent of TGN perfume is truly captivating, providing an extraordinary experience. I love how the fragrance is light yet long-lasting. A great choice!
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Rafi Ahmad</h3>
                      <h4>Artis &amp; Youtuber</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="assets/img/testimonials/testimonials-rafi.jpg" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Events Section ======= -->
    <section id="new" class="events">
      <div class="container-fluid" data-aos="fade-up">

      <div class="section-header">
        <h2 style="color: #333;">Exclusive Perfume Collection</h2>
        <p style="color: #666;">Discover <span>Your Signature Scent</span></p>
      </div>

        <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img/parfume-iklan.png)">
              <h3>Elegant Fragrance</h3>
              <div class="price align-self-start">
                <a href="index.php#menu" style="color: white;">Special Offer</a>
              </div>
              <p class="description">
              Indulge in the captivating aroma of our elegant fragrance. Perfect for any occasion.
              </p>
            </div><!-- End Event item -->

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img/parfume-iklan1.png)">
              <h3>Luxurious Blend</h3>
              <div class="price align-self-start">
                <a href="index.php#menu" style="color: white;">Exclusive Deal</a>
              </div>
              <p class="description">
              Immerse yourself in the luxurious blend of our signature perfume. Unleash your senses.
              </p>
            </div><!-- End Event item -->

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img/parfume-iklan2.png)">
              <h3>Celebrate Essence</h3>
              <div class="price align-self-start">
                <a href="index.php#menu" style="color: white;">Limited Stock</a>
              </div>
              <p class="description">
              Celebrate your essence with our exclusive perfume. A scent that defines you.
              </p>
            </div><!-- End Event item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Events Section -->

<!-- ======= Staff Section ======= -->
<section id="staff" class="chefs section-bg">
      <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Our</h2>
      <p><span>Professional</span> Staff</p>
    </div>

    <div class="row gy-4">

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/staff/putra-ai.jpg" class="img-fluid" alt="">
            <div class="social">
              <a href="twitter.com"><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Putra Ardiansyah</h4>
            <span>STAFF PARFUM</span>
            <p>Passionate about crafting exquisite fragrances, Putra is our master perfumer with a keen sense of olfactory artistry. His expertise in blending unique scents ensures a delightful and memorable experience for every fragrance enthusiast.</p>
          </div>
        </div>
      </div><!-- End Staff Member -->

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/staff/fachri-ai.jpg" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Fachri Aditya Rizky</h4>
            <span>STAFF PARFUM</span>
            <p>our talented Perfume Telu Gusti Noir His olfactory creations weave stories that transport you to realms of elegance and allure. Immerse yourself in the symphony of scents meticulously crafted by this aromatic virtuoso.</p>
          </div>
        </div>
      </div><!-- End Staff Member -->

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/staff/krisna-ai.jpg" class="img-fluid" alt="">
            <div class="social">
              <a href="https://twitter.com/ShedHooman"><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Krisna Aprian Putra Wirawan</h4>
            <span>STAFF PARFUM</span>
            <p>Krisna our dedicated Perfume Specialist. With a refined sense of scent and a passion for helping customers find their signature fragrance, Krisna ensures a personalized and delightful experience for every visitor. Her expertise in the world of perfumery makes him an invaluable member of our team.</p>
          </div>
        </div>
      </div><!-- End Staff Member -->

    </div>

  </div>
</section><!-- End Staff Section -->

   <!-- ======= Gallery Section ======= -->
   <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>gallery</h2>
          <p>Check <span>Our Gallery</span></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/galery-parfum.png"><img src="assets/img/gallery/galery-parfum.png" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/galery-parfum1.png"><img src="assets/img/gallery/galery-parfum1.png" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/galery-parfum2.png"><img src="assets/img/gallery/galery-parfum2.png" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/galery-parfum3.png"><img src="assets/img/gallery/galery-parfum3.png" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/galery-parfum4.png"><img src="assets/img/gallery/galery-parfum4.png" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/galery-parfum5.png"><img src="assets/img/gallery/galery-parfum5.png" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/galery-parfum6.jpg"><img src="assets/img/gallery/galery-parfum6.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/galery-parfum7.png"><img src="assets/img/gallery/galery-parfum7.png" class="img-fluid" alt=""></a></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Need Help? <span>Contact Us</span></p>
        </div>

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-map flex-shrink-0"></i>
              <div>
                <h3>Our Address</h3>
                <p>Jalan Warung Jati Barat No.98. RT.1/RW.7. Pejaten Barat. Daerah Khusus Ibukota Jakarta 12510. Indonesia.</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>telugustinoir@gmail.com</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+62 822 9991 1239</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-share flex-shrink-0"></i>
              <div>
                <h3>Opening Hours</h3>
                <div><strong>Monday-Friday:</strong> 9AM - 5PM; </div>
                  <div></div><strong>Saturday-Sunday:</strong> Closed
                </div>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

        <form action="https://submit-form.com/UrK9NyKuM"  class="p-3 p-md-4">
  <label for="name">Name</label>
  <input id="name" type="text" name="name" class="form-control" placeholder="Your Name" required="" />

  <label for="email">Email</label>
  <input id="email" type="email" name="email" class="form-control" placeholder="Your Email" required="" />
  
  <label for="subject">Subject</label>
  <input id="subject" type="subject" name="subject" class="form-control" placeholder="Message Subject" required="" />

  <label for="message">Message</label>
  <textarea id="message" class="form-control" name="message" rows="5" placeholder="Message" required=""></textarea>

  <div class="text-center">
    <button class="btn-email" type="submit">Send Message</button>
  </div>
</form>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  
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

</body>

</html>

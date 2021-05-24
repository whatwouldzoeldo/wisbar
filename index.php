<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Wisata Jawa Barat</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Maundy - v4.2.0
  * Template URL: https://bootstrapmade.com/maundy-free-coming-soon-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php
  require_once("sparqllib.php");
  $test = "";
  if (isset($_POST['search-wisata'])) {
    $test = $_POST['search-wisata'];
    $data = sparql_get(
      "http://localhost:3030/wisatajabar/query",
      "
      PREFIX p: <http://wisatajabar.com>
      PREFIX d: <http://wisatajabar.com/ns/data#>
      
      SELECT ?id ?namaWisata ?jenisWisata ?alamat ?fasilitas ?telpon
      WHERE
      { 
          ?id d:namaWisata ?namaWisata ;
              d:jenisWisata ?jenisWisata;
              d:alamatWisata ?alamat;
              d:fasilitasWisata ?fasilitas;
              d:telponWisata ?telpon;
              FILTER regex(?namaWisata,  '$test')
      
      }
            "
    );
  } else {
    $data = sparql_get(
      "http://localhost:3030/wisatajabar/query",
      "
      PREFIX p: <http://wisatajabar.com>
      PREFIX d: <http://wisatajabar.com/ns/data#>
      
      SELECT ?id ?namaWisata ?jenisWisata ?alamat ?fasilitas ?telpon
      WHERE
      { 
          ?id d:namaWisata ?namaWisata ;
              d:jenisWisata ?jenisWisata;
              d:alamatWisata ?alamat;
              d:fasilitasWisata ?fasilitas;
              d:telponWisata ?telpon;
      
      }
            "
    );
  }

  if (!isset($data)) {
    print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
  }
  ?>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center">

      <h1>Wisata Jawa Barat</h1>
      <h2>Cari destinasi wisata anda di sini!</h2>
      <!-- <div class="countdown d-flex justify-content-center" data-count="2021/12/3">
        <div>
          <h3>%d</h3>
          <h4>Days</h4>
        </div>
        <div>
          <h3>%h</h3>
          <h4>Hours</h4>
        </div>
        <div>
          <h3>%m</h3>
          <h4>Minutes</h4>
        </div>
        <div>
          <h3>%s</h3>
          <h4>Seconds</h4>
        </div>
      </div> -->

      <div class="main">
        <div class="container">
          <div class="shadow mb-5 bg-white rounded layout">
            <div class="form-group has-search">
              <form action="" method="post" id="nameform">
                <div class="input-group">
                  <span class="fa fa-search fa-1x form-control-feedback"></span>
                  <input type="text" name="search-wisata" class="form-control form-control-lg " placeholder="Cari Tempat Wisata">
                  <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"> Cari
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="social-links text-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div> -->

    </div>
  </header><!-- End #header -->

  <div class="konten">
    <div class="container">
      <h3>Hasil Pencarian Tempat Wisata</h3>
      <p>Keyword : <span>
          <?php
          if ($test != NULL) {
            echo $test;
          } else {
            echo "Search Keyword";
          }
          ?></span></p>
      <hr>
      <div class="row">

        <?php foreach ($data as $dat) : ?>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <div class="header-data"> <b>Nama Wisata :</b></div>
                  <div class="item-data"><?= $dat['namaWisata'] ?></div>
                  <hr>
                </div>

                <div>
                  <p>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#drop" aria-expanded="false" aria-controls="drop">
                      Alamat Wisata
                    </button>
                  </p>
                  <div class="collapse" id="drop">
                    <div class="card card-body">
                      <p class="card-text">
                        <?= $dat['alamatWisata'] ?>
                        <br>
                        <!--<?= $dat['id'] ?>-->
                      </p>
                    </div>
                  </div>
                </div>
                <hr>

              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <div class="header-data"> <b>Jenis Wisata :</b>
                    <div class="item-data"><?= $dat['jenisWisata'] ?></div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="header-data"> <b>Fasilitas Wisata :</b></div>
                  <div class="item-data"><?= $dat['fasilitasWisata'] ?></div>
                </li>
                <li class="list-group-item">
                  <div class="header-data"> <b>No. Telepon :</b></div>
                  <div class="item-data"><?= $dat['telponWisata'] ?></div>
                </li>
              </ul>

            </div>
          </div>

        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <!-- <div class="section-title">
          <h2>About Us</h2>
          <p>Illo velit quae dolorem voluptate pireda notila set. Corrupti voluptatum tempora iste ratione deleniti corrupti nostrum ut</p>
        </div>

        <div class="row mt-2">
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-briefcase"></i></div>
            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-bar-chart"></i></div>
            <h4 class="title"><a href="">Dolor Sitema</a></h4>
            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class="bi bi-brightness-high"></i></div>
            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
          </div>
        </div> -->

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Contact Us Section ======= -->
    <!-- <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact Us</h2>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group mt-3">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>End Contact Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Maundy</span></strong>. All Rights Reserved
      </div>
      <div class="credits"> -->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/maundy-free-coming-soon-bootstrap-theme/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div> -->
  <!-- </footer>End #footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
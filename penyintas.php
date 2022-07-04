<?php 
  require 'NotifikasiPenyintas.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>MBKM SPI 4</title>
  
  <link rel="icon" href="img/logo.png">

  <link rel="stylesheet" href="css/maicons.css">

  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="vendor/animate/animate.css">

  <link rel="stylesheet" href="css/theme.css">
</head>
<body>
  
  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky" data-offset="300">
      <div class="container">
        <a href="index.html" class="navbar-brand">MBKM <span class="text-primary">SPI4</span></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapsed" id="navbarContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="service.html">Layanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Kontak</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-2" href="service.html">Kembali</a>
            </li>
          </ul>
        </div>

      </div>
    </nav>
  </header>

  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <form action="" method="POST" class="contact-form py-5 px-lg-5">
          <h2 class="mb-4 font-weight-medium text-secondary">Penyintas Covid-19</h2>
          <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
              <label class="text-black" for="fname">Nama Depan</label>
              <input type="text" name="fname" id="fname" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="text-black" for="lname">Nama Belakang</label>
              <input type="text" name="lname" id="lname" class="form-control">
            </div>
          </div>
  
          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="email">Nomor handphone</label>
              <input type="text" name="hp" id="email" class="form-control" required>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="email">Alamat</label>
              <input type="text" name="alamat" id="email" class="form-control" required>
            </div>
          </div>
  
          <div class="row form-group">
  
            <div class="col-md-12">
              <label class="text-black" for="subject">Tanggal Sembuh</label>
              <input type="date" name="tanggal" id="subject" class="form-control" required>
            </div>
          </div>
          
         

  
          <div class="row form-group mt-4">
            <div class="col-md-12">
              <input type="submit" name="lapor" value="Lapor" class="btn btn-primary">
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-6 px-0">
        <div class="map">
                    <iframe width="700" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16888.565554016808!2d109.34615518625219!3d-7.409784417376425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65598374036e43%3A0xc12301b03eed90ea!2sRumah%20Sakit%20Umum%20Harapan%20Ibu!5e0!3m2!1sid!2sid!4v1642431156643!5m2!1sid!2sid"></iframe>
                 </div>
      </div>
    </div>
  </div>

  <p class="text-center" id="copyright">Copyright &copy; 2022. MBKM SPI 4 develop by <a href="https://www.instagram.com/rachmatteeee/" target="_blank">Rachmatteeee</a></p>

<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/google-maps.js"></script>

<script src="vendor/wow/wow.min.js"></script>

<script src="js/theme.js"></script>

<script type='text/javascript'> 
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>
<?php 
require 'connectDB.php';
  date_default_timezone_set('Asia/Jakarta');
  $date= date("Y-m-d");
  $type = "**Notifikasi Saran Baru**";
  if (isset($_POST['input'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
      $sql = "INSERT INTO saran ( tanggal, first_name, last_name, email, subjek, pesan) VALUES (? ,?, ?, ?, ?, ?)";
      $result = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_input_saran";
        exit();
      }
      else{
        mysqli_stmt_bind_param($result, "ssssss", $date, $fname, $lname, $email, $subject, $message);
        mysqli_stmt_execute($result);
      }
       $apiToken = "5104627636:AAFYK_9jCOkproO7dtRN4VP-4hx1TtaItN0";
        $data = [
            'chat_id' => '-797192102', 
            'text' => $type
        ];
        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
  }
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
        <a href="#" class="navbar-brand">MBKM<span class="text-primary">SPI4</span></a>

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
              <a class="nav-link" href="blog.html">Blog</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="contact.php">Kontak</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-2" href="mbkm.php">Login</a>
            </li>
          </ul>
        </div>

      </div>
    </nav>

    <div class="container">
      <div class="page-banner">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-md-6">
            <nav aria-label="Breadcrumb">
              <ul class="breadcrumb justify-content-center py-0 bg-transparent">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Kontak</li>
              </ul>
            </nav>
            <h1 class="text-center">Hubungi Kami</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="page-section">
    <div class="container">
      <div class="row text-center align-items-center">
        <div class="col-lg-4 py-3">
          <div class="display-4 text-center text-primary"><span class="mai-pin"></span></div>
          <p class="mb-3 font-weight-medium text-center text-lg">Alamat</p>
          <p class="mb-0 text-secondary text-center">Jl. Raya Mayjen Sungkono No.KM 5, Dusun 2, Blater, Kec. Kalimanah, Kabupaten Purbalingga, Jawa Tengah 53371</p>
        </div>
        <div class="col-lg-4 py-3">
          <div class="display-4 text-center text-primary"><span class="mai-call"></span></div>
          <p class="mb-3 font-weight-medium text-lg text-center">Phone</p>
          <p class="mb-0 text-center text-secondary">+62 821 3500 9418</a></p>
          <p class="mb-0 text-center text-secondary">(0281) 6596700</a></p>
        </div>  
        <div class="col-lg-4 py-3">
          <div class="display-4 text-center text-primary"><span class="mai-mail"></span></div>
          <p class="mb-3 font-weight-medium text-lg text-center">Email Address</p>
          <p class="mb-0 text-center text-secondary">rachmat.trishardian1999@gmail.com</a></p>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <form action="" method="post" class="contact-form py-5 px-lg-5">
            <h2 class="mb-4 font-weight-medium text-secondary">Kotak Saran</h2>
            <div class="row form-group">
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">Nama Depan</label>
                <input type="text" id="fname" name="fname" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="text-black" for="lname">Nama Belakang</label>
                <input type="text" id="lname" name="lname" class="form-control">
              </div>
            </div>
    
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control">
              </div>
            </div>
    
            <div class="row form-group">
    
              <div class="col-md-12">
                <label class="text-black" for="subject">Subjek</label>
                <input type="text" id="subject" name="subject" class="form-control">
              </div>
            </div>
    
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="message">Saran</label>
                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Tulis saran anda disini..."></textarea>
              </div>
            </div>
    
            <div class="row form-group mt-4">
              <div class="col-md-12">
                <input type="submit" name="input" value="Kirim" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-6 px-0">
          <div class="map">
                      <iframe width="700" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.329629147629!2d109.33414531472361!3d-7.428726994640473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559814ade5b79%3A0xaef1b7bab5cba0f0!2sFakultas%20Teknik%20Universitas%20Jenderal%20Soedirman!5e0!3m2!1sen!2sus!4v1629108219405!5m2!1sen!2sus"></iframe>
                   </div>
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA_zqjFMsJM_sxP9-6Pde5vVCTyJmUHM&callback=initMap"></script>

<script type='text/javascript'> 
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>

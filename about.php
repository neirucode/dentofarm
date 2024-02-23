<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link  rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - ABOUT US</title>
  <style>
    .box{
      border-top-color: var(--teal) !important;
    }
    p{
      font-size: 18px;
    }
    .card-bg{
      position: relative;
      color: light;
      background: #3f9cc1;
      padding: 10px;
    }
  </style>
</head>
<body class="bg-light">
<div class="wrapper">

<?php
if (isset($_SESSION['active_image'])) {
  $backgroundImage = $_SESSION['active_image'];
  echo "<style>body { background-image: url('$backgroundImage'); background-size: cover; }</style>";
} else {
  // Fallback if the session variable is not set
  echo "<style>body { background-image: none; }</style>";
}
?>

  <?php require('inc/header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-light"></div>
    <p class="text-center text-light mt-3">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. 
      Temporibus incidunt odio quos <br> dolore commodi repudiandae 
      tenetur consequuntur et similique asperiores.
    </p>
  </div>

  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2 text-light">
        <h3 class="mb-3">Lorem ipsum dolor sit</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. 
          Omnis minima sapiente aliquam sed officia nostrum fuga?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. 
          Omnis minima sapiente aliquam sed officia nostrum fuga?
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
        <img src="images/about/about.jpg" class="w-100">
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="card-bg rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/hotel.svg" width="70px">
          <h4 class="mt-3">100+ ROOMS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="card-bg rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/customers.svg" width="70px">
          <h4 class="mt-3">200+ CUSTOMERS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="card-bg rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/rating.svg" width="70px">
          <h4 class="mt-3">150+ REVIEWS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="card-bg rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/staff.svg" width="70px">
          <h4 class="mt-3">200+ STAFFS</h4>
        </div>
      </div>
    </div>
  </div>
  <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>

<div class="container px-4">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-5">
      <?php 
        $about_r = selectAll('team_details');
        $path = ABOUT_IMG_PATH;
        while ($row = mysqli_fetch_assoc($about_r)) {
          echo <<<data
            <div class="swiper-slide custom-bg text-center overflow-hidden rounded" style="height: 500px; position: relative;">
              <img src="$path$row[picture]" class="w-100" style="object-fit: cover; height: 100%; width: 100%;">
              <div style="position: absolute; bottom: 0; left: 0; right: 0; background: transparent; padding: 10px;">
                <h5 class="mt-2 fw-bolder text-dark">$row[name]</h5>
              </div>
            </div>
          data;
        }
      ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>


  <?php require('inc/footer.php'); ?>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
  </script>


</body>
</html>
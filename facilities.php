<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - FACILITIES</title>
  <style>
    .pop:hover{
      border-top-color: #DAF7A6 !important;
      transform: scale(1.03);
      transition: all 0.3s;
    }
    .card-bg{
      position: relative;
      color: white;
      background: #3f9cc1;
      padding: 10px;
    }
  </style>
  </style>
</head>
<body>
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
    <h2 class="fw-bold h-font text-center">OUR SERVICES</h2>
    <div class="h-line bg-light"></div>
    <p class="text-center text-white mt-3">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. 
      Temporibus incidunt odio quos <br> dolore commodi repudiandae 
      tenetur consequuntur et similique asperiores.
    </p>
  </div>

  <div class="container">
    <div class="row">
      <?php 
        $res = selectAll('facilities');
        $path = FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
          echo<<<data
            <div class="col-lg-4 col-md-6 mb-5 px-4">
              <div class="card-bg rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                  <img src="$path$row[icon]" width="40px">
                  <h5 class="m-0 ms-3">$row[name]</h5>
                </div>
                <p>$row[description]</p>
              </div>
            </div>
          data;
        }
      ?>
    </div>
  </div>


  <?php require('inc/footer.php'); ?>

</body>
</html>
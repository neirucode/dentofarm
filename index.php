<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title']?> - HOME</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

</head>

<body style="background-color: #E7F7F8;">

<?php require('inc/header.php'); ?>

  <script>
    const hambuger = document.querySelector('.hambuger');
    const navMenu = document.querySelector('.nav-menu');

    hambuger.addEventListener("click", mobileMenu);

    function mobileMenu() {
      hambuger.classList.toggle("active");
      navMenu.classList.toggle("active");
    }

    const navLink = document.querySelectorAll('.nav-link');
    navLink.forEach((n) => n.addEventListener("click", closeMenu));

    function closeMenu() {
      hambuger.classList.remove("active");
      navMenu.classList.remove("active");
    }
  </script>
<section class="home" id="home">
  <div class="head_container">
    <div class="box">
      <div class="text ">
        <h2>Where Time Stands Still.</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
        <a href="about.php"><button class="button">MORE INFO</button></a>
      </div>
    </div>
    <div class="image">
      <img class="main-slide">
    </div>

    <div class="image_item">
    <?php
$res = selectAll('carousel');
$firstImage = true;

while ($row = mysqli_fetch_assoc($res)) {
    $path = CAROUSEL_IMG_PATH;
    $activeClass = $firstImage ? 'active' : '';
    if (!isset($_SESSION['active_image'])) {
        $_SESSION['active_image'] = $path . $row['image'];
    }
    echo <<<data
        <img src="$path$row[image]" class="slide $activeClass" onclick="enlargeImage('$path$row[image]', this)">
    data;

    $firstImage = false;
}
?>
</div>
</div>
</section>
<script>
function enlargeImage(imagePath, clickedImage) {
    const allImages = document.querySelectorAll('.slide');
    allImages.forEach(image => image.classList.remove('active'));
    clickedImage.classList.add('active');

    const mainImage = document.querySelector('.image .main-slide');
    mainImage.src = imagePath;
}
const firstImage = document.querySelector('.image_item .slide');
enlargeImage(firstImage.getAttribute('src'), firstImage);
</script>
  <section class="book">
    <div class="container flex">
      <div class="input grid">
        <div class="box">
        <form action="rooms.php">
          <label>Check-in:</label>
          <input type="date" name="checkin" required placeholder="Check-in-Date">
        </div>
        <div class="box">
          <label>Check-out:</label>
          <input type="date" name="checkout" required placeholder="Check-out-Date">
        </div>
        <div class="box">
          <label>Adults:</label> <br>
          <select class="form-select shadow-none align-items-center text-secondary fw-bold" style="background-color: transparent;" name="adult">
          <?php
                  $guests_q = mysqli_query($con, "SELECT MAX(adult) AS `max_adult`, MAX(children) AS `max_children` 
                    FROM `rooms` WHERE `status`='1' AND `removed`='0'");
                  $guests_res = mysqli_fetch_assoc($guests_q);

                  for ($i = 1; $i <= $guests_res['max_adult']; $i++) {
                    echo "<option value='$i'>$i</option>";
                  }
                  ?>
          </select>
        </div>
        <div class="box">
          <label>Children:</label> <br>
          <select class="form-select shadow-none align-items-center text-secondary fw-bold" style="background-color: transparent;" name="children">
                  <?php
                  for ($i = 1; $i <= $guests_res['max_children']; $i++) {
                    echo "<option value='$i'>$i</option>";
                  }
                  ?>
                </select>
        </div>
      </div>
      <input type="hidden" name="check_availability">
      <div class="search text-white">
        <input type="submit" value="SUBMIT">
      </div>
    </div>
    </form>
  </section>
  
  <section class="about top" id="about">
    <div class="container flex">
      <div class="left">
        <div class="img">
          <img src="images\extras\sc.jpg" class="image1">
          <img src="images\extras\330419707_118296287735130_2549206940498523572_n.jpg" class="image2">
        </div>
      </div>
      <div class="right">
        <div class="heading">
          <h5>RAISING COMFORT TO THE HIGHEST LEVEL</h5>
          <h2>Welcome to Dentofarm Resort</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <a href="about.php"><button class="button btn1">READ MORE</button></a>
        </div>
      </div>
    </div>
  </section>
  <section class="wrapper top">
    <div class="container">
      <div class="text align-items-center">
        <h2>Our Services</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

        <div class="content">
        <?php
          $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 6");
          $path = FACILITIES_IMG_PATH;

          while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
            <div class="box flex align-items-center">
              <img src="$path$row[icon]" width="50px">
              <span class='mx-3'>$row[name]</span>
            </div>
          data;
          }
          ?>
        
        </div>
      </div>
    </div>
  </section>
  <section class="room top" id="room">
    <div class="container">
      <div class="heading_top flex1">
        <div class="heading">
          <h5>RAISING COMFORT TO THE HIGHEST LEVEL</h5>
          <h2>Rooms & Suites</h2>
        </div>
        <div class="btn">
          <a href="rooms.php"><button class="button btn1">VIEW ALL</button></a>
        </div>
      </div>

      <div class="content grid">
      <?php

$room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3", [1, 0], 'ii');

while ($room_data = mysqli_fetch_assoc($room_res)) {
  // get features of room

  $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
    INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
    WHERE rfea.room_id = '$room_data[id]'");

  $features_data = "";
  while ($fea_row = mysqli_fetch_assoc($fea_q)) {
    $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
      $fea_row[name]
    </span>";
  }

  // get facilities of room

  $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
    INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
    WHERE rfac.room_id = '$room_data[id]'");

  $facilities_data = "";
  while ($fac_row = mysqli_fetch_assoc($fac_q)) {
    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
      $fac_row[name]
    </span>";
  }

  // get thumbnail of image

  $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
  $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
    WHERE `room_id`='$room_data[id]' 
    AND `thumb`='1'");

  if (mysqli_num_rows($thumb_q) > 0) {
    $thumb_res = mysqli_fetch_assoc($thumb_q);
    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
  }

  $book_btn = "";

  if (!$settings_r['shutdown']) {
    $login = 0;
    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
      $login = 1;
    }

    $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</button>";
  }

  $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
    WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

  $rating_res = mysqli_query($con, $rating_q);
  $rating_fetch = mysqli_fetch_assoc($rating_res);

  $rating_data = "";

  if ($rating_fetch['avg_rating'] != NULL) {
    $rating_data = "<div class='rating mb-4'>
      <h6 class='mb-1'>Rating</h6>
      <span class='badge rounded-pill bg-light'>
    ";

    for ($i = 0; $i < $rating_fetch['avg_rating']; $i++) {
      $rating_data .= "<i class='bi bi-star-fill text-warning'></i> ";
    }

    $rating_data .= "</span>
      </div>
    ";
  }

  // print room card

echo <<<data
    <div class="box">
      <div class="img">
        <a href="../dentofarm/room_details.php?id=$room_data[id]"><img src="$room_thumb" style='max-height: 38vh;'></a>
      </div>
      <div class="text">
        <a href="../dentofarm/room_details.php?id=$room_data[id]"><h3>$room_data[name]</h3></a>
        <p> <span>₱</span>$room_data[price]<span>/per night</span> </p>
      </div>
    </div>
data;
}
?>
        </div>
      </div>
    </div>
  </section>

  <section class="wrapper wrapper2 top">
    <div class="container">
      <div class="text">
        <div class="heading">
          <h5>AT THE HEART OF COMMUNICATION</h5>
          <h2>People Say</h2>
        </div>

        <div class="container-fluid">
            <div class="testimonials swiper swiper-testimonials">
              <div class="swiper-wrapper mb-2">
                <?php

                $review_q = "SELECT rr.*,uc.name AS uname, uc.profile, r.name AS rname FROM `rating_review` rr
            INNER JOIN `user_cred` uc ON rr.user_id = uc.id
            INNER JOIN `rooms` r ON rr.room_id = r.id
            ORDER BY `sr_no` DESC LIMIT 6";

                $review_res = mysqli_query($con, $review_q);
                $img_path = USERS_IMG_PATH;

                if (mysqli_num_rows($review_res) == 0) {
                  echo 'No reviews yet!';
                } else {
                  while ($row = mysqli_fetch_assoc($review_res)) {
                    $stars = "<i class='bi bi-star-fill text-warning'></i> ";
                    for ($i = 1; $i < $row['rating']; $i++) {
                      $stars .= " <i class='bi bi-star-fill text-warning'></i>";
                    }

                    echo <<<slides
                  <div class="swiper-slide p-2" style="height: 400px; object-fit: cover;">
                      <div class="profile d-flex align-items-center mb-3">
                        <img src="$img_path$row[profile]" class="rounded-circle" loading="lazy" width="20px">
                        <h6 class="m-0 ms-2">$row[uname]</h6>
                      </div>
                      <p>
                        $row[review]
                      </p>
                      <div class="rating p-1">
                        $stars
                    </div>
                  </div>
              slides;
                  }
                }

                ?>
              </div>
              <div class="swiper-pagination"></div>
            </div>

</div>

  </section>


    <section class="amenity top" id="amenity">
    <div class="container flex">
    <?php

 $res = mysqli_query($con, "SELECT * FROM `others` ORDER BY `id` DESC LIMIT 4");
  $path = OTHERS_IMG_PATH;

echo '<div class="left grid-container">';
while ($row = mysqli_fetch_assoc($res)) {
    echo '<div class="grid-item"><img src="' . $path . $row['picture'] . '"></div>';
}
echo '</div>';

echo <<<data
<div class="right">
    <div class="text">
        <h2>Other Amenities</h2>
        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
data;

mysqli_data_seek($res, 0); // Reset the result pointer

while ($row = mysqli_fetch_assoc($res)) {
    echo <<<data
    <div class="accordionWrapper">
        <div class="accordionItem open">
            <h2 class="accordionIHeading">{$row['name']}</h2>
            <div class="accordionItemContent">
                <p>{$row['description']}</p>
                
            </div>
        </div>
    </div>
data;
}

?>
    </div>


<style>
  .grid-container {
    display: grid;
    grid-template-columns: repeat(2, 2fr);
    gap: 1.3rem;
}

.grid-item {
    width: 100%;
    overflow: hidden;
}

.grid-item img {
    width: 100%;
    min-height: auto;
    display: block;
}
</style>

  </section>
  <script>
  var accItem = document.getElementsByClassName('accordionItem');
  var accHD = document.getElementsByClassName('accordionIHeading');

  for (i = 0; i < accHD.length; i++) {
    accHD[i].addEventListener('click', toggleItem, false);
  }

  function toggleItem() {
    var itemClass = this.parentNode.className;
    for (var i = 0; i < accItem.length; i++) {
      accItem[i].className = 'accordionItem close';
    }
    if (itemClass == 'accordionItem close') {
      this.parentNode.className = 'accordionItem open';
    }
  }

  // Close accordion by default
  for (var i = 0; i < accItem.length; i++) {
    accItem[i].className = 'accordionItem close';
  }

  //testimonials
  var swiper = new Swiper(".swiper-testimonials", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  loop: true,
  coverflowEffect: {
    rotate: 50,
    stretch: 0,
    depth: 100,
    modifier: 1,
    slideShadows: false,
  },
  pagination: {
    el: ".swiper-pagination",
  },
  autoplay: {
    delay: 3000, 
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
    },
    640: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});
</script>


<!-- gallery

<section class="gallary mtop " id="gallary">
    <div class="container">
      <div class="heading_top flex1">
        <div class="heading">
          <h5>WELCOME TO OUR PHOTO GALLERY</h5>
          <h2>Photo Gallery of Our Hotel</h2>
        </div>
        <div class="button">
          <button class="btn1">VIEW GALLERY</button>
        </div>
      </div>

      <div class="owl-carousel owl-theme">
        <div class="item">
          <img src="image/g1.jpg" alt="">
        </div>
        <div class="item">
          <img src="image/g2.jpg" alt="">
        </div>
        <div class="item">
          <img src="image/g3.jpg" alt="">
        </div>
        <div class="item">
          <img src="image/g4.jpg" alt="">
        </div>
        <div class="item">
          <img src="image/g5.jpg" alt="">
        </div>
        <div class="item">
          <img src="image/g6.jpg" alt="">
        </div>
        <div class="item">
          <img src="image/g7.jpg" alt="">
        </div>
        <div class="item">
          <img src="image/g8.jpg" alt="">
        </div>
      </div>

    </div>
</section> -->
<!-- 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      dots: false,
      navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2
        },
        1000: {
          items: 4
        }
      }
    })
  </script> -->



  <section class="map top">
  <iframe src="<?php echo $contact_r['iframe'] ?>" width="600" height="650" style="border:0;"
      allowfullscreen="" loading="lazy"></iframe>
</section>

      <!-- Password reset modal and code -->
      <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="recovery-form">
              <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">
                  <i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password
                </h5>
              </div>
              <div class="modal-body">
                <div class="mb-4">
                  <label class="form-label">New Password</label>
                  <input type="password" name="pass" required class="form-control shadow-none">
                  <input type="hidden" name="email">
                  <input type="hidden" name="token">
                </div>
                <div class="mb-2 text-end">
                  <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">CANCEL</button>
                  <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

              </div>
            </div>
          </div>
      </div>
  <?php require('inc/footer.php'); ?>

</body>

</html>
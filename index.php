<?php
include('inc/header.php'); 
include('config/db.php'); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Banner Section */
        .banner-section {
            position: relative;
            background: #000; /* fallback background */
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: left;
            color: #fff;
            overflow: hidden;
        }
        .banner-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.4; /* overlay effect */
            position: absolute;
            top: 0; left: 0;
            z-index: 1;
        }
        .banner-content {
            position: relative;
            z-index: 2;
        }
        .banner-content h1 {
            font-size: 3rem;
            font-weight: 800;
        }
        .banner-content p {
            font-size: 1.2rem;
            margin: 15px 0;
        }
        .banner-content .btn {
            font-size: 1rem;
            padding: 10px 25px;
            border-radius: 30px;
        }
            .team-area {
      padding: 100px 0 70px;
      background: #fff;
    }
    .area-title h2 {
      font-weight: 700;
      margin-bottom: 15px;
    }
    .team {
      background: #f8f9fa;
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
    }
    .team:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }
    .team__img img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }
    .team__content {
      padding: 20px;
    }
    .team__content h4 {
      font-weight: 600;
      margin-bottom: 5px;
    }
    .team__content span {
      font-size: 0.9rem;
      color: #888;
    }
    </style>
</head>
<body>

    <!-- Banner Section -->
    <section class="banner-section">
        <!-- Background Image -->
        <img src="images/banner.png" alt="Banner">

        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="banner-content">
            <h1>𝒇𝒂𝒔𝒉𝒊𝒐𝒏.𝒉𝒖𝒃</h1>
                        <p>New arrivals are here. Shop the latest limited edition T-Shirts now.</p>
                        <a href="men.php" class="btn btn-light btn-lg">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<br><br><br>

 

  <!-- 🔍 Search Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold text-uppercase">Search Products</h2>
      <p class="text-muted">Find your favorite T-shirts !</p>
    </div>

    <div class="input-group mb-5 shadow-sm rounded-pill">
      <span class="input-group-text bg-primary text-white rounded-start-pill px-4">
        <i class="fa fa-search"></i>
      </span>
      <input type="text" id="search" class="form-control border-0 rounded-end-pill" placeholder="Search for products..." autocomplete="off">
    </div>

    <!-- Live Results -->
    <div class="row g-4" id="product-list">
      <!-- Products will appear here dynamically -->
    </div>
  </div>
</section>

<!-- jQuery (for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    // Load products based on input
    function loadProducts(query = '') {
      if (query.length > 0) {
        $.ajax({
          url: "search_products.php",
          method: "POST",
          data: { query: query },
          success: function(data) {
            $('#product-list').html(data);
          }
        });
      } else {
        $('#product-list').html('');
      }
    }

    // On typing
    $('#search').on('keyup input', function() {
      let query = $(this).val().trim();
      loadProducts(query);
    });
  });
</script>

<style>
  /* Product Card Styling */
  .product-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }
  .product-card img {
    height: 250px;
    object-fit: cover;
    width: 100%;
  }
  .product-card .card-body {
    background: #fff;
    padding: 1.2rem;
  }
  .product-card .btn {
    border-radius: 30px;
    font-weight: 600;
  }
</style>

    <section class="team-area">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="area-title text-center mb-50">
          <h2>Many Brands</h2>
          <p>T-Shirts Are Available</p>
        </div>
      </div>
    </div>
    <div class="row">
    
      <!-- Team Member 1 -->

      <!-- Team Member 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="team mb-30">
          <div class="team__img">
            <img src="images/images (2).jpeg" alt="">
          </div>
          <div class="team__content text-center">
            <h4></h4>
            <span></span>
          </div>
        </div>
      </div>
      <!-- Team Member 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="team mb-30">
          <div class="team__img">
            <img src="images/images (1).png" alt="">
          </div>
          <div class="team__content text-center">
            <h4></h4>
            <span></span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="team mb-30">
          <div class="team__img">
            <img src="images/images (3).png" alt="">
          </div>
          <div class="team__content text-center">
            <h4></h4>
            <span></span>
          </div>
        </div>
      </div>

            <div class="col-lg-4 col-md-6">
        <div class="team mb-30">
          <div class="team__img">
            <img src="images\images (4).png" alt="">
          </div>
          <div class="team__content text-center">
            <h4></h4>
            <span></span>
          </div>
        </div>
      </div>

            <div class="col-lg-4 col-md-6">
        <div class="team mb-30">
          <div class="team__img">
            <img src="images\puma.png" alt="">
          </div>
          <div class="team__content text-center">
            <h4></h4>
            <span></span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>



            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="contact text-center mb-30">
                           <img src="images\service-6.png" alt="">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="contact text-center mb-30">
                        <img src="images\service-9.png" alt="">
                        </div>
                    </div>
                    <div class="col-xl-4  col-lg-4 col-md-4 ">
                        <div class="contact text-center mb-30">
                          <img src="images\service-8.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
  </div>
</section>

<br><br><br>
 <section class="breadcrumb-area" data-background="img/bg/page-title.png">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-text text-center">
                            <h1>Contact Us</h1>
                            <ul class="breadcrumb-menu">
  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<br>
                <section class="contact-area pt-120 pb-90" data-background="assets/img/bg/bg-map.html">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="contact text-center mb-30">
                            <i class="fas fa-envelope"></i>
                            <h3>Mail Here</h3>
                            <p>fashion_hub@site.com</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="contact text-center mb-30">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3>Visit Here</h3>
                            <p>27 Division St, New York, NY 10002,
                                Jaklina, United Kingpung</p>
                        </div>
                    </div>
                    <div class="col-xl-4  col-lg-4 col-md-4 ">
                        <div class="contact text-center mb-30">
                            <i class="fas fa-phone"></i>
                            <h3>Call Here</h3>
                            <p>+8 (123) 985 789</p>
                            <p>+787 878897 87</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   <br>
<br>


</body>
</html>

<?php include('inc/footer.php'); ?>
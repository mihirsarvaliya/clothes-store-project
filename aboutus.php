<?php include('inc/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Mission & Team</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Owl Carousel (for testimonials if needed) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

  <style>
    /* Mission Section */
    .mission-text {
      padding: 50px 20px;
    }
    .mission-title p {
      font-size: 1rem;
      font-weight: 600;
      color: #007bff;
      margin-bottom: 10px;
    }
    .mission-title h1 {
      font-size: 2.2rem;
      font-weight: 800;
      margin-bottom: 20px;
    }
    .mission-text p {
      font-size: 1rem;
      color: #555;
      line-height: 1.7;
    }

    /* Testimonial Section */
    .big-team-area {
      position: relative;
      padding: 80px 0;
      background: #f8f9fa;
    }
    .big-team-area .big-image img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 30px;
    }
    .testimonial-item {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .testimonial-item p {
      font-size: 1.1rem;
      font-style: italic;
      margin-bottom: 10px;
    }
    .testimonial-item span {
      display: block;
      font-weight: bold;
      color: #007bff;
    }

    /* Team Section */
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

<!-- Mission Section -->
<section class="mission-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-7 col-lg-8">
        <div class="mission-text">
          <div class="mission-title">
            <p><span></span> </p>
            <h1>About Us</h1>
          </div>
          <p>Welcome to our Clothes Store, your go-to destination for trendy, stylish, and comfortable fashion. We believe clothing is more than just fabric – it’s a reflection of your personality and lifestyle. Our collection is carefully curated to bring you the latest designs, high-quality materials, and affordable prices. From casual wear to formal outfits, we offer something for everyone, ensuring you look and feel your best every day. Customer satisfaction is our top priority, and we strive to provide a seamless shopping experience. Thank you for choosing us to be a part of your fashion journey.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonial Section -->
<section class="big-team-area">
  <div class="big-image">
    <img src="images/banner2.jpg" alt="">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        
          <div class="testimonial-item text-center">
            <p>“𝒇𝒂𝒔𝒉𝒊𝒐𝒏.𝒉𝒖𝒃 is one of those platforms that gives you space to work with people who know you, love you, and support you.”</p>
            <span>- Mihir Sarvaliya</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="team-area">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="area-title text-center mb-50">
          <h2>Awesome Team</h2>
          <p>Our one of the best team members</p>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Team Member 1 -->
      <div class="col-lg-4 col-md-6">
        <div class="team mb-30">
          <div class="team__img">
            <img src="images/mihir.jpg" alt="">
          </div>
          <div class="team__content text-center">
            <h4>Mihir Sarvaliya</h4>
            <span>Web Devloper</span>
          </div>
        </div>
      </div>
      <!-- Team Member 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="team mb-30">
          <div class="team__img">
            <img src="images/p.jpg" alt="">
          </div>
          <div class="team__content text-center">
            <h4>Parth Variya</h4>
            <span>Designing</span>
          </div>
        </div>
      </div>
      <!-- Team Member 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="team mb-30">
          <div class="team__img">
            <img src="images\Screenshot_20250924_163230.jpg"  alt="">
          </div>
          <div class="team__content text-center">
            <h4>Manthan Tank</h4>
            <span>Devloper</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<br><br>
                       <center> <a href="index.php" class="btn btn-secondary px-4">⬅ Back </a> <br><br>

<!-- Bootstrap JS -->

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
  $(".testimonial-active").owlCarousel({
    loop:true,
    margin:20,
    nav:false,
    dots:true,
    autoplay:true,
    autoplayTimeout:4000,
    responsive:{
      0:{ items:1 },
      768:{ items:1 },
      1200:{ items:2 }
    }
  });
</script>
</body>
</html>
<?php include('inc/footer.php'); ?>
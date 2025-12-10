<?php  
include('config/db.php');
session_start();

$message =  '';

if(isset($_POST['submit'])){
    $product_id = $_GET['id'];
    $c_id = $_SESSION['customerid']; 
    $review  = $_POST['review']; 

    $insertReview = "INSERT INTO reviews (pid, uid, review)
	VALUES ('$product_id','$c_id' ,'$review' )";  

	if(mysqli_query($conn, $insertReview)){
        $message = '<div class="alert alert-success">Review Submitted</div>';
    }
}

if(isset($_GET['id'])){
    $product_id = $_GET['id'];
   $sql = "SELECT * FROM products  WHERE product_id='$product_id'";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);

   $product_name  = $row['product_name'];
   $cat_id  = $row['cat_id']; 
   $price  = $row['price'];
   $product_description  = $row['product_description'];
   $thumb  = $row['thumb'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $product_name; ?> - Product Details</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .product-img {
      max-height: 500px;
      object-fit: cover;
      border-radius: 10px;
    }
    .price {
      font-size: 1.5rem;
      color: #28a745;
    }
    .tab-btns button {
      margin-right: 5px;
    }
    .review-box {
      border-bottom: 1px solid #eee;
      padding: 10px 0;
    }
    .review-box:last-child {
      border: none;
    }
    .related-card {
      transition: 0.3s;
    }
    .related-card:hover {
      transform: translateY(-5px);
      box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
    }
  </style>
</head>
<body>

<div class="container py-5">

  <!-- Product Section -->
  <div class="row bg-white p-4 rounded shadow-sm">
    <div class="col-md-6">
      <img src="admin/<?php echo $thumb ?>" alt="" class="img-fluid product-img">
    </div>
    <div class="col-md-6">
      <h3><b><?php echo $product_name ?></b></h3>
      <h2 class="price"><b>INR <?php echo  $price ?>.00</b></h2>
      <p><?php echo $product_description ?></p>            

      <form action="addToCart.php" method="get" class="mt-3">
        <input type="hidden" name="id" value="<?php echo  $product_id ?>">
        <div class="mb-3 d-flex align-items-center">
          <label class="me-2 fw-bold">Quantity:</label>
          <input type="number" class="form-control w-25" name="quantity" value="1" min="1">
        </div>
        <button type="submit" class="btn btn-success">
          <i class="fa fa-cart-arrow-down"></i> Add To Cart
        </button>
      </form>

      <div class="mt-3">
        <?php
          $sql2 = "SELECT * FROM Category where cat_id = '$cat_id'";
          $result2 = mysqli_query($conn, $sql2); 
          $row2 = mysqli_fetch_assoc($result2);
        ?> 
        <p>Category: 
          <a href="index.php?id=<?php echo $cat_id ?>" class="text-decoration-none">
            <?php echo $row2["cat_name"] ?>
          </a>
        </p>
      </div>
    </div>
  </div>

  <!-- Tabs Section -->
  <ul class="nav nav-tabs mt-5" id="productTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button">Details</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">Reviews</button>
    </li>
  </ul>

  <div class="tab-content bg-white p-4 shadow-sm" id="productTabsContent">
    <!-- Details -->
    <div class="tab-pane fade show active" id="details" role="tabpanel">
      <p><?php echo $product_description ?></p>
    </div>

    <!-- Reviews -->
    <div class="tab-pane fade" id="reviews" role="tabpanel">
      <h5>Customer Reviews</h5>
      <div class="mb-3">
        <?php
          $sql_allReview = "SELECT * FROM reviews JOIN user_data ON user_data.userid=reviews.uid WHERE pid='$product_id'";
          $result_allReview = mysqli_query($conn, $sql_allReview);
          if (mysqli_num_rows($result_allReview) > 0) {
            while($row_nameEmail = mysqli_fetch_assoc($result_allReview)) {
              echo '<div class="review-box">
                      <strong>'.$row_nameEmail['firstname'].'</strong>
                      <span class="text-muted small"> '.$row_nameEmail['timestamp'].'</span>
                      <p>'.$row_nameEmail['review'].'</p>
                    </div>';
            }
          } else {
            echo '<p class="text-muted">No reviews yet.</p>';
          }
        ?>
      </div>

      <?php
      $proid = $_GET['id'];
      if(isset($_SESSION['customerid'])){
          $c_id = $_SESSION['customerid']; 
          $sql_count = "SELECT * FROM reviews where pid='$proid' AND uid='$c_id'";
          $result_count = mysqli_query($conn, $sql_count);
          if (mysqli_num_rows($result_count) > 0) { 
              echo '<div class="alert alert-info text-center">You already submitted a review for this product</div>';
          } else {
      ?>
      <h6>Add a review</h6>
      <form method="post">
        <div class="mb-3">
          <textarea name="review" class="form-control" rows="4" placeholder="Write your review..." required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit Review</button>
        <?php echo $message; ?>
      </form>
      <?php } } ?>
    </div>
  </div>

  <!-- Related Products -->
  <div class="card mt-5">
    <div class="card-header">
      Related Products
    </div>
    <div class="card-body">
      <div class="row g-4">
        <?php
          $sql_related = "SELECT * FROM products WHERE product_id != $product_id ORDER BY rand() LIMIT 3";
          $result_related = mysqli_query($conn, $sql_related);
          while($row_related = mysqli_fetch_assoc($result_related)) {
        ?>
        <div class="col-md-4">
          <div class="card related-card h-50">
            <img src="admin/<?php echo $row_related['thumb']; ?>" class="img-fluid product-img" alt="">
            <div class="card-body text-center">
              <h6><?php echo $row_related['product_name']; ?></h6>
              <p class="text-muted small"><?php echo substr($row_related['product_description'], 0, 60); ?>...</p>
              <div class="price">INR <?php echo $row_related['price']; ?>.00</div>
              <a href="single.php?id=<?php echo $row_related['product_id']; ?>" class="btn btn-outline-primary btn-sm mt-2">
                <i class="fa fa-eye"></i> View
              </a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>

</div>
<br><br>
                       <center> <a href="men.php" class="btn btn-secondary px-4">⬅ Back </a><br><br>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include('inc/footer.php'); ?>

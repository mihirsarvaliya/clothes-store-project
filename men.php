<?php  
include('config/db.php');   
?>  <!DOCTYPE html>  <html lang="en">  
<head>  
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <title>Men's Collection</title>  
  <!-- Bootstrap CSS -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">  
  <!-- Font Awesome -->  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">  
  <style>  
    body {  
      background: #f8f9fa;  
    }  
    .product-card {  
      transition: transform 0.3s, box-shadow 0.3s;  
    }  
    .product-card:hover {  
      transform: translateY(-5px);  
      box-shadow: 0px 4px 12px rgba(0,0,0,0.15);  
    }  
    .product-img {  
      height: 250px;  
      object-fit: cover;  
    }  
    .price {  
      font-size: 1.1rem;  
      color: #28a745;  
    }  
  </style>  
</head>  
<body>  <div class="container py-5">  
  <h2 class="text-center mb-4">Collections</h2>  
  <div class="row g-4">  
    <?php   
      $sql = "SELECT * FROM products";  
      if(isset($_GET['id'])){  
          $catID = $_GET['id'];  
          $sql .= " WHERE cat_id = '$catID'";  
      }  
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_assoc($result)) {  
    ?>  
      <div class="col-md-4 col-sm-6">  
        <div class="card product-card h-100">  
          <a href="single.php?id=<?php echo $row['product_id']; ?>">  
            <img src="admin/<?php echo $row['thumb']; ?>" class="card-img-top product-img" alt="<?php echo $row['product_name']; ?>">  
          </a>  
          <div class="card-body text-center">  
            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>  
            <p class="card-text text-muted"><?php echo $row['product_description']; ?></p>  
            <div class="price mb-2"><b>INR <?php echo $row['price']; ?>.00</b></div>  
            <div class="d-flex justify-content-between">  
              <a href="addToCart.php?id=<?php echo $row['product_id']; ?>" class="btn btn-sm btn-success">  
                <i class="fa fa-cart-arrow-down"></i> Add To Cart  
              </a>  
              <a href="single.php?id=<?php echo $row['product_id']; ?>" class="btn btn-sm btn-outline-primary">  
                <i class="fa fa-eye"></i> Details  
              </a>  
            </div>  
          </div>  
        </div>  
      </div>  
    <?php } ?>  
  </div>  
</div>  <!-- Bootstrap JS -->  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>  

<center> <a href="index.php" class="btn btn-secondary px-4">⬅ Back </a> <br><br>

</body>  
</html>
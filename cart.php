<?php 

include('config/db.php');
include('inc/header.php');

// Ensure cart exists
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background: #f5f5f5;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    h2 {
      font-weight: 700;
      color: #198754;
      margin: 30px 0;
    }
    table img {
      width: 80px;
      border-radius: 8px;
    }
    .table th {
      background: #198754;
      color: #fff;
      text-align: center;
      vertical-align: middle;
    }
    .table td {
      vertical-align: middle;
      text-align: center;
    }
    .btn-remove {
      background: #dc3545;
      color: #fff;
      border-radius: 6px;
      padding: 6px 12px;
      font-size: 14px;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn-remove:hover {
      background: #b02a37;
      color: #fff;
    }
    .btn-checkout {
      background: #198754;
      color: #fff;
      font-weight: 500;
      border-radius: 8px;
      padding: 10px 20px;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn-checkout:hover {
      background: #157347;
      color: #fff;
    }
    .card {
      margin-top: 20px;
      border-radius: 10px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }
    .card-header {
      font-weight: 600;
      background: #198754;
      color: #fff;
      border-radius: 10px 10px 0 0;
    }
    .card-body {
      font-size: 18px;
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">🛒 Your Shopping Cart</h2>

    <div class="table-responsive">
      <table class="table table-bordered table-hover bg-white">
          <tr>
              <th>Image</th>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
              <th>Action</th>
          </tr>

          <?php
          $total = 0;

          if (!empty($cart)) {
              foreach($cart as $key => $value){
                  $sql = "SELECT * FROM products WHERE product_id = $key";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
          ?>
              <tr>
                  <td><img src="admin/<?php echo $row['thumb']?>" alt=""></td>
                  <td><a href="single.php?id=<?php echo $row['product_id']?>"><?php echo $row['product_name']?></a></td>
                  <td>₹<?php echo number_format($row['price'], 2)?></td>
                  <td><?php echo $value['quantity']?></td>
                  <td>₹<?php echo number_format($row['price'] * $value['quantity'], 2)?></td>
                  <td><a href='deleteCart.php?id=<?php echo $key; ?>' class="btn-remove"><i class="fa fa-trash"></i> Remove</a></td>
              </tr>
          <?php
                  $total += $row['price'] * $value['quantity'];
              }
          } else {
              echo "<tr><td colspan='6' class='text-center text-danger'>Your cart is empty</td></tr>";
          }
          ?>
      </table>
    </div>

    <?php if (!empty($cart)) { ?>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a class="btn-checkout" href='checkout.php'><i class="fa fa-credit-card"></i> Proceed to Checkout</a>
    </div>

    <div class="card">
      <div class="card-header">Cart Summary</div>
      <div class="card-body">
        Total Amount: <strong>₹<?php echo number_format($total, 2); ?></strong>
      </div>
    </div>
    <?php } ?>
</div>
<br><br>
                       <center> <a href="index.php" class="btn btn-secondary px-4">⬅ Back </a> <br><br>
<!-- Bootstrap JS -->

</body>
</html>
<br><br>
<?php include('inc/footer.php'); ?>
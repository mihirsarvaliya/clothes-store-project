<?php 

include('config/db.php');
include('inc/header.php');  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    h2 {
      font-weight: 700;
      color: #0d6efd;
    }
    h3 {
      font-weight: 600;
    }
    .account-table {
      border-radius: 10px;
      overflow: hidden;
    }
    .account-table thead {
      background-color: #0d6efd;
      color: #fff;
    }
    .account-table th, .account-table td {
      vertical-align: middle;
    }
    .account-table tfoot th {
      background: #f1f1f1;
      font-weight: 600;
    }
    .ma-address {
      margin-top: 40px;
    }
    .ma-address h4 {
      font-weight: 600;
      margin-bottom: 10px;
    }
    .ma-address a {
      font-size: 14px;
      margin-left: 10px;
    }
    .address-box {
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">My Account</h2>

    <section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

                        <!-- Recent Orders -->
			            <h3 class="mb-3">Recent Orders</h3>
			            <table class="cart-table account-table table table-bordered bg-white text-dark shadow-sm">
				            <thead>
					            <tr>
						            <th>Product</th>
						            <th>Quantity</th>
						            <th>Price</th>
						            <th>Total Price</th>
					            </tr>
				            </thead>
				            <tbody>
				            <?php
				            $c_id = $_SESSION['customerid'];

                            if(isset($_GET['id'])){
                                $o_id = $_GET['id'];
                            }

                            $sql_orders = "SELECT * FROM orders WHERE id='$o_id' AND userid='$c_id'";
                            $result_orders = mysqli_query($conn, $sql_orders);
                            $row_orders = mysqli_fetch_assoc($result_orders);

				            $sql = "SELECT * FROM orderitems WHERE orderid='$o_id'";
				            $result = mysqli_query($conn, $sql);

				            if (mysqli_num_rows($result) > 0) {
					            while($row = mysqli_fetch_assoc($result)) {
                                    $prodID = $row["pid"]; 
                                    $sql_product = "SELECT * FROM products WHERE product_id='$prodID'";
                                    $result_prod = mysqli_query($conn, $sql_product);
                                    $row_prod = mysqli_fetch_assoc($result_prod);
				            ?>
				            <tr>
					            <td>
                                    <a href="single.php?id=<?php echo $prodID ;?>" class="fw-semibold text-decoration-none text-dark">
                                        <?php echo $row_prod['product_name'];?>
                                    </a>
					            </td>
					            <td><?php echo $row["pquantity"] ?></td>
					            <td>₹<?php echo $row["productprice"] ?></td>
					            <td>₹<?php echo $row["pquantity"] * $row["productprice"] ?></td>
				            </tr>
				            <?php
					            }
			                } else {
				              
			                }
			                ?>
				            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2"></th>
                                    <th>Total Price</th>
                                    <th>₹<?php echo  $row_orders['totalprice'] ?></th>
                                </tr>
                                <tr>
                                    <th colspan="2"></th>
                                    <th>Order Status</th>
                                    <th><?php echo  $row_orders['orderstatus'] ?></th>
                                </tr>
                                <tr>
                                    <th colspan="2"></th>
                                    <th>Date</th>
                                    <th><?php echo date('M j, Y g:i A', strtotime($row_orders["timestamp"]));  ?></th>
                                </tr>
                            </tfoot>
			            </table>		

                        <!-- Addresses -->
			            <div class="ma-address">
						    <h3>My Addresses</h3>
						    <p class="text-muted">The following addresses will be used on the checkout page by default.</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="address-box bg-white text-dark px-4 py-3 shadow-sm">
                                        <h4>Billing Address 
                   
                                        </h4>
                                        <?php  
                                        $sql_add = "SELECT * FROM user_data  WHERE userid='$c_id'";
                                        $result_add = mysqli_query($conn, $sql_add);
                                        $row_add = mysqli_fetch_assoc($result_add); 
                                     
                                        echo $row_add['address1'] . "<br>";
                                        echo $row_add['address2'] . "<br>";
                                        echo $row_add['city'] . "<br>";
                                        echo $row_add['zip'] . "<br>";
                                        echo $row_add['country'] . "<br>";
                                        echo $row_add['mobile'] . "<br>";
                                        ?>
                                    </div>
                                </div>
                            </div>
			            </div>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php include('inc/footer.php');  ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
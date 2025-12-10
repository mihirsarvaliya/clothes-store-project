<?php
include('inc/header.php');
?>
<?php 
include('config/db.php');

if(!isset($_SESSION['customerid'])){
	echo '<script>window.location.href = "login.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Account</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .account-container {
      max-width: 900px;
      margin: 30px auto;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      font-weight: bold;
      margin-bottom: 20px;
      color: #343a40;
    }
    .order-table th {
      background-color: #0d6efd;
      color: #fff;
    }
    .address-box {
      padding: 15px;
      background: #f1f3f5;
      border-radius: 8px;
    }
    .status-cancelled {
      color: red;
      font-weight: bold;
    }
    .status-delivered {
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container account-container">
  <h2>My Account</h2>

  <!-- Recent Orders -->
  <div class="mb-4">
    <h4>Recent Orders</h4>
    <div class="table-responsive">
      <table class="table table-bordered table-hover order-table">
        <thead>
          <tr>
            <th>Total Price</th>
            <th>Order Status</th>
            <th>Payment Mode</th>
            <th>Date and Time</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        		<?php
				
				$c_id = $_SESSION['customerid'];

 
  
				$sql = "SELECT * FROM orders WHERE userid='$c_id'";
				$result = mysqli_query($conn, $sql);
			  
				if (mysqli_num_rows($result) > 0) {
				 // output data of each row
				 while($row = mysqli_fetch_assoc($result)) {
 			?>
					<tr>
						<td>
							<?php echo $row["totalprice"] ?>
						</td>
						<td>
						<?php echo $row["orderstatus"] ?>
						</td>
						<td>
						<?php echo $row["paymentmode"] ?>		
						</td>
						<td>
						

						<?php echo date('M j g:i A', strtotime($row["timestamp"]));  ?>		
						</td>
						<td>
							<a href="view-order.php?id=<?php echo $row["id"] ?>">View</a> 
							<?php if($row["orderstatus"] != 'Cancelled'){ ?>
								|  <a href="cancel-order.php?id=<?php echo $row["id"] ?>">cancel</a> 
							<?php }?>
						</td>
					</tr>
				 
			
			<?php
				}
			   } else {
				 echo "0 results";
			   }
			 
			 
			 ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Address Section -->
  <div>
    <h4>My Address</h4>
    <div class="address-box">
      <strong>Billing Address</strong> 
 
           <br> <?php  
                        $sql_add = "SELECT * FROM user_data  WHERE userid='$c_id'";
                        $result_add = mysqli_query($conn, $sql_add);
                      
				        		if (mysqli_num_rows($result_add) > 0) {
                     $row_add = mysqli_fetch_assoc($result_add); 
					 
                        echo $row_add['firstname'] ." ". $row_add['lastname'] . "<br>";
                        echo $row_add['size'] . "<br>";
                        echo $row_add['address1'] . "<br>";
                        echo $row_add['address2'] . "<br>";
                        echo $row_add['city'] . "<br>";
                        echo $row_add['zip'] . "<br>";
                        echo $row_add['country'] . "<br>";
                        echo $row_add['mobile'] . "<br>";
                    }
                    else
                    {
                      echo"<p> no data found</p>";
                    }
                        ?>
    </div>
  </div>
</div>
<br><br>
                       <center> <a href="index.php" class="btn btn-secondary px-4">⬅ Back </a> <br><br>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include('inc/footer.php'); ?>
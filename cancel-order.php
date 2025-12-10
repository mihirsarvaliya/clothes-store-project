<?php  
session_start();
include('config/db.php');

if(!isset($_SESSION['customer']) && empty($_SESSION['customer']) ){
    header('location:login.php');
}
if(!isset($_SESSION['customerid'])){
    echo '<script>window.location.href = "login.php";</script>';
}

$message  = '';
if(isset($_POST['submit'])){
    $orderid = $_POST['orderid'];
    $reason = $_POST['reason'];
    $status = 'cancelled';

    $insertCancel = "INSERT INTO ordertracking (orderid, status, reason )
        VALUES ('$orderid', '$status', '$reason')";  

    if(mysqli_query($conn, $insertCancel)){
        $up_sql = "UPDATE orders SET orderstatus='Cancelled'  WHERE id=$orderid";
        mysqli_query($conn, $up_sql);
        header('location:myaccount.php');
    }
}

$cid = $_SESSION['customerid'];
$sql = "SELECT * FROM user_data WHERE userid = $cid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cancel Order</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .page_header h2 {
      font-weight: 700;
      color: #dc3545;
    }
    .card {
      border-radius: 12px;
    }
    table th, table td {
      vertical-align: middle !important;
    }
    textarea {
      resize: none;
    }
    .btn-danger {
      font-weight: 600;
      border-radius: 30px;
      padding: 10px 30px;
    }
    .table tfoot th {
      font-weight: 600;
      background: #f1f1f1;
    }
  </style>
</head>
<body>

<div class="container my-5">
    <section id="content">
        <div class="content-blog">
            <div class="page_header text-center py-4">
                <h2>Cancel Order</h2>
                <p class="text-muted">Please review your order details and provide a reason for cancellation.</p>
            </div>

            <form method="post">
                <?php echo $message ?>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-dark">
                                       
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
                                                <a href="single.php?id=<?php echo $prodID;?>" class="text-decoration-none fw-semibold text-dark">
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
                                            echo "<tr><td colspan='4' class='text-center text-muted'>No items found</td></tr>";
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
                                            <th><?php echo  $row_orders['timestamp'] ?></th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <!-- Reason textarea -->
                                <div class="mb-3">
                                    <label for="reason" class="form-label fw-semibold">Reason for Cancellation</label>
                                    <textarea class="form-control" name="reason" id="reason" rows="4" required></textarea>
                                </div>

                                <!-- Hidden order ID -->
                                <input type="hidden" name="orderid" value="<?php echo $_GET['id'] ?>">

                                <!-- Submit button -->
                                <div class="text-center">
                                    <input type="submit" name="submit" value="Cancel Order" class="btn btn-danger">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?php include('inc/footer.php'); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
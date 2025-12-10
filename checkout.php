<?php    
session_start();  
include('config/db.php');  
  
if(!isset($_SESSION['customer']) && empty($_SESSION['customer'])){  
    header('location:login.php');  
}  
  
if(!isset($_SESSION['customerid'])){  
    echo '<script>window.location.href = "login.php";</script>';  
}  
  
$total = 0;  
$cart = [];  
if(isset($_SESSION['cart'])){  
    $cart = $_SESSION['cart'];  
    foreach($cart as $key => $value){  
        $sql_cart = "SELECT * FROM products where product_id = $key";  
        $result_cart = mysqli_query($conn, $sql_cart);  
        $row_cart = mysqli_fetch_assoc($result_cart);  
        $total += ($row_cart['price'] * $value['quantity']);  
    }  
}  
  
$message  = '';  
  
if(isset($_POST['submit'])){  
    if(isset($_POST['agree']) && $_POST['agree'] == 'true'){  
        $country = $_POST['country'];  
        $fname = $_POST['fname'];  
        $lname = $_POST['lname'];  
        $size = $_POST['size'];  
        $addr1 = $_POST['addr1'];  
        $addr2 = $_POST['addr2'];  
        $city = $_POST['city'];  
        $Postcode = $_POST['Postcode'];  
        $Phone = $_POST['Phone'];  
        $payment = $_POST['payment'];  
        $cid = $_SESSION['customerid'];   
  
        $sql = "SELECT * FROM user_data where userid = $cid";  
        $result = mysqli_query($conn, $sql);  
  
        if (mysqli_num_rows($result) == 1) {  
            // Update  
            $up_sql = "UPDATE user_data   
                       SET firstname='$fname', lastname='$lname', size='$size', address1='$addr1',   
                           address2='$addr2', city='$city', country='$country', zip='$Postcode', mobile='$Phone'    
                       WHERE userid=$cid";  
            $Updated = mysqli_query($conn, $up_sql);  
  
            if($Updated){  
                if(isset($_SESSION['cart'])){  
                    $total = 0;  
                    foreach($cart as $key => $value){  
                        $sql_cart = "SELECT * FROM products where product_id = $key";  
                        $result_cart = mysqli_query($conn, $sql_cart);  
                        $row_cart = mysqli_fetch_assoc($result_cart);  
                        $total += ($row_cart['price'] * $value['quantity']);  
                    }  
                }  
  
                $insertOrder = "INSERT INTO orders (userid, totalprice, orderstatus, paymentmode )  
                                VALUES ('$cid', '$total', 'Order Placed', '$payment')";    
  
                if(mysqli_query($conn, $insertOrder)){  
                    $orderid = mysqli_insert_id($conn);   
                    foreach($cart as $key => $value){   
                        $sql_cart = "SELECT * FROM products where product_id = $key";  
                        $result_cart = mysqli_query($conn, $sql_cart);  
                        $row_cart = mysqli_fetch_assoc($result_cart);   
                        $price_product = $row_cart["price"];  
                        $q  = $value["quantity"];  
  
                        $insertordersItems = "INSERT INTO orderitems (orderid, pid, pquantity, productprice)   
                                              VALUES ('$orderid', '$key', '$q', '$price_product')";  
                        mysqli_query($conn, $insertordersItems);  
                    }  
                    unset($_SESSION['cart']);  
                    echo '<script>
                            alert("Order placed successfully!");
                            window.location.href = "myaccount.php";
                          </script>';  
                }  
            }  
        } else {  
            // Insert  
            $ins_sql = "INSERT INTO user_data (userid, firstname, lastname, size, address1, address2, city, country, zip, mobile)  
                        VALUES ('$cid', '$fname', '$lname', '$size', '$addr1', '$addr2', '$city', '$country', '$Postcode', '$Phone')";   
            $inserted = mysqli_query($conn, $ins_sql);  
  
            if($inserted){  
                if(isset($_SESSION['cart'])){  
                    $total = 0;  
                    foreach($cart as $key => $value){  
                        $sql_cart = "SELECT * FROM products where product_id = $key";  
                        $result_cart = mysqli_query($conn, $sql_cart);  
                        $row_cart = mysqli_fetch_assoc($result_cart);  
                        $total += ($row_cart['price'] * $value['quantity']);  
                    }  
                }  
  
                $insertOrder = "INSERT INTO orders (userid, totalprice, orderstatus, paymentmode )  
                                VALUES ('$cid', '$total', 'Order Placed', '$payment')";    
  
                if(mysqli_query($conn, $insertOrder)){  
                    $orderid = mysqli_insert_id($conn);   
                    foreach($cart as $key => $value){   
                        $sql_cart = "SELECT * FROM products where product_id = $key";  
                        $result_cart = mysqli_query($conn, $sql_cart);  
                        $row_cart = mysqli_fetch_assoc($result_cart);   
                        $price_product = $row_cart["price"];  
                        $q  = $value["quantity"];  
  
                        $insertordersItems = "INSERT INTO orderitems (orderid, productid, quantity, productprice)   
                                              VALUES ('$orderid', '$key', '$q', '$price_product')";  
                        mysqli_query($conn, $insertordersItems);  
                    }  
                    unset($_SESSION['cart']);  
                    echo '<script>
                            alert("Order placed successfully!");
                            window.location.href = "myaccount.php";
                          </script>';  
                }  
            }  
        }  
    } else {  
        $message =  'Agree to terms and conditions';  
    }  
}  
  
$cid = $_SESSION['customerid'];  
$sql = "SELECT * FROM user_data where userid = $cid";  
$result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_assoc($result);  
?>  
  
<!DOCTYPE html>  
<html lang="en">  
<head>  
  <meta charset="UTF-8">  
  <title>Checkout</title>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
  <style>  
    body { background: #222; color: #fff; }  
    .page_header { background: #343a40; color: #fff; border-radius: 8px; }  
    .form-control { border-radius: 8px; }  
    .btn { background: #007bff; color: #fff; border-radius: 8px; padding: 10px 20px; }  
    .btn:hover { background: #0056b3; }  
    .card { border-radius: 10px; box-shadow: 0 3px 6px rgba(0,0,0,0.3); }  
  </style>  
</head>  
<body>  
  
<div class="container my-5">  
    <div class="page_header text-center py-4">  
        <h2>Shop - Checkout</h2>  
        <p>Get the best kit for smooth shave</p>  
    </div>  
  
    <form method="post" id="checkoutForm" class="mt-4">  
        <div class="row">  
            <div class="col-md-8">  
                <div class="card bg-dark text-white p-4">  
                    <h3 class="mb-3">Billing Details</h3>  
  
                    <div class="mb-3">  
                        <label>Country</label>  
                        <select class="form-control" name="country" id="country" required>  
                            <option value="">Select Country</option>  
                            <option value="IN" <?php if(($row['country'] ?? '') == 'IN') echo 'selected'; ?>>India</option>  
                            <option value="US" <?php if(($row['country'] ?? '') == 'US') echo 'selected'; ?>>USA</option>  
                            <option value="UK" <?php if(($row['country'] ?? '') == 'UK') echo 'selected'; ?>>United Kingdom</option>  
                        </select>  
                    </div>  
  
                    <div class="row">  
                        <div class="col-md-6 mb-3">  
                            <label>First Name</label>  
                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $row['firstname'] ?? '' ?>" required>  
                        </div>  
                        <div class="col-md-6 mb-3">  
                            <label>Last Name</label>  
                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $row['lastname'] ?? '' ?>" required>  
                        </div>  
                    </div>  
  
                    <div class="mb-3">  
                        <label>Size</label>  
                        <select class="form-control" name="size" id="size" required>  
                            <option value="">-- Select Size --</option>  
                            <option value="S" <?php if(($row['size'] ?? '') == 'S') echo 'selected'; ?>>Small (S)</option>  
                            <option value="M" <?php if(($row['size'] ?? '') == 'M') echo 'selected'; ?>>Medium (M)</option>  
                            <option value="L" <?php if(($row['size'] ?? '') == 'L') echo 'selected'; ?>>Large (L)</option>  
                            <option value="XL" <?php if(($row['size'] ?? '') == 'XL') echo 'selected'; ?>>Extra Large (XL)</option>  
                        </select>  
                    </div>  
  
                    <div class="mb-3">  
                        <label>Address 1</label>  
                        <input type="text" class="form-control" name="addr1" id="addr1" value="<?php echo $row['address1'] ?? '' ?>" required>  
                    </div>  
  
                    <div class="mb-3">  
                        <label>Address 2</label>  
                        <input type="text" class="form-control" name="addr2" id="addr2" value="<?php echo $row['address2'] ?? '' ?>">  
                    </div>  
  
                    <div class="row">  
                        <div class="col-md-6 mb-3">  
                            <label>City</label>  
                            <input type="text" class="form-control" name="city" id="city" value="<?php echo $row['city'] ?? '' ?>" required>  
                        </div>  
                        <div class="col-md-6 mb-3">  
                            <label>Postcode</label>  
                            <input type="text" class="form-control" name="Postcode" id="Postcode" value="<?php echo $row['zip'] ?? '' ?>" required>  
                        </div>  
                    </div>  
  
                    <div class="mb-3">  
                        <label>Phone</label>  
                        <input type="text" class="form-control" name="Phone" id="Phone" value="<?php echo $row['mobile'] ?? '' ?>" required>  
                    </div>  
                </div>  
            </div>  
  
            <div class="col-md-4">  
                <div class="card bg-light text-dark p-4">  
                    <h4>Your Order</h4>  
                    <hr>  
                    <p><strong>Subtotal:</strong> ₹<?php echo $total ?>.00</p>  
                    <p><strong>Shipping:</strong> Free</p>  
                    <p><strong>Total:</strong> ₹<?php echo $total ?>.00</p>  
                    <hr>  
  
                    <h5>Payment Method</h5>  
                    <div class="form-check mb-2">  
                        <input class="form-check-input" type="radio" name="payment" value="COD" checked>  
                        <label class="form-check-label">Cash on Delivery</label>  
                    </div>  
                    <div class="form-check mb-2">  
                        <input class="form-check-input" type="radio" name="payment" value="Cheque">  
                        <label class="form-check-label">Cheque Payment</label>  
                    </div>  
  
                    <div class="form-check mb-3">  
                        <input class="form-check-input" type="checkbox" name="agree" id="agree" value="true" required>  
                        <label class="form-check-label">I agree to the <a href="#">terms & conditions</a></label>  
                    </div>  
  
                    <input type="submit" name="submit" value="Place Order" class="btn w-100">  
                </div>  
            </div>  
        </div>  
    </form>  
</div>  
<br><br>
                       <center> <a href="cart.php" class="btn btn-secondary px-4">⬅ Back </a>
  
<script>  
document.getElementById("checkoutForm").addEventListener("submit", function(e) {  
    let isValid = true;  
  
    let country = document.getElementById("country").value.trim();  
    let fname = document.getElementById("fname").value.trim();  
    let lname = document.getElementById("lname").value.trim();  
    let size = document.getElementById("size").value.trim();  
    let addr1 = document.getElementById("addr1").value.trim();  
    let city = document.getElementById("city").value.trim();  
    let postcode = document.getElementById("Postcode").value.trim();  
    let phone = document.getElementById("Phone").value.trim();  
    let agree = document.getElementById("agree").checked;  
    let payment = document.querySelector('input[name="payment"]:checked');  
  
    // Country  
    if (country === "") {  
        alert("Please select a country.");  
        isValid = false;  
    }  
  
    // First & Last name (only letters and spaces)  
    let namePattern = /^[A-Za-z\s]+$/;  
    if (!fname.match(namePattern)) {  
        alert("First name must contain only letters.");  
        isValid = false;  
    }  
    if (!lname.match(namePattern)) {  
        alert("Last name must contain only letters.");  
        isValid = false;  
    }  
  
    // Size  
    if (size === "") {  
        alert("Please select a size.");  
        isValid = false;  
    }  
  
    // City (only letters and spaces)  
    if (!city.match(namePattern)) {  
        alert("City must contain only letters.");  
        isValid = false;  
    }  
  
    // Postcode (exactly 6 digits, no characters)  
    let postPattern = /^[0-9]{6}$/;  
    if (!postcode.match(postPattern)) {  
        alert("Postcode must be exactly 6 digits.");  
        isValid = false;  
    }  
  
    // Phone (exactly 10 digits)  
    let phonePattern = /^[0-9]{10}$/;  
    if (!phone.match(phonePattern)) {  
        alert("Please enter a valid 10-digit phone number.");  
        isValid = false;  
    }  
  
    // Payment  
    if (!payment) {  
        alert("Please select a payment method.");  
        isValid = false;  
    }  
  
    // Agree  
    if (!agree) {  
        alert("You must agree to the terms & conditions.");  
        isValid = false;  
    }  
  
    if (!isValid) {  
        e.preventDefault();  
    }  
});  
</script>  
  
</body>  
</html>  
<?php include('inc/footer.php'); ?>
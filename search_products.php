<?php
include('config/db.php');

if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%' OR product_description LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
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
            <?php
        }
    } else {
        echo "<h5 class='text-center text-muted'>No products found</h5>";
    }
}
?>
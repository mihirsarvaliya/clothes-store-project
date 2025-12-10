<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shop - Register</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (icons) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background: #f8f9fa;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .register-container {
      max-width: 450px;
      margin: 60px auto;
      padding: 30px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
    }
    .register-container h3 {
      font-weight: 600;
      color: #198754;
    }
    .btn-custom {
      font-size: 16px;
      padding: 10px;
      border-radius: 8px;
    }
    .form-control {
      border-radius: 8px;
      padding: 10px;
    }
    .alert {
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="register-container">
      <h3 class="text-center mb-4"><i class="fa fa-user-plus"></i> Register an Account</h3>

      <?php
      if (isset($_REQUEST['message'])) {
          if ($_GET['message'] == '2') { 
              echo '<div class="alert alert-danger text-center">Error Creating Account</div>';
          }
      }
      ?>

      <form action="registerprocess.php" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">E-mail Address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
        </div>

        <div class="mb-3">
          <label for="passwordAgain" class="form-label">Re-enter Password</label>
          <input type="password" class="form-control" id="passwordAgain" name="passwordAgain" placeholder="Re-enter password">
        </div>

        <button type="submit" name="submit" class="btn btn-success btn-custom w-100">
          <i class="fa fa-check"></i> Register
        </button>
      </form>

      <div class="text-center mt-3">
        <p>Already have an account? <a href="login.php" class="text-success">Login here</a></p>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
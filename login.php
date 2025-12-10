<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login & Register</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background: url('images/login.jpg') no-repeat center center/cover;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .page_header h2 {
      font-weight: 700;
      color: #fff;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.4);
    }
    .box-content {
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0px 6px 18px rgba(0,0,0,0.15);
      margin-bottom: 40px;
      transition: transform 0.3s ease;
    }
    .box-content:hover {
      transform: translateY(-5px);
    }
    .heading {
      font-size: 22px;
      font-weight: 600;
      color: #198754;
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 10px;
      padding: 12px;
      font-size: 15px;
    }
    .btn-custom {
      background: #198754;
      color: #fff;
      font-size: 16px;
      font-weight: 500;
      padding: 12px;
      border-radius: 10px;
      width: 100%;
      transition: 0.3s ease;
    }
    .btn-custom:hover {
      background: #157347;
    }
    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
      <div class="col-md-12 my-5">
        <div class="page_header text-center">
            <h2>LOGIN & REGISTER</h2>
        </div>
      </div>
  </div>

  <div class="row justify-content-center">
    <!-- Login -->
    <div class="col-md-5">
        <div class="box-content">
            <h3 class="heading text-center"><i class="fas fa-sign-in-alt me-2"></i>I'm a Returning Customer</h3>

            <?php
            if(isset($_REQUEST['message'])){
                if($_GET['message'] == '1'){ 
                    echo "<div class='alert alert-danger'>Invalid Credential</div>";
                }
            }
            ?>

            <form id="loginForm" action='loginProcess.php' method='post'>
                <div class="mb-3">
                    <label class="form-label">Username or E-mail Address</label>
                    <input type="text" class="form-control" name='email' id="loginEmail" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name='password' id="loginPassword" required>
                </div>
                <button type="submit" name='submit' class="btn btn-custom">Login</button>
            </form>
        </div>
    </div>

    <!-- Register -->
    <div class="col-md-5">
        <div class="box-content">
            <h3 class="heading text-center"><i class="fas fa-user-plus me-2"></i>Register An Account</h3>

            <?php
            if(isset($_REQUEST['message'])){

                if($_GET['message'] == '2'){ 
                    echo "<div class='alert alert-danger'>Error Creating Account</div>";
                }
                elseif($_GET['message'] == '3'){ 
                    echo "<div class='alert alert-success'>Registration successfully...</div>";
            }
          }
            ?>

            <form id="registerForm" action='registerprocess.php' method='post'>
                <div class="mb-3">
                    <label class="form-label">E-mail Address</label>
                    <input type="email" class="form-control" name='email' id="regEmail" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name='password' id="regPassword" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Re-enter Password</label>
                    <input type="password" class="form-control" name='passwordAgain' id="regPasswordAgain" required>
                </div>
                <button type="submit" name='submit' class="btn btn-custom">Register</button>
            </form>
        </div>
    </div>
  </div>
</div>
<br><br>

                       <center> <a href="index.php" class="btn btn-secondary px-4">⬅ Back </a> <br><br>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript Validation -->
<script>
document.getElementById("loginForm").addEventListener("submit", function(e){
    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value.trim();

    if(email === "" || password === ""){
        alert("All fields are required!");
        e.preventDefault();
    }
});

document.getElementById("registerForm").addEventListener("submit", function(e){
    const email = document.getElementById("regEmail").value.trim();
    const password = document.getElementById("regPassword").value.trim();
    const confirmPassword = document.getElementById("regPasswordAgain").value.trim();

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    if(email === "" || password === "" || confirmPassword === ""){
        alert("All fields are required!");
        e.preventDefault();
    } else if(!email.match(emailPattern)){
        alert("Please enter a valid email address!");
        e.preventDefault();
    } else if(password.length < 6){
        alert("Password must be at least 6 characters long!");
        e.preventDefault();
    } else if(password !== confirmPassword){
        alert("Passwords do not match!");
        e.preventDefault();
    }
});
</script>

</body>
</html>
<?php include('inc/footer.php'); ?>
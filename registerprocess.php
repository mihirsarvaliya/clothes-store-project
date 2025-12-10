<?php
session_start();
include('config/db.php');

if (isset($_POST['submit'])) {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // ✅ Step 1: Check if email already exists
    $checkSql = "SELECT id FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Email exists → show alert and redirect back
        echo "<script>
                alert('Email is already exists!');
                window.location.href='login.php';
              </script>";
        exit();
    } else {
        // ✅ Step 2: Insert new user
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['customer']   = $email;
            $_SESSION['customerid'] = mysqli_insert_id($conn);
            echo "<script>
                    alert('Registration successful! Please login.');
                    window.location.href='login.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Something went wrong. Please try again.');
                    window.location.href='login.php';
                  </script>";
            exit();
        }
    }
}
?>
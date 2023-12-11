<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_karyawan = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if (mysqli_num_rows($select_karyawan) > 0) {

      $row = mysqli_fetch_assoc($select_karyawan);

      if ($row['user_type'] == 'adminkrw') {
         // Adminmsg
         $_SESSION['admin_type'] = $row['user_type'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location: admin_karyawan.php');
      } elseif ($row['user_type'] == 'super') {
         // superadmin
         $_SESSION['admin_type'] = $row['user_type'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location: admin_page.php');
      } elseif ($row['user_type'] == 'adminpd') {
         // Adminpd
         $_SESSION['admin_type'] = $row['user_type'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location: admin_products.php');
      } elseif ($row['user_type'] == 'adminord') {
         // Adminord
         $_SESSION['admin_type'] = $row['user_type'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location: admin_orders.php');
      } elseif ($row['user_type'] == 'adminusr') {
         // Adminct
         $_SESSION['admin_type'] = $row['user_type'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location: admin_users.php');
      } elseif ($row['user_type'] == 'adminmsg') {
         // Adminmsg
         $_SESSION['admin_type'] = $row['user_type'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location: admin_contacts.php');
      } else {
         // Admin lainnya
         $_SESSION['admin_type'] = $row['user_type'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location: admin_page.php');
      }
   } else {
      $message[] = 'incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <section class="form-container">

      <form action="" method="post">
         <h3>login Admin</h3>
         <input type="email" name="email" class="box" placeholder="enter your email" required>
         <input type="password" name="pass" class="box" placeholder="enter your password" required>
         <p>lupa kata sandi? <a href="admin_forgot_password.php">ubah kata sandi</a></p>
         <p>belum punya akun? <a href="register_admin.php">daftar sekarang</a></p>
         <input type="submit" class="btn" name="submit" value="login now">



      </form>

   </section>

</body>

</html>
<?php
// Include file konfigurasi atau hubungkan ke database Anda di sini
@include 'config.php';

// Pesan kesalahan atau notifikasi
$message = [];

if(isset($_POST['submit'])){
   // Filter dan ambil data dari formulir
   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);

   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $filter_birthplace = filter_var($_POST['birthplace'], FILTER_SANITIZE_STRING);
   $birthplace = mysqli_real_escape_string($conn, $filter_birthplace);

   $filter_address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
   $address = mysqli_real_escape_string($conn, $filter_address);

   $filter_question = filter_var($_POST['question'], FILTER_SANITIZE_STRING);
   $filter_answer = filter_var($_POST['answer'], FILTER_SANITIZE_STRING);
   $question = mysqli_real_escape_string($conn, $filter_question);
   $answer = mysqli_real_escape_string($conn, $filter_answer);

   // Cek apakah email sudah ada dalam database
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Email sudah terdaftar!';
   } else {
      // Jika password dan konfirmasi password cocok
      if($pass != $cpass){
         $message[] = 'Konfirmasi password tidak cocok!';
      } else {
         // Insert data ke database
         mysqli_query($conn, "INSERT INTO `users` (name, email, password, birthplace, address, question_forgot, answer_forgot) VALUES ('$name', '$email', '$pass', '$birthplace', '$address', '$question', '$answer')") or die('Query failed');
         $message[] = 'Pendaftaran berhasil!';
         // Redirect ke halaman login
         header('location: login.php');
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Akun</title>

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-5">
   <div class="row">
      <div class="col-md-6 offset-md-3">
         <h2 class="text-center">Formulir Pendaftaran Akun</h2>
         <?php
         // Tampilkan pesan kesalahan atau notifikasi jika ada
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="alert alert-danger">'.$message.'</div>';
            }
         }
         ?>
         <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
               <label for="name">Nama Lengkap:</label>
               <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
               <label for="email">Email:</label>
               <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
               <label for="pass">Password:</label>
               <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
            <div class="form-group">
               <label for="cpass">Konfirmasi Password:</label>
               <input type="password" class="form-control" id="cpass" name="cpass" required>
            </div>
            <div class="form-group">
               <label for="birthplace">Tempat Tanggal Lahir:</label>
               <input type="text" class="form-control" id="birthplace" name="birthplace" required>
            </div>
            <div class="form-group">
               <label for="address">Alamat:</label>
               <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
            </div>
            <div class="form-group">
               <label for="question">Hint Pertanyaan Lupa Password:</label>
               <input type="text" class="form-control" id="question" name="question" required>
            </div>
            <div class="form-group">
               <label for="answer">Jawaban Pertanyaan Lupa Password:</label

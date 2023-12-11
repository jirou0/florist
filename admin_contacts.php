<?php

@include 'config.php';

session_start();

$admin_type = $_SESSION['admin_type'];

if(!isset($admin_type)|| empty($admin_type)){
   header('location:home.php');
}

if ($admin_type != 'super' &&  $admin_type != 'adminmsg'){
   header('location:home.php');
   exit();
}


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

if(isset($_POST['submit_reply'])){
   // Kode untuk mengirimkan balasan
   $reply_id = $_POST['reply_id'];
   $reply_message = mysqli_real_escape_string($conn, $_POST['reply_message']);
   $auto_message = $_POST['auto_message']; // Ambil pesan otomatis dari input tersembunyi
   
   // Gabungkan pesan otomatis dengan pesan yang ingin Anda balas
   $full_reply_message = $auto_message . "\n\n" . $reply_message;
   
   // Pastikan untuk menghindari SQL injection atau menggunakan metode pengamanan lainnya saat menyimpan ke database
   mysqli_query($conn, "INSERT INTO `message`(reply_message) VALUES('$full_reply_message') WHERE id = '$reply_id'") or die('query failed');
   
   header('location: admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">messages</h1>

   <div class="box-container">

      <?php
       $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
       if(mysqli_num_rows($select_message) > 0){
          while($fetch_message = mysqli_fetch_assoc($select_message)){
      ?>
      <div class="box">
         <p>user id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
         <p>name : <span><?php echo $fetch_message['name']; ?></span> </p>
         <p>number : <span><?php echo $fetch_message['number']; ?></span> </p>
         <p>email : <span><?php echo $fetch_message['email']; ?></span> </p>
         <p>message : <span><?php echo $fetch_message['message']; ?></span> </p>
         <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('hapus pesan ini?');" class="delete-btn">delete</a>

         <form action="" method="post">
    <input type="hidden" name="reply_id" value="<?php echo $fetch_message['id']; ?>">
    <input type="hidden" name="auto_message" value="Terimakasih telah menghubungi toko kami. Maaf atas ketidaknyamanan Anda, saya akan menangani hal tersebut.">
    <a href="mailto:<?php echo $fetch_message['email'] ; ?>" onclick="return confirm('balas pesan ini?');" class="btn">Kirim Email</a>
</form>


      </div>
      <?php
         }
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
      ?>
   </div>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>
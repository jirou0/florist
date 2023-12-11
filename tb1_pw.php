<?php

@include 'config.php';

session_start();

$admin_type = $_SESSION['admin_type'];

if(!isset($admin_type)|| empty($admin_type)){
   header('location:home.php');
}

if ($admin_type != 'super' &&  $admin_type != 'adminusr'){
   header('location:admin_page.php');
   exit();
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
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
   <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: large;
  margin: 10px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.center {
  margin-left: auto;
  margin-right: auto;
}
</style>
</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title">akun pengguna</h1>

   <a href="input_data_konsumen.php" class="option-btn">Input Data</a>
   <a href="convert_excel.php" class="option-btn">Convert Excel</a>
      <table class="center">
  <tr>
    <th>No : </th>
    <th>NIK : </th> 
    <th>Tempat/Tanggal lahir : </th>
    <th>Alamat :   </th>
    

  </tr>

  <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         if(mysqli_num_rows($select_users) > 0){
            while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
  <tr>
   
    <td><?php echo $fetch_users['no']; ?></td>
    <td><?php echo $fetch_users['NIK'];?></td> 
    <td><?php echo $fetch_users['tgl_lahir']; ?></td>
    <td><?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; }; ?>"><?php echo $fetch_users['user_type']; ?></td>
    <td><a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn" style="font-size: 12px !important;">Hapus</a> </td>
    <td><a href="admin_update_users.php?update=<?php echo $fetch_users['id']; ?>" onclick="return confirm('update this user?');" class="delete-btn" style="font-size: 12px !important;">EDIT</a> </td>
  </tr>
  <?php
  }
}
?>
</table>
   </div>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>
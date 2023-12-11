<?php

@include 'config.php';

session_start();

$admin_type = $_SESSION['admin_type'];

if (!isset($admin_type) || empty($admin_type)) {
  header('location:home.php');
}

if ($admin_type != 'super' &&  $admin_type != 'adminkrw') {
  header('location:admin_page.php');
  exit();
}
if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `karyawan` WHERE id = '$delete_id'") or die('query failed');
  header('location:admin_karyawan.php');
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

    td,
    th {
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

    <h1 class="title">DAFTAR KARYAWAN</h1>

    <a href="input_karyawan.php" class="option-btn">Input Data</a>
    <a href="convert_karyawan.php" class="option-btn">Convert Excel</a>
    <table class="center">
      <tr>
        <th>User id : </th>
        <th>Username: </th>
        <th>Tanggal Lahir : </th>
        <th>Email : </th>
        <th>No Telepon : </th>
        <th>Alamat : </th>
        <th>Keahlian : </th>
        <th>Jabatan: </th>
        <th>Delete : </th>
        <th>Edit : </th>

      </tr>

      <?php
      $select_admin = mysqli_query($conn, "SELECT * FROM `admin` ") or die('query failed');
      if (mysqli_num_rows($select_admin) > 0) {
        while ($fetch_admin = mysqli_fetch_assoc($select_admin)) {
      ?>
          <tr>

            <td><?php echo $fetch_admin['id']; ?></td>
            <td><?php echo $fetch_admin['name']; ?></td>
            <td><?php echo $fetch_admin['birthplace']; ?></td>
            <td><?php echo $fetch_admin['email']; ?></td>
            <td><?php echo $fetch_admin['no_hp']; ?></td>
            <td><?php echo $fetch_admin['address']; ?></td>
            <td><?php echo $fetch_admin['keahlian']; ?></td>
            <td><?php echo $fetch_admin['jabatan']; ?></td>
            <td><a href="admin_karyawan.php?delete=<?php echo $fetch_admin['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn" style="font-size: 12px !important; color:black;">HAPUS</a> </td>
            <td><a href="admin_update_karyawan.php?update=<?php echo $fetch_admin['id']; ?>" onclick="return confirm('update this user?');" class="delete-btn" style="font-size: 12px !important; color:black;">EDIT</a> </td>
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
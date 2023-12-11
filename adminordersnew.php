<?php

@include 'config.php';

session_start();

$admin_type = $_SESSION['admin_type'];

if(!isset($admin_type)|| empty($admin_type)){
   header('location:home.php');
}

if ($admin_type != 'super' &&  $admin_type != 'adminord'){
   header('location:home.php');
   exit();
}


if(isset($_POST['update_order'])){
   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
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
         border-radius: 20px;
         border-collapse: separate;
         border-spacing: 0;
         overflow: hidden; /* Untuk memastikan tabel tetap dalam batas yang ditentukan */
      }

      td, th {
         border: 1px solid #dddddd;
         text-align: left;
         padding: 2px;
    
      }

      tr:nth-child(even) {
         background-color: #dddddd;
      }
   </style>
</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="orders">
    <h1 class="title">Placed Orders</h1>
    <table class="center">
        <tr>
            <th style="background-color: #e84393; color: #ffffff;">User id :</th>
            <th style="background-color: #e84393; color: #ffffff;">Transaksi:</th>
            <th style="background-color: #e84393; color: #ffffff;">Nama:</th>
            <th style="background-color: #e84393; color: #ffffff;">Nomor:</th>
            <th style="background-color: #e84393; color: #ffffff;">Email:</th>
            <th style="background-color: #e84393; color: #ffffff;">Alamat:</th>
            <th style="background-color: #e84393; color: #ffffff;">Metode Pembayaran:</th>
            <th style="background-color: #e84393; color: #ffffff;">Pesanan:</th>
            <th style="background-color: #e84393; color: #ffffff;">Total Harga:</th>
            <th style="background-color: #e84393; color: #ffffff;">Status Pembayaran:</th>
            <th style="background-color: #e84393; color: #ffffff;">Edit : </th>
            <th style="background-color: #e84393; color: #ffffff;">Delete :</th>
        </tr>

        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY placed_on DESC") or die('Query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
        ?>
        <tr>
            <td><?php echo $fetch_orders['user_id']; ?></td>
            <td><?php echo $fetch_orders['placed_on']; ?></td>
            <td><?php echo $fetch_orders['name']; ?></td>
            <td><?php echo $fetch_orders['number']; ?></td>
            <td><?php echo $fetch_orders['email']; ?></td>
            <td><?php echo $fetch_orders['address']; ?></td>
            <td><?php echo $fetch_orders['method']; ?></td>
            <td><?php echo $fetch_orders['total_products']; ?></td>
            <td>IDR <?php echo $fetch_orders['total_price']; ?>K</td>
            <td> 
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="tertunda">tertunda</option>
               <option value="selesai">selesai</option>
            </select> </td>
            <td> <input type="submit" name="update_order" value="update" class="option-btn"> </td>
            <td> <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a> </td>
          </td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
</section>

<script src="js/admin_script.js"></script>

</body>
</html>
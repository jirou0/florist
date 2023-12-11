<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);

   mysqli_query($conn, "UPDATE `products` SET name = '$name', details = '$details', price = '$price' WHERE id = '$update_p_id'") or die('query failed');

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;
   $old_image = $_POST['update_p_image'];

   // Debugging statements
   $message[] = 'Debugging Info:';
   $message[] = 'Script executed from: ' . __FILE__;
   $message[] = 'image_folder: ' . $image_folder;
   $message[] = 'old_image: ' . $old_image;

   if (file_exists($image_folder)) {
      $message[] = 'Image folder exists.';
   } else {
      $message[] = 'Image folder does not exist. Creating it...';
      mkdir('uploaded_img', 0755, true);
   }

   if (move_uploaded_file($image_tmp_name, $image_folder)) {
      $message[] = 'Image moved successfully!';
   } else {
      $message[] = 'Failed to move file.';

      // Additional debugging information
      $message[] = 'Error: ' . error_get_last()['message']; // Display the last PHP error message
   }

   $old_image_path = 'uploaded_img/' . $old_image;
   if (file_exists($old_image_path)) {
      unlink($old_image_path);
      $message[] = 'Old image removed successfully!';
   } else {
      $message[] = 'Old image not found. It might have already been deleted.';
   }

   $message[] = 'Product updated successfully!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom admin CSS file link -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="update-product">
<?php
   $update_id = $_GET['update'];
   $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
   if(mysqli_num_rows($select_products) > 0){
      while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<form action="" method="post" enctype="multipart/form-data">
   <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image"  alt="">
   <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
   <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
   <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="Update product name" name="name">
   <input type="number" min="0" class="box" value="<?php echo $fetch_products['price']; ?>" required placeholder="Update product price" name="price">
   <textarea name="details" class="box" required placeholder="Update product details" cols="30" rows="10"><?php echo $fetch_products['details']; ?></textarea>
   <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
   <input type="submit" value="Update Product" name="update_product" class="btn">
   <a href="admin_products.php" class="option-btn">Go Back</a>
</form>
<?php
      }
   }else{
      echo '<p class="empty">No update product selected</p>';
   }
?>
</section>

<script src="js/admin_script.js"></script>
</body>
</html>

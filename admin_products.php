<?php
@include 'config.php';

session_start();

$admin_type = $_SESSION['admin_type'];

if (!isset($admin_type) || empty($admin_type)) {
    header('location:home.php');
}

if ($admin_type != 'super' && $admin_type != 'adminpd') {
    header('location:admin_page.php');
    exit();
}

// Fungsi untuk memvalidasi dan menyimpan gambar
function uploadImage($image, $targetFolder)
{
    $targetFile = $targetFolder . basename($image['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Validasi jika file gambar atau bukan
    $check = getimagesize($image['tmp_name']);
    if ($check === false) {
        return 'File bukan gambar.';
    }

    // Cek ukuran file
    if ($image['size'] > 2000000) { // 2 MB
        return 'Ukuran gambar terlalu besar.';
    }

    // Izinkan format gambar tertentu
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowedExtensions)) {
        return 'Hanya gambar dengan format JPG, JPEG, dan PNG yang diizinkan.';
    }

    // Pindahkan file gambar ke folder tujuan
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        return $targetFile; // Mengembalikan path file yang berhasil diunggah
    } else {
        return 'Terjadi kesalahan saat mengunggah gambar.';
    }
}

// Proses form jika tombol "Add Product" ditekan
if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $image = $_FILES['image'];

    // Lokasi folder untuk menyimpan gambar
    $imageFolder = 'flowers/';

    // Panggil fungsi uploadImage untuk validasi dan menyimpan gambar
    $imagePath = uploadImage($image, $imageFolder);
    echo $imagePath;

    // Jika berhasil menyimpan gambar, lanjutkan dengan menyimpan data produk
    if (is_string($imagePath)) {
        $insert_product = mysqli_query($conn, "INSERT INTO `products` (name, details, price, image) VALUES ('$name', '$details', '$price', '$imagePath')") or die('Query failed: ' . mysqli_error($conn));

        if ($insert_product) {
            $message = ['Product added successfully!'];
        } else {
            $message = ['Failed to insert product: ' . mysqli_error($conn)];
        }
    } else {
        $message[] = $imagePath; // Pesan kesalahan dari fungsi uploadImage
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('Query failed: ' . mysqli_error($conn));
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink($fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('Query failed: ' . mysqli_error($conn));
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('Query failed: ' . mysqli_error($conn));
    mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('Query failed: ' . mysqli_error($conn));
    header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

    <?php @include 'admin_header.php'; ?>

    <section class="add-products">

        <?php
        if (isset($message) && is_array($message)) {
            foreach ($message as $msg) {
                echo '<div class="message"><span>' . $msg . '</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <h3>tambahkan produk baru</h3>
            <input type="text" class="box" required placeholder="nama produk" name="name">
            <input type="number" min="0" class="box" required placeholder="harga produk" name="price">
            <textarea name="details" class="box" required placeholder="detail produk" cols="30" rows="10"></textarea>
            <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
            <input type="submit" value="add product" name="add_product" class="btn">
        </form>

    </section>

    <section class="show-products">

        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <div class="box">
                        <div class="price">IDR <?php echo $fetch_products['price']; ?>K </div>
                        <img class="image" src="<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="details"><?php echo $fetch_products['details']; ?></div>
                        <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">perbarui</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">hapus</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>

    </section>

    <script src="js/admin_script.js"></script>

</body>

</html>
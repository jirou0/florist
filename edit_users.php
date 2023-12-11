<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom admin CSS file link -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* CSS Custom Untuk Membuat Formulir Lebih Besar */
        .form-control {
            font-size: 18px; /* Ukuran font dalam input dan elemen formulir lainnya */
            padding: 12px; /* Tambahkan padding agar elemen formulir lebih besar */
        }

        /* Jika Anda ingin membuat tombol formulir lebih besar */
        .btn {
            font-size: 18px; /* Ukuran font tombol formulir */
            padding: 10px 20px; /* Tambahkan padding tombol formulir */
        }

        /* Jika Anda ingin membuat label lebih besar */
        .label {
            font-size: 18px; /* Ukuran font label */
        }

        /* Jika Anda ingin membuat pesan kesalahan atau informasi lebih besar */
        .alert {
            font-size: 18px; /* Ukuran font pesan kesalahan atau informasi */
        }
    </style>
</head>
<body>

<?php 
@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['update_users'])) {
    $update_u_name = mysqli_real_escape_string($conn, $_POST['update_u_name']);
    $update_u_birthplace = mysqli_real_escape_string($conn, $_POST['update_u_birthplace']);
    $update_u_email = mysqli_real_escape_string($conn, $_POST['update_u_email']);
    $update_u_no_hp = mysqli_real_escape_string($conn, $_POST['update_u_no_hp']);
    $update_u_address = mysqli_real_escape_string($conn, $_POST['update_u_address']);
    $update_u_user = mysqli_real_escape_string($conn, $_POST['update_u_user']);

    $query = "UPDATE users SET
             name = '$update_u_name',
             birthplace = '$update_u_birthplace',
             email = '$update_u_email',
             no_hp = '$update_u_no_hp',
             address = '$update_u_address',
             user_type = '$update_u_user'
             WHERE id = $user_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update berhasil
        // Anda bisa menambahkan pesan sukses atau mengarahkan pengguna ke halaman lain di sini
    } else {
        die('Query failed: ' . mysqli_error($conn));
    }
}

$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('Query failed');
if (mysqli_num_rows($select_users) > 0) {
    while ($fetch_users = mysqli_fetch_assoc($select_users)) {
        ?>
        <div class="container mt-5">
            <form method="POST" action="#">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="label">Nama</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_users['name']; ?>" name="update_u_name"></td>
                        </tr>
                        <tr>
                            <th class="label">Tempat/Tanggal lahir</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_users['birthplace']; ?>" name="update_u_birthplace"></td>
                        </tr>
                        <tr>
                            <th class="label">Email</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_users['email']; ?>" name="update_u_email"></td>
                        </tr>
                        <tr>
                            <th class="label">Nomor Telepon</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_users['no_hp']; ?>" name="update_u_no_hp"></td>
                        </tr>
                        <tr>
                            <th class="label">Alamat</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_users['address']; ?>" name="update_u_address"></td>
                        </tr>
                        <!-- Anda bisa menambahkan baris tambahan sesuai kebutuhan -->
                    </table>
                </div>
                <input type="submit" value="Edit Pengguna" name="update_users" class="btn btn-primary">
                <a href="home.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    <?php
    }
}
?>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>

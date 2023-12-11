<?php
@include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_admin'])) {
    $update_u_name = mysqli_real_escape_string($conn, $_POST['update_u_name']);
    $update_u_birthplace = mysqli_real_escape_string($conn, $_POST['update_u_birthplace']);
    $update_u_email = mysqli_real_escape_string($conn, $_POST['update_u_email']);
    $update_u_no_hp = mysqli_real_escape_string($conn, $_POST['update_u_no_hp']);
    $update_u_address = mysqli_real_escape_string($conn, $_POST['update_u_address']);
    $update_u_keahlian = mysqli_real_escape_string($conn, $_POST['update_u_keahlian']);
    $update_u_jabatan = mysqli_real_escape_string($conn, $_POST['update_u_jabatan']);

    $query = "UPDATE admin SET
             name = '$update_u_name',
             birthplace = '$update_u_birthplace',
             email = '$update_u_email',
             no_hp = '$update_u_no_hp',
             address = '$update_u_address',
             keahlian = '$update_u_keahlian',
             jabatan = '$update_u_jabatan'  
             WHERE id = " . $_GET['update'];

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<div class="alert alert-success">Berhasil edit pengguna!</div>';
    } else {
        die('Query failed: ' . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* CSS Custom Untuk Membuat Formulir Lebih Besar */
        .form-control {
            font-size: 18px;
            /* Ukuran font dalam input dan elemen formulir lainnya */
            padding: 12px;
            /* Tambahkan padding agar elemen formulir lebih besar */
        }

        /* Jika Anda ingin membuat tombol formulir lebih besar */
        .btn {
            font-size: 18px;
            /* Ukuran font tombol formulir */
            padding: 10px 20px;
            /* Tambahkan padding tombol formulir */
        }

        /* Jika Anda ingin membuat label lebih besar */
        .label {
            font-size: 18px;
            /* Ukuran font label */
        }

        /* Jika Anda ingin membuat pesan kesalahan atau informasi lebih besar */
        .alert {
            font-size: 18px;
            /* Ukuran font pesan kesalahan atau informasi */
        }

        th {
            font-size: 18px;
            /* Ukuran font header kolom */
            padding: 15px;
            /* Tambahkan padding untuk meningkatkan ukuran <th> */
        }
    </style>
</head>

<body>

    <?php @include 'admin_header.php'; ?>

    <?php
    $update_id = $_GET['update'];
    $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$update_id'") or die('query failed');
    if (mysqli_num_rows($select_admin) > 0) {
        while ($fetch_admin = mysqli_fetch_assoc($select_admin)) {
    ?>
            <div class="container mt-5">
                <form method="POST" action="#">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_admin['name']; ?>" name="update_u_name"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_admin['birthplace']; ?>" name="update_u_birthplace"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_admin['email']; ?>" name="update_u_email"></td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_admin['no_hp']; ?>" name="update_u_no_hp"></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_admin['address']; ?>" name="update_u_address"></td>
                        </tr>
                        <tr>
                            <th>Keahlian</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_admin['keahlian']; ?>" name="update_u_keahlian"></td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td><input type="text" class="form-control" value="<?php echo $fetch_admin['jabatan']; ?>" name="update_u_jabatan"></td>
                        </tr>
                    </table>
                    <input type="submit" value="Edit Pengguna" name="update_admin" class="option-btn">
                    <a href="admin_karyawan.php" class="option-btn" style="color:black;">Kembali</a>
                </form>
            </div>
    <?php
        }
    }
    ?>

</body>

</html>
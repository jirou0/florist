<?php
@include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['add_user'])) {
    $add_u_name = mysqli_real_escape_string($conn, $_POST['add_u_name']);
    $add_u_birthdate = mysqli_real_escape_string($conn, $_POST['add_u_birthdate']);
    $add_u_email = mysqli_real_escape_string($conn, $_POST['add_u_email']);
    $add_u_no_hp = mysqli_real_escape_string($conn, $_POST['add_u_no_hp']);
    $add_u_address = mysqli_real_escape_string($conn, $_POST['add_u_address']);
    $add_u_keahlian = mysqli_real_escape_string($conn, $_POST['add_u_keahlian']);
    $add_u_jabatan = mysqli_real_escape_string($conn, $_POST['add_u_jabatan']);

    // Query untuk menambahkan data baru ke dalam tabel users
    $query = "INSERT INTO karyawan (name, birthdate, email, no_hp, address, keahlian, jabatan)
              VALUES ('$add_u_name','$add_u_birthdate' ,'$add_u_email', '$add_u_no_hp', '$add_u_address', '$add_u_keahlian', '$add_u_jabatan')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<div class="alert alert-success">Berhasil menambahkan pengguna!</div>';
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
    <title>Tambah Pengguna</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

        th {
        font-size: 18px; /* Ukuran font header kolom */
        padding: 15px; /* Tambahkan padding untuk meningkatkan ukuran <th> */
    }
    </style>
</head>
<body>

<?php @include 'admin_header.php'; ?>

<div class="container mt-5">
    <form method="POST" action="#">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td><input type="text" class="form-control" value="" name="add_u_name"></td>
            </tr>
            <tr>
                <th>Tempat Tanggal Lahir</th>
                <td><input type="text" class="form-control" value="" name="add_u_birthdate"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="text" class="form-control" value="" name="add_u_email"></td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <td><input type="text" class="form-control" value="" name="add_u_no_hp"></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><input type="text" class="form-control" value="" name="add_u_address"></td>
            </tr>
            <tr>
                <th>Keahlian</th>
                <td><input type="text" class="form-control" value="" name="add_u_keahlian"></td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td><input type="text" class="form-control" value="" name="add_u_jabatan"></td>
            </tr>
        </table>
        <input type="submit" value="Tambah Pengguna" name="add_user" class="option-btn">
        <a href="admin_karyawan.php" class="option-btn" style="color: black;">Kembali</a>

    </form>
</div>

</body>
</html>

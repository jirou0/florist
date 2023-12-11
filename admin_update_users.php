<?php
@include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_users'])) {
    $update_u_name = mysqli_real_escape_string($conn, $_POST['update_u_name']);
    $update_u_email = mysqli_real_escape_string($conn, $_POST['update_u_email']);
    $update_u_password = mysqli_real_escape_string($conn, $_POST['update_u_password']);
    $update_u_user = mysqli_real_escape_string($conn, $_POST['update_u_user']);

    $query = "UPDATE users SET
             name = '$update_u_name',
             email = '$update_u_email',
             password = '$update_u_password',
             user_type = '$update_u_user'
             WHERE id = " . $_GET['update'];

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update berhasil
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

<?php
$update_id = $_GET['update'];
$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$update_id'") or die('query failed');
if (mysqli_num_rows($select_users) > 0) {
    while ($fetch_users = mysqli_fetch_assoc($select_users)) {
        ?>
        <div class="container mt-5">
            <form method="POST" action="#">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td><input type="text" class="form-control" value="<?php echo $fetch_users['name']; ?>" name="update_u_name"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" class="form-control" value="<?php echo $fetch_users['email']; ?>" name="update_u_email"></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td><input type="text" class="form-control" value="<?php echo $fetch_users['password']; ?>" name="update_u_password"></td>
                    </tr>
                    <tr>
                        <th>User Type</th>
                        <td><input type="text" class="form-control" value="<?php echo $fetch_users['user_type']; ?>" name="update_u_user"></td>
                    </tr>
                    <tr>
                        <th>Lupa Password</th>
                        <td><input type="text" class="form-control" value="<?php echo $fetch_users['answer_forgot']; ?>" name="update_u_forgot"></td>
                    </tr>
                    <tr>
                        <th>Pertanyaan Password</th>
                        <td><input type="text" class="form-control" value="<?php echo $fetch_users['question_forgot']; ?>" name="update_u_question"></td>
                    </tr>
                </table>
                <input type="submit" value="Edit Pengguna" name="update_users" class="option-btn">
                <a href="admin_users.php" class="option-btn">Kembali</a>
            </form>
        </div>
    <?php
    }
}
?>

</body>
</html>

<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv X-UA-Compatible content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom admin CSS file link -->
    <link rel="stylesheet" href="css/style.css">
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

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Karyawan</h3>
    </section>

    <section class="orders">
        <table class="center">
            <tr>
                <th style="background-color: #e84393; color: #ffffff;">Nama : </th>
                <th style="background-color: #e84393; color: #ffffff;">Tanggal Lahir</th>
                <th style="background-color: #e84393; color: #ffffff;">Email :</th>
                <th style="background-color: #e84393; color: #ffffff;">Nomor Telepon :</th>
                <th style="background-color: #e84393; color: #ffffff;">Alamat:</th>
                <th style="background-color: #e84393; color: #ffffff;">Keahlian:</th>
                <th style="background-color: #e84393; color: #ffffff;">Jabatan</th>
            </tr>

            <?php
            $select_karyawan = mysqli_query($conn, "SELECT * FROM `karyawan`") or die('query failed');
            if(mysqli_num_rows($select_karyawan) > 0){
               while($fetch_karyawan = mysqli_fetch_assoc($select_karyawan)){
                ?>
                    <tr>
                        <td><?php echo $fetch_karyawan['name']; ?></td>
                        <td><?php echo $fetch_karyawan['birthdate']; ?></td>
                        <td><?php echo $fetch_karyawan['email']; ?></td>
                        <td><?php echo $fetch_karyawan['no_hp']; ?></td>
                        <td><?php echo $fetch_karyawan['address']; ?></td>
                        <td><?php echo $fetch_karyawan['keahlian']; ?></td>
                        <td><?php echo $fetch_karyawan['jabatan']; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>

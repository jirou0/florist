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
    <title>Pesanan</title>

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
            overflow: hidden;
            /* Untuk memastikan tabel tetap dalam batas yang ditentukan */
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
        <h3>Pesanan Anda</h3>
        <p><a href="home.php">home</a> / order</p>
    </section>

    <section class="orders">
        <h1 class="title">Placed Orders</h1>
        <table class="center">
            <tr>
                <th style="background-color: #e84393; color: #ffffff;">Transaksi:</th>
                <th style="background-color: #e84393; color: #ffffff;">Nama:</th>
                <th style="background-color: #e84393; color: #ffffff;">Nomor:</th>
                <th style="background-color: #e84393; color: #ffffff;">Email:</th>
                <th style="background-color: #e84393; color: #ffffff;">Alamat:</th>
                <th style="background-color: #e84393; color: #ffffff;">Metode Pembayaran:</th>
                <th style="background-color: #e84393; color: #ffffff;">Pesanan:</th>
                <th style="background-color: #e84393; color: #ffffff;">Total Harga:</th>
                <th style="background-color: #e84393; color: #ffffff;">Status Pembayaran:</th>
            </tr>

            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '{$user_id}' ") or die('Query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                    <tr>
                        <td><?php echo $fetch_orders['placed_on']; ?></td>
                        <td><?php echo $fetch_orders['name']; ?></td>
                        <td><?php echo $fetch_orders['number']; ?></td>
                        <td><?php echo $fetch_orders['email']; ?></td>
                        <td><?php echo $fetch_orders['address']; ?></td>
                        <td><?php echo $fetch_orders['method']; ?></td>
                        <td><?php echo $fetch_orders['total_products']; ?></td>
                        <td>IDR <?php echo $fetch_orders['total_price']; ?>K</td>
                        <td style="color: <?php echo $fetch_orders['payment_status'] == 'pending' ? 'red' : 'green'; ?>">
                            <?php echo $fetch_orders['payment_status']; ?>
                        </td>
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
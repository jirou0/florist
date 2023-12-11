<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Profil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Data Profil</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td><?php echo $_POST['nama']; ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?php echo $_POST['jenis_kelamin']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?php echo $_POST['tanggal_lahir']; ?></td>
                        </tr>
                        <tr>
                            <th>No. Handphone</th>
                            <td><?php echo $_POST['no_hp']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $_POST['email']; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?php echo $_POST['alamat']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <a href="input_data_users.php" class="btn btn-primary">Kembali ke Formulir</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $message = array(); // Initialize an empty array for error/success messages

    $name = $_POST['name'];
    $birthplace = $_POST['birthplace'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $address = $_POST['address'];
    $pass = md5($_POST['pass']);
    $cpass = md5($_POST['cpass']);
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $keahlian = $_POST['keahlian'];
    $jabatan = $_POST['jabatan'];

    // Check if the email already exists
    $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email'");
    if (mysqli_num_rows($select_admin) > 0) {
        $message[] = 'User already exists!';
    } else {
        // Check if passwords match
        if ($pass != $cpass) {
            $message[] = 'Confirm password not matched!';
        } else {
            // Use prepared statements to insert user data
            $stmt = mysqli_prepare($conn, "INSERT INTO `admin` (name, birthplace, email, no_hp, address, password, question_forgot, answer_forgot, keahlian, jabatan, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?, ?,?)");
            if ($stmt) {
                $user_type = 'user';
                mysqli_stmt_bind_param($stmt, "sssssssss", $name, $birthplace, $email, $no_hp, $address, $pass, $question, $answer,$keahlian, $jabatan, $user_type);
                if (mysqli_stmt_execute($stmt)) {
                    $message[] = 'Registered successfully!';
                    header('location: login.php');
                } else {
                    $message[] = 'Query execution failed: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message[] = 'Failed to prepare statement: ' . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
    ?>
    <section class="form-container">
        <form action="" method="post">
            <h3>Daftar sekarang</h3>
            <input type="text" name="name" class="box" placeholder="Enter your username" required>
            <input type="text" name="birthplace" class="box" placeholder="Tanggal Lahir: " required>
            <input type="email" name="email" class="box" placeholder="Enter your email" required>
            <input type="text" name="no_hp" class="box" placeholder="enter your number phone" required>
            <input type="text" name="address" class="box" placeholder="Alamat (Jalan, Kota, Provinsi, Kode POS)" required>
            <input type="password" name="pass" class="box" placeholder="Enter your password" required>
            <input type="password" name="cpass" class="box" placeholder="Confirm your password" required>
            <input type="text" name="question" class="box" placeholder="Enter hint for forgot password" required>
            <input type="text" name="answer" class="box" placeholder="Enter the answer" required>
            <input type="text" name="keahlian" class="box" placeholder="keahlian" required>
            <input type="text" name="jabatan" class="box" placeholder="jabatan" required>
            <input type="submit" class="btn" name="submit" value="Register Now">
            <p>Sudah mempunyai akun? <a href="login.php">Masuk sekarang</a></p>
        </form>
    </section>
</body>

</html>
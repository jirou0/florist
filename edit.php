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
        //succeed
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
    <title>dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php @include 'admin_header.php'; ?>

<?php
$update_id = $_GET['update'];
$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$update_id'") or die('query failed');
if (mysqli_num_rows($select_users) > 0) {
    while ($fetch_users = mysqli_fetch_assoc($select_users)) {
        ?>
        <form method="POST" action="#">
            <input type="text" class="box" value="<?php echo $fetch_users['name']; ?>" name="update_u_name">
            <input type="text" class="box" value="<?php echo $fetch_users['email']; ?>" name="update_u_email">
            <input type="text" class="box" value="<?php echo $fetch_users['password']; ?>" name="update_u_password">
            <input type="text" class="box" value="<?php echo $fetch_users['user_type']; ?>" name="update_u_user">
            <input type="text" class="box" value="<?php echo $fetch_users['forgot_password']; ?>" name="update_u_forgot">
            <input type="text" class="box" value="<?php echo $fetch_users['question_password']; ?>"
                   name="update_u_question">
            <input type="text" class="box" value="<?php echo $fetch_users['name']; ?>" required
                   placeholder="update users" name="users">
            <input type="submit" value="edit_users" name="update_users" class="btn">
            <a href="admin_users.php" class="option-btn">go back</a>
        </form>
    <?php
    }
}
?>

</body>
</html>

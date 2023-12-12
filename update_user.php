<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- edit area -->
<?php
    include 'conn/konneksi.php';
    $npk = $_POST['npk'];
    $nama = $_POST['nama'];
    $pasword = $_POST ['password'];
    
    $update = mysqli_query($cnts,"UPDATE user SET npk='$npk', nama='$nama', password='$pasword' WHERE npk=' $npk'");
    header('location: user_add.php');

?>
<!-- edit area -->

</body>
</html>
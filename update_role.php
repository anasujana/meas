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
    $role = $_POST['role'];
   
    $update = mysqli_query($cnts,"UPDATE role_user SET npk='$npk', role_user='$role' WHERE npk=' $npk'");
    header('location: roleuser.php');

?>
<!-- edit area -->

</body>
</html>
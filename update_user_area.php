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
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $area = $_POST['area'];
   
    $update = mysqli_query($cnts,"UPDATE user_area SET id_user=' $nama', id_area='$area' WHERE id=' $id'");
    header('location: user_area.php');

?>
<!-- edit area -->

</body>
</html>
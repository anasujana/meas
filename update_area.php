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
    $area = $_POST['area'];
   
    $update = mysqli_query($cnts,"UPDATE area SET id='$id', area='$area' WHERE id=' $id'");
    header('location: area.php');

?>
<!-- edit area -->

</body>
</html>
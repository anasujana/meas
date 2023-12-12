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
    $id = $_POST['id_part'];
    $area = $_POST['area'];
    $part_name = $_POST['part_name'];
   
    $update = mysqli_query($cnts,"UPDATE register_part SET id_area=' $area', part_name='$part_name' WHERE id_part=' $id'");
    header('location: register_part.php');

?>
<!-- edit area -->

</body>
</html>
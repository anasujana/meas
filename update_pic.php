<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    include 'conn/konneksi.php';
    $id_pic = $_POST['id_pic'];
    $pic = $_POST['pic'];
    $frm= $_POST['frm'];
    $area = $_POST['area'];
   
    $update = mysqli_query($cnts,"UPDATE pic_check SET pic='$pic', foreman='$frm', area='$area' WHERE id='$id_pic'");
    header('location: monthly_report_admin.php');

?>


</body>
</html>
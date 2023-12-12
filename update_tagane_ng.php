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
   include('conn/konneksi.php');
        $no = $_POST['no_urut'];
        $npk = $_POST['npk'];
        $judgement = $_POST ['judgement'];
        $kategori = $_POST ['kategori'];
        $detail = $_POST ['detail'];

        $update = mysqli_query($cnts,"UPDATE tagane_check SET pic='$npk', judgement='$judgement', kategori=' $kategori ', detail='$detail' 
        WHERE no_urut=' $no'");
        header('location: tagane_ng.php');
    
?>
</body>
</html>
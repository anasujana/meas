<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="formFilter.php" method="POST">
        Tanggal : <input type="Date" name="Date" id="Date">
        <input type="submit" value="cari">
</form>
<table border=1>
    <td>Tanggal</td>
    <td>Part No</td>
    <td>Result</td>

<?php
        include('conn/konneksi.php');
        $terimaTanggal  = $_POST ['Date'];

    if(isset($terimaTanggal)){
        $matrix_eye = mysqli_query($cnts,"SELECT Date, Part_No, Result FROM matrix_eye WHERE Date= '$terimaTanggal'");
    }else{
        $matrix_eye = mysqli_query($cnts,"SELECT Date, Part_No, Result  FROM matrix_eye");
    }
        
        
?>

<?php
    foreach ($matrix_eye AS $d){
      $Tanggal = $d ['Date'];
      $Part_No = $d ['Part_No'];
      $Result = $d ['Result'];
?>
    <tr>
    <td><?php echo $Tanggal; ?></td>
    <td><?php echo $Part_No; ?></td>
    <td><?php echo $Result; ?></td>
    </tr>
 <?php
}
 ?>
</table>
</body>
</html>
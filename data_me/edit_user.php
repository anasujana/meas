<?php
include('../conn/konneksi.php');
session_start();
$a = array();
$row = 0;

$datauser = mysqli_query($cnts,"SELECT * FROM user");            

foreach ($datauser AS $user){
        $npk = $user ['npk'];
        $nama = $user ['nama']; 
        $password = $user ['password'];
        
        $a[$row][0]=$npk;
        $a[$row][1]=$nama;
        $a[$row][2]=$password;
        $a[$row][3]="<a href='user_add.php?npk=$npk'>
        <button type='button' class='btn btn-icon btn-danger btn-circle btn-sm'> 
        <i class='fa fa-trash' aria-hidden='true'></i>
        </button>
        </a>
        <button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit' data-toggle='modal' 
        data-npk='$npk' data-nama='$nama' data-pasword='$password'
        data-target='#exampleModal1'> 
        <i class='fas fa-edit'  aria-hidden='true'></i>
        </button>";       

    $row++;

    } 
    
    $data = array(
                    'data' => $a
    );
    echo json_encode($data);
?> 

                    
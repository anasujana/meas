<?php
include('../conn/konneksi.php');
session_start();
$a = array();
$row = 0;

        $datarelasi= mysqli_query($cnts, "SELECT us.npk,ru.role_user FROM user us 
        left join role_user ru on us.npk=ru.npk");             

        foreach ($datarelasi AS $roleuser){
        $npk = $roleuser['npk'];
        $roleuser = $roleuser['role_user'];

        $a[$row][0]=$npk;
        $a[$row][1]=$roleuser;
        $a[$row][2]="<a href='roleuser.php?npk=$npk'>
        <button type='button' class='btn btn-icon btn-danger btn-circle btn-sm'> 
        <i class='fa fa-trash' aria-hidden='true'></i>
        </button>
        </a>
        <button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit'
        data-toggle='modal' 
        data-npk='$npk' data-role='$roleuser' 
        data-target='#exampleModal2' > 
        <i class='fas fa-edit' aria-hidden='true'></i>
        </button>";       

    $row++;

    } 
    
    $data = array(
                    'data' => $a
    );
    echo json_encode($data);
?> 

                    
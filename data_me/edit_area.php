<?php
include('../conn/konneksi.php');
session_start();
$a = array();
$row = 0;

$datauser = mysqli_query($cnts,"SELECT * FROM area");            

foreach ($datauser AS $user){
        $id = $user ['id'];
        $area = $user ['area']; 

        $a[$row][0]=$id;
        $a[$row][1]=$area;
        $a[$row][2]="<a href='area.php?id=$id'>
        <button type='button' class='btn btn-icon btn-danger btn-circle btn-sm'> 
        <i class='fa fa-trash' aria-hidden='true'></i>
        </button>
        </a>
        <button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit'
        data-toggle='modal' 
        data-id='$id' data-area='$area' 
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

                    
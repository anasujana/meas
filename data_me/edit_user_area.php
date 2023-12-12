<?php
include('../conn/konneksi.php');
session_start();
$a = array();
$row = 0;
  
    $datarelasi =  mysqli_query ($cnts,"SELECT ua.id,us.npk,us.nama,ar.area FROM user_area ua 
    LEFT JOIN user us ON ua.id_user= us.npk  
    LEFT JOIN area ar on ua.id_area=ar.id ");                                  

    foreach($datarelasi AS $data){
        $id = $data['id'];     
        $npk = $data['npk'];
        $nama = $data['nama'];
        $area= $data['area'];

        $a[$row][0]=  $npk;
        $a[$row][1]=  $nama ;
        $a[$row][2]=  $area;
        $a[$row][3]="<a href='user_area.php?id=$id'>
        <button type='button' class='btn btn-icon btn-danger btn-circle btn-sm'> 
        <i class='fa fa-trash' aria-hidden='true'></i>
        </button>
        </a>
        <button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit'
        data-toggle='modal' 
        data-id='$npk' data-nama='$nama' data-area='$area' 
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

                    
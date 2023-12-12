<?php
include('../conn/konneksi.php');
session_start();
$a = array();
$row = 0;
  
    $datarelasi =  mysqli_query ($cnts,"SELECT rp.id_part, ar.area,rp.part_name from register_part rp left join area ar on rp.id_area=ar.id ");                                    

    foreach($datarelasi AS $data){
        $id = $data['id_part'];
        $area = $data['area'];
        $part_name = $data['part_name'];

        $a[$row][0]= $area;
        $a[$row][1]= $part_name;
        $a[$row][2]="<a href='register_part.php?id=$id'>
        <button type='button' class='btn btn-icon btn-danger btn-circle btn-sm'> 
        <i class='fa fa-trash' aria-hidden='true'></i>
        </button>
        </a>
        <button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit'
        data-toggle='modal' 
        data-id='$id' data-area1='$area' data-part='$part_name' 
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

                    
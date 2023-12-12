<?php
include('../conn/konneksi.php');
session_start();
$a = array();
$row = 0;

    $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='MAIN BODY LH'");                                   

    foreach($tabel AS $data){
        $pic = $data['pic'];
        $foreman = $data['foreman'];    
        $area = $data['area'];  ;

        $a[$row][0]= '<b class="result" data-toggle="modal" data-pic='.$pic.' data-frm='. $foreman.' 
        data-area="'.$area.'" data-target="#exampleModal">'.$pic.'</b>';;
        $a[$row][1]= $foreman;
        $a[$row][2]= $area;       

    $row++;

    } 
    
    $data = array(
                    'data' => $a
    );
    echo json_encode($data);
?> 

<?php
include('../conn/konneksi.php');
session_start();
$a = array();
$row = 0;

    $id_area = $_SESSION["id_area"];
    
    if($_SESSION["id_area"]==1){
        $tabel =  mysqli_query ($cnts,"SELECT tc.id, me.No_urut, me.Part_No, me.Date, me.Point_No, me.TH, me.Dia, me.Weld_T,
        me.Depth, me.Weld_type, me.Result, tc.status_after from matrix_eye me 
        left join tagane_check tc on me.No_urut=tc.no_urut left join register_part rp on me.Part_No=rp.part_name
        WHERE (Result='NG' or Result='N.A.') AND status_after='NG' OR status_after='OK'"); 
    }else{ 
        $tabel =  mysqli_query ($cnts,"SELECT tc.id, me.No_urut, me.Part_No, me.Date, me.Point_No, me.TH, me.Dia, me.Weld_T,
        me.Depth, me.Weld_type, me.Result, tc.status_after from matrix_eye me 
        left join tagane_check tc on me.No_urut=tc.no_urut left join register_part rp on me.Part_No=rp.part_name
        WHERE rp.id_area=$id_area and (Result='NG' or Result='N.A.') AND (status_after='NG' OR status_after='OK')");   
    }  
    


    foreach($tabel AS $data){
    $id = $data['id'];
    $No = $data['No_urut'];
    $Part_No = $data['Part_No'];
    $Date = $data['Date'];
    $Point_No = $data['Point_No'];  
    $TH = $data['TH'];
    $Dia = $data['Dia'];
    $Weld_T = $data['Weld_T'];
    $Depth = $data['Depth'];
    $Weld_type = $data['Weld_type'];
    $Result = $data['Result'];  
    $status_after = $data['status_after'];
        
        $a[$row][0]=$id;
        $a[$row][1]=$No;
        $a[$row][2]=$Part_No;
        $a[$row][3]= $Date;
        $a[$row][4]= $Point_No;
        $a[$row][5]=$TH;
        $a[$row][6]=$Dia;
        $a[$row][7]= $Weld_T;
        $a[$row][8]= $Depth;
        $a[$row][9]= $Weld_type;
        $a[$row][10]= '<b data-toggle="modal" data-target="#exampleModal">'.$Result.'</b>';
        $a[$row][11]= $status_after;
        $a[$row][12]="<button type='button' class='btn btn-icon btn-success btn-circle btn-sm ubah'
                    data-toggle='modal' data-no_urut='$No' data-target='#exampleModal1'> 
                    <i class='fas fa-edit' aria-hidden='true'></i>
                    </button>";       

    $row++;

    } 
    
    $data = array(
                    'data' => $a
    );
    echo json_encode($data);
?> 

                    
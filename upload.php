<?php
include('conn/konneksi.php');
require "session.php";
function generateRandomString($length = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength= strlen($characters);
    $randomstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randomstring = $characters[rand(0, $charactersLength - 1)];
    }
    return $randomstring;
}
require 'vendor/autoload.php';

if(isset($_FILES['upload'])){
    
        $err="";
        $ekstensi= "";
        $succes= "";

        $file_name= $_FILES['upload']['name'];
        $file_data= $_FILES['upload']['tmp_name'];

        if(empty($file_name)){
            echo  $err= "<li>masukan file</li>"; 
        }
        else{
            $ekstensi= pathinfo($file_name)['extension'];
        }

        $ekstensi_allowed= array("xls","xlsx","csv");
        if(!in_array($ekstensi, $ekstensi_allowed)){
            echo $err= "<p class='text-center'>you must upload file xls or xlsx</p>";
        }

        if(empty($err)){
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
            $spreadsheet= $reader->load($file_data);
            $sheet_data= $spreadsheet->getActiveSheet()->toArray();

            $jumlah_data= 0;

            $id =  mysqli_fetch_array(mysqli_query ($cnts,"SELECT No_urut FROM matrix_eye ORDER BY No_urut  DESC limit 1"));
            $id1=$id['No_urut']+1;         
            
           for($i=1;$i<count($sheet_data);$i++){
                $Part_No= $sheet_data [$i]['0'];
                $Date= $sheet_data [$i]['1'];
                $jam= $sheet_data [$i]['1'];
                $Point_No= $sheet_data [$i]['2'];
                $TH= $sheet_data [$i]['3'];
                $Dia= $sheet_data [$i]['4'];
                $Weld_T= $sheet_data [$i]['5'];
                $Depth= $sheet_data [$i]['6'];
                $Weld_type= $sheet_data [$i]['7'];
                $Result= $sheet_data [$i]['8'];
                $img= $sheet_data [$i]['9'];
                
                // $file = $img;
                // $newfile = $_SERVER['192.168.43.179'] . "D:/xampp/htdocs/meas/img/img_me/$id1.jpg";
                // if ( copy($file, $newfile) ) {
                //     echo "Copy success!";
                // }else{
                //     echo "Copy failed.";
                // }

                if($Weld_type==""){
                    $Weld_type='N.A.';
                }
                $Date= date("Y-m-d",strtotime ($Date));
                $jam= date("H:i:s",strtotime ($jam));

                $sql1= "insert into matrix_eye(Part_No,Date,jam,Point_No,TH,Dia,Weld_T,Depth,Weld_type,Result)
                VALUES('$Part_No','$Date','$jam',' $Point_No','$TH',' $Dia','$Weld_T','$Depth','$Weld_type','$Result')";

                mysqli_query($cnts, $sql1);
                $jumlah_data++;
                $id1++;
            }
            if($jumlah_data > 0){
                echo $succes= "<p class='text-center'>upload file succes</p>";
            }
        }

        if($err){
            echo "$err";
        }
        if($succes){
            echo "$succes";
        }
    }
?>



                    
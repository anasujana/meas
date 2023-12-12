<?php   
include('conn/konneksi.php');
session_start();
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Part_No');
$sheet->setCellValue('B1', 'Date');
$sheet->setCellValue('C1', 'Point_No');
$sheet->setCellValue('D1', 'TH');
$sheet->setCellValue('E1', 'Dia');
$sheet->setCellValue('F1', 'Weld_T');
$sheet->setCellValue('G1', 'Depth');
$sheet->setCellValue('H1', 'Weld_type');
$sheet->setCellValue('I1', 'Result');
$sheet->setCellValue('J1', 'Tagane Check');
$sheet->setCellValue('K1', 'Pic Tagane');
$sheet->setCellValue('L1', 'Countermeasure');
$sheet->setCellValue('M1', 'Cek Repair');

if(isset($_POST['star_date']) and isset($_POST['end_date'])){
    $star_date = $_POST['star_date'];
    $end_date = $_POST['end_date'];
    $tabel = mysqli_query ($cnts,"SELECT me.No_urut, me.Part_No, me.Date, me.Point_No, me.TH, me.Dia, me.Weld_T,
    me.Depth, me.Weld_type, me.Result, me.tagane, tc.pic, tc.countermeasure tc.status_after 
    from matrix_eye me left join tagane_check tc on me.No_urut=tc.no_urut 
    where Date>='$star_date' and Date<='$end_date' ORDER BY Date, Part_No, tagane ASC ");
} 
if (!empty($star_date) and !empty($end_date)){
    $star_date = $_POST['star_date'];
    $end_date = $_POST['end_date'];
    $tabel = mysqli_query ($cnts,"SELECT me.No_urut, me.Part_No, me.Date, me.Point_No, me.TH, me.Dia, me.Weld_T,
    me.Depth, me.Weld_type, me.Result, tc.pic, tc.countermeasure, tc.status_after, me.tagane from matrix_eye me 
    left join tagane_check tc on me.No_urut=tc.no_urut  
    where Date>='$star_date' and Date<='$end_date' ORDER BY Date, Part_No, tagane ASC");
}
else{
    $tabel = mysqli_query ($cnts,"SELECT me.No_urut, me.Part_No, me.Date, me.Point_No, me.TH, me.Dia, me.Weld_T,
    me.Depth, me.Weld_type, me.Result, me.tagane, me.pic_tagane, tc.pic, tc.countermeasure, tc.status_current, tc.status_after
    from matrix_eye me left join tagane_check tc on me.No_urut=tc.no_urut ORDER BY Date, Part_No, tagane ASC");
}


$i = 2;
foreach($tabel AS $data){
    $No = $data['No_urut'];
    $tag = $data['tagane'];
    $res = $data['Result'];
    $tag = $data['tagane'];
    $current = $data['status_current'];
    $pic = $data['pic'];
    $pic_check = $data['pic_tagane'];
    
    if($res !='OK'){
        if($tag == ''){
            $hasil = $current;
            $pic =  $pic;
        }else{
            $hasil = $tag;
            $pic = $pic_check;
        }
    }else{
        $hasil = "";
    }

    // $img= "<img src='img/img_me/$No.jpg' alt='' width=200px>";
    // copy('C:/xampp/htdocs/meas/img/img_me/1.jpg', '/tmp/1.jpeg');
    
    $sheet->setCellValue('A'.$i, $data['Part_No']);
    $sheet->setCellValue('B'.$i, $data['Date']);
    $sheet->setCellValue('C'.$i, $data['Point_No']);
    $sheet->setCellValue('D'.$i, $data['TH']);
    $sheet->setCellValue('E'.$i, $data['Dia']);
    $sheet->setCellValue('F'.$i, $data['Weld_T']);
    $sheet->setCellValue('G'.$i, $data['Depth']);
    $sheet->setCellValue('H'.$i, $data['Weld_type']);
    $sheet->setCellValue('I'.$i, $data['Result']);
    // $sheet->setCellValue('J'.$i, $img);
    $sheet->setCellValue('J'.$i, $hasil);
    $sheet->setCellValue('K'.$i, $pic);
    $sheet->setCellValue('L'.$i, $data['countermeasure']);
    $sheet->setCellValue('M'.$i, $data['status_after']);
    $i++;
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' =>
            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$sheet->getStyle('A1:M'.$i)->applyFromArray($styleArray);
$sheet->getColumnDimension('B')->setWidth(12);
$sheet->getColumnDimension('A')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(12);
$sheet->getColumnDimension('J')->setWidth(14);
$sheet->getColumnDimension('K')->setWidth(10);
$sheet->getColumnDimension('L')->setWidth(40);
$sheet->getColumnDimension('M')->setWidth(10);
$sheet->getStyle('A1:M1')->getFont()->setBold(true);

$writer = new xlsx($spreadsheet);
$file_name= 'data matrix eye';
header ('Content-Type: application/vnd.ms-excel; charset=utf-8');
header ('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
header ('Cache-Control: max-age=0');
$writer->save('php://output');
// $writer->save("./templatesdata matrix eye");
// "C:/xampp/".$YourFileName
// use PhpOffice\PhpSpreadsheet\IOFactory;
// require __DIR__ . '/Header.php';

// $spreadsheet = require __DIR__ . '/templates/MyTemplate.php';

// $filename = basename($helper->getFilename("MyFilename", 'xls'));
// $writer = IOFactory::createWriter($spreadsheet, 'Xls');

// $callStartTime = microtime(true);
// $writer->save("./templates/MyFilename.xls");
// // $writer->save('C:/xampp/htdocs/tmp/' . $outputFileName);
// $helper->logWrite($writer, $filename, $callStartTime);


                                  
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
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/me.jpg" type="image/x-icon">
    
    <title>MEAS</title>

    <?php include 'element/header.php';?>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

     <!-- Sidebar -->
    <?php include 'element/sb_admin.php';?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column ">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include 'element/topbar.php';?>         
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid ">

            <?php
                 $id_area=$_SESSION["id_area"];
                if(isset($_GET['tanggal_mulai']) and isset($_GET['tanggal_akhir'])){
                    $tanggal_mulai = $_GET['tanggal_mulai'];
                    $tanggal_akhir = $_GET['tanggal_akhir'];

                    $_SESSION["star_date"] = $tanggal_mulai;
                    $_SESSION["end_date"] = $tanggal_akhir;
                }

                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1");
                $tgl=mysqli_fetch_array($tanggal);
                $tgl = $tgl['tgls'];
            
                $_SESSION["tgl_awal"] =  $tgl;
                ?>

                <!-- download excel -->
                <div class="row mt-4">
                    <div class="col">
                        <form action="export.php" method="post" class="form-inline float-right">
                            <input type="date" name="star_date" id="" class="form-control">
                            <input type="date" name="end_date" id="" class="form-control ml-3">
                            <a href="export.php" ><button type="submit" class="input-group-text bg-primary text-white ml-3">download excel</button></a>
                        </form>
                    </div>
                </div> 
                <br>     
                <!-- download excel -->
            
                <!-- card -->
                <?php
                if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                                    where (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabelok =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where (Result='OK' OR tagane='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabelng =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where (Result='NG' AND tagane!='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabel_na =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where (Result='N.A.' AND tagane!='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                                    where me.Date='$tgl'");
                    $tabelok =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where (Result='OK' OR tagane='OK') and me.Date='$tgl'");
                    $tabelng =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where (Result='NG' AND tagane!='OK') ");
                    $tabel_na =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where (Result='N.A.' AND tagane!='OK')");
                    }
                    $total = mysqli_num_rows ($tabeltotal);
                    $ok = mysqli_num_rows ($tabelok);
                    $ng = mysqli_num_rows ($tabelng);
                    $na = mysqli_num_rows ($tabel_na);
                ?>
                <!-- card -->

                <!-- Content Row -->
                <div class="row">                  
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="dc_admin.php">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Point Check</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="Total"><?php echo $total ?> Titik</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-list-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </a>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="dc_admin.php?Result=OK">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Point OK</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="Ok"><?php echo $ok ?> Unit</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>                           
                            </div> 
                        </a>               
                    </div>
                        
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="dc_admin.php?Result=NG">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Point NG</div>                                     
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="Ng"><?php echo $ng ?> Point</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-times-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>         
                        
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="dc_admin.php?Result=N.A.">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Point N.A.</div>                                      
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="Na"><?php echo $na ?> Point</div>
                                        </div>         
                                        <div class="col-auto">
                                            <i class="fa fa-times-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>                 
                            </div>
                        </a>
                    </div>              
                </div>

                <!-- upload excel -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="upload" name="file">
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                    <div class="input-group-append">
                    <input class="input-group-text bg-primary text-white" id="simpan" type="submit" name="submit" value="upload file"> 
                    </div>
                    </div>
                </form> 
            
                
                <?php
                    // // if(isset($_POST['submit'])){
                    //         $err="";
                    //         $ekstensi= "";
                    //         $succes= "";

                    //         $file_name= $_FILES['file']['name'];
                    //         $file_data= $_FILES['file']['tmp_name'];

                    //         if(empty($file_name)){
                    //             $err= "<li>masukan file</li>"; 
                    //         }
                    //         else{
                    //             $ekstensi= pathinfo($file_name)['extension'];
                    //         }

                    //         $ekstensi_allowed= array("xls","xlsx","csv");
                    //         if(!in_array($ekstensi, $ekstensi_allowed)){
                    //             $err= "<p class='text-center'>you must upload file xls or xlsx</p>";
                    //         }

                    //         if(empty($err)){
                    //             $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
                    //             $spreadsheet= $reader->load($file_data);
                    //             $sheet_data= $spreadsheet->getActiveSheet()->toArray();

                    //             $jumlah_data= 0;
                    //             for($i=1;$i<count($sheet_data);$i++){
                    //                 $Part_No= $sheet_data [$i]['0'];
                    //                 $Date= $sheet_data [$i]['1'];
                    //                 $Point_No= $sheet_data [$i]['2'];
                    //                 $TH= $sheet_data [$i]['3'];
                    //                 $Dia= $sheet_data [$i]['4'];
                    //                 $Weld_T= $sheet_data [$i]['5'];
                    //                 $Depth= $sheet_data [$i]['6'];
                    //                 $Weld_type= $sheet_data [$i]['7'];
                    //                 $Result= $sheet_data [$i]['8'];

                    //                 if($Weld_type==""){
                    //                     $Weld_type='N.A.';
                    //                 }
                    //                 $Date= date("y-m-d",strtotime ($Date));
                                    
                    //                 $sql1= "insert into matrix_eye(Part_No,Date,Point_No,TH,Dia,Weld_T,Depth,Weld_type,Result)
                    //                 VALUES('$Part_No','$Date',' $Point_No','$TH',' $Dia','$Weld_T','$Depth','$Weld_type','$Result')";

                    //                 mysqli_query($cnts, $sql1);
                    //                 $jumlah_data++;
                                    
                    //             }
                    //             if($jumlah_data > 0){
                    //                 $succes= "<p class='text-center'>upload file succes</p>";
                    //             }
                    //         }

                    //         if($err){
                    //             echo "$err";
                    //         }
                    //         if($succes){
                    //             echo "$succes";
                    //         }
                    //     }
                    ?>
                    <!-- upload excel -->
                     
               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                            <img src='' alt='' class='img' width=470px id="img">
                           </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <!-- insert tagane -->
                <?php                                  
                    if(isset($_POST['no_urut']) and isset($_POST['point_no']) and isset($_POST['pic']) and isset($_POST['nama']) and isset($_POST['status_current']) and isset($_POST['problem'])
                    and isset($_POST['countermeasure']) and isset($_POST['status_after'])){
                    $no_urut = $_POST ['no_urut'];
                    $point_no = $_POST ['point_no'];
                    $npk = $_POST ['pic'];
                    $nama = $_POST ['nama'];
                    $status = $_POST ['status_current'];
                    $problem = $_POST ['problem'];
                    $countermeasure = $_POST ['countermeasure'];
                    $status_after = $_POST ['status_after'];

                    $tambah = mysqli_query($cnts,"INSERT INTO tagane_check 
                    VALUES ('','$no_urut','$point_no','$npk','$nama','$status','$problem','$countermeasure','$status_after','',
                    '','')");
                    if($_POST['pic']>0){
                    }
                    }else{
                    }    
                ?>
                <!-- insert tagane -->

                <?php
                    if(isset($_GET ['Result'])){
                        $result  = $_GET ['Result'];
                        if($result=='NG'){
                            $colour= 'text-danger';
                            $add = '<b>POINT NG</b>';
                        }elseif($result=='N.A.'){
                            $colour= 'text-danger';
                            $add = '<b>POINT N.A.</b>';
                        }elseif($result=='OK'){
                            $colour= 'text-success';
                            $add = '<b>POINT OK</b>';
                        }
                    }else{    
                        $colour = "text-primary";
                        $add = "<b>TOTAL POINT CHECK</b>";
                    }
                    ?>                       

                <?php    
                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1");
                $tgl=mysqli_fetch_array($tanggal);
                $tgl = $tgl['tgls'];

                $_SESSION["tgl_awal"] =  $tgl;
                ?>                  

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="<?php echo $colour;?>"><b>Data Matrix Eye</b> <?php echo $add;?>
                        
                            <!-- Topbar Search -->
                            <form action="" method="get"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right">
                                <div class="input-group">
                                    <input type="date" 
                                    value="<?php 
                                    if(isset($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                                    echo $_SESSION["star_date"];
                                    }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                                    echo $_SESSION["tgl_awal"];
                                    }    
                                    ?>" 
                                    name="tanggal_mulai" id="" class="form-control">
                                    <input type="date" 
                                    value="<?php
                                    if(isset($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){ 
                                    echo $_SESSION["end_date"];
                                    }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                                        echo $_SESSION["tgl_awal"];
                                    }    
                                    ?>" 
                                    name="tanggal_akhir" id="" class="form-control ml-3">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </h6>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive ">
                            <form id="CekAll" method="post" action="">
                            <table class="table table-bordered table-sm text-center" id="data_me" width="100%"  cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No_urut</th>
                                        <th>Part_No</th>
                                        <th>Date</th>
                                        <th>Point_No</th>
                                        <th>TH</th>
                                        <th>Dia</th>
                                        <th>Weld_T</th>
                                        <th>Depth</th>
                                        <th>Weld_type</th>
                                        <th>Result</th> 
                                        <!-- <th>Image</th>                                           -->
                                    </tr>
                                </thead>                             
                            </table>
                            </form>
                        </div>
                    </div>                                
                </div>    
                <!-- Footer -->
                <?php include 'element/footer.php';?>
                <!-- End of Footer -->       
            </div>      
        </div>   
    </div>   
</div>      

</body>
<script type="text/javascript">
   
var table = $('#data_me').DataTable({
    lengthMenu: [
            [10, 50, 100, -1],
            [10, 50,100, 'All'],
        ],
        
        // custom datatable
        // dom: '<"top"l>rt<"bottom"ip><"clear">',

    "ajax":'data_me/data_me_admin.php<?php 
    if(isset($_GET ['Result'])){
        $result = $_GET ['Result'];
        echo '?Result='.$result;
        if(isset($_GET['tanggal_mulai']) and isset($_GET['tanggal_akhir'])){
            $result1 = $_GET ['tanggal_mulai'];
            $result2 = $_GET ['tanggal_akhir'];
            echo '&tanggal_mulai='.$result1;
            echo '&tanggal_akhir='.$result2;
        }else{
            $result = "";
        }
    }else{
        $result = "";
        if(isset($_GET['tanggal_mulai']) and isset($_GET['tanggal_akhir'])){
            $result1 = $_GET ['tanggal_mulai'];
            $result2 = $_GET ['tanggal_akhir'];
            echo '?tanggal_mulai='.$result1;
            echo '&tanggal_akhir='.$result2;
        }else{
            $result = "";
        }
    }
    ;
    
    ?>',
    "rowCallback": function( row, data, index){
            if (data[9] == '<b class="result" data-toggle="modal" data-target="#exampleModal">NG</b>'){
                $('td',row).css('background-color','Red');
                $('td',row).css('color','white');
        
            }else if (data[9] == '<b class="result" data-toggle="modal" data-target="#exampleModal">N.A.</b>'){
                $('td',row).css('background-color','Red');
                $('td',row).css('color','white');
            }
    }
    })

        $(document).on('click','.data',function(){
            // var id = this;
            var ids = $(this).attr('data-image');
            $('.img').attr('src', 'img/img_me/'+ids+'.jpg');
        })

        $(document).ready( function () {
		$("#simpan").click(function(a){
            a.preventDefault();

			const fileupload = $('#upload').prop('files')[0];
			//var nama_file = $('#nama_file').val();
            console.log(fileupload)
			if (fileupload !="") {
		        let formData = new FormData();
		        formData.append('upload', fileupload);
                console.log(formData)
		        $.ajax({
		            type: 'POST',
		            url: "upload.php",
		            data: formData,
		            cache: false,
		            processData: false,
		            contentType: false,
                    success: function(data) {
                        table.ajax.reload();
                        console.log(data)
                        $.ajax({
                        method: "POST",
                        url: "sumary_admin.php",
                        //data: {tagane: ""},
                        success : function(data){
                            console.log(data)
                            let obj = JSON.parse(data);
                            $('#Total').text(obj.total+" Point")
                            $('#Ok').text(obj.ok+" Point")
                            $('#Ng').text(obj.ng+" Point")
                            $('#Na').text(obj.na+" Point")
                        }
                    })
                    swal("Terimakasih","Data berhasil di upload","success");
                    }
		        });
		    }
        });
    });


</script>	
</html>
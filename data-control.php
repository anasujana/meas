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
    <?php include 'element/sidebar.php';?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include 'element/topbar.php';?>         
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <?php
                $id_area=$_SESSION["id_area"];
                $npk2 = $_SESSION["npk"];

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
                <?php
                if($_SESSION["id_area"]==1){
                ?>
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
                <?php   
                }
                ?>
                <!-- download excel -->

                <!-- card -->
                <?php
                if($_SESSION["id_area"]==1){
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
                }else{
                    if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                                    where rp.id_area='$id_area' and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabelok =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' AND
                                                                                    (Result='OK' OR tagane='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabelng =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' AND 
                                                                                    (Result='NG' AND tagane!='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabel_na =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' 
                                                                                    AND (Result='N.A.' AND tagane!='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                                    where rp.id_area='$id_area' and me.Date='$tgl'");
                    $tabelok =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' AND
                                                                                    (Result='OK' OR tagane='OK') and me.Date='$tgl'");
                    $tabelng =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' AND 
                                                                                    (Result='NG' AND tagane!='OK') ");
                    $tabel_na =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' 
                                                                                    AND (Result='N.A.' AND tagane!='OK') ");
                    }
                    $total = mysqli_num_rows ($tabeltotal);
                    $ok = mysqli_num_rows ($tabelok);
                    $ng = mysqli_num_rows ($tabelng);
                    $na = mysqli_num_rows ($tabel_na);
                }
                ?>
                <!-- card -->

                <!-- Content Row -->
                <div class="row">                  
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="data-control.php">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Point Check</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total"><?php echo $total ?> Titik</div>
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
                        <a href="data-control.php?Result=OK">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Point OK</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="ok"><?php echo $ok ?> Unit</div>
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
                        <a href="data-control.php?Result=NG">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Point NG</div>                                     
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="ng"><?php echo $ng ?> Point</div>
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
                        <a href="data-control.php?Result=N.A.">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Point N.A.</div>                                      
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="na"><?php echo $na ?> Point</div>
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

                 <?php 
                // upload excel
                if($_SESSION["id_area"]==1){
                ?>  
    
                <form action="" method="post" enctype="multipart/form-data" ><iframe name="hidden-iframe" style="display: none;"></iframe>
                    <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="upload" name="file">
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                    <div class="input-group-append">
                    <input class="input-group-text bg-primary text-white" id="simpan"  type="submit" name="submit" value="upload file"> 
                    </div>
                    </div>
                </form> 
        
                <?php
                }
                ?>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tagane Check</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="data-control.php" method="post">
                            <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputpictagane">No Urut</label>
                                        <input type="number" name="no_urut" class="form-control"  id="no_urut"  >
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="Nama">Point No</label>
                                        <input type="text" name="point_no"  class="form-control" id="point_no" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputpictagane">Pic Tagane</label>
                                        <input type="number" name="pic" class="form-control"  id="inputpictagane" value="<?php echo $_SESSION["npk"];?>" >
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="Nama">Nama</label>
                                        <input type="text" name="nama"  class="form-control" id="" placeholder="" value="<?php echo $_SESSION["nama"];?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputAddress">status</label>
                                         <input type="text" name="status_current" class="form-control"  id="status" value="">
                                    </div>                                 
                                
                                    <div class="form-group col-md-10">
                                        <label for="inputCity">Problem</label>
                                        <input type="text" name="problem" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="inputState">Countermeasure</label>
                                        <input type="text" name="countermeasure" class="form-control" id="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select name="status_after" class="form-control" id="">
                                        <option>OK</option>
                                        <option>NG</option>
                                        </select>                   
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </form>
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
                    // $r = (isset($_GET ['Result']))?$_GET ['Result']:"";
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
                            <form action="" method="GET"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right">
                                <!-- <input type="text" value="<?=$r?>" name="Result"> -->
                                <div class="input-group">
                                    <input type="date" name="tanggal_mulai" 
                                    value="<?php 
                                    if(isset($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                                    echo $_SESSION["star_date"];
                                    }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                                    echo $_SESSION["tgl_awal"];
                                    }    
                                    ?>" 
                                    id="" class="form-control ml-3">
                                    <input type="date" name="tanggal_akhir" 
                                    value="<?php
                                    if(isset($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){ 
                                    echo $_SESSION["end_date"];
                                    }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                                        echo $_SESSION["tgl_awal"];
                                    }    
                                    ?>" 
                                    id="" class="form-control ml-3">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                       
                                    </div>
                                </div>
                            </form>
                        </h6>
                    </div>

                    <!-- Modal -->
               <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                            <img src='' alt='' class='img' width=470px id="image">
                           </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                   
                    <div class="card-body">
                        <div class="table-responsive ">
                        <form id="CekAll" method="POST" action="">
                            <table class="table table-bordered table-sm  text-center" id="data_me" width="100%" cellspacing="0">
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
                                        <!-- <th>Image</th>                                             -->
                                        <?php
                                        if($_SESSION["id_area"]!=1){
                                            if(isset($_GET ['Result'])){
                                                if($_GET ['Result']=="NG" or $_GET ['Result']=="N.A."){
                                                echo '<th><a onclick="checkedAll(&quot;CekAll&quot;);">Tagane</a></th>';
                                                }
                                            }
                                        } 
                                        ?>
                                    </tr>
                                    <input type="button" class="input-group-text bg-primary text-white ml-6 float-right" id="konfirmasi" value="konfirmasi">
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

<!-- Modal -->
<div class=" add_npk modal fade" id="npk" tabindex="5" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Konfirmasi Npk Pic Tagane !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="data-control.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="hidden" name="no_urut" class="form-control"  id="no_urut1" value="" >
                            <br>
                            <input type="number" name="npk" class="form-control "  id="npk1" value="" placeholder="masukan npk pic tagane disini" autofocus>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">                                
                <input type="submit" id="konfir" class="btn btn-primary float-right" value="Konfirmasi">
            </div>
        </div>
    </div>
</div>
<div class="info-notif"></div>
<!-- modal -->

</body>

<script type="text/javascript">
    
var checked=false;
var checkbox='';
function checkedAll(checkbox)
{
var inputVal= document.getElementById(checkbox);
 if (checked==false){
 checked=true;
 }else{
 checked = false;
 }
 for (var i =0; i < inputVal.elements.length; i++){
 inputVal.elements[i].checked=checked;
 }
}

//akses data json
var table = $('#data_me').DataTable({
    lengthMenu: [
            [10, 25, 50,100, -1],
            [10, 25, 50,100, 'All'],
        ],
    "ajax":'data_me/data_me.php<?php 
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

//konfirmasi npk
$('#konfir').on('click', function(a){
    a.preventDefault();
    var no_urut= $('#no_urut1').val()
    var npk= $('#npk1').val()
    var form = $('#CekAll').serialize()
    // console.log(form)
    if(npk == ''){
        swal("Maaf","Npk belum di isi..","error");
    }else{
        var id = 'update';
        console.log(form);
        $.ajax({
            method: "POST",
            url: "data_me/save_ng.php?npk="+npk+"&no_urut="+no_urut+"&id="+id,
            data: form,
            success : function(sukses){
                $('.info-notif').html(sukses)
                table.ajax.reload();
                $.ajax({
                    method: "POST",
                    url: "sumary.php",
                    success : function(data){   
                        console.log(data)
                        let obj = JSON.parse(data);
                        $('#total').text(obj.total+" Point")
                        $('#ok').text(obj.ok+" Point")
                        $('#ng').text(obj.ng+" Point")
                        $('#na').text(obj.na+" Point")
                        table.ajax.reload();                                                  
                    }
                })  
            $('#npk').modal('hide');
            }
        })
    }  
})

//masukan value checkbox  
const btn = document.querySelector('#konfirmasi');
btn.addEventListener('click', (event) => {
    let checkboxes = document.querySelectorAll('input[name="data_ng[]"]:checked');
    let values = [];
    checkboxes.forEach((checkbox) => {
        values.push(checkbox.value);
    });
    console.log(values)
   
    swal({
        title:"Apakah Hasil Tagane OK ?",
        text: "Klik ya jika setelah dilakukan tagane manual haslinya OK",
        icon:"warning",
        buttons: ["Tidak", "Ya"],
        dangerMode:true,})
        
    .then((konfirmasi)=>{
        if (konfirmasi){
        //tampilkan modal konfirmasi npk      
        $('#npk').modal('show');               
        }else{
            swal("Maaf","Data belum di konfirmasi","error")
        } 
    });   
});

//set data pada modal
 $('#data_me').on('click','.result',function(){
    var id = this;
    var ids = $(this).data('no');
    $('#no_urut').val(ids);
})

$('#data_me').on('click','.result',function(){
    var id = this;
    var ids = $(this).data('point');
    $('#point_no').val(ids);
})

$('#data_me').on('click','.result',function(){
    var id = this;
    var ids = $(this).data('status');
    $('#status').val(ids);
})

$(document).on('click','.data',function(){
            // var id = this;
            var ids = $(this).attr('data-img');
            $('.img').attr('src', 'img/img_me/'+ids+'.jpg');
        })

//ajax upload file
$(document).ready( function () {
	$("#simpan").click(function(a){
        a.preventDefault();

		const fileupload = $('#upload').prop('files')[0];
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
                        url: "sumary.php",
                        success : function(data){
                            console.log(data)
                            let obj = JSON.parse(data);
                            $('#total').text(obj.total+" Point")
                            $('#ok').text(obj.ok+" Point")
                            $('#ng').text(obj.ng+" Point")
                            $('#na').text(obj.na+" Point")
                            table.ajax.reload();                           
                        }
                    })
                    swal("Terimakasih","Data berhasil di upload","success");
                }
		    });
		}
    });
});

//auto focus input
$(document).ready(function() {
    $('#npk').on('shown.bs.modal', function(){
        $('#npk1').trigger('focus');
    });
});

</script>	
</html>
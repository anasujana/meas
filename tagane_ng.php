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

    <title>MEAS</title>

    <?php include 'element/header.php';?>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    
     <!-- Sidebar -->
     <?php 
    if($_SESSION["role_user"]=='admin'){
    include 'element/sb_admin.php';
    }else{
    include 'element/sidebar.php';  
    }
    ?>
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
            $role_user=$_SESSION["role_user"];
            ?>

                <?php
                if(isset($_GET ['Result'])){
                        $result  = $_GET ['Result'];
                        $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name where Result='$result'");  

                    }else{
                        $result = "";
                        $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name");
                    }
                ?>

                
                <?php
                    if(isset($_POST['submit'])){
                            $err="";
                            $ekstensi= "";
                            $succes= "";

                            $file_name= $_FILES['file']['name'];
                            $file_data= $_FILES['file']['tmp_name'];

                            if(empty($file_name)){
                                $err= "<li>masukan file</li>"; 
                            }
                            else{
                                $ekstensi= pathinfo($file_name)['extension'];
                            }

                            $ekstensi_allowed= array("xls","xlsx");
                            if(!in_array($ekstensi, $ekstensi_allowed)){
                                $err= "<p class='text-center'>you must upload file xls or xlsx</p>";
                            }

                            if(empty($err)){
                                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
                                $spreadsheet= $reader->load($file_data);
                                $sheet_data= $spreadsheet->getActiveSheet()->toArray();

                                $jumlah_data= 0;
                                for($i=1;$i<count($sheet_data);$i++){
                                    $Part_No= $sheet_data [$i]['0'];
                                    $Date= $sheet_data [$i]['1'];
                                    $Point_No= $sheet_data [$i]['2'];
                                    $TH= $sheet_data [$i]['3'];
                                    $Dia= $sheet_data [$i]['4'];
                                    $Weld_T= $sheet_data [$i]['5'];
                                    $Depth= $sheet_data [$i]['6'];
                                    $Weld_type= $sheet_data [$i]['7'];
                                    $Result= $sheet_data [$i]['8'];

                                    if($Weld_type==""){
                                        $Weld_type='N.A.';
                                    }
                                    $Date= date("y-m-d",strtotime ($Date));
                                    
                                    $sql1= "insert into matrix_eye(Part_No,Date,Point_No,TH,Dia,Weld_T,Depth,Weld_type,Result)
                                    VALUES('$Part_No','$Date',' $Point_No','$TH',' $Dia','$Weld_T','$Depth','$Weld_type','$Result')";

                                    mysqli_query($cnts, $sql1);
                                    $jumlah_data++;
                                    
                                }
                                if($jumlah_data > 0){
                                    $succes= "<p class='text-center'>upload file succes</p>";
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
                                         <input type="text" name="status_current" class="form-control"  id="" value="NG">
                                    </div>                                 
                                
                                    <div class="form-group col-md-10">
                                        <label for="inputCity">Problem</label>
                                        <input type="text" name="problem" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="inputState">Countermeasure</label>
                                        <input type="text" name="countermeasure" class="form-control" id="">
                                    </div>
                                    <div class="form-group col-md-2">
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

                <?php                                  
                    if(isset($_POST['pic']) and isset($_POST['nama']) and isset($_POST['status_current']) and isset($_POST['problem'])
                    and isset($_POST['countermeasure']) and isset($_POST['status_after'])){
                    $npk = $_POST ['pic'];
                    $nama = $_POST ['nama'];
                    $status = $_POST ['status_current'];
                    $problem = $_POST ['problem'];
                    $countermeasure = $_POST ['countermeasure'];
                    $status_after = $_POST ['status_after'];

                    $tambah = mysqli_query($cnts,"INSERT INTO tagane_check 
                    VALUES ('','$npk','$nama','$status','$problem','$countermeasure','$status_after')");
                    if($_POST['pic']>0){
                    }
                    }else{
                    }    
                ?>

                <?php 
               if($_SESSION["id_area"]==1){
                    if(isset($_GET ['Result'])){
                        $result  = $_GET ['Result'];
                        $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name where Result='$result'");  

                    }else{
                        $result = "";
                        $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name");
                    }
                }else{ 
                    if(isset($_GET ['Result'])){
                        $result  = $_GET ['Result'];
                        $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name where Result='$result' AND rp.id_area='$id_area'");  

                    }else{
                        $result = "";
                        $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name WHERE rp.id_area='$id_area'");
                    }
                }
                ?>

                    <?php
                        if($result=='NG'){
                            $colour= 'text-danger';
                            $add = 'point NG';
                        }elseif($result=='ok'){
                            $colour= 'text-success';
                            $add = 'point OK';
                        }else{
                            $colour = "text-primary";
                            $add = "total poin check";
                        }
                    ?>              
                
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-danger"><strong>Data Tagane NG</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                        <form id="CekAll" method="post" action="">
                            <table class="table table-bordered table-sm  text-center" id="data_ng" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>id</th>
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
                                        <th>Repair</th>
                                        <?php
                                         if($_SESSION["id_area"]==1){
                                            echo '<th>Action</th>';
                                        }
                                        ?>                                              
                                    </tr>
                                </thead>
                                
                            </table>
                           
                            </form>
                        </div>
                    </div>                                
                </div>                      
            </div>      
        </div>  
         <!-- Footer -->
         <?php include 'element/footer.php';?>
        <!-- End of Footer --> 
    </div>   
</div>     
              
                <!-- Modal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Judgemnet from quality team</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="update_tagane_ng.php" method="POST">   
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                         <label for="validationServer02">No urut</label>
                                            <input type="number" name="no_urut" class="form-control " id="no_urut" placeholder="" value="" readonly >   
                                        </div>
                                        <div class="col-md-12 mb-3">
                                         <label for="validationServer02">Npk</label>
                                            <input type="number" name="npk" class="form-control " id="validationServer01" placeholder="" value="<?php echo $_SESSION["npk"];?>" >   
                                        </div>
                                        <div class="col-md-12 mb-3">
                                           <label for="validationServer02">Judgement</label>
                                            <select name="judgement" id="" class="form-control ">
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>
                                            </select>  
                                        </div>
                                        <div class="col-md-12 mb-3">
                                           <label for="validationServer02">Kategori</label>
                                           <input type="text" name="kategori" id="" class="form-control " value="QUALITY UP" placeholder="QUALITY UP">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer02">Keterangan</label>
                                            <input type="text" name="detail" class="form-control " id="validationServer01" placeholder="" value="" required>   
                                        </div>
                                    <div class="modal-footer">
                                        <input type="reset" class="btn btn-secondary" value="reset">
                                        <input type="submit" class="btn btn-primary" value="save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                    
                <!-- modal -->

                 <!-- Modal -->
                 <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Judgemnet from quality team</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">   
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                         <label for="validationServer02">No urut</label>
                                            <input type="number" name="no_urut" class="form-control " id="no_urut" placeholder="" value="" readonly >   
                                        </div>
                                        <div class="col-md-12 mb-3">
                                         <label for="validationServer02">Npk</label>
                                            <input type="number" name="npk" class="form-control " id="validationServer01" placeholder="" value="<?php echo $_SESSION["npk"];?>" >   
                                        </div>
                                        <div class="col-md-12 mb-3">
                                           <label for="validationServer02">Judgement</label>
                                            <select name="judgement" id="" class="form-control ">
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>
                                            </select>  
                                        </div>
                                        <div class="col-md-12 mb-3">
                                           <label for="validationServer02">Kategori</label>
                                            <select name="kategori" id="" class="form-control ">
                                                <option value="scrapt">SCRAPT</option>
                                                <option value="repair">REPAIR</option>
                                                <option value="other">OTHER</option>
                                            </select>  
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer02">Keterangan</label>
                                            <input type="text" name="detail" class="form-control " id="validationServer01" placeholder="" value="" required>   
                                        </div>
                                    <div class="modal-footer">
                                        <input type="reset" class="btn btn-secondary" value="reset">
                                        <input type="submit" class="btn btn-primary" value="save">
                                    </div>
                                </form>
                            </div>
                              
                        </div>
                           
                    </div>
                  
                </div>                    
                <!-- modal -->         

</body>
 
<script type="text/javascript">
var checked=false;
var checkbox='';
function checkedAll(checkbox)
{
 var inputVal= document.getElementById(checkbox);
 if (checked==false)
 {
 checked=true;
 }
 else
 {
 checked = false;
 }
 for (var i =0; i < inputVal.elements.length; i++)
 {
 inputVal.elements[i].checked=checked;
 }
}

var table = $('#data_ng').DataTable({
    "ajax":'data_me/data_me_ng.php?',
    "rowCallback": function( row, data, index){
            if (data[11] == 'NG'){
                $('td',row).css('background-color', 'Red');
                $('td',row).css('color', 'white');
        
            }
    }
    })

        $('#data_ng').on('click','.ubah',function(){
            var id = this;
            var id1 = $(this).data('no_urut');
            
            $('#no_urut').val(id1);
        })

</script>	

</html>
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
                      $id_area = $_SESSION["id_area"];
    
                      if($_SESSION["id_area"]==1){
                        $tabel =  mysqli_query ($cnts,"SELECT tc.id,me.No_urut, me.Part_No, me.Date, me.Point_No, me.TH,
                        me.Dia, me.Weld_T, me.Depth, me.Weld_type, me.Result, tc.judgement, tc.kategori, tc.detail from matrix_eye me 
                        left join tagane_check tc on me.No_urut=tc.no_urut left join register_part rp on me.Part_No=rp.part_name
                        WHERE judgement='OK' OR judgement='NG'");
                    }else{ 
                        $tabel =  mysqli_query ($cnts,"SELECT  tc.id, me.No_urut, me.Part_No, me.Date, me.Point_No, me.TH,
                        me.Dia, me.Weld_T, me.Depth, me.Weld_type, me.Result, tc.judgement, tc.detail, tc.kategori from matrix_eye me 
                        left join tagane_check tc on me.No_urut=tc.no_urut left join register_part rp on me.Part_No=rp.part_name
                        WHERE  rp.id_area=$id_area AND judgement='OK' OR judgement='NG'");   
                    }        
                ?> 
               
    
   
                
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-danger"><b>History Of Tagane NG</b></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                        <form id="CekAll" method="post" action="">
                            <table class="table table-bordered table-sm  text-center background-color danger" id="dataTable" width="100%" cellspacing="0">
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
                                        <th>Judgement</th>
                                        <th>Kategori</th>
                                        <th>Detail</th>                                            
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                foreach($tabel AS $data){
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
                                    $judgement = $data['judgement'];
                                    $kategori = $data['kategori'];
                                    $detail = $data['detail'];                                   
                                    

                                    if($judgement=='NG'){
                                        $color= 'bg-danger text-white';
                                        }else{
                                        $color= 'bg-white';
                                        }                                       
                                ?>       

                                <tr class="<?php echo $color; ?>">
                                    <td><?php echo $No; ?></td>
                                    <td><?php echo $Part_No; ?></td>
                                    <td><?php echo $Date; ?></td>
                                    <td><?php echo $Point_No; ?></td>
                                    <td><?php echo $TH; ?></td>
                                    <td><?php echo $Dia; ?></td>
                                    <td><?php echo $Weld_T; ?></td>
                                    <td><?php echo $Depth; ?></td>
                                    <td><?php echo $Weld_type; ?></td>
                                    <td><?php echo $Result; ?></td>
                                    <td><?php echo $judgement; ?></td>
                                    <td><?php echo $kategori; ?></td>
                                    <td><?php echo $detail; ?></td>
                                    
                            
                                                               
                                </tr>
                                <?php
                                }
                                ?>                      
                                </tbody>
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
 
</body>     	
</html>
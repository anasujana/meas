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
    <?php include 'element/sb_admin.php';?>
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

            <!-- card -->
                <?php
                    if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"]) and isset ($_SESSION["tahun"])){
                        $sm =  mysqli_query($cnts,"SELECT * FROM matrix_eye where (MONTH(Date) >= '$_SESSION[star_date]' and MONTH(Date) <= '$_SESSION[end_date]')  AND year(Date)= '$_SESSION[tahun]' and (Part_No='Matrieye SM Rh' or Part_No='Matrixeye SM Lh') group by Date");
                        $mb_rh = mysqli_query($cnts,"SELECT * FROM matrix_eye where (MONTH(Date) >= '$_SESSION[star_date]' and MONTH(Date) <= '$_SESSION[end_date]')  AND year(Date)= '$_SESSION[tahun]' and Part_No='Matrixeye MB RH' group by Date");
                        $mb_lh = mysqli_query($cnts,"SELECT * FROM matrix_eye where (MONTH(Date) >= '$_SESSION[star_date]' and MONTH(Date) <= '$_SESSION[end_date]')  AND year(Date)= '$_SESSION[tahun]' and Part_No='Matrixeye MB LH' group by Date");
                        $ub = mysqli_query($cnts,"SELECT * FROM matrix_eye where (MONTH(Date) >= '$_SESSION[star_date]' and MONTH(Date) <= '$_SESSION[end_date]') AND year(Date)= '$_SESSION[tahun]' and (Part_No='Matrixeye UB #20 Rev1') group by Date");
                    }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                        
                        $transdate = date('m', time());
                        
                        $sm = mysqli_query($cnts,"SELECT * FROM matrix_eye where (Part_No='Matrieye SM Rh' or Part_No='Matrixeye SM Lh') and MONTH(Date)='$transdate' group by Date");
                        $mb_rh = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye MB RH' and MONTH(Date)='$transdate' group by Date");
                        $mb_lh = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye MB LH' and MONTH(Date)='$transdate' group by Date");
                        $ub = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye UB #20 Rev1' and MONTH(Date)='$transdate' group by Date");
                    }
                    $total_sm = mysqli_num_rows ($sm);
                    $total_mb_rh = mysqli_num_rows ($mb_rh);
                    $total_mb_lh = mysqli_num_rows ($mb_lh);
                    $total_ub = mysqli_num_rows ($ub);
                ?>
                <!-- card -->
                
                 <!-- Content Row -->
                 <div class="row">                  
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-danger text-uppercase mb-1">SIDE MEMBER D26 A</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total"><?php echo $total_sm ?> FIle</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-file fa-2x text-gray-300" data-toggle="modal" data-target="#npk"></i>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-success text-uppercase mb-1">MAIN BODY RH </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="ok"><?php echo $total_mb_rh ?> File</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>                           
                            </div> 
                                       
                    </div>
                        
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                       
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-info text-uppercase mb-1">MAIN BODY LH</div>                                     
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="ng"><?php echo $total_mb_lh ?> File</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                    </div>         
                        
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-warning text-uppercase mb-1">UNDER BODY MIX</div>                                      
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="na"><?php echo $total_ub ?> File</div>
                                        </div>         
                                        <div class="col-auto">
                                            <i class="fa fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>                 
                            </div>
                       
                    </div>              
                </div>

                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h6 class="<?php echo $colour;?>"><b>List data upload to MEAS</b> <?php ?>
                            <!-- Topbar Search -->
                            <!-- <form>
                            <div class="form-row align-items-center">
                                <div class="col-sm-3 my-1">
                                <label class="sr-only" for="inlineFormInputName">Name</label>
                                <input type="text" class="form-control" id="inlineFormInputName" placeholder="Jane Doe">
                                </div>
                                <div class="col-sm-3 my-1">
                                <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">to</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
                                </div>
                                </div>
                                <div class="col-sm-3 my-1">
                                <label class="sr-only" for="inlineFormInputName">Name</label>
                                <input type="text" class="form-control" id="inlineFormInputName" placeholder="Jane Doe">
                                </div>
                                <div class="col-auto my-1">
                                <button type="submit" class="btn btn-primary">Go</button>
                                </div>
                            </div>
                            </form> -->
                            <form action="monitoring_upload.php" method="POST"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right">
                                <!-- <input type="text" value="<?=$r?>" name="Result"> -->
                                <div class="input-group">
                                    <select name="star_bulan" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-dark">To</div>
                                        </div>
                                        <select name="end_bulan" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <select name='tahun' class="custom-select mr-sm-2" id="inlineFormCustomSelect">";
                                        <?php
                                        $mulai= date('Y') - 50;
                                        for($i = $mulai;$i<$mulai + 100;$i++){
                                            $sel = $i == date('Y') ? ' selected="selected"' : '';
                                            echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>

                                    <button type="submit" class="btn btn-primary mb-2">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </form>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3 col-sm-3">
                                <table class="table table-bordered table-sm table-striped text-center" id="" width="20%" cellspacing="0">
                                    <thead class="bg-danger text-white">
                                        <tr>
                                            <th>SM D26A</th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $transdate = date('m', time());

                                        if(isset($_POST['star_bulan']) and isset( $_POST['end_bulan']) and isset($_POST['tahun'])){
                                            $star_bulan = $_POST['star_bulan'];
                                            $end_bulan = $_POST['end_bulan'];
                                            $tahun = $_POST['tahun'];

                                            $_SESSION["star_date"] = $star_bulan;
                                            $_SESSION["end_date"] = $end_bulan;
                                            $_SESSION["tahun"] = $tahun;

                                        }else if(!isset($_POST['star_bulan']) and !isset( $_POST['end_bulan']) and !isset($_POST['tahun'])){
                                            $transdate = date('m', time());
                                        }

                                        if(isset($star_bulan) and isset($end_bulan) and isset($tahun)){
                                            $monitoring = mysqli_query($cnts,"SELECT * FROM matrix_eye where (MONTH(Date) >= '$star_bulan' and MONTH(Date) <= '$end_bulan')  AND year(Date)= '$tahun' and (Part_No='Matrieye SM Rh' or Part_No='Matrixeye SM Lh') group by Date");
                                        }else{
                                            $monitoring = mysqli_query($cnts,"SELECT * FROM matrix_eye where (Part_No='Matrieye SM Rh' or Part_No='Matrixeye SM Lh') and MONTH(Date)='$transdate' group by Date");
                                        }

                                       
                                        foreach($monitoring AS $data){
                                        $tgl = $data['Date'];
                                    ?>
                                        <tr>
                                            <td><?php echo  $tgl; ?></td> 
                                        </tr>
                                    <?php
                                    }
                                    ?>                             
                                </table>
                            </div>
                            <div class="col-sm-3 col-sm-3">
                                <table class="table table-sm table-striped text-center" id="data_me" width="20%" cellspacing="0">
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th>MAIN BODY RH</th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $transdate = date('m', time());

                                     if(isset($_POST['star_bulan']) and isset( $_POST['end_bulan']) and isset($_POST['tahun'])){
                                        $star_bulan = $_POST['star_bulan'];
                                        $end_bulan = $_POST['end_bulan'];
                                        $tahun = $_POST['tahun'];
                                    }

                                    if(isset($star_bulan) and isset($end_bulan) and isset($tahun)){
                                        $monitoring = mysqli_query($cnts,"SELECT * FROM matrix_eye where (MONTH(Date) >= '$star_bulan' and MONTH(Date) <= '$end_bulan')  AND year(Date)= '$tahun' and Part_No='Matrixeye MB RH' group by Date");
                                    }else{
                                        $monitoring = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye MB RH' and MONTH(Date)='$transdate' group by Date");
                                    }

                                    foreach($monitoring AS $data){
                                    $tgl = $data['Date'];
                                    ?>
                                    <tr>
                                        <td><?php echo  $tgl; ?></td> 
                                    </tr>
                                    <?php
                                    }
                                    ?>                             
                                </table>
                            </div>
                            <div class="col-sm-3 col-sm-3">
                                <table class="table table-sm table-striped text-center" id="data_me" width="20%" cellspacing="0">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>MAIN BODY LH</th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $transdate = date('m', time());

                                    if(isset($_POST['star_bulan']) and isset( $_POST['end_bulan']) and isset($_POST['tahun'])){
                                        $star_bulan = $_POST['star_bulan'];
                                        $end_bulan = $_POST['end_bulan'];
                                        $tahun = $_POST['tahun'];
                                    }

                                    if(isset($star_bulan) and isset($end_bulan) and isset($tahun)){
                                        $monitoring = mysqli_query($cnts,"SELECT * FROM matrix_eye where (MONTH(Date) >= '$star_bulan' and MONTH(Date) <= '$end_bulan')  AND year(Date)= '$tahun' and Part_No='Matrixeye MB LH' group by Date");
                                    }else{
                                        $monitoring = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye MB LH' and MONTH(Date)='$transdate' group by Date");
                                    }
                                    
                                    foreach($monitoring AS $data){
                                    $tgl = $data['Date'];
                                    $tgl= date("Y-m-d",strtotime ($tgl));
                                    ?>
                                    <tr>
                                        <td><?php echo  $tgl; ?></td> 
                                    </tr>
                                    <?php
                                    }
                                    ?>                             
                                </table>
                            </div>
                            <div class="col-sm-3 col-sm-3">
                                <table class="table table-sm table-striped text-center" id="data_me" width="20%" cellspacing="0">
                                    <thead class="bg-warning text-white">
                                        <tr>
                                            <th>UNDER BODY MIX</th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $transdate = date('m', time());

                                    if(isset($_POST['star_bulan']) and isset( $_POST['end_bulan']) and isset($_POST['tahun'])){
                                            $star_bulan = $_POST['star_bulan'];
                                            $end_bulan = $_POST['end_bulan'];
                                            $tahun = $_POST['tahun'];
                                        }

                                        if(isset($star_bulan) and isset($end_bulan) and isset($tahun)){
                                            $monitoring = mysqli_query($cnts,"SELECT * FROM matrix_eye where (MONTH(Date) >= '$star_bulan' and MONTH(Date) <= '$end_bulan')  AND year(Date)= '$tahun' and (Part_No='Matrixeye UB #20 Rev1') group by Date");
                                        }else{
                                            $monitoring = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye UB #20 Rev1' and MONTH(Date)='$transdate' group by Date");
                                        }

                                    foreach($monitoring AS $data){
                                    $tgl = $data['Date'];
                                    ?>
                                    <tr>
                                        <td><?php echo  $tgl; ?></td> 
                                    </tr>
                                    <?php
                                    }
                                    ?>                             
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>      
        </div>   
    </div>   
</div>
<!-- Footer -->
<?php include 'element/footer.php';?>
<!-- End of Footer -->

<?php
    $sm = mysqli_query($cnts,"SELECT * FROM matrix_eye where (Part_No='Matrieye SM Rh' or Part_No='Matrixeye SM Lh')  group by Date");
    $mb_rh = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye MB RH' group by Date");
    $mb_lh = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye MB LH' group by Date");
    $ub = mysqli_query($cnts,"SELECT * FROM matrix_eye where Part_No='Matrixeye UB #20 Rev1' group by Date");
    
    $total_sm = mysqli_num_rows ($sm);
    $total_mb_rh = mysqli_num_rows ($mb_rh);
    $total_mb_lh = mysqli_num_rows ($mb_lh);
    $total_ub = mysqli_num_rows ($ub);

    $ub = mysqli_query($cnts,"SELECT Date FROM matrix_eye where Part_No='Matrixeye UB #20 Rev1' group by Date");
?>
<!-- Modal -->
<div class=" add_npk modal fade" id="npk" tabindex="5" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalCenterTitle"><strong>Cost Benefit from MEAS</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <table class="table table-bordered table-sm table-striped text-center center" id="data_me" width="20%" cellspacing="0">
                                <thead class="bg-warning text-white">
                                    <tr>     
                                        <th>AREA</th>
                                        <th>JUMLAH FILE UPLOAD</th>
                                        <th>SAVING COST</th>                        
                                    </tr>
                                </thead>
                                <tr>
                                    <td>SM D26A</td> 
                                    <td><?php echo $total_sm ?> File</td>
                                    <?php $sm = $total_sm*0.5*77340?>
                                    <?php 
                                        function rupiah($sm){
                                            $format_rupiah = "Rp " . number_format($sm,2,',','.');
                                            return $format_rupiah;
                                        }
                                        
                                    ?>
                                    <td><strong><?php echo rupiah($sm)?></strong></td>
                                </tr>
                                <tr>
                                    <td>MAIN BODY RH</td> 
                                    <td><?php echo $total_mb_rh ?> File</td>
                                    <?php $mb_rh = $total_mb_rh*0.5*77340?>
                                    <td><strong><?php echo rupiah($mb_rh)?></strong></td>
                                </tr>   
                                <tr>
                                    <td>MAIN BODY LH</td> 
                                    <td><?php echo $total_mb_lh ?> File</td>
                                    <?php $mb_lh = $total_mb_lh*0.5*77340?>
                                    <td><strong><?php echo rupiah($mb_lh)?></strong></td>
                                </tr>
                                <tr>
                                    <td>UNDER BODY MIX</td> 
                                    <td><?php echo $total_ub ?> File</td>
                                    <?php $ub = $total_ub*0.5*77340?>
                                    <td><strong><?php echo rupiah($ub)?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="bg-info text-white"><strong>TOTAL SAVING COST</strong></td> 
                                    <?php $total = $sm+$mb_rh+$mb_lh+$ub?>
                                    <td class="bg-info text-white"><strong><?php echo rupiah($total)?> </strong></td>
                                </tr>                             
                            </table>
                </div>
               
            </div>
        </div>
    </div>
    <div class="info-notif"></div>
    <!-- modal -->
</body>
<script>
$.ajax({
        method: "POST",
        url: "filter_monitor.php",
        success : function(data){   
            console.log(data)
            let obj = JSON.parse(data);
            $('#total').text(obj.total+" File")
            $('#ok').text(obj.ok+" File")
            $('#ng').text(obj.ng+" File")
            $('#na').text(obj.na+" File")
                                                             
        }
    })  
</script>
</html>
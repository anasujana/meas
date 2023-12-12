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

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="<?php echo $colour;?>"><b>Cost Benefit from MEAS</b> <?php ?>
                        </h6>
                    </div>
                    <div class="card-body col-sm-12  ">
                        <div class="table-responsive ">                     
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
                                    <?php $total = $total_sm*0.25*77340+$total_mb_rh*0.25*77340+$total_mb_lh*0.25*77340+$total_ub*0.25*77340?>
                                    <td class="bg-info text-white"><strong><?php echo rupiah($total)?> </strong></td>
                                </tr>                             
                            </table>
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
</html>
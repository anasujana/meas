<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <script type="text/javascript" src="js/chart.js"></script>

    <script src="js/chartjs-plugin-datalabels.min.js"
    integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <title>MEAS</title>
    <style>
        .chartBox{
            50px
        }
        #header_chart { font-family: Georgia; }
    </style>

    <?php include 'element/header.php';?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="d-print-none">
            <?php include 'element/sidebar.php';?>
        </div>
        <!-- Sidebar -->
        
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

                    <!-- Page Heading -->
                    

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <!-- Bar Chart1 -->
                            <div class="card shadow mb-3 ">
                                <div class="card-body">
                                    <img src="img/adm.gif" width="250px"alt="" class="float-left">
                                    <img src="img/icare.png" width="200px"alt="" class="float-right">
                                    <p id="header_chart" class=" align-middle text-center font-weight-bold " style="font-size:45px" >Daily Report Matrix Eye Check <p> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-print-none" >
                        <div class="ccol-sm-12 col-sm-12">               
                            <form action="" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right">
                                <div class="input-group">
                                    <input type="date" name="mulai_tanggal" id="" class="form-control ml-3">
                                    <input type="date" name="akhir_tanggal" id="" class="form-control ml-3">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>         
                        </div>               
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-4 col-lg-2">
                            <!-- Bar Chart MB LH -->
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                
                            <div class="chartBox">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-6">
                                        <table class="table table-bordered table-xl text-center align-middle tbl_pic"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                            <?php

                                            if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                            $tanggal_mulai = $_GET['mulai_tanggal'];
                                            $tanggal_akhir = $_GET['akhir_tanggal'];
                                            $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                                    
                                            $_SESSION["star"] = $tanggal_mulai;
                                            $_SESSION["end"] = $tanggal_akhir;
                                            }

                                            $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='MAIN BODY LH'");
                                            foreach($tabel AS $data){
                                                $id = $data['id'];
                                                $pic = $data['pic'];
                                                $foreman = $data['foreman'];    
                                                $area = $data['area'];         
                                            ?>       
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">PIC CHECK</td>
                                            <td class="align-middle pic" id="mb_lh"  data-toggle="modal" data-id='<?php echo $id; ?>' data-pic='<?php echo $pic; ?>' data-frm='<?php echo $foreman; ?>' 
                                            data-area='<?php echo $area; ?>' data-target="#exampleModal">
                                                <?php echo $pic; ?>
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">FRM</td>
                                            <td class="align-middle"><?php echo $foreman; ?></td>
                                            <?php
                                            }
                                            ?>
                                            </tr>        
                                        </table>
                                    </div>
                                    <div class="col-sm-6 col-sm-6">
                                        <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                                $tgl=mysqli_fetch_array($tanggal);
                                                $tgl = $tgl['tgls'];
                                                $_SESSION["tgl_awal"] =  $tgl;

                                                // $tanggal1 = mysqli_query($cnts,"SELECT Date as tgls1 FROM matrix_eye ORDER BY Date ASC limit 1 ");
                                                // $tgl1=mysqli_fetch_array($tanggal1);
                                                // $tgl1 = $tgl1['tgls1'];

                                                // $_SESSION["tgl_awal1"] =  $tgl1;

                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    $_SESSION["star"] = date("d-F-Y",strtotime ($_SESSION["star"]));
                                                    $_SESSION["end"] = date("d-F-Y",strtotime ($_SESSION["end"]));
                                                    echo $_SESSION["star"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            <td class="align-middle" >
                                                <?php
                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    $_SESSION["end"] = date("d-F-Y",strtotime ($_SESSION["end"]));
                                                    echo $_SESSION["end"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">AREA</td>
                                            <td class="align-middle" colspan="2"><?php echo $area; ?></td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                   
                                    </div>
                                        <canvas id="myChart1" width="50" height="50"></canvas>
                                    </div>

                                </div>
                            </div>

                            <!-- SM RH -->
                            <div class="card shadow mb-4">
                                <div class="card-body">


                                <div class="row">
                                <div class="col-sm-6 col-sm-6">
                                    <table class="table table-bordered table-xl text-center align-middle tbl_pic"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                        <?php

                                            if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                            $tanggal_mulai = $_GET['mulai_tanggal'];
                                            $tanggal_akhir = $_GET['akhir_tanggal'];
                                            $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                                    
                                            $_SESSION["star"] = $tanggal_mulai;
                                            $_SESSION["end"] = $tanggal_akhir;
                                            }

                                            $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='SIDE MEMBER'");
                                            foreach($tabel AS $data){
                                                $id = $data['id'];
                                                $pic = $data['pic'];
                                                $foreman = $data['foreman'];    
                                                $area = $data['area'];         
                                            ?>       
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">PIC CHECK</td>
                                            <td class="align-middle pic" id="mb_rh"  data-toggle="modal" data-id='<?php echo $id; ?>' data-pic='<?php echo $pic; ?>' data-frm='<?php echo $foreman; ?>' 
                                            data-area='<?php echo $area; ?>' data-target="#exampleModal">
                                                <?php echo $pic; ?>
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">FRM</td>
                                            <td class="align-middle"><?php echo $foreman; ?></td>
                                        <?php
                                        }
                                        ?>
                                            </tr>        
                                        </table>
                                    </div>
                                    <div class="col-sm-6 col-sm-6">
                                        <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                        <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                                $tgl=mysqli_fetch_array($tanggal);
                                                $tgl = $tgl['tgls'];
                                                $_SESSION["tgl_awal"] =  $tgl;

                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    $_SESSION["star"] = date("d-F-Y",strtotime ($_SESSION["star"]));
                                                    $_SESSION["end"] = date("d-F-Y",strtotime ($_SESSION["end"]));
                                                    echo $_SESSION["star"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            <td class="align-middle" >
                                                <?php
                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    echo $_SESSION["end"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">AREA</td>
                                            <td class="align-middle" colspan="2"><?php echo $area; ?></td>
                                            </tr>
                                            
                                        </table>
                                    </div> 
                                </div>
                                    <div class="chartBox">
                                    <canvas id="myChart3" width="50" height="50"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6">
                            <!-- Bar MB RH -->
                             <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-6">
                                            <table class="table table-bordered table-xl text-center align-middle tbl_pic"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                                <?php

                                                if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                                $tanggal_mulai = $_GET['mulai_tanggal'];
                                                $tanggal_akhir = $_GET['akhir_tanggal'];
                                                $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                                        
                                                $_SESSION["star"] = $tanggal_mulai;
                                                $_SESSION["end"] = $tanggal_akhir;
                                                }

                                                $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='MAIN BODY RH'");
                                                foreach($tabel AS $data){
                                                    $id = $data['id'];
                                                    $pic = $data['pic'];
                                                    $foreman = $data['foreman'];    
                                                    $area = $data['area'];         
                                                ?>       
                                                <tr  height="50%">
                                                <td class="align-middle" width="20%">PIC CHECK</td>
                                                <td class="align-middle pic"  data-toggle="modal" data-id='<?php echo $id; ?>' data-pic='<?php echo $pic; ?>' data-frm='<?php echo $foreman; ?>' 
                                                data-area='<?php echo $area; ?>' data-target="#exampleModal"><?php echo $pic; ?></td>
                                                </tr>
                                                <tr height="50%">
                                                <td class="align-middle">FRM</td>
                                                <td class="align-middle"><?php echo $foreman; ?></td>
                                                <?php
                                                }
                                                ?>
                                                </tr>        
                                            </table>
                                        </div>
                                        <div class="col-sm-6 col-sm-6">
                                            <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                                $tgl=mysqli_fetch_array($tanggal);
                                                $tgl = $tgl['tgls'];
                                                $_SESSION["tgl_awal"] =  $tgl;

                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    $_SESSION["star"] = date("d-F-Y",strtotime ($_SESSION["star"]));
                                                    $_SESSION["end"] = date("d-F-Y",strtotime ($_SESSION["end"]));
                                                    echo $_SESSION["star"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            <td class="align-middle" >
                                                <?php
                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    echo $_SESSION["end"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            </td>
                                            </tr>
                                                </tr>
                                                <tr height="50%">
                                                <td class="align-middle">AREA</td>
                                                <td class="align-middle" colspan="2"><?php echo $area; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="chartBox">
                                    <canvas id="myChart2" width="50" height="50"></canvas>
                                    </div>
                          
                                </div>
                            </div>

                            <!-- Bar gaya motor -->
                            <div class="card shadow mb-6">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-6">
                                            <table class="table table-bordered table-xl text-center align-middle tbl_pic"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                                <?php

                                                if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                                $tanggal_mulai = $_GET['mulai_tanggal'];
                                                $tanggal_akhir = $_GET['akhir_tanggal'];
                                                $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                                        
                                                $_SESSION["star"] = $tanggal_mulai;
                                                $_SESSION["end"] = $tanggal_akhir;
                                                }

                                                $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='GAYA MOTOR'");
                                                foreach($tabel AS $data){
                                                    $id = $data['id'];
                                                    $pic = $data['pic'];
                                                    $foreman = $data['foreman'];    
                                                    $area = $data['area'];         
                                                ?>       
                                                <tr  height="50%">
                                                <td class="align-middle" width="20%">PIC CHECK</td>
                                                <td class="align-middle pic"  data-toggle="modal" data-id='<?php echo $id; ?>' data-pic='<?php echo $pic; ?>' data-frm='<?php echo $foreman; ?>' 
                                                data-area='<?php echo $area; ?>' data-target="#exampleModal"><?php echo $pic; ?></td>
                                                </tr>
                                                <tr height="50%">
                                                <td class="align-middle">FRM</td>
                                                <td class="align-middle"><?php echo $foreman; ?></td>
                                                <?php
                                                }
                                                ?>
                                                </tr>        
                                            </table>
                                        </div>
                                        <div class="col-sm-6 col-sm-6">
                                            <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                                $tgl=mysqli_fetch_array($tanggal);
                                                $tgl = $tgl['tgls'];
                                                $_SESSION["tgl_awal"] =  $tgl;

                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    $_SESSION["star"] = date("d-F-Y",strtotime ($_SESSION["star"]));
                                                    $_SESSION["end"] = date("d-F-Y",strtotime ($_SESSION["end"]));
                                                    echo $_SESSION["star"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            <td class="align-middle" >
                                                <?php
                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    echo $_SESSION["end"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            </td>
                                            </tr>
                                                <tr height="50%">
                                                <td class="align-middle">AREA</td>
                                                <td class="align-middle" colspan="2"><?php echo $area; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="chartBox">
                                    <canvas id="myChart5" width="50" height="50"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-xl-2">
                            <!-- Bar Chart UB MIX -->
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-6">
                                            <table class="table table-bordered table-xl text-center align-middle tbl_pic"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                                <?php

                                                if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                                $tanggal_mulai = $_GET['mulai_tanggal'];
                                                $tanggal_akhir = $_GET['akhir_tanggal'];
                                                $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                                        
                                                $_SESSION["star"] = $tanggal_mulai;
                                                $_SESSION["end"] = $tanggal_akhir;
                                                }

                                                $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='UNDER BODY'");
                                                foreach($tabel AS $data){
                                                    $id = $data['id'];
                                                    $pic = $data['pic'];
                                                    $foreman = $data['foreman'];    
                                                    $area = $data['area'];         
                                                ?>       
                                                <tr  height="50%">
                                                <td class="align-middle" width="20%">PIC CHECK</td>
                                                <td class="align-middle pic" id="mb_rh"  data-toggle="modal" data-id='<?php echo $id; ?>' data-pic='<?php echo $pic; ?>' data-frm='<?php echo $foreman; ?>' 
                                                data-area='<?php echo $area; ?>' data-target="#exampleModal">
                                                    <?php echo $pic; ?>
                                                </td>
                                                </tr>
                                                <tr height="50%">
                                                <td class="align-middle">FRM</td>
                                                <td class="align-middle"><?php echo $foreman; ?></td>
                                                <?php
                                                }
                                                ?>
                                                </tr>        
                                            </table>
                                        </div>
                                        <div class="col-sm-6 col-sm-6">
                                            <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                                $tgl=mysqli_fetch_array($tanggal);
                                                $tgl = $tgl['tgls'];
                                                $_SESSION["tgl_awal"] =  $tgl;

                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    $_SESSION["star"] = date("d-F-Y",strtotime ($_SESSION["star"]));
                                                    $_SESSION["end"] = date("d-F-Y",strtotime ($_SESSION["end"]));
                                                    echo $_SESSION["star"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            <td class="align-middle" >
                                                <?php
                                                 if(isset($_SESSION["star"]) and isset ($_SESSION["end"])){
                                                    echo $_SESSION["end"];
                                                    }else if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                                    $tgl = date("d-F-Y",strtotime ($tgl));
                                                    echo $tgl;
                                                    }    
                                                ?>
                                            </td>
                                            </td>
                                            </tr>
                                                <tr height="50%">
                                                <td class="align-middle">AREA</td>
                                                <td class="align-middle" colspan="2"><?php echo $area; ?></td>
                                                </tr>
                                                
                                            </table>
                                        </div>                                
                                    </div>
                                    <div class="chartBox">
                                    <canvas id="myChart4" width="100" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-sm-12">
                                        <table class="table table-bordered table-lg "  style="font-size:12px" width="50" height="50" cellspacing="0">
                                                <th class="text-center">HASIL</th>
                                                <th class="text-center">KETERANGAN</th>
                                                <tr>
                                                <td class="align-middle text-center"><img src="img/good.png" height="35px"></td>
                                                <td>HASIL SPOT OK</td>
                                                </tr>
                                                <tr>
                                                <td rowspan="2" class="align-middle text-center"><img src="img/na.png" height="63px"></td></td>
                                                <td>STANDAR SPOT TIDAK TERDETEKSI DI ALAT MATRIK EYE</td>
                                                </tr>
                                                <tr>
                                                <td class="">TELAH TERKONFIRMASI OK</td>
                                                </tr>
                                                <tr>
                                                <td rowspan="2"class="align-middle text-center"><img src="img/open.png" height="63px"></td></td>
                                                <td>HASIL SPOT NG ( TIDAK DITEMUKAN HASIL SPOT)</td>
                                                </tr>
                                                <tr>
                                                <td class="">TELAH TERKONFIRMASI OK</td>
                                                </tr>
                                                <td rowspan="2" class="align-middle text-center"><img src="img/small.png" height="63px"></td></td>
                                                <td>HASIL SPOT NG ( DIAMETER NUGGET KECIL)</td>
                                                </tr>
                                                <tr>
                                                <td class="">TELAH TERKONFIRMASI OK</td>
                                                </tr>
                                                <tr>
                                                <td rowspan="2" class="align-middle text-center"><img src="img/stick.png" height="63px"></td></td>
                                                <td>HASIL SPOT NG (KETEBALAN NUGGET KECIL /TIDAK DITEMUKAN)</td>
                                                </tr>
                                                <tr>
                                                <td class="">TELAH TERKONFIRMASI OK</td>
                                                </tr>
                                                <td rowspan="2" class="align-middle text-center "><img src="img/thin.png" height="63px"></td></td>
                                                <td>HASIL SPOT NG ( KONDISI PERMUKAAN SPOT GELOMBANG)</td>
                                                </tr>
                                                <tr>
                                                <td class="">TELAH TERKONFIRMASI OK</td>
                                                </tr>
                                                <tr>
                                                <td colspan="2" class="text-center"><strong>Note : Untuk Hasil NG telah terkonfirmasi dengan menggunakan tagane palu dan pahat, jika terjadi crack point spot di repair dengan di bor dan di las CO2.</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
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

            <!-- script chart.js -->

                            <script>
                            // setup Matrixeye MB LH
                            const data1={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye ORDER BY Weld_type ASC");                                      
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                echo "'".$Jumlah."',";                                  
                                }
                                ?>     
                                'TOTAL SPOT',
                                ],
                                datasets: [{
                                label: 'Matrixeye MB LH',
                                data: [
                                <?php

                                $id_area = $_SESSION["id_area"];

                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                $tgl=mysqli_fetch_array($tanggal);
                                $tgl = $tgl['tgls'];
                            
                                $_SESSION["tgl_awal"] =  $tgl;

                                if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                    $tanggal_mulai = $_GET['mulai_tanggal'];
                                    $tanggal_akhir = $_GET['akhir_tanggal'];
                                    $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                            
                                    $_SESSION["star"] = $tanggal_mulai;
                                    $_SESSION["end"] = $tanggal_akhir;
                                }

                                if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye MB LH' AND Date='$tgl'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND my.Part_No='Matrixeye MB LH' AND my.Date='$tgl') AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }else if(isset ($_SESSION["star"]) and isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye MB LH' and Date>='$_SESSION[star]' and Date<='$_SESSION[end]'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND my.Part_No='Matrixeye MB LH' and (my.Date>='$_SESSION[star]' and my.Date<='$_SESSION[end]')) AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['total'];                                                                                                                                                
                                echo $Jumlah.',';                                  
                                }
                                echo $total;
                                ?>
                                ],
                                backgroundColor: [
                                    '#2ECC71', '#ECF0F1','#FF0000','#F1C40F', '#3498DB','#909497','#9C640C'
                                ],
                                borderColor: [
                                'rgba(0, 0, 0, 0.1)'
                                ],
                                borderWidth: 1,
                                datalabels: {
                                    anchor:'end',
                                    align:'top',
                                    offset: 2
                                }
                                }]
                            };

                            // config
                            const config1={
                                type: 'bar',
                                data: data1,
                                options: {   
                                    
                                   plugins:{
                                    // datalabels:{
                                    legend: {
                                        display: false,                      
                                    },
                                    title: {
                                    display: true,
                                    text: 'MAIN BODY LH',
                                    color: '#006400',
                                    }
                                // } 
                            }                 
                                },
                                plugins:[ChartDataLabels]
                            };

                            // render init blok
                            const myChart1= new Chart(
                                document.getElementById('myChart1'),
                                config1
                            );

                            function downloadPDF(){
                                const canvas = document.getElementById('myChart1');
                                //create image
                                const canvasImage = canvas.toDataURL('image/jpeg',1.0);
                                console.log(canvasImage)
                                //image to pdf
                                let pdf = new jsPDF('landscape');
                                pdf.setFontSize=(20);
                                pdf.addImage(canvasImage, 'JPEG', 15,15,280,150);
                                pdf.save('monthlyreport.pdf');
                            }
                                                   
                            // setup Matrixeye MB RH
                                const data2={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye ORDER BY Weld_type ASC");                                      
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                echo "'".$Jumlah."',";                                  
                                }
                                ?>     
                                'TOTAL SPOT',
                                ],
                                datasets: [{
                                label: 'Matrixeye MB RH',
                                data: [
                                <?php 

                                $id_area = $_SESSION["id_area"];

                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                $tgl=mysqli_fetch_array($tanggal);
                                $tgl = $tgl['tgls'];
                            
                                $_SESSION["tgl_awal"] =  $tgl;
                                
                                if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                    $tanggal_mulai = $_GET['mulai_tanggal'];
                                    $tanggal_akhir = $_GET['akhir_tanggal'];
                                    $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                            
                                    $_SESSION["star"] = $tanggal_mulai;
                                    $_SESSION["end"] = $tanggal_akhir;
                                }

                                if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye MB RH' AND Date='$tgl'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND my.Part_No='Matrixeye MB RH' AND my.Date='$tgl') AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }else if(isset ($_SESSION["star"]) and isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye MB RH' and Date>='$_SESSION[star]' and Date<='$_SESSION[end]'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND my.Part_No='Matrixeye MB RH' and (my.Date>='$_SESSION[star]' and my.Date<='$_SESSION[end]')) AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }                                  
                                    foreach($matrix_eye AS $data){
                                    $Jumlah =$data ['total'];                                                                                                                                                
                                    echo $Jumlah.',';                                  
                                    }
                                    echo $total;
                                    ?>
                                ],
                                backgroundColor: [
                                    '#2ECC71', '#ECF0F1','#FF0000','#F1C40F', '#3498DB','#909497','#9C640C'
                                ],
                                borderColor: [
                                'rgba(0, 0, 0, 0.1)'
                                ],
                                borderWidth: 1,
                                datalabels: {
                                    anchor:'end',
                                    align:'top',
                                    offset: 2
                                }
                                }]
                            };

                            // config
                            const config2={
                                type: 'bar',
                                data: data2,
                                options: {
                                    plugins:{
                                    legend: {
                                        display: false,                      
                                    },
                                    title: {
                                    display: true,
                                    text: 'MAIN BODY RH',
                                    color: '#0000FF',
                                    }
                                }       
                                },
                                plugins:[ChartDataLabels]
                            };

                            // render init blok
                            const myChart2= new Chart(
                                document.getElementById('myChart2'),
                                config2
                            );

                            // setup SIDE MEMBER RH
                            const data3={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye ORDER BY Weld_type ASC");                                      
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                echo "'".$Jumlah."',";                                  
                                }
                                ?>     
                                'TOTAL SPOT',
                                ],
                               datasets: [{
                                label: 'Matrieye SM Rh',
                                data: [
                                <?php
                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                $tgl=mysqli_fetch_array($tanggal);
                                $tgl = $tgl['tgls'];
                            
                                $_SESSION["tgl_awal"] =  $tgl;
                               
                                if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                    $tanggal_mulai = $_GET['mulai_tanggal'];
                                    $tanggal_akhir = $_GET['akhir_tanggal'];
                                    $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                            
                                    $_SESSION["star"] = $tanggal_mulai;
                                    $_SESSION["end"] = $tanggal_akhir;
                                }

                                if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE (Part_No='Matrieye SM Rh' or Part_No='Matrixeye SM Lh') AND Date='$tgl'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND (my.Part_No='Matrieye SM Rh' or my.Part_No='Matrixeye SM Lh') AND my.Date='$tgl') AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }else if(isset ($_SESSION["star"]) and isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE (Part_No='Matrieye SM Rh' or Part_No='Matrixeye SM Lh') and Date>='$_SESSION[star]' and Date<='$_SESSION[end]'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND (my.Part_No='Matrieye SM Rh' or my.Part_No='Matrixeye SM Lh') and (my.Date>='$_SESSION[star]' and my.Date<='$_SESSION[end]')) AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }               

                                    foreach($matrix_eye AS $data){
                                    $Jumlah =$data ['total'];                                                                                                                                                
                                    echo $Jumlah.',';                                  
                                    }
                                    echo $total;
                                    ?>
                                ],
                                backgroundColor: [
                                    '#2ECC71', '#ECF0F1','#FF0000','#F1C40F', '#3498DB','#909497','#9C640C'
                                ],
                                borderColor: [
                                'rgba(0, 0, 0, 0.1)'
                                ],
                                borderWidth: 1,
                                datalabels: {
                                    anchor:'end',
                                    align:'top',
                                    offset: 2
                                }
                                }]
                            };

                            // config
                            const config3={
                                type: 'bar',
                                data: data3,
                                options: {
                                    plugins:{
                                    legend: {
                                        display: false,                      
                                    },
                                    title: {
                                    display: true,
                                    text: 'SIDE MEMBER RH',
                                    color: '#FF8C00',
                                    }
                                }       
                                },
                                plugins:[ChartDataLabels]
                            };

                            // render init blok
                            const myChart3= new Chart(
                                document.getElementById('myChart3'),
                                config3
                            );

                            // setup Matrixeye UB #20 Rev1
                            const data4={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye ORDER BY Weld_type ASC");                                      
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                echo "'".$Jumlah."',";                                  
                                }
                                ?>     
                                'TOTAL SPOT',
                                ],
                                datasets: [{
                                label: 'Matrixeye UB #20 Rev1',
                                data: [
                                <?php

                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                $tgl=mysqli_fetch_array($tanggal);
                                $tgl = $tgl['tgls'];
                            
                                $_SESSION["tgl_awal"] =  $tgl;

                                if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                    $tanggal_mulai = $_GET['mulai_tanggal'];
                                    $tanggal_akhir = $_GET['akhir_tanggal'];
                                    $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                            
                                    $_SESSION["star"] = $tanggal_mulai;
                                    $_SESSION["end"] = $tanggal_akhir;
                                }

                                if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye UB #20 Rev1' AND Date='$tgl'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND my.Part_No='Matrixeye UB #20 Rev1' AND my.Date='$tgl') AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }else if(isset ($_SESSION["star"]) and isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye UB #20 Rev1' and Date>='$_SESSION[star]' and Date<='$_SESSION[end]'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND my.Part_No='Matrixeye UB #20 Rev1' and (my.Date>='$_SESSION[star]' and my.Date<='$_SESSION[end]')) AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }               
                                   
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['total'];                                                                                                                                                
                                echo $Jumlah.',';                                  
                                }
                                echo $total;
                                ?>
                                ],
                                backgroundColor: [
                                    '#2ECC71', '#ECF0F1','#FF0000','#F1C40F', '#3498DB ','#909497','#9C640C'
                                ],
                                borderColor: [
                                'rgba(0, 0, 0, 0.1)'
                                ],
                                borderWidth: 1,
                                datalabels: {
                                    anchor:'end',
                                    align:'top',
                                    offset: 2
                                }
                                }]
                            };

                            // config
                            const config4={
                                type: 'bar',
                                data: data4,
                                options: {
                                    plugins:{
                                    legend: {
                                        display: false,                      
                                    },
                                    title: {
                                    display: true,
                                    text: 'UNDER BODY',
                                    color: '#8B4513',
                                    }
                                }       
                                },
                                plugins:[ChartDataLabels]
                            };

                            // render init blok
                            const myChart4= new Chart(
                                document.getElementById('myChart4'),
                                config4
                            );

                            // setup
                            const data5={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye ORDER BY Weld_type ASC");                                      
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                echo "'".$Jumlah."',";                                  
                                }
                                ?>     
                                'TOTAL SPOT',
                                ],
                                datasets: [{
                                label: 'GAYA MOTOR',
                                data: [
                                <?php 

                                $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1 ");
                                $tgl=mysqli_fetch_array($tanggal);
                                $tgl = $tgl['tgls'];
                            
                                $_SESSION["tgl_awal"] =  $tgl;
                               
                               
                                if(isset($_GET['mulai_tanggal']) and isset($_GET['akhir_tanggal'])){
                                    $tanggal_mulai = $_GET['mulai_tanggal'];
                                    $tanggal_akhir = $_GET['akhir_tanggal'];
                                    $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");
                            
                                    $_SESSION["star"] = $tanggal_mulai;
                                    $_SESSION["end"] = $tanggal_akhir;
                                }

                                if(!isset($_SESSION["star"]) and !isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='' AND Date='$tgl'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND Part_No='' AND my.Date='$tgl') AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }else if(isset ($_SESSION["star"]) and isset ($_SESSION["end"])){
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='' and Date>='$_SESSION[star]' and Date<='$_SESSION[end]'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query ($cnts,"SELECT DISTINCT me.Weld_type, (SELECT COUNT('my.Weld_type') AS Jumlah 
                                    FROM matrix_eye my WHERE my.Weld_type = me.Weld_type AND Part_No='' and (my.Date>='$_SESSION[star]' and my.Date<='$_SESSION[end]')) AS total 
                                    from matrix_eye me ORDER BY me.Weld_type ASC");
                                }               
                                                                   
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['total'];                                                                                                                                                
                                echo $Jumlah.',';                                  
                                }
                                echo $total;
                                ?>
                                ],
                                backgroundColor: [
                                    '#2ECC71', '#ECF0F1','#FF0000','#F1C40F', '#3498DB','#909497','#9C640C'
                                ],
                                borderColor: [
                                'rgba(0, 0, 0, 0.1)'
                                ],
                                borderWidth: 1,
                                datalabels: {
                                    anchor:'end',
                                    align:'top',
                                    offset: 2
                                }
                                }]
                            };

                            // config
                            const config5={
                                type: 'bar',
                                data: data5,
                                options: {
                                    plugins:{
                                    legend: {
                                        display: false,                      
                                    },
                                    title: {
                                    display: true,
                                    text: 'GAYA MOTOR',
                                    color: '#FF0000',
                                    }
                                }       
                                },
                                plugins:[ChartDataLabels]
                            };

                            // render init blok
                            const myChart5= new Chart(
                                document.getElementById('myChart5'),
                                config5
                            );

                </script>

                <script>
                        $('.tbl_pic').on('click','.pic',function(){
                            var id = this;
                            var id1 = $(this).data('id');
                            
                            $('#id_pic_area').val(id1);
                        })

                        $('.tbl_pic').on('click','.pic',function(){
                            var id = this;
                            var id1 = $(this).data('pic');
                            
                            $('#pic_area').val(id1);
                        })

                        $('.tbl_pic').on('click','.pic',function(){
                            var id = this;
                            var id1 = $(this).data('frm');
                            
                            $('#frm_area').val(id1);
                        })

                        $('.tbl_pic').on('click','.pic',function(){
                            var id = this;
                            var id1 = $(this).data('area');
                            
                            $('#nama_area').val(id1);
                        })

                </script>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-warning" id="exampleModalLabel">PIC AREA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="update_pic.php" method="post">
                                <div class="form-row">        
                                        <input  type="hidden" class="form-control bg-primary text-white" name="id_pic" id="id_pic_area" placeholder="">                                   
                                    <div class="form-group col-md-12">
                                        <label for="inputpictagane">Pic Tagane</label>
                                        <input type="text" class="form-control text-center bg-primary text-white" name="pic" id="pic_area" placeholder="">
                                    </div>
                                     <div class="form-group col-md-12">
                                        <label for="Nama">FRM</label>
                                        <input type="text" class="form-control text-center bg-success text-white" name="frm" id="frm_area" placeholder="">
                                    </div>
                                     <div class="form-group col-md-12">
                                        <label for="Nama">Area</label>
                                        <input type="text" class="form-control text-center bg-danger text-white" name="area" id="nama_area" placeholder="">
                                    </div>
                               
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Save">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               <!-- Modal -->

              

</body>

</html>
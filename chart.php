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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js"
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

                    <!-- Page Heading -->
                    

                    <!-- Content Row -->

                    <div class="row">

                        <div class="col-xl-12 col-lg-10">

                                <!-- Bar Chart1 -->
                                <div class="card shadow mb-3 ">
                                    <div class="card-body">
                                   
                                        <img src="img/adm.gif" width="180px"alt="" class="float-left">
                                        <img src="img/icare.png" width="150px"alt="" class="float-right">
                                        <p id="header_chart" class=" align-middle text-center font-weight-bold " style="font-size:38px" >Daily Report Matrix Eye Check<p>
                                  
                                    </div>

                                </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-6 col-lg-2">
                            <?php
                            if($_SESSION["id_area"]==4){
                            ?>
                            <!-- Bar Chart MB LH -->
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">

                                    <table class="table table-bordered table-xl text-center align-middle"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                    <?php
                                            $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='MAIN BODY LH'");
                                            foreach($tabel AS $data){
                                                $pic = $data['pic'];
                                                $foreman = $data['foreman'];    
                                                $date = $data['date'];
                                                $area = $data['area'];         
                                            ?>       
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">PIC CHECK</td>
                                            <td class="align-middle" data-toggle="modal" data-target="#exampleModal"><?php echo $pic; ?></td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">FRM</td>
                                            <td class="align-middle" data-toggle="modal" data-target="#exampleModal"><?php echo $foreman; ?></td>
                                            <?php
                                            }
                                            ?>
                                            </tr>        
                                        </table>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                        <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tgl=date('d-F-Y');
                                                echo $tgl;
                                                ?>
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">AREA</td>
                                            <td class="align-middle"><?php echo $area; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                                    <div class="chartBox">
                                    <canvas id="myChart1" width="100" height="100"></canvas>
                                    </div>

                                </div>
                            </div>
                            <?php   
                            }
                            ?>

                            <?php
                            if($_SESSION["id_area"]==3){
                            ?>
                            <!-- Bar Chart MB RH -->
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                <div class="row">
                                    <div class="col-xl-6 col-xl-4">
                                    <table class="table table-bordered table-xl text-center align-middle"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                        <?php
                                            $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='MAIN BODY RH'");
                                            foreach($tabel AS $data){
                                                $pic = $data['pic'];
                                                $foreman = $data['foreman'];    
                                                $date = $data['date'];
                                                $area = $data['area'];         
                                            ?>       
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">PIC CHECK</td>
                                            <td class="align-middle"><?php echo $pic; ?></td>
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
                                    <div class="col-xl-6 col-lg-6">
                                        <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                        <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tgl=date('d-F-Y');
                                                echo $tgl;
                                                ?>
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">AREA</td>
                                            <td class="align-middle"><?php echo $area; ?></td>
                                            </tr>  
                                        </table>
                                    </div>
                                </div>
                                    <div class="chartBox">
                                    <canvas id="myChart2" width="100" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                            <?php   
                            }
                            ?>

                            <?php
                            if($_SESSION["id_area"]==2){
                            ?>
                            <!-- Bar Chart1 -->
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <table class="table table-bordered table-xl text-center align-middle"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                            <?php
                                            $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='SIDE MEMBER'");
                                            foreach($tabel AS $data){
                                                $pic = $data['pic'];
                                                $foreman = $data['foreman'];    
                                                $area = $data['area'];         
                                            ?>       
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">PIC CHECK</td>
                                            <td class="align-middle"><?php echo $pic; ?></td>
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
                                    <div class="col-xl-6 col-lg-6">
                                        <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                        <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                            <?php
                                                $tgl=date('d-F-Y');
                                                echo $tgl;
                                                ?>
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">AREA</td>
                                            <td class="align-middle"><?php echo $area; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                    <div class="chartBox">
                                    <canvas id="myChart3" width="100" height="100"></canvas>
                                    </div>

                                </div>
                            </div>
                            <?php   
                            }
                            ?>

                        </div>

                        <div class="col-xl-6 col-lg-6">
                        
                            <?php
                            if($_SESSION["id_area"]==5){
                            ?>
                            <!-- Bar Chart1 -->
                            <div class="card shadow mb-4">
                                <div class="card-body">


                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                    <table class="table table-bordered table-xl text-center align-middle"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                    <?php
                                            $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='UNDER BODY'");
                                            foreach($tabel AS $data){
                                                $pic = $data['pic'];
                                                $foreman = $data['foreman'];    
                                                $date = $data['date'];
                                                $area = $data['area'];         
                                            ?>       
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">PIC CHECK</td>
                                            <td class="align-middle"><?php echo $pic; ?></td>
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
                                    <div class="col-xl-6 col-lg-6">
                                        <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                        <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tgl=date('d-F-Y');
                                                echo $tgl;
                                                ?>    
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">AREA</td>
                                            <td class="align-middle"><?php echo $area; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                    <div class="chartBox">
                                    <canvas id="myChart4" width="100" height="100"></canvas>
                                    </div>
                          
                                </div>
                            </div>
                            <?php   
                            }
                            ?>

                            <?php
                            if($_SESSION["id_area"]==8){
                            ?>
                            <!-- Bar Chart1 -->
                            <div class="card shadow mb-4">
                                <div class="card-body">


                                <div class="row">
                                    <div class="col-xl-6">
                                    <table class="table table-bordered table-xl text-center align-middle"  style="font-size:12px"  height="100%" width="100%" width="100%" cellspacing="0">
                                    <?php
                                            $tabel =  mysqli_query ($cnts,"SELECT * from pic_check WHERE area='GAYA MOTOR'");
                                            foreach($tabel AS $data){
                                                $pic = $data['pic'];
                                                $foreman = $data['foreman'];    
                                                $date = $data['date'];
                                                $area = $data['area'];         
                                            ?>       
                                            <tr  height="50%">
                                            <td class="align-middle" width="20%">PIC CHECK</td>
                                            <td class="align-middle"><?php echo $pic; ?></td>
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
                                    <div class="col-xl-6 col-lg-6">
                                        <table class="table table-bordered table-xl text-center align-middle"   style="font-size:12px"   height="100%" width="100%" cellspacing="0">
                                        <tr  height="50%">
                                            <td class="align-middle" width="20%">DATE</td>
                                            <td class="align-middle">
                                                <?php
                                                $tgl=date('d-F-Y');
                                                echo $tgl;
                                                ?>    
                                            </td>
                                            </tr>
                                            <tr height="50%">
                                            <td class="align-middle">AREA</td>
                                            <td class="align-middle"><?php echo $area; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    
                                </div>

                                    <div class="chartBox">
                                    <canvas id="myChart5" width="100" height="100"></canvas>
                                    </div>

                                </div>
                            </div>
                            <?php   
                            }
                            ?>


                            <!-- Bar Chart1 -->
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                    <table class="table table-bordered table-xl "  style="font-size:12px"   width="100%" cellspacing="0">
                                        
                                        <th class="text-center">HASIL</th>
                                        <th class="text-center">KETERANGAN</th>
                                        <tr>
                                        <td rowspan="2" class="align-middle text-center bg-primary text-white">N/A</td>
                                        <td>STANDAR SPOT TIDAK TERDETEKSI DI ALAT MATRIK EYE</td>
                                        </tr>
                                        <tr>
                                        <td class="">TELAH TERKONFIRMASI OK</td>
                                        </tr>
                                        <td class="align-middle text-center bg-success text-white"> GOOD</td>
                                        <td>HASIL SPOT OK</td>
                                        </tr>
                                        <tr>
                                        <td rowspan="2"class="align-middle text-center bg-danger text-white">OPEN</td>
                                        <td>HASIL SPOT NG ( TIDAK DITEMUKAN HASIL SPOT)</td>
                                        </tr>
                                        <tr>
                                        <td class="">TELAH TERKONFIRMASI OK</td>
                                        </tr>
                                        <td rowspan="2" class="align-middle text-center bg-warning text-white">SMALL</td>
                                        <td>HASIL SPOT NG ( DIAMETER NUGGET KECIL)</td>
                                        </tr>
                                        <tr>
                                        <td class="">TELAH TERKONFIRMASI OK</td>
                                        </tr>
                                        <tr>
                                        <td rowspan="2" class="align-middle text-center bg-secondary bg-gradient text-white">STICK</td>
                                        <td>HASIL SPOT NG (KETEBALAN NUGGET KECIL /TIDAK DITEMUKAN)</td>
                                        </tr>
                                        <tr>
                                        <td class="">TELAH TERKONFIRMASI OK</td>
                                        </tr>
                                        <td rowspan="2" class="align-middle text-center bg-info text-white">THIN</td>
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
        
            <!-- Footer -->
            <?php include 'element/footer.php';?>
            <!-- End of Footer -->

            <!-- script chart.js -->

                            <script>

                            // setup
                            const data1={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye WHERE Part_No='Matrixeye MB LH' GROUP BY Weld_type");                                      
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
                                $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye MB LH'"); 
                                $total = mysqli_num_rows ($tabeltotal);                               
                                $matrix_eye = mysqli_query($cnts,"SELECT *, Count('Weld_type') AS Jumlah FROM matrix_eye WHERE Part_No='Matrixeye MB LH' GROUP BY Weld_type");                                      
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                echo $Jumlah.',';                                  
                                }
                                echo $total;
                                ?>
                                ],
                                backgroundColor: [
                                    '#006400', '#D2B48C','#FF0000','#FFFF00', '#87CEEB','#4682B4','#FFA500'
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
                            
                                                        
                            // setup
                                const data2={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye WHERE Part_No='Matrixeye MB RH' GROUP BY Weld_type");                                      
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
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye MB RH'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query($cnts,"SELECT *, Count('Weld_type') AS Jumlah FROM matrix_eye WHERE Part_No='Matrixeye MB RH' GROUP BY Weld_type");                                      
                                    foreach($matrix_eye AS $data){
                                    $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                    echo $Jumlah.',';                                  
                                    }
                                    echo $total;
                                    ?>
                                ],
                                backgroundColor: [
                                   
                                    '#006400', '#D2B48C','#FF0000','#FFFF00', '#87CEEB','#4682B4','#FFA500'
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

                            // setup
                            const data3={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye WHERE Part_No='Matrieye SM Rh' GROUP BY Weld_type");                                      
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
                                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye SM Rh'"); 
                                    $total = mysqli_num_rows ($tabeltotal);                               
                                    $matrix_eye = mysqli_query($cnts,"SELECT *, Count('Weld_type') AS Jumlah FROM matrix_eye WHERE Part_No='Matrieye SM Rh' GROUP BY Weld_type");                                      
                                    foreach($matrix_eye AS $data){
                                    $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                    echo $Jumlah.',';                                  
                                    }
                                    echo $total;
                                    ?>
                                ],
                                backgroundColor: [
                                    '#006400', '#D2B48C','#FF0000','#FFFF00', '#87CEEB','#4682B4','#FFA500'
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

                            // setup
                            const data4={
                                labels: [
                                <?php
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye WHERE Part_No='Matrixeye UB #20 Rev1' GROUP BY Weld_type");                                      
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
                                $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye UB #20 Rev1'"); 
                                $total = mysqli_num_rows ($tabeltotal);                               
                                $matrix_eye = mysqli_query($cnts,"SELECT *, Count('Weld_type') AS Jumlah FROM matrix_eye WHERE Part_No='Matrixeye UB #20 Rev1' GROUP BY Weld_type");                                      
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                echo $Jumlah.',';                                  
                                }
                                echo $total;
                                ?>
                                ],
                                backgroundColor: [
                                '#006400', 'bg-secondary bg-gradient','#FF0000','#FFFF00', '#87CEEB','#4682B4','#FFA500'
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
                                $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye WHERE Part_No='RF SA Center Pillar Body LH' GROUP BY Weld_type");                                      
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
                                $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='RF SA Center Pillar Body LH'"); 
                                $total = mysqli_num_rows ($tabeltotal);                               
                                $matrix_eye = mysqli_query($cnts,"SELECT *, Count('Weld_type') AS Jumlah FROM matrix_eye WHERE Part_No='RF SA Center Pillar Body LH' GROUP BY Weld_type");                                      
                                foreach($matrix_eye AS $data){
                                $Jumlah =$data ['Jumlah'];                                                                                                                                                
                                echo $Jumlah.',';                                  
                                }
                                echo $total;
                                ?>
                                ],
                                backgroundColor: [
                                    '#006400', '#D2B48C','#FF0000','#FFFF00', '#87CEEB','#4682B4','#FFA500'
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
                                <form action="dc_produksi.php" method="">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputpictagane">Pic Tagane</label>
                                        <input type="text" class="form-control" id="inputpictagane" placeholder="Npk">
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="Nama">Nama</label>
                                        <input type="password" class="form-control" id="inputPassword4" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputAddress">status</label>
                                         <input type="text" class="form-control" id="inputAddress" placeholder="NG">
                                    </div>                                 
                                
                                    <div class="form-group col-md-10">
                                        <label for="inputCity">Problem</label>
                                        <input type="text" class="form-control" id="inputCity">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="inputState">Countermeasure</label>
                                        <input type="text" class="form-control" id="Countermeasure">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                        <option>OK</option>
                                        <option>NG</option>
                                        </select>                   
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
                <!-- modal -->

              

</body>

</html>
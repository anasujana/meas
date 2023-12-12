<?php
include('conn/konneksi.php');
session_start();

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

                $data = array(
                    'total' => $total_sm,
                    'ok' => $total_mb_rh,
                    'ng' => $total_mb_lh,
                    'na' => $total_ub,
    );
    echo json_encode($data);
?> 

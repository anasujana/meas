<?php
                    include('conn/konneksi.php');
                
                        // cek ada/tidak nya data
                        if(isset($_POST['npk']) and isset($_POST['tagane'])){
                        // terima data                                 
                        $terima_npk = $_POST ['npk'];
                        $tagane_cek = $_POST['tagane']; 
                        foreach($tagane_cek as $data){
                             // tambahkan ke database    
                        $add = mysqli_query($cnts,"INSERT INTO matrix_eye VALUES ('','','','','','','','','','',
                        '','$terima_npk') where No_urut=$data "); 
                        }
                       
                                    
                        // if agar 0 tidak tampil
                        if($_POST['npk']>0){
                        }
                        }else{

                        }
                ?>
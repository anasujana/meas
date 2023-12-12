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
                  
                <div class="row">
                    <div class="col">
                        <h3>Data User</h3>
                    </div>
                    <div class="col">
                        <div class="button-group mb-3 text-right"  data-toggle="modal" data-target="#exampleModal">
                            <button type="button" class="btn btn-outline-primary">Tambah Data</button>   
                        </div> 
                    </div>                    
                </div> 
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="user_add.php" method="POST">   
                                    <div class="form-row">
                                        <!-- <div class="col-md-12 mb-3">
                                            <label for="validationServer01">id</label>
                                            <input type="number" name="id" class="form-control " id="validationServer01" placeholder="" value="">   
                                        </div> -->
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer01">Npk</label>
                                            <input type="number" name="npk" class="form-control " id="validationServer01" placeholder="" value="">   
                                        </div>
                                    </div> 
                                    <div class="form-row">  
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer02">Nama</label>
                                            <input type="text" name="nama" class="form-control " id="validationServer02" placeholder="" >                       
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer02">Password</label>
                                            <input type="password" name="password" class="form-control " id="validationServer02" placeholder="" >                     
                                        </div>
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

                <!-- delete -->
                <?php 
                if(isset($_GET ['npk'])){
                    $id  = $_GET ['npk'];
                    $delete =  mysqli_query ($cnts,"DELETE FROM user where npk='$id'");  
                }
                ?>
                <!-- delete -->

                <?php
                    include('conn/konneksi.php');

                        // cek ada/tidak nya data
                        if(isset($_POST['npk']) and isset($_POST['nama']) and isset($_POST['password'])){
                        // terima data                                 
                        $terimanpk        = $_POST ['npk'];
                        $terimanama      = $_POST ['nama'];
                        $terimanpassword      = $_POST ['password'];
                                    
                        // tambahkan ke database    
                        $add = mysqli_query($cnts,"INSERT INTO user VALUES (' $terimanpk ','$terimanama','$terimanpassword')"); 
                                    
                        // if agar 0 tidak tampil
                        if($_POST['npk']>0){
                        }
                        }else{

                        }
                ?>
                
                <div class="card shadow mb-4">                 
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table class="table table-bordered table-sm  text-center table-striped" id="user" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <!-- <th>id</th> -->
                                        <th>Npk</th>
                                        <th>Nama</th>
                                        <th>Password</th>                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
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
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="update_user.php" method="POST">   
                                    <div class="form-row">
                                        <!-- <div class="col-md-12 mb-3">
                                            <label for="validationServer01">id</label>
                                            <input type="number" name="id" class="form-control " id="validationServer01" placeholder="" value="">   
                                        </div> -->
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer01">Npk</label>
                                            <input type="number" name="npk" class="form-control " id="npk" placeholder="" value="">   
                                        </div>
                                    </div> 
                                    <div class="form-row">  
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer02">Nama</label>
                                            <input type="text" name="nama" class="form-control " id="nama" placeholder="" >                       
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer02">Password</label>
                                            <input type="password" name="password" class="form-control " id="pasword" placeholder="" >                     
                                        </div>
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

<script>
var table = $('#user').DataTable({
    "ajax":'data_me/edit_user.php?',
    })

        $('#user').on('click','.edit',function(){
            var id = this;
            var id1 = $(this).data('npk');
            
            $('#npk').val(id1);
        })

        $('#user').on('click','.edit',function(){
            var id = this;
            var id2 = $(this).data('nama');
            $('#nama').val(id2);
        })

        $('#user').on('click','.edit',function(){
            var id = this;
            var id3 = $(this).data('pasword');
            $('#pasword').val(id3);
        })

</script>

</html>
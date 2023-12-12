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
                        <h3>Data karyawan</h3>
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
                                <form action="user_area.php" method="POST">   
                                    <div class="form-row">
                
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Nama</label>
                                        <select name="nama" id="nama" class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                            include('conn/konneksi.php');
                                            $datauser = mysqli_query($cnts,"SELECT * FROM user");
                                            
                                            foreach ($datauser AS $user){
                                            $id = $user['nama'];
                                            $id_user = $user['npk']
                                            ?>                                         
                                                <option value="<?php echo $id_user; ?>"><?php echo $id; ?></option> 
                                            <?php
                                            }
                                            ?> 
                                        </select> 
                                        
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Area</label>
                                       <select name="area" id="area" class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                            include('conn/konneksi.php');
                                            $datauser = mysqli_query($cnts,"SELECT * FROM area");
                                            foreach ($datauser AS $user){
                                            $id = $user['area'];
                                            $id_area= $user['id']
                                            ?>   
                                            <option  value="<?php echo $id_area; ?>" ><?php echo $id; ?></option>    
                                            <?php
                                            }
                                        ?> 
                                        </select> 
                                                    
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
                if(isset($_GET ['id'])){
                    $id  = $_GET ['id'];
                    $delete =  mysqli_query ($cnts,"DELETE FROM user_area where id='$id'");  
                }
                ?>
                <!-- delete -->

                <?php
                if(isset($_POST['nama']) and isset($_POST['area'])){
                $terimanpk        = $_POST['nama'];                          
                $terimaarea      = $_POST['area'];
                                    
                // tambahkan ke database    
                $add = mysqli_query($cnts,"INSERT INTO user_area (id_user, id_area) VALUES (' $terimanpk ','$terimaarea')"); 
                }
                ?>               
                <?php 
                        
                $datarelasi =  mysqli_query ($cnts,"SELECT ua.id,us.npk,us.nama,ar.area FROM user_area ua 
                                                        LEFT JOIN user us ON ua.id_user= us.npk  
                                                        LEFT JOIN area ar on ua.id_area=ar.id ");
                                                       
                    ?>
                    <div class="card shadow mb-4">                 
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-bordered table-sm  text-center table-striped" id="user_area" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Npk</th>
                                            <th>Nama</th>
                                            <th>Area</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
    </div>
            <!-- Footer -->
            <?php include 'element/footer.php';?>
            <!-- End of Footer -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="update_user_area.php" method="POST">
                                    <div class="form-row">  
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer02">NPK</label>
                                            <input type="text" name="id" class="form-control " id="id" placeholder="" readonly>                       
                                        </div>
                                    </div>
                                    <div class="form-row">
                
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Nama</label>
                                        <select name="nama" id="nama" class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                            $datauser = mysqli_query($cnts,"SELECT * FROM user");
                                            
                                            foreach ($datauser AS $user){
                                            $id = $user['nama'];
                                            $id_user = $user['npk']
                                            ?>                                         
                                                <option value="<?php echo $id_user; ?>"><?php echo $id; ?></option> 
                                            <?php
                                            }
                                            ?> 
                                        </select> 
                                        
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Area</label>
                                       <select name="area" id="area" class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                            include('conn/konneksi.php');
                                            $datauser = mysqli_query($cnts,"SELECT * FROM area");
                                            foreach ($datauser AS $user){
                                            $id = $user['area'];
                                            $id_area= $user['id']
                                            ?>   
                                            <option  value="<?php echo $id_area; ?>" ><?php echo $id; ?></option>    
                                            <?php
                                            }
                                        ?> 
                                        </select> 
                                                    
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
var table = $('#user_area').DataTable({
    "ajax":'data_me/edit_user_area.php?',
    })

    $('#user_area').on('click','.edit',function(){
            var id = this;
            var id1 = $(this).data('id');
            
            $('#id').val(id1);
    })

    $('#user_area').on('click','.edit',function(){
        var id = this;
        var id1 = $(this).data('nama');
        
        $('#nama').val(id1);
    })

    $('#user_area').on('click','.edit',function(){
        var id = this;
        var id2 = $(this).data('area');
        $('#area').val(id2);
    })

</script>

</html>

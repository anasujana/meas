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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                        <h3>Data Role User</h3>
                    </div>
                    <div class="col">
                        <div class="button-group mb-3 text-right" data-toggle="modal" data-target="#exampleModal">
                            <button type="button" class="btn btn-outline-primary">Tambah Data</button>   
                        </div>
                    </div>   
                </div> 
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Role User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="roleuser.php" method="POST">   
                                    <div class="form-row">
                
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Npk</label>
                                        <select name="npk" id="npk" class="form-control" id="exampleFormControlSelect1">>
                                        <?php
                                            include('conn/konneksi.php');
                                            $datauser = mysqli_query($cnts,"SELECT * FROM user");
                                            
                                            foreach ($datauser AS $user){
                                            $id_user = $user['npk'];
                                            ?>                                         
                                                <option value="<?php echo $id_user; ?>"><?php echo $id_user; ?></option> 
                                            <?php
                                            }
                                            ?> 
                                        </select> 
                                      
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Role User</label>
                                        <select name="role_user" id="nama" class="form-control" id="role">>
                                        <option value="user">user</option>
                                        <option value="management">management</option>
                                        <option value="admin">admin</option>
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
                    
                <?php 
                if(isset($_GET ['npk'])){
                    $npk  = $_GET ['npk'];
                    $delete =  mysqli_query ($cnts,"DELETE FROM role_user where npk='$npk'");  
                }
                ?>

                <?php
                    include('conn/konneksi.php');
                    if(isset($_POST['npk']) and isset($_POST['role_user'])){
                    $terimanpk        = $_POST ['npk'];
                    $terimarole      = $_POST ['role_user'];

                    $add = mysqli_query($cnts,"INSERT INTO role_user VALUES ('$terimanpk','$terimarole')");
                    if($_POST['npk']>0){
                    }
                    }
                ?>

                
  
                <div class="card shadow mb-4">                 
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table class="table table-bordered table-sm  text-center table-striped" id="role" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Npk</th>
                                    <th>Role User</th>
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
              <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Role User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="update_role.php" method="POST">   
                                    <div class="form-row">
                
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Npk</label>
                                        <select name="npk" id="npk" class="form-control" id="exampleFormControlSelect1">>
                                        <?php
                                            include('conn/konneksi.php');
                                            $datauser = mysqli_query($cnts,"SELECT * FROM user");
                                            
                                            foreach ($datauser AS $user){
                                            $id_user = $user['npk'];
                                            ?>                                         
                                                <option value="<?php echo $id_user; ?>"><?php echo $id_user; ?></option> 
                                            <?php
                                            }
                                            ?> 
                                        </select> 
                                      
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Role User</label>
                                        <select name="role" id="role" class="form-control">
                                        <option value="user">user</option>
                                        <option value="management">management</option>
                                        <option value="admin">admin</option>
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
var table = $('#role').DataTable({
    "ajax":'data_me/edit_role.php?',
    })

        $('#role').on('click','.edit',function(){
            var id = this;
            var id1 = $(this).data('npk');
            
            $('#npk').val(id1);
        })

        $('#role').on('click','.edit',function(){
            var id = this;
            var id2 = $(this).data('role');
            $('#role').val(id2);
        })


</script>

</html>
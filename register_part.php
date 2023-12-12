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
                                <h5 class="modal-title" id="exampleModalLabel">Area</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="register_part.php" method="POST">   
                                    <div class="form-row">
                
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Area</label>
                                        <select name="id_area" id="" class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                            include('conn/konneksi.php');
                                            $datauser = mysqli_query($cnts,"SELECT * FROM user_area ua 
                                            left join area ar on ua.id_area=ar.id group by id_area ");
                                            
                                            foreach ($datauser AS $user){
                                            $id = $user['id_area'];
                                            $area = $user['area']
                                            ?>                                         
                                                <option value="<?php echo $id; ?>"><?php echo $area; ?></option> 
                                            <?php
                                            }
                                            ?> 
                                        </select> 
                                        
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Part Name</label>
                                       <select name="part_name" id="" class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                            include('conn/konneksi.php');
                                            $datauser = mysqli_query($cnts,"SELECT * FROM matrix_eye group by Part_No");
                                            foreach ($datauser AS $user){
                                            $id = $user['Part_No'];
                                            ?>   
                                            <option  value="<?php echo $id; ?>" ><?php echo $id; ?></option>    
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
                if(isset($_GET ['id_part'])){
                    $id  = $_GET ['id_part'];
                    $delete =  mysqli_query ($cnts,"DELETE FROM register_part where id_part='$id'");  
                }
                ?>
                <!-- delete -->

                <?php
                if(isset($_POST['id_area']) and isset($_POST['part_name'])){
                $terimanpk        = $_POST['id_area'];                          
                $terimaarea      = $_POST['part_name'];
                                    
                // tambahkan ke database    
                $add = mysqli_query($cnts,"INSERT INTO register_part (id_area, part_name) VALUES (' $terimanpk ','$terimaarea')"); 
                }
                ?>  

                <?php     
                $datarelasi =  mysqli_query ($cnts,"SELECT rp.id_part, ar.area,rp.part_name from register_part rp left join area ar on rp.id_area=ar.id ");                                    
                ?>
                    <div class="card shadow mb-4">                 
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-bordered table-sm  text-center table-striped" id="register_part" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Area</th>
                                            <th>Part Name</th>
                                            <td>Action</td>
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
                                <h5 class="modal-title" id="exampleModalLabel">Area</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="update_part.php" method="POST">
                                    
                                    <div class="form-row">  
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer02">Id_part</label>
                                            <input type="text" name="id_part" class="form-control " id="id_part" placeholder="" readonly>                       
                                        </div>
                                    </div>
                                    <div class="form-row">
                
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Area</label>
                                        <select name="area" id="area1" class="form-control">
                                        <?php
                                            include('conn/konneksi.php');
                                            $datauser = mysqli_query($cnts,"SELECT * FROM user_area ua 
                                            left join area ar on ua.id_area=ar.id group by id_area ");
                                            
                                            foreach ($datauser AS $user){
                                            $id = $user['id_area'];
                                            $area = $user['area']
                                            ?>                                         
                                                <option value="<?php echo $id; ?>"><?php echo $area; ?></option> 
                                            <?php
                                            }
                                            ?> 
                                        </select> 
                                        
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlSelect1">Part Name</label>
                                       <select name="part_name" id="part_name" class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                            $datauser = mysqli_query($cnts,"SELECT * FROM matrix_eye group by Part_No");
                                            foreach ($datauser AS $user){
                                            $id = $user['Part_No'];
                                            ?>   
                                            <option  value="<?php echo $id; ?>" ><?php echo $id; ?></option>    
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
var table = $('#register_part').DataTable({
    "ajax":'data_me/edit_part.php?',
    })

        $('#register_part').on('click','.edit',function(){
            var id = this;
            var id1 = $(this).data('id');
            
            $('#id_part').val(id1);
        })

        $('#register_part').on('click','.edit',function(){
            var id = this;
            var id2 = $(this).data('area');
            
            $('#area1').val(id2);
        })

        $('#register_part').on('click','.edit',function(){
            var id = this;
            var id3 = $(this).data('part');
            $('#part_name').val(id3);
        })

</script>

</html>

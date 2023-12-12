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
                    <h3>Data Area</h3>
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
                                <h5 class="modal-title" id="exampleModalLabel">Add Area</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="area.php" method="POST">   
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationServer01">Id</label>
                                        <input type="number" name="id" class="form-control " id="validationServer01"  value="">   
                                    </div>
                                </div> 
                                <div class="form-row">  
                                    <div class="col-md-12 mb-3">
                                        <label for="validationServer02">Area</label>
                                        <input type="text" name="area" class="form-control " id="validationServer02" value="" >                       
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
                    include('conn/konneksi.php');
                    if(isset($_POST['id']) and isset($_POST['area'])){
                    $terimaid        = $_POST ['id'];
                    $terimaarea      = $_POST ['area'];
                        
                    $add = mysqli_query($cnts,"INSERT INTO area VALUES ('$terimaid','$terimaarea')"); 
                        if($_POST['id']>0){
                        }
                    }
                    ?>

                    <?php 
                    if(isset($_GET ['id'])){
                        $id = $_GET ['id'];
                        $delete =  mysqli_query ($cnts,"DELETE FROM area where id='$id'");  
                    }
                    ?>

                <div class="card shadow mb-4">                 
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table class="table table-bordered table-sm  text-center table-striped" id="area" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Area Id</th>
                                        <th>Area</th>
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
        
        
    <!-- /.container-fluid -->

    <!-- End of Main Content -->

    <!-- Modal -->        
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="update_area.php" method="POST">   
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationServer01">Id</label>
                                        <input type="number" name="id" class="form-control " id="id"  value="">   
                                    </div>
                                </div> 
                                <div class="form-row">  
                                    <div class="col-md-12 mb-3">
                                        <label for="validationServer02">Area</label>
                                        <input type="text" name="area" class="form-control " id="nama_area" value="" >                       
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


    <!-- Footer -->
<?php include 'element/footer.php';?>
            <!-- End of Footer -->


</body>

<script>
var table = $('#area').DataTable({
    "ajax":'data_me/edit_area.php?',
    })

        $('#area').on('click','.edit',function(){
            var id = this;
            var id1 = $(this).data('id');
            
            $('#id').val(id1);
        })

        $('#area').on('click','.edit',function(){
            var id = this;
            var id2 = $(this).data('area');
            $('#nama_area').val(id2);
        })


</script>

</html>


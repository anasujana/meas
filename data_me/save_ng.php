<?php
include('../conn/konneksi.php');
session_start();
$npk1 = $_SESSION["npk"];

if($_GET['id'] == 'update'){
    // echo "sukses";
    $npk = $_GET['npk'];
    $no_urut = $_GET['no_urut'];
    // echo count($_POST['data_ng']);
    if(isset($_POST['data_ng'])){
        if($npk == $npk1){
            foreach($_POST['data_ng']AS $data){
                //insert
                    $add = mysqli_query($cnts,"UPDATE matrix_eye SET pic_tagane='$npk', tagane='OK'  WHERE No_urut='$data'");           
                    if($_GET['npk']>0){
                    }      
                
            }
            if($add){
                ?>
                <script>
                    swal("Terimakasih","Data berhasil di dikonfirmasi","success");
                </script>
                <?php
            }
        }else{
            ?>
            <script>
                swal("Gagal","Npk salah","error");
            </script>
            <?php
        }
    }

}else{
    $tagane_cek = $_POST['tagane']; 
    
    foreach($tagane_cek as $data){
        $update = mysqli_query($cnts,"UPDATE matrix_eye SET tagane='OK' WHERE No_urut=$data");
    }
}

?>
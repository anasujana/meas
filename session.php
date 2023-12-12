<?php 
    session_start();
if($_SESSION['logged_in']==false){
    header('location:index.php');
}
?>
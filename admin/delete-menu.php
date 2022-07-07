<?php 
    include('../db_connect.php');
    $id = $_GET['id'];
    $query = "delete from dishes where d_id='$id'";
    $result=mysqli_query($conn,$query);
    if($result){
        header('location:manage-menu.php');
    }
?>
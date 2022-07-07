<?php 
    include('db_connect.php');
    if(isset($_GET['id'])){
        $query = "delete from cart where cart_id='{$_GET['id']}'";
        $result = mysqli_query($conn,$query);
        if($result){
            header('location:cart.php');
        }
    }
    else{
        header('location:cart.php');
    }
    
?>
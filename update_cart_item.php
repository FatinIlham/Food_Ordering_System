<?php 
    include('db_connect.php');
    $quantity = $_POST['q'];
    $id = $_POST['id'];
    $query = "update cart set quantity='$quantity' where cart_id=$id";
    $result = mysqli_query($conn,$query);
    if($result){
        echo "YES";
        header("location:cart.php");
        die();
    }
?>
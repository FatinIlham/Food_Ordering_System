<?php 
    $conn=mysqli_connect('localhost','root','','foodorderingsystem');
    if(!$conn){
        die("error: ".mysqli_connct_error());
    }
?>
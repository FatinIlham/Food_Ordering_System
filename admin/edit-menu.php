<?php include('admin-nav.php')?>
<?php 
    include('../db_connect.php');
    $id = $_GET['id'];
    $query = "select * from restaurant";
    $result = mysqli_query($conn,$query);
    $c=0;
    $query1="select * from dishes where d_id = '$id'";
    $result1=mysqli_query($conn,$query1);
    if($result1){
        $row = mysqli_fetch_assoc($result1);
        $food_name = $row['name'];
        $food_about = $row['about'];
        $res_id = $row['r_id'];
        $food_price = $row['price'];
        $food_img = $row['img'];
    }
?>
<?php
    if(isset($_POST['submit'])){

        if(!isset($_FILES['imagefile']) || $_FILES['imagefile']['error'] == UPLOAD_ERR_NO_FILE){
            $image=$food_img;
            $c = 1;
        }
        else{
        
            $target_dir = "../upload/";
            $filename = $target_dir.basename($_FILES['imagefile']['name']);
            $temp_file_name = $_FILES['imagefile']['tmp_name'];
            $image=basename($_FILES['imagefile']['name']);
        }
        
        $f_name = $_POST['foodname'];
        $f_about = $_POST['about'];
        $fr_id = $_POST['resname'];
        $f_price = $_POST['price'];
        
        $query2 = "update dishes set 
                    name='$f_name',
                    about='$f_about',
                    r_id='$fr_id',
                    price='$f_price',
                    img='$image'
                where d_id='$id'";
        $result2 = mysqli_query($conn,$query2);

        if($result2){
            if($c==0){
                move_uploaded_file($temp_file_name,$filename);
            }
            header('location:manage-menu.php');
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit-menu.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <lebel>Food Name</lebel>
        <input type="text" name="foodname" value="<?php echo $food_name?>">
        <lebel>About</lebel>
        <input type="text" name="about" value="<?php echo $food_about?>">
        <lebel>Restaurent Name</lebel>
        <select name="resname" id="">
            <?php 
                while($row = mysqli_fetch_assoc($result)){
                    $r_id = $row['r_id'];
                    $r_name = $row['name'];
                ?>
                    <option value="<?php echo $r_id?>" <?php if($r_id==$res_id) echo 'selected'?> > <?php echo $r_name ?> </option>
                <?php
                }
            ?>
            
        </select>  
        <lebel>Price</lebel>      
        <input type="text" name="price" value="<?php echo $food_price?>">
        <lebel>Image</lebel>
        <input type="file" name="imagefile">
        <img src="../upload/<?php echo $food_img?>" alt=""><br><br>
        <input type="submit" name="submit">
       
    </form>

</body>
</html>
<?php include('../footer.php')?>
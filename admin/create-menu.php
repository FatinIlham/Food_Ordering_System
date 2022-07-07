<?php include("admin-nav.php") ?>
<?php 
    include("../db_connect.php");
    $query = "select * from restaurant";
    $result = mysqli_query($conn,$query);
?>
<?php 
    
    $error=['res_name'=>'','dish_name'=>'','price'=>'','about'=>'','image'=>''];
    $res_name = $dish_name = $price = $about = $image = '';
   
    if(isset($_POST['submit'])){

         
        if(!isset($_FILES['imagefile']) || $_FILES['imagefile']['error'] == UPLOAD_ERR_NO_FILE){
            $error['image']='Select an image';
        }
        else{
            $target_dir = "../upload/";
            $filename = $target_dir.basename($_FILES['imagefile']['name']);

            $temp_file_name = $_FILES['imagefile']['tmp_name'];
            $image=basename($_FILES['imagefile']['name']);

        }
         
        
        
        

        //name
        
        if(empty($_POST['res-name'])){
            $error['res_name']='Restaurent should not be empty';
        }
        else{
            $res_name=$_POST['res-name'];
        }

        if(empty($_POST['dish-name'])){
            $error['dish_name']='Dish should not be empty';
        }
        else{
            $dish_name=$_POST['dish-name'];
        }

        if(empty($_POST['price'])){
            $error['price']='Price should not be empty';
        }
        else{
            $price=$_POST['price'];
        }

        if(empty($_POST['about'])){
            $error['about']='About should not be empty';
        }
        else{
            $about=$_POST['about'];
        }

        
        if($error['res_name']=="" && $error['dish_name']=="" && $error['price']=="" && $error['about']=="" && $error['image']==""){
            move_uploaded_file($temp_file_name,$filename);
            $query1="insert into dishes(r_id,name,about,price,img) values('$res_name','$dish_name','$about','$price','$image')";
            $result1 = mysqli_query($conn,$query1);
            if($result1){
                $res= "Dish added";
            }
            else{
                $res="Failed";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create-menu.css">
    <title>Document</title>
</head>
<body>
    <center><?php  echo isset($res)? $res:"" ?></center>
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Add Food/s</h1>
        <lebel>Restaurent Name</lebel>
        <select name="res-name" id="">
            <option value="">--Select Restaurent--</option>
            <?php
                while($row = mysqli_fetch_assoc($result)){
                ?>
                    <option value="<?php echo $row['r_id']?>"><?php echo $row['name']?></option>
                <?php
                }

            ?>
        </select><br>
        <span><small><?php echo isset($error['res_name'])?$error['res_name']: "" ?></small></span><br><br>
        <div class="main-div">
            <div class="div1">
                <lebel>Dish Name</lebel>
                <input type="text" name="dish-name"><br>
                <span><small><?php echo isset($error['dish_name'])?$error['dish_name']: "" ?></small></span><br><br>
                <lebel>Price</lebel>
                <input type="text" name="price"><br>
                <span><small><?php echo isset($error['price'])?$error['price']: "" ?></small></span><br>
            </div>
            <div class="div2">
                <lebel>About</lebel>
                <input type="text" name="about"><br>
                <span><small><?php echo isset($error['about'])?$error['about']: "" ?></small></span><br><br>
                <lebel>Image</lebel>
                <input type="file" name="imagefile"><br>
                <span><small><?php echo isset($error['image'])?$error['image']: "" ?></small></span><br>
            </div>
        </div>
        
        <input type="submit" name="submit">
    </form>
</body>
</html>

<?php include("../footer.php") ?>
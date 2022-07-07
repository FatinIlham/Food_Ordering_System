<?php 
    include('../db_connect.php');
    $error=['name'=>'','email'=>'','phone'=>'','url'=>'','o_hr'=>'','c_hr'=>'','o_days'=>'','image'=>'','address'=>''];
    $name = $email = $phone = $url = $o_hr = $c_hr = $o_days = $image = $address = '';
   
    if(isset($_POST['add'])){

         
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
        
        if(empty($_POST['name'])){
            $error['name']='Name should not be empty';
        }
        else{
            $name=mysqli_real_escape_string($conn,$_POST['name']);
        }

        //email
        if(empty($_POST['email'])){
            $error['email']='Email should not be empty';
        }
        else{
           
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $error['email']='Please provide a valid email';
            }
            else{
                $email = mysqli_real_escape_string($conn,$_POST['email']);
            }
        }
        
        //phone
        if(empty($_POST['phone'])){
            $error['phone']='Phone number should not be empty';
        }

        else{
            $pattern='/^(?:\+88|88)?(01[3-9]\d{8})$/';
            if(!preg_match($pattern,$_POST['phone'])){
                $error['phone']='Phone number do not match with bd number format';
            }
            else{
                $phone=mysqli_real_escape_string($conn,$_POST['phone']);
            }
        }

        //url
        if(empty($_POST['url'])){
            $error['url']='Url should not be empty';
        }
        else{
            $url=$_POST['url'];
        }

        if(empty($_POST['opening_time'])){
            $error['o_hr']='Opening time should not be empty';
        }
        else{
            $o_hr=$_POST['opening_time'];
        }

        if(empty($_POST['closing_time'])){
            $error['c_hr']='closing time should not be empty';
        }
        else{
            $c_hr=$_POST['closing_time'];
        }
        
        if(empty($_POST['opening_days'])){
            $error['o_days']='Opening days should not be empty';
        }
        else{
            $o_days=$_POST['opening_days'];
        }
     
        if(empty($_POST['address'])){
            $error['address']='Address should not be empty';
        }
        else{
            $address=$_POST['address'];
        }
       
        if($error['name']=='' && $error['email']=='' && $error['phone']=='' && $error['url']=='' && $error['o_hr']==''
            && $error['c_hr']=='' && $error['o_days']=='' && $error['image']==''&& $error['address']==''){
            move_uploaded_file($temp_file_name,$filename);
            $query="insert into restaurant(name,email,phone,url,o_hr,c_hr,o_days,address,img) 
                    values('$name','$email','$phone','$url','$o_hr','$c_hr','$o_days','$address','$image')";
            $result = mysqli_query($conn,$query);
            if($result){
                $res= "Restaurant added";
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
    <link rel="stylesheet" href="add-store.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php include "admin-nav.php"; ?>
    <center><?php echo isset($res)? $res:"" ?></center>
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Add New Restaurant</h1>
        
            <input type="text" name="name" placeholder="Restaurant Name"><br>
            <span class=""><small><?php echo $error['name']?></small></span><br><br>
    
        
            <input type="email" name="email" placeholder="Email address"><br>
            <span class=""><small><?php echo $error['email']?></small></span><br><br>
            

        
            <input type="text" name="phone" placeholder="Contact Number"><br>
            <span class=""><small><?php echo $error['phone']?></small></span><br><br>
 
  
            <input type="text" name="url" placeholder="Website url"><br>
            <span class=""><small><?php echo $error['url']?></small></span><br><br>
            
      
        
      
            <select name="opening_time" id="">
                <option value="">--Select Your Hours--</option>
                <option value="9am">9am</option>
                <option value="10am">10am</option>
                <option value="11am">11am</option>
                <option value="12am">12am</option>
            </select><br>
            <span class=""><small><?php echo $error['o_hr']?></small></span><br><br>
 
            <select name="closing_time" id="">
                <option value="">--Select Your Hours--</option>
                <option value="8pm">8pm</option>
                <option value="9pm">9pm</option>
                <option value="10pm">10pm</option>
                <option value="11pm">11pm</option>
            </select><br>
            <span class=""><small><?php echo $error['c_hr']?></small></span><br><br>

        
  
            <select name="opening_days" id="">
                <option value="">--Select Your Days--</option>
                <option value="mon-tue">mon-tue</option>
                <option value="mon-wed">mon-wed</option>
                <option value="mon-thu">mon-thu</option>
                <option value="mon-fri">mon-fri</option>
                <option value="mon-fri">mon-sat</option>
                <option value="24hr-x7">24hr-x7</option>
            </select>
            <span class=""><small><?php echo $error['o_days']?></small></span><br><br>

        
       
            <input type="file" name="imagefile" accept="image/*" ><br>
            <span class=""><small><?php echo $error['image']?></small></span><br><br>

        

            <textarea name="address" id="" cols="30" rows="10"></textarea><br>
            <span class=""><small><?php echo $error['address']?></small></span><br><br>
     
        

        <input type="submit" name="add" value="Add">
    </form>
    <?php include "../footer.php" ?>
</body>
</html>
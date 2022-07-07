<?php include("admin-nav.php")?>
<?php 
    include("../db_connect.php");
    $id= $_GET['id'];
    $c=0;
    $query = "select * from restaurant where r_id=$id";
    $result = mysqli_query($conn,$query);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $contact = $row['phone'];
        $url = $row['url'];
        $o_hr = $row['o_hr'];
        $c_hr = $row['c_hr'];
        $o_days = $row['o_days'];
        $img = $row['img'];
        $address = $row['address'];
    }
    
?>
<?php 
    if(isset($_POST['submit'])){
        
        if(!isset($_FILES['imagefile']) || $_FILES['imagefile']['error'] == UPLOAD_ERR_NO_FILE){
            $image=$img;
            $c = 1;
        }
        else{
        $target_dir = "../upload/";
        $filename = $target_dir.basename($_FILES['imagefile']['name']);
        $temp_file_name = $_FILES['imagefile']['tmp_name'];
        $image=basename($_FILES['imagefile']['name']);
        }
        $name1 = $_POST['name'];
        $email1 = $_POST['email'];
        $contact1 = $_POST['contact'];
        $url1 = $_POST['url'];
        $o_hr1 = $_POST['o_hr'];
        $c_hr1 = $_POST['c_hr'];
        $o_days1 = $_POST['o_days'];
        $address1 = $_POST['address'];
        $id = $_POST['h']; 
        $query1 = "update restaurant set name='$name1', email='$email1', phone='$contact1',url = '$url1',
                    o_hr = '$o_hr1', c_hr = '$c_hr1', o_days = '$o_days1', address= '$address1', img = '$image'
                    where r_id = '$id'";

        $result1 = mysqli_query($conn,$query1);
        if($result1){
            if($c==0){
            move_uploaded_file($temp_file_name,$filename);
            }
            header('location:manage-store.php'); 
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit-store.css">
    <title>Document</title>
</head>
<body>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div class="main-div">
            <div class="div1">
                    <lebel>Name</lebel><br>
                    <input type="text" name="name" value="<?php echo $name?>"><br>
                    <lebel>Email</lebel><br>
                    <input type="text" name="email" value="<?php echo $email ?>"><br>
                    <lebel>Contact</lebel><br>
                    <input type="text" name="contact" value="<?php echo $contact ?>" ><br>
                    <lebel>Website Url</lebel><br>
                    <input type="text" name="url" value="<?php echo $url ?>"><br>
            </div>
            <div class="div2">
                    <lebel>Opening Hour</lebel><br>
                    <select name="o_hr" id="">
                        <option value="9am" <?php if($o_hr == '9am') echo 'selected' ?> >9am</option>
                        <option value="10am" <?php if($o_hr == '10am') echo 'selected' ?> >10am</option>
                        <option value="11am" <?php if($o_hr == '11am') echo 'selected' ?> >11am</option>
                        <option value="12am" <?php if($o_hr == '12am') echo 'selected' ?> >12am</option>
                    </select><br>
                    <lebel>Closing Hour</lebel><br>
                    <select name="c_hr" id="">
                        <option value="8pm" <?php if($c_hr == '8pm') echo 'selected' ?> >8pm</option>
                        <option value="9pm" <?php if($c_hr == '9pm') echo 'selected' ?> >9pm</option>
                        <option value="10pm" <?php if($c_hr == '10pm') echo 'selected' ?> >10pm</option>
                        <option value="11pm" <?php if($c_hr == '11pm') echo 'selected' ?> >11pm</option>
                    </select><br>
                    <lebel>Opening Days</lebel><br>
                    <select name="o_days" id="">
                        <option value="mon-tue" <?php if($o_days == 'mon-tue') echo 'selected' ?> >mon-tue</option>
                        <option value="mon-wed" <?php if($o_days == 'mon-wed') echo 'selected' ?> >mon-wed</option>
                        <option value="mon-thu" <?php if($o_days == 'mon-thu') echo 'selected' ?> >mon-thu</option>
                        <option value="mon-fri" <?php if($o_days == 'mon-fri') echo 'selected' ?> >mon-fri</option>
                        <option value="mon-sat" <?php if($o_days == 'mon-sat') echo 'selected' ?> >mon-sat</option>
                        <option value="24hr-x7" <?php if($o_days == '24hr-x7') echo 'selected' ?> >24hr-x7</option>
                    </select><br>
            </div>
        </div>
        <lebel>Image</lebel><br>
        <input type="file" name="imagefile" value="<?php echo $img ?>" accept="image/*">
        <img src="../upload/<?php echo $img ?>" alt="" height="200px"><br><br>
        <lebel>Address</lebel><br>
        <textarea name="address" id=""> <?php echo $address ?> </textarea>

        <input type="hidden" name="h" value="<?php echo $id?>" >
        <input type="submit" name="submit" value="Update">
            

    </form>

</body>
</html>
<?php include("../footer.php")?>
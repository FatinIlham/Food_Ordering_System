<?php 
    include('db_connect.php');
    $error=['name'=>'','email'=>'','phone'=>'','password'=>'','confirmPassword'=>''];
    $name = $email = $phone = $password = $confirmPassword = '';
    if(isset($_POST['signup'])){
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

        //password
        if(empty($_POST['password'])){
            $error['password']='Passoword should not be empty';
        }
        else{
            $password=$_POST['password'];
        }

        if(empty($_POST['confirmPassword'])){
            $error['confirmPassword']='Confirm password should not be empty';
        }
        else{
            
            $confirmPassword=$_POST['confirmPassword'];
            if($password!=$confirmPassword){
                $error['password']='Password do not match';
                $error['confirmPassword']='Confirm password do not match';
            }
            else{
                if(strlen($password)<8){
                    $error['password']='Password length should be atleast 8 digit';
                }        
            }
        }
        if($error['name']=='' && $error['email']=='' && $error['phone']=='' && $error['password']=='' && $error['confirmPassword']==''){
            $query1="select * from registration where email='$email' and phone='$phone'";
            $result1=mysqli_query($conn,$query1);
            if(mysqli_num_rows($result1)>0){
                $reg='Already Registered';
            }
            else{

                $securepassword=md5($password);
                $query="insert into registration(name,email,phone,password) values('$name','$email','$phone','$securepassword')";
                $result=mysqli_query($conn,$query);
                if($result){
                    $reg='Registration is successful';
                    $name="";
                    $email="";
                    $phone="";
                    $password="";
                    $confirmPassword="";
                    
                }
                else{
                    $reg='Registration Failed';
                }
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
    <link rel="stylesheet" href="style_register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
   
    <title>Registration</title>
</head>
<body>
    <div class="content">
        <div class="ra"><?php echo isset($reg)? $reg:''?></div>
        <form action="" method="post">
            <h1>Create <span style="color: #ff3838";>Account</span> </h1>
            <div class="inputfield">
                <!-- <level>Name</level><br> -->
                <input type="text" name="name" value="<?php echo isset($name)? $name:'' ?>" placeholder="Name"><br>
                <span class="text-danger"><small><?php echo $error['name']?></small></span>
            </div>
            
            <div class="inputfield">
                <!-- <level>Email</level><br> -->
                <input type="text" name="email" value="<?php echo isset($email)? $email:'' ?>" placeholder="Email Address"><br>
                <span class=""><small><?php echo $error['email']?></small></span>
            </div>
            <div class="inputfield">
                <!-- <level>Phone</level><br> -->
                <input type="text" name="phone" value="<?php echo isset($phone)? $phone:'' ?>" placeholder="Phone"><br>
                <span class=""><small><?php echo $error['phone']?></small></span>
            </div>
            <div class="inputfield">
                <!-- <level>Password</level><br> -->
                <input type="password" name="password" value="<?php echo isset($password)? $password:'' ?>" placeholder="Password"><br>
                <span class=""><small><?php echo $error['password']?></small></span>
            </div>
            <div class="inputfield">
                <!-- <level>Confirm Password</level><br> -->
                <input type="password" name="confirmPassword" value="<?php echo isset($confirmPassword)? $confirmPassword:'' ?>" placeholder="Confirm Password"><br>
                <span class=""><small><?php echo $error['confirmPassword']?></small></span>
                
            </div>
            <input class="btn" type="submit" name="signup" value="Sign Up">
            <div style="margin-top:20px;text-align: center;">Already have an account? <a href="login.php" style="color:#ff3838">Login</a></div>
        </form>
    </div>
    
</body>
</html>
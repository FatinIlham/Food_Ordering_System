<?php 
include('db_connect.php');
session_start();
$error=['email'=>'','password'=>''];
$email = $password='';
if(isset($_POST['signin'])){
 

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
    
   //password
    if(empty($_POST['password'])){
        $error['password']='Passoword should not be empty';
    }
    else{
        $password=$_POST['password'];
    }

    if($error['email']=='' && $error['password']==''){
        $epass=md5($password);
        $query="select * from registration where email='$email' and password='$epass'";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
            $_SESSION['user']=$email;
            header('location:index.php');
            die();
        }
        else{
            $log="Email or Password is wrong";
            $email="";
            $password="";
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
    <link rel="stylesheet" href="style_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="content">
        <div><?php echo isset($log)?$log:''?></div>
        <form action="" method="post">
            
            <h1>User <span style="color:#ff3838">Login</span></h1>
            <div class="inputfield">
                <!-- <level>Email</level><br> -->
                <input type="email" name="email" value="<?php echo isset($email)?$email:'' ?>" placeholder="Email"><br>
                <span class=""><small><?php echo $error['email']?></small></span>
            </div>
           
            <div class="inputfield">
                <!-- <level>Password</level><br> -->
                <input type="password" name="password" value="<?php echo isset($password)?$password:'' ?>" placeholder="Password"><br>
                <span class=""><small><?php echo $error['password']?></small></span>
            </div>
            
            <input class="btn" type="submit" name="signin" value="Sign in">
            <div style="margin-top:20px;text-align: center;">Don't have an account? <a href="register.php" style="color:#ff3838">Register</a></div>
        </form>
    </div>
    
</body>
</html>

<?php 
include('../db_connect.php');
session_start();
$error=['user'=>'','password'=>''];
$name = $password='';
if(isset($_POST['signin'])){
 

    //username
    if(empty($_POST['user'])){
        $error['user']='Username should not be empty';
    }
    else{
       
        $name = mysqli_real_escape_string($conn,$_POST['user']);
        
    }
    
   //password
    if(empty($_POST['password'])){
        $error['password']='Passoword should not be empty';
    }
    else{
        $password=$_POST['password'];
    }

    if($error['user']=='' && $error['password']==''){
        // $epass=md5($password);
        $query="select * from admin where name='$name' and password='$password'";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
            $_SESSION['admin']=$name;
            header('location:home.php');
            die();
        }
        else{
            $log="Username or Password is wrong";
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
    <link rel="stylesheet" href="admin-login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <div><?php echo isset($log)?$log:''?></div>
        <form action="" method="post">
            
            <h1>Admin <span style="color:#51a52b">Login</span></h1>
            <div class="inputfield">
                <!-- <level>Email</level><br> -->
                <input type="text" name="user" value="<?php echo isset($email)?$email:'' ?>" placeholder="Username"><br>
                <span class=""><small><?php echo $error['user']?></small></span>
            </div>
           
            <div class="inputfield">
                <!-- <level>Password</level><br> -->
                <input type="password" name="password" value="<?php echo isset($password)?$password:'' ?>" placeholder="Password"><br>
                <span class=""><small><?php echo $error['password']?></small></span>
            </div>
            
            <input class="btn" type="submit" name="signin" value="Sign in">
            
        </form>
    </div>
    
</body>
</html>

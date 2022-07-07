<?php 
    include('navbar.php');
    if(!isset($_SESSION['user'])){
        header("location:index.php");
    }
    $error=['name'=>'','email'=>'','phone'=>'','streetaddress'=>'','city'=>'','postalcode'=>'','paymenttype'=>''];
?>   
<?php 
    include('db_connect.php');
    $query = "select * from registration where email = '{$_SESSION['user']}'";
    $result = mysqli_query($conn,$query); 
    if($result){
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $phone = '0'.$row['phone'];
    }

    if(isset($_POST['submit'])){

        if(empty($_POST['name'])){
            $error['name']='Name should not be empty';
        }
        else{
            $name=mysqli_real_escape_string($conn,$_POST['name']);
        }
        
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

        if(empty($_POST['streetaddress'])){
            $error['streetaddress']='Street Address should not be empty';
        }
        else{
            $streetaddress=mysqli_real_escape_string($conn,$_POST['streetaddress']);
        }

        if(empty($_POST['city'])){
            $error['city']='City should be selected';
        }
        else{
            $city=mysqli_real_escape_string($conn,$_POST['city']);
        }

        if(empty($_POST['postalcode'])){
            $error['postalcode']='Postal code should not be empty';
        }
        else{
            $postalcode=mysqli_real_escape_string($conn,$_POST['postalcode']);
        }
        if(empty($_POST['check'])){
            $error['paymenttype']='Payment type should be selected';
        }

        if(!$error['name']='' && !$error['email']='' && !$error['phone']='' && !$error['streetaddress']='' &&
           !$error['city']='' && !$error['postalcode']='' && !$error['paymenttype']=''){

            $query1 = "select cart.cart_id,cart.d_id,cart.quantity,dishes.name,dishes.price,dishes.r_id from cart,dishes where cart.d_id = dishes.d_id and cart.customer_id = '{$_SESSION['user']}'";
            $result1 = mysqli_query($conn,$query1);
            if($result1){
                while($row = mysqli_fetch_array($result1)){
                    $cart_id = $row[0];
                    $d_id = $row[1];
                    $quantity = $row[2];
                    $dish_name = $row[3];
                    $price = $row[4];
                    $r_id = $row[5];
                    date_default_timezone_set("Asia/Dhaka");
                    $date = date("Y-m-d h:i:sa");
                    $query2 = "insert into orders(u_id,d_id,d_name,quantity,price,date,streetaddress,city,postalcode,r_id)
                                values('{$_SESSION['user']}','$d_id','$dish_name','$quantity','$price','$date','$streetaddress','$city','$postalcode','$r_id')"; 

                    $result2 = mysqli_query($conn,$query2);
                    if($result2){
                        echo "Order Successfull";

                        $query3 = "delete from cart where cart_id = '$cart_id'";
                        $result3 = mysqli_query($conn,$query3);
                        $_POST = array();
                        // unset($streetaddress);
                        // unset($city);
                        // unset($postalcode);
                    }
                   


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
    <link rel="stylesheet" href="order.css">
    <title>Document</title>
</head>
<body>
    <section>
        <form action="" method=post>
            <h1>Payment <span style="color:#ff3838">Form</span></h1>
            <lebel style="color:gray">Name</lebel>
            <input type="text" name="name" value="<?php echo $name?>"><br>
            <span class="text-danger"><small><?php echo $error['name']?></small></span><br>
            <lebel style="color:gray">Email</lebel>
            <input type="text" name="email" value="<?php echo $email?>"><br>
            <span class="text-danger"><small><?php echo $error['email']?></small></span><br>
            <lebel style="color:gray">Phone</lebel>
            <input type="text" name="phone" value="<?php echo $phone?>"><br>
            <span class="text-danger"><small><?php echo $error['phone']?></small></span><br>
            <lebel style="color:gray">Street Address</lebel><br>
            <input type="text" name="streetaddress" value="<?php if(isset($streetaddress)) echo $streetaddress?>"><br>
            <span class="text-danger"><small><?php echo $error['streetaddress']?></small></span><br>
            <lebel style="color:gray">City Name</lebel><br>
            <select name="city" id="">
                <option value="">--Select Your City--</option>
                <option value="rajshahi">Rajshahi</option>
                <option value="dhaka">Dhaka</option>
                <option value="sylhet">Sylhet</option>
                <option value="chattogram">Chattogram</option>
                <option value="khulna">Khulna</option>
                <option value="barisal ">Barisal </option>
            </select><br>
            <span class="text-danger"><small><?php echo $error['city']?></small></span><br>
            <lebel style="color:gray">Postal Code</lebel><br>
            <input type="number" name="postalcode" value="<?php if(isset($postalcode)) echo $postalcode?>"><br>
            <span class="text-danger"><small><?php echo $error['postalcode']?></small></span><br>
            <input type="radio"  name="check"><span style="color:green">Cash On delivery</span><br>
            <span class="text-danger"><small><?php echo $error['paymenttype']?></small></span><br>
            <input type="submit" style="margin-top:20px" name="submit" value="Order">
        </form>
    </section>
</body>
</html>
<?php include("footer.php")?>
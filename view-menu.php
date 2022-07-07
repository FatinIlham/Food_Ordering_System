<?php include('navbar.php')?>
<?php 
    include('db_connect.php');
    if(!isset($_GET['id'])){
        header('location:restaurent.php');
    }

    $id = $_GET['id'];
    $query = "select * from dishes where r_id='$id'";
    $result = mysqli_query($conn,$query);
    
    $query1="select * from restaurant where r_id = '$id'";
    $result1 = mysqli_query($conn,$query1);
    if($result1){
        $row1= mysqli_fetch_assoc($result1);
        $res_name=$row1['name'];
        $res_address=$row1['address'];
        $res_image = $row1['img'];
        $res_open = $row1['o_days'];

    }
    if(isset($_POST['addcart']) && isset($_SESSION['user'])){
        $f_id = $_POST['food_id'];
        $user = $_SESSION['user'];
        $queryy = "select * from cart where d_id='$f_id' and customer_id='$user'";
        $resultt = mysqli_query($conn,$queryy);
        if(mysqli_num_rows($resultt)<=0){
            $query2 = "insert into cart(d_id,customer_id,quantity) values('$f_id','$user',1)";
            $result2 = mysqli_query($conn,$query2);
            if($result2){
               // echo "<center>Added to your cart</center>";
                header('location:cart.php');
            }
        }
        else{
            $query3 = "update cart 
                        set quantity = ((select quantity from cart where d_id='$f_id' and customer_id='$user')+1)
                        where d_id='$f_id' and customer_id='$user'";
            $result3 = mysqli_query($conn,$query3);
            if($result3){
                header('location:cart.php');
            }   
        }
        
    }
    if(isset($_POST['addcart']) && !isset($_SESSION['user'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view-menu.css">
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Menu of <?php echo $res_name?></h1>
        <div class="res-info">
            <img src="upload/<?php echo $res_image?>" alt="">
            <div class="res-details">
                <h3><?php echo $res_name?></h3>
                <p>Opening Days: <?php echo $res_open?></p>
                <p>Address: <?php echo $res_address?></p>
            </div>
        </div>
        <div class="food-row">
            <?php 
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                        $food_name=$row['name'];
                        $food_price = $row['price'];
                        $food_about = $row['about'];
                        $food_image = $row['img'];
                        $food_id = $row['d_id'];
                        ?>
                        <div class="food-card">
                        <div class="food-image">
                            <img src="upload/<?php echo $food_image?>" alt="">
                        </div>
                        <div class="fdiv">
                            <div class="food-name">
                                <?php echo $food_name?>
                            </div>
                            <div class="food-price">
                                <?php echo $food_price?>
                            </div>
                        </div>
                        
                        <div class="food-about">
                            <?php echo $food_about?>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="food_id" value="<?php echo $food_id?>">
                            <input type="submit" value="Add to cart" name="addcart">
                        </form>
                        
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
        
    </section>
    
</body>
</html>
<?php include('footer.php')?>
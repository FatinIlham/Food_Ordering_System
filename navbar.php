<?php 
    session_start();

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Document</title>
</head>
<body>
<nav>
    <div class="logo">F<span style="color:#ff3838">O</span>S</div>
        <ul id="ul">
            <li><a href="index.php">Home</a></li>
            <li><a href="restaurent.php">Restaurents</a></li>
            <?php 
                if(isset($_SESSION['user'])){
                    include('db_connect.php');
                    $cid = $_SESSION['user'];
                    $query = "select * from cart where customer_id = '$cid'";
                    $result = mysqli_query($conn,$query);
                    if($result){
                        $num = mysqli_num_rows($result);
                    }
                ?>
                    <li class="drop"><a href="#"><i class="fas fa-user"></i> <?php echo $_SESSION['user'] ?></a>
                        <ul class="drop-down">
                            <li><a href="order_details.php"><i class="fas fa-utensils"></i> Orders</a></li>
                            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li><a href="cart.php" id="c"><i class="fas fa-shopping-cart"></i> My Cart <span id="count-cart"><?php echo $num?></span></a></li>
                <?php 
                }
                else{
                ?>
                    <li><a href="register.php">Sign up</a></li>
                    <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Sign in</a></li>
                <?php
                }
            ?>
        
        </ul>
        <div class="toggol" onclick="tog()">
            <div style="width:20px; height:3px; background:black; margin-bottom:5px"></div>
            <div style="width:20px; height:3px; background:black;margin-bottom:5px"></div>
            <div style="width:20px; height:3px; background:black;margin-bottom:5px"></div>
        </div>
    </nav>
    
    <script>
        function tog(){
            var element = document.getElementById("ul");
            element.classList.toggle("active");
        }
    </script>

</body>
</html>
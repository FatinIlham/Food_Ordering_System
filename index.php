<?php 
    include "db_connect.php";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">

    <title>Home page</title>
</head>
<body>
    <!-- navigation -->
    <?php include "navbar.php" ?>
    <div class="header">
        <div class="title">
            <h1>Hungry??</h1>
            <P>Good, we are here to serve you</P>
            
                <form action="">
                    <div class="search-food">
                    <input type="search" name="searchfood" placeholder="Search Foods">
                    <input type="submit" name="submit_search" value="Search">
                    </div>
                </form>
        </div>
        <div class="overlay"></div>
    </div>

    <!-- Category -->
    <div class="category">
        <h1>All Categories</h2>
        <div class="category-row">
            <div class="category-food">
                <img src="img/Category/burger.png" alt="">
                <p>Burger</p>
            </div>
            <div class="category-food">
                <img src="img/Category/chicken.png" alt="">
                <p>Chicken</p>
            </div>
            <div class="category-food">
                <img src="img/Category/pizza.png" alt="">
                <p>Pizza</p>
            </div>
            <div class="category-food">
                <img src="img/Category/barbecue.png" alt="">
                <p>BBQ</p>
            </div>
            <div class="category-food">
                <img src="img/Category/sandwich.png" alt="">
                <p>Sandwitch</p>
            </div>
            
        </div>
    </div>

    <!-- Most Popular Restaurents -->
    <section>
        <h1>Popular Restaurents</h1>
        <div class="row">
            <?php 
                $query = "select * from restaurant order by r_id desc";
                $result = mysqli_query($conn,$query);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        $image = 'upload/'.$row['img'];
                        $name = $row['name'];
                        $address = $row['address'];
                        $o_hr = $row['o_hr'];
                        $c_hr = $row['c_hr'];
                        $r_id = $row['r_id'];
                        ?>
                        <div class="restaurant-card">
                            <div class="res-img">
                                <img src="<?php echo $image ?>" alt="">
                            </div>
                            <div class="res-info">
                                <div class="res-name">
                                    <?php echo $name ?>
                                </div>
                                <div class="res-address">
                                    <?php echo $address ?>
                                </div>
                                <div class="res-time">
                                    <?php echo $o_hr.'-'.$c_hr ?>
                                </div>
                            
                                <div class="res-button">
                                    <a href="view-menu.php?id=<?php echo $r_id?>">View Menu</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
      
    </section>
        

    <!-- Food Order ways -->
    <div class="ways">
        <h1>Easy 3 Steps To Follow</h1>
        <p>The easiest way to your food. Food Ordering System provides fresh delivery with in the 30 minutes and<br>provide free food if order is not on time. So don't wait and start ordering right now!</p>
        <div class="ways-row">
            <div class="ways-item">
                <img src="img/fork.png" alt="">
                <h3>Choose A Restaurant</h3>
                <p>First thing you can do is choose from our restautant partners easily!</p>
            </div>
            <div class="ways-item">
                <img src="img/fast-food.png" alt="">
                <h3>Choose A Tasty Dish</h3>
                <p>We've got you covered with menus from over various delivery restaurants online!</p>
            </div>
            <div class="ways-item">
                <img src="img/checkmark.png" alt="">
                <h3>Pick Up or Delivery</h3>
                <p>After all, the food gets delivered or you can pick it up as per your choices!</p>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>
</html>
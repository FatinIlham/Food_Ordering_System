<?php 
    
    include "navbar.php";
    include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="restaurent.css">
   
    <title>Restaurants</title>
</head>
<body>
    <section>
        <h1>Restaurents</h1>
        <div class="row">
            <?php 
                $query = "select * from restaurant";
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
    <?php include "footer.php" ?>
</body>
</html>

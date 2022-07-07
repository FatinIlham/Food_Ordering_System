
<?php 
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location:admin-login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php include "admin-nav.php"; ?>
    <section>
        <div class="row-records">
            <div class="card-records">
                <img src="../img/admin-img/users.png" alt="">
                <div class="card-records-info">
                    <div class="card-num">10</div>
                    <div class="card-type">User/s</div>
                </div>
            </div>
            <div class="card-records">
                <img src="../img/admin-img/restaurant.png" alt="">
                <div class="card-records-info">
                    <div class="card-num">10</div>
                    <div class="card-type">Restaurant/s</div>
                </div>
            </div>
            <div class="card-records">
                <img src="../img/admin-img/dish.png" alt="">
                <div class="card-records-info">
                    <div class="card-num">10</div>
                    <div class="card-type">Dishes/s</div>
                </div>
            </div>
            <div class="card-records">
                <img src="../img/admin-img/orders.png" alt="">
                <div class="card-records-info">
                    <div class="card-num">10</div>
                    <div class="card-type">Total<br>Order/s</div>
                </div>
            </div>
            <div class="card-records">
                <img src="../img/admin-img/pending.png" alt="">
                <div class="card-records-info">
                    <div class="card-num">10</div>
                    <div class="card-type">pending<br>Orders</div>
                </div>
            </div>
            <div class="card-records">
                <img src="../img/admin-img/delivered.png" alt="">
                <div class="card-records-info">
                    <div class="card-num">10</div>
                    <div class="card-type">Delivered<br>Orders</div>
                </div>
            </div>
            <div class="card-records">
                <img src="../img/admin-img/remove.png" alt="">
                <div class="card-records-info">
                    <div class="card-num">10</div>
                    <div class="card-type">Rejected<br>Orders</div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include "../footer.php" ?>
</body>
</html>
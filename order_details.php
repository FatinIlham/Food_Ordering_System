<?php include('navbar.php')?>
<?php 
    include('db_connect.php');
    $query = "select * from orders where u_id = '{$_SESSION['user']}' and status!='Cancel'";
    $result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="order_details.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Recent Orders</h1>
        <div class="table-responsive res-table">
            <table class="table table-striped table-bordered align-middle">
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                <?php 
                    if($result){
                        while($row = mysqli_fetch_array($result)){
                            $item = $row['d_name'];
                            $quantity = $row['quantity'];
                            $price = $row['price'];
                            $status = $row['status'];
                            $order_date = $row['date'];
                            ?>
                            <tr>
                                <td><?php echo  $item ?></td>
                                <td><?php echo  $quantity ?></td>
                                <td><?php echo  $price ?></td>
                                <td><?php echo  $status ?></td>
                                <td><?php echo  $order_date ?></td>
                                <td><a href="" class="btn btn-danger btn-sm">Cancel</a></td>
                            </tr>
                            <?php
                        }
                    }
                
                ?>
                
            </table>
        </div>
        
    </section>
</body>
</html>
<?php include('footer.php')?>
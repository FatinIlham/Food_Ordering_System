<?php 
    include("../db_connect.php");
    $query = "select * from orders";
    $result = mysqli_query($conn,$query);

?>
<?php include("admin-nav.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manage-orders.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Order details</h1>
            <div class="table-responsive res-table">
                <table class="table table-striped table-bordered align-middle">
                    <tr>
                        <th>User</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Order date</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            $user = $row['u_id'];
                            $item = $row['d_name'];
                            $qty = $row['quantity'];
                            $price = $row['price'];
                            $address = $row['streetaddress'];
                            $status = $row['status'];
                            $order_date = $row['date'];
                        
                        ?>
                        
                            <tr>
                                <td><?php echo $user?></td>
                                <td><?php echo $item?></td>
                                <td><?php echo $qty?></td>
                                <td><?php echo $price?></td>
                                <td><?php echo $address?></td>
                                <td><?php echo $status?></td>
                                <td><?php echo $order_date?></td>
                                <td>
                                    <a href="" class="btn btn-info btn-sm">Process</a>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php  
                        }  
                    }
                    ?>
                    
                </table>
    </section>
</body>
</html>
<?php include("../footer.php")?>
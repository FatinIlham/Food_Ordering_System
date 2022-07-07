<?php include('admin-nav.php') ?>
<?php
    include('../db_connect.php');
    $query = "select dishes.name,dishes.about,restaurant.name,dishes.price,dishes.img,dishes.d_id from dishes,restaurant where dishes.r_id = restaurant.r_id";
    $result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manage-menu.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Available Food's/s</h1>
        <div class="table-responsive res-table">
            <table class="table table-striped table-bordered align-middle">
                <tr>
                    <th>FoodName</th>
                    <th>About</th>
                    <th>RestaurentName</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result)){
                            
                            $f_name = $row[0];
                            $about = $row[1];
                            $r_name = $row[2];
                            $price =$row[3];
                            $img = $row[4];
                            $d_id = $row[5];
                            
                        ?>

                            <tr>
                                <td><?php echo $f_name?></td>
                                <td><?php echo $about?></td>
                                <td><?php echo $r_name?></td>
                                <td><?php echo $price?></td>
                                <td><img src="../upload/<?php echo $img?>" alt=""></td>
                                
                                <td>
                                    <a href="edit-menu.php?id=<?php echo $d_id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="delete-menu.php?id=<?php echo $d_id ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
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
<?php include('../footer.php')?>
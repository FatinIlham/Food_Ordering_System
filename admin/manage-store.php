<?php include("admin-nav.php") ?>
<?php 
    include("../db_connect.php");
    $query = "select * from restaurant";
    $result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manage-store.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Available Restaurent/s</h1>
        <div class="table-responsive res-table">
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Website</th>
                    <th>Open Hrs</th>
                    <th>Close Hrs</th>
                    <th>Open days</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                <?php
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['r_id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $url = $row['url'];
                            $o_hr = $row['o_hr'];
                            $c_hr = $row['c_hr'];
                            $o_days = $row['o_days'];
                            $address= $row['address'];
                        ?>

                            <tr>
                                <td><?php echo $name?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $phone?></td>
                                <td><?php echo $url?></td>
                                <td><?php echo $o_hr?></td>
                                <td><?php echo $c_hr?></td>
                                <td><?php echo $o_days?></td>
                                <td><?php echo $address?></td>
                                <td>
                                    <a href="edit-store.php?id=<?php echo $id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="delete-store.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm">Delete</a>
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

<?php include("../footer.php") ?>
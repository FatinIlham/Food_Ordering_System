<?php include("admin-nav.php") ?>
<?php 
    include("../db_connect.php");
    $query = "select * from registration";
    $result = mysqli_query($conn,$query);
    $c = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="users.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Available Users/s</h1>
        <div class="table-responsive res-table">
            <table class="table table-striped table-bordered">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Contact</th>
                </tr>
                <?php
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            $name = $row['name'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                        ?>

                            <tr>
                                <td><?php $c+=1; echo $c ?></td>
                                <td><?php echo $name?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $phone?></td>
                            
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
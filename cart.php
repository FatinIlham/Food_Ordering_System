<?php include('navbar.php')?>
<?php 
    include('db_connect.php');
    if(!$_SESSION['user']){
        header('location:index.php');
    }
    $_SESSION['cart'] = array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="cart.css">
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Food Cart</h1>
        <?php 
            if(isset($_SESSION['user'])){
                $query = "select cart.cart_id,cart.d_id,cart.customer_id,dishes.r_id,dishes.name,dishes.price,cart.quantity,dishes.img,dishes.d_id
                      from cart,dishes where cart.d_id = dishes.d_id and customer_id='{$_SESSION['user']}'";
                $result = mysqli_query($conn,$query);
            }
        ?>
        <div class="table-responsive res-table">
            <table class="table table-striped align-middle">
                <tr>
                    <th>Image</th>
                    <th>Dish</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
                <?php
                    if(mysqli_num_rows($result)>0){
                        $total = 0;
                        while($row = mysqli_fetch_array($result)){
                            $cart_id = $row[0];
                            $dish_name = $row[4];
                            $price = $row[5];
                            $quantity = $row[6];
                            $subt = $price*$quantity;
                            $total += $subt;
                            $img = 'upload/'.$row[7];
                            $dish_id = $row[8];

                        ?>
                            <tr class="box-out">
                                <td><img src="<?php echo $img?>" alt="" width="100px"></td>
                                <td><?php echo $dish_name?></td>
                                <td><?php echo $price?></td>
                                <td class="box">
                                    <form method="post" action="update_cart_item.php">
                                    <input type="number" min="1" name="q" value="<?php echo $quantity?>" class="inputfld">
                                    <input type="hidden" value="<?php echo $cart_id?>" name="id">

                                </td> 
                                    
                                <td id="sub-total"><?php echo $subt?></td>
                                <td><input class="btn btn-info btn-sm" type="submit" value="Update">
                                    </form>
                                    <a href="cancel_cart_item.php?id=<?php echo $cart_id?>" class="btn btn-danger btn-sm">Cancel</a></td>
                            </tr>
                        <?php
                        }?>
                        <tr><td colspan="5" style="text-align:right"><h3>Total = <?php echo $total?></h3></td>
                            <td></td></tr>
                        <?php
                    }
                    else{
                        ?><tr><td colspan="6"><h1>Cart is Empty</h1></td></tr><?php
                    }
                ?>
              
            </table>
        </div>
        <div style="display:flex; justify-content:flex-end;">
            <a 
                <?php
                if($num>0){
                    ?> href="order.php"<?php
                }
                else{
                    ?> href="cart.php"<?php
                }                
                ?>
                class="btn btn-success">Check Out &#10095;</a>
        </div>
        
        <?php
          
        ?>
        </section>
    <script>
        // let dec_btn = document.getElementsByClassName("dec-btn");
        // let inc_btn = document.getElementsByClassName("inc-btn");
        

        // for(var i=0; i < inc_btn.length; i++){
        //     var button = inc_btn[i];
            
        //     button.addEventListener('click',function(event){
        //         var buttonClicked = event.target;
        //         var input = buttonClicked.parentElement.children[1];
        //         var inputValue = input.value;
        //         var newValue = parseInt(inputValue) + 1;
        //         var subinput = buttonClicked.parentElement.parentElement.children[4];
        //         var perPrice = buttonClicked.parentElement.parentElement.children[2];
        //         var subValue = perPrice.innerHTML;
        //         subinput.innerHTML = newValue * parseInt(subValue);
        //         input.value = newValue;

        //     })
        // }

        // for(var i=0; i < dec_btn.length; i++){
        //     var button = dec_btn[i];
        //     button.addEventListener('click',function(event){
        //         var buttonClicked = event.target;
        //         var input = buttonClicked.parentElement.children[1];
        //         var inputValue = input.value;
        //         var newValue = parseInt(inputValue) - 1;
        //         if(newValue >0){
        //             var subinput = buttonClicked.parentElement.parentElement.children[4];
        //             var perPrice = buttonClicked.parentElement.parentElement.children[2];
        //             var subValue = perPrice.innerHTML;
        //             subinput.innerHTML = newValue * parseInt(subValue);
        //             input.value = newValue;
        //         }
        //     })
        // }
    </script>
</body>
</html>
<?php include('footer.php')?>
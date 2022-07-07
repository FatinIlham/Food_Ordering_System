<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <title>Document</title>
</head>
<body>
<nav>
    <div class="logo" onclick="location.href='home.php'">F<span style="color:#ff3838">O</span>S</div>
        <ul id="ul">
            <li><a href="users.php">Users</a></li>
            <li class="drop"><a href="#">Store</a>
                <ul class="drop-down">
                    <li><a href="add-store.php">Add Store </a></li>
                    <li><a href="manage-store.php">Manage Store</a></li>
                </ul>
            </li>
            <li class="drop"><a href="#">Menu</a>
                <ul class="drop-down">
                    <li><a href="create-menu.php">Create menu</a></li>
                    <li><a href="manage-menu.php">Manage menu</a></li>
                </ul>
            </li>
            <li><a href="manage-orders.php">Orders</a></li>
            <li><a href="admin-logout.php">Logout</a></li>
        
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
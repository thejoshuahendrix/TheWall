<!DOCTYPE html>
<html>

<head>
    <script src="https://use.fontawesome.com/4069a288de.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./layout/template.css"> 
</head>

<body>

    <nav>
        <div class="logo">The Wall</div>

        <ul class="nav-links">

            <li> <a href="userposts.php">The Wall</a> </li>
            <div class="dropdown">Account
            <div class="dropdown-content">
            <br>
            <?php if(!isset($_SESSION['Username'])){ ?>
            <li> <a href="index.php">Login</a> </li>
            <br>
            <li> <a href="newuser.php">Register</a> </li>
            <br>
            <?php }else{ ?>
                <li><a href="logout.php">Logout</a></li>
                <br>
                <?php } ?>
                <li><a href="about.php">About</a></li>
                <br>
            </div>
            </div>

        </ul>
    </nav>
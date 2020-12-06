<?php
include "base.php";
include "./layout/header.php"
?>

<div id="main">

    <?php
    if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) { //When a user logged in successfully.


    ?>
        <center>
            <h1>The Wall</h1>
        </center>
        <br>
        <p>Thanks for visiting the wall!</p><br>
            <br>
            <h2>Thanks for logging in!<br><br>
                You are <code><?= $_SESSION['Username'] ?></code> <br><br>
                Email address is <code><?= $_SESSION['EmailAddress'] ?></code>.</h2>
            <br><br>
            <p><a href="logout.php">Logout</a></p>


        <?php

    } elseif (!empty($_POST['username']) && !empty($_POST['password'])) { //When a user is logging infirst time.


        $username =  $conn->real_escape_string($_POST['username']);
        $password = md5($conn->real_escape_string($_POST['password']));
        $query = "SELECT * FROM users2 WHERE Username = '" . $username . "' AND Password = '" . $password . "'";
        $result =  $conn->query($query);
        if (!$result) echo "<p>Error in database query</p>";


        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $email = $row['Email'];
            $_SESSION['Username'] = $username;
            $_SESSION['EmailAddress'] = $email;
            $_SESSION['LoggedIn'] = 1;
            echo "<h1>Success</h1>";
            echo "<a href='index.php'>Click here to go to members area.</a>";
        } else {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
        }
    } else { //When a user is comingfirst time.  →Notlogged in.
        ?>

            <center>
                <h1>The Wall</h1>
            </center>
            <br>
            <p>Thanks for visiting the wall!<br>
                <br>
                The Wall is a social media platform that uses text only posts.<br>
                Everyone can see everyone's post<br>
                Please either login below,<br>
                or click <a href="newuser.php">here</a> to register.</p>
            <form method="post" action="index.php" name="loginform" id="loginform">
                <fieldset>
                    <label for="username">Username:</label><br>
                    <input type="text" name="username" id="username" />
                    <br><br>
                    <label for="password">Password:</label><br><br>
                    <input type="password" name="password" id="password" />
                    <br>
                    <input type="submit" name="login" id="login" value="Login" />
                </fieldset>
            </form>
        <?php
    } // End of if
        ?>
</div>
<?php
include "./layout/footer.php"
?>
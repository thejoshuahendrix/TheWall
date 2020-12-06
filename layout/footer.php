<footer>

        <ul class="nav-links">
        <li> <a href="userposts.php">The Wall</a> </li>
            <div class="dropup">Account
            <div class="dropup-content">
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


</footer>
</body>

</html>
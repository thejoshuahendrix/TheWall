<?php
include "base.php";
include "./layout/header.php"
?>
<div id="main">
    <?php
    //If user is logged in
    if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
        //if user is editing a post
        if (isset($_POST['editpost']) && isset($_POST['editcontent'])) {
            editPost($_POST['id'], $_POST['editcontent']);
        }
        //if user is adding a post
        if (isset($_POST['description'])) {
            addPost();
        }
        //if a user is deleting post
        if (isset($_POST['del'])) {
            delPost($_POST['id']);
        }
        echo "<center><h1><span style='color:blue'>User: </span>" . $_SESSION['Username'] . "</h1></center>";

        //grab all posts from database to print on page
        $query = "SELECT * FROM posts";
        $result =  $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $post = array(
                'id' => $row['PostID'],
                'username' => $row['Username'],
                'desc' => $row['PostContent'],
                'date' => $row['PostDate']
            );
            $posts[] = $post;
        } ?>
        <div class="centerbox">


            <div class="card">
                <div class="posthead title">
                    <div>
                        Add A post
                    </div>
                    <div>Name:<?php echo htmlspecialchars($_SESSION['Username']); ?></div>
                    <div class="date">Now</div>
                </div>
                <form method="post" action="userposts.php">
                    <textarea type="text" name="description" rows="5" cols="50" name="description"></textarea>
                    <button type="submit"><i style="color:green;font-style:normal;" class="fa-save fa-2x"></i></button>
                </form>
            </div>

<!-- Print all Posts,  -->
            <?php foreach (array_reverse($posts) as $post) :
                $date = date_create_from_format("Y-m-d H:i:s", $post['date']); ?>
                <div class="card">
                    <?php
                    $postid = $post['id'];
                    echo "<div class='posthead title' id='$postid'>";
                    ?>
                    <div>ID: <?php echo htmlspecialchars($postid); ?> </div>
                    <div>Name: <?php echo htmlspecialchars($post['username']); ?> </div>
                    <div class="date"><?php echo htmlspecialchars(date_format($date, 'g:ia \o\n l M jS Y')); ?> </div>

                </div>
                <ul>
                    <!-- If post edit button clicked display edit form,  -->

                    <?php
                    if (isset($_POST['edit']) && isset($_POST['id']) && $_POST['id'] == $postid && !isset($_POST['editcontent'])) {
                    ?>
                        <form action="userposts.php" method="post">
                            <textarea name="editcontent" cols="50" rows="5"></textarea>
                            <button type="submit" ' name="editpost"><i style="color:green;font-style:normal;" class="fa-save fa-2x"></i></button>
                            <button type="submit" ' name="cancel"><i style="color:red;font-style:normal;" class="fa-minus-circle fa-2x"></i></button>
                            <input type="hidden" name="id" value="<?php echo $postid ?>">
                        </form>
                </ul>
            <?php
                    } else { ?>
                <li style="list-style:disc"><?php echo htmlspecialchars($post['desc']); ?></li>
                </ul>
                 <!-- If post is owned by user give them option buttons,  -->
            <?php
                    }
                    if ($_SESSION['Username'] == $post['username'] && !isset($_POST['edit'])) { ?>
                <form class="delete" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <button type="submit" name="edit"><i style="color:blue;font-style:normal;" class="fa-edit fa-2x"></i></button>
                    <button type="submit" name="del"><i style="color:red;font-style:normal;" class="fa-times fa-2x"></i></button>
                    <input type="hidden" name="id" value="<?php echo $postid ?>">
                </form>
            <?php
                    }
            ?>
        </div>
<?php endforeach;
        } else {
            ?>
             <center>
                <h1>The Wall</h1>
            
            <br>
            <p>Thanks for visiting the wall!<br>
                <br>
                The Wall is a social media platform that uses text only posts.<br><br>
                Everyone can see everyone's post<br><br>
                You must be logged in to enjoy the features of the Wall<br><br>
                <br>
                Please either click <a href="index.php">here</a> to login,<br>
                or click <a href="newuser.php">here</a> to register.</p>
                </center>
            <?php
        }

//DB FUNCTIONS
        function addPost()
        {
            global $conn;
            $timestamp = date("Y-m-d H:i:s");
            $query = "INSERT INTO posts(PostId,Username,PostContent,PostDate) VALUES(NULL, '" . $_SESSION['Username'] . "','" . $_POST['description'] . "','" . $timestamp . "') ";
            if (mysqli_query($conn, $query)) {
                echo "New post added successfully";
                header("Refresh:0");
            } else {
                echo "Error!";
            }
        }
        function delPost($postid)
        {
            global $conn;
            $query = "DELETE FROM posts WHERE PostID = " . $postid;
            if (mysqli_query($conn, $query)) {
                echo "Post deleted successfully";
                header("Refresh:0");
            } else {
                echo "Error!";
            }
        }
        function editPost($postid, $content)
        {
            global $conn;
            $query = "UPDATE posts SET PostContent = '" . $content . "' WHERE PostID = '" . $postid . "'";
            if (mysqli_query($conn, $query)) {
                echo "Post updated successfully";
                sleep(1);
                header("Refresh:0");
            } else {
                echo "Error!";
            }
        }
?>

</div>
</div>
<?php
include "./layout/footer.php"
?>
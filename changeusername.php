<?php
include "base.php";
include "./layout/header.php";

if ($_POST['newusername']) {

    $oldusername = $_SESSION['Username'];
    $newusername = $_POST['newusername'];
    

    $query = "SELECT * FROM users2 WHERE Username = '" . $newusername . "'";
    $result =  $conn->query($query);
    if (!$result) {
        echo "<p>Error in database query</p>";
    }
    if ($result->num_rows == 1) {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
    } else {
        $query = "UPDATE users2 SET Username='$newusername' WHERE Username='$oldusername'";
        if (mysqli_query($conn, $query)) {
            $_SESSION['Username'] = $newusername;
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>
<form method="post" action="changeusername.php">
    <label for="newusername">Input new Username</label><input type="text" name="newusername">
    <input type="submit">
</form>
<?php
include "./layout/footer.php"
?>
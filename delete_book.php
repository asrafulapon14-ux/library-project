<?php
include "db.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM books WHERE id='$id'";
    mysqli_query($conn, $query);
}

header("Location: book_list.php");
exit();
?>
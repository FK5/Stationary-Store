<?php
    session_start();
    require_once('db.php');
    $user_id=$_GET['userId'];

    $sql = "DELETE FROM user WHERE user_id=".$user_id."";
    if (mysqli_query($conn, $sql)) {
        header('Location:../html/admin/index.php');
      } else {
        header('Location:../html/admin/index.php');
      }

?>

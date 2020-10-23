<?php
    session_start();
    require_once('db.php');
    $user_id=$_GET['userId'];

    $sql = "UPDATE user SET access=0 WHERE user_id=".$user_id."";
    if (mysqli_query($conn, $sql)) {
        header('Location:../html/admin/index.php');
      } else {
        header('Location:../html/admin/index.php');
      }

?>

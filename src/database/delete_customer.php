<?php
    session_start();
    require_once('db.php');
    $user_id=$_GET['userId'];

    $sql = "DELETE FROM customer WHERE user_id=".$user_id."";
    if (mysqli_query($conn, $sql)) {
        header('Location:../html/manager/index.php');
      } else {
        header('Location:../html/manager/index.php');
      }

?>

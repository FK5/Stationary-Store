<?php
    session_start();
    require_once('db.php');
    $user_id=$_GET['userId'];

    $sql = "UPDATE user SET access=0 WHERE user_id=".$user_id."";
    if (mysqli_query($conn, $sql)) {
      switch ($_SESSION['role']) {
        case 1:
          header('Location:../html/admin/index.php');
          break;
        case 2:
        header('Location:../html/manager/employees.php');
          break;
      }

      } else {
        switch ($_SESSION['role']) {
          case 1:
            header('Location:../html/admin/index.php');
            break;
          case 2:
          header('Location:../html/manager/employees.php');
            break;
        }
      }

?>

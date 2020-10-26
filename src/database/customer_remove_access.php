<?php
    session_start();
    require_once('db.php');
    $customer_id=$_GET['userId'];

    $sql = "UPDATE customer SET access=0 WHERE customer_id=".$customer_id."";
    if (mysqli_query($conn, $sql)) {
      switch ($_SESSION['role']) {
        case 2:
          header('Location:../html/manager/index.php');
          break;
        case 3:
          header('Location:../html/employee/index.php');
          break;
        }
      } else {
        switch ($_SESSION['role']) {
          case 2:
            header('Location:../html/manager/index.php');
            break;
          case 3:
            header('Location:../html/employee/index.php');
            break;
      }
    }

?>

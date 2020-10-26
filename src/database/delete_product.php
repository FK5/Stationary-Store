<?php
    session_start();
    require_once('db.php');
    $product_id=$_GET['productId'];

    $sql = "DELETE FROM product WHERE product_id=".$product_id."";
    if (mysqli_query($conn, $sql)) {
      switch ($_SESSION['role']) {
        case 2:
          header('Location: ../html/manager/products.php');
          break;
        case 3:
          header('Location: ../html/employee/products.php');
          break;
        }
      }else {
        switch ($_SESSION['role']) {
          case 2:
            header('Location: ../html/manager/products.php');
            break;
          case 3:
            header('Location: ../html/employee/products.php');
            break;
      }
    }

?>

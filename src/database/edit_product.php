<?php
    session_start();
    require_once('db.php');

    if(empty($_POST['pname'])){
      switch ($_SESSION['role']) {
        case 2:
          header('Location: ../html/manager/products.php');
          break;
        case 3:
          header('Location: ../html/employee/products.php');
          break;
      }

    }else{

    $product_id = $_GET['productId'];

    $product_name=$_POST['pname'];
    $cost_price=$_POST['cprice'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $barcode=$_POST['barcode'];
    $quantity=$_POST['quantity'];

    $sql = "UPDATE product SET product_name='".$product_name."', cost_price='".$cost_price."',
     price='".$price."', description='".$description."', barcode='".$barcode."', quantity='".$quantity."'
     WHERE product_id=$product_id";
    if(mysqli_query($conn, $sql)){
      switch ($_SESSION['role']) {
        case 2:
          header('Location: ../html/manager/products.php');
          break;
        case 3:
          header('Location: ../html/employee/products.php');
          break;
      }
    }else{echo "error";}
  }

?>

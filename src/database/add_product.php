<?php
    session_start();
    require_once('db.php');

    if(empty($_POST['pname']) || empty($_FILES['productImage'])){
      switch ($_SESSION['role']) {
        case 2:
          header('Location: ../html/manager/products.php');
          break;
        case 3:
          header('Location: ../html/employee/products.php');
          break;
      }

    }else{

    $product_name=$_POST['pname'];
    $cost_price=$_POST['cprice'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $barcode=$_POST['barcode'];
    $quantity=$_POST['quantity'];

    $target_dir = "../assets/images/products/";
    $new_file_name = $product_name.".jpg";
    $target_file= $target_dir.$new_file_name;
    move_uploaded_file($_FILES["productImage"]["tmp_name"],$target_file);

    $image_url="{\"path\":\"".$new_file_name."\"}";

    $sql = "INSERT INTO product (product_name, cost_price, price, description, barcode, quantity, image_url)
    VALUES ('".$product_name."','".$cost_price."','".$price."','".$description."','".$barcode."','".$quantity."','".$image_url."')";
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

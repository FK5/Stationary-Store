<?php
    session_start();
    require_once('./db.php');

    if(!isset($_SESSION['id'])){
      header('Location: ../authentication-login1.php');
    }

    if($_SESSION['role']!=3 || empty($_SESSION['role'])){
      header('Location: ../html/error.html');
    }

    $product_id = $_POST['productId'];
    $sql = "SELECT * FROM product WHERE product_id=".$product_id."";
    $query_result = mysqli_query($conn, $sql);
    while($record = mysqli_fetch_assoc($query_result)) {
      $product_info[] = $record;
    }
    $product_name=$product_info[0]['product_name'];

    if(!empty($_FILES["newImage"])){
      // print_r($_FILES["newImage"]);
      $target_dir = "../assets/images/products/";
      $new_file_name = $product_name.".jpg";
      $target_file= $target_dir.$new_file_name;
      move_uploaded_file($_FILES["newImage"]["tmp_name"],$target_file);
      // print_r($target_file);
      $sql = "UPDATE product SET image_url='{\"path\":\"".$new_file_name."\"}' WHERE product_id=".$product_id."";
      if (mysqli_query($conn, $sql)) {
        // echo "Record updated successfully";
        header('Location: ../html/employee/products.php');
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }
    }

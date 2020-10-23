<?php
    session_start();
    require_once('db.php');

    // print_r($_POST);
    $i=0;

    foreach ($_POST as $product_id => $quantity) {
      if($product_id=="zero_config_length"){
        continue;
      }
      if($quantity==""){
        continue;
      }
      $pids[$i]=$product_id;
      $quantities[$i]=$quantity;
      $i++;
    }

    $_SESSION['pids']=$pids;
    $_SESSION['quantities']=$quantities;

    header('Location: ../html/customer/index.php');

    // print_r($_SESSION['pids']);
    // echo "<br />";
    // print_r($_SESSION['quantities']);



?>

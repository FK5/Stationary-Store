<?php
    session_start();
    require_once('db.php');
    $customer_id = $_SESSION['id'];

    //creating an order then filling it
    $sql = "INSERT INTO customer_order (customer,date_ordered) VALUES ($customer_id,NOW())";
    mysqli_query($conn, $sql);

    //getting unit price
    $sql = "SELECT * FROM product WHERE flag_service=0";
    $query_result = mysqli_query($conn, $sql);
    while($record = mysqli_fetch_assoc($query_result)) {
      $product_listing[$record['product_id']] = $record;
    }

    //selecting latest order
    $sql = "SELECT * FROM customer_order ORDER BY order_id DESC LIMIT 1";
    $query_result = mysqli_query($conn, $sql);
    while($record = mysqli_fetch_assoc($query_result)) {
      $latest[] = $record;
    }
    $order_id=$latest[0]["order_id"];

    for($i=0;$i<count($_SESSION['pids']);$i++){
      $product=$_SESSION['pids'][$i];
      $quantity=$_SESSION['quantities'][$i];
      $price=$product_listing[$product]['price']*$quantity;
      $sql = "INSERT INTO product_order (product_id, order_id, quantity, price) VALUES ($product, $order_id,$quantity,$price)";
      mysqli_query($conn, $sql);

    }
    unset($_SESSION['pids']);
    unset($_SESSION['quantities']);

    $_SESSION['purchaseComplete']=true;
    header('Location: ../html/customer/index.php');


    // echo "CONFIRMEEDD";

?>

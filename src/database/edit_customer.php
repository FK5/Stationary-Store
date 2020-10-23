<?php
    session_start();
    require_once('db.php');
    $customer_id = $_SESSION['id'];

    if(empty($_POST['fullname'])){
      header('Location: ../html/customer/profile.php');
    }else{

    $fullname=$_POST['fullname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $username=$_POST['username'];

    $sql = "UPDATE customer SET full_name='".$fullname."', phone='".$phone."', email='".$email."', username='".$username."' WHERE customer_id=$customer_id";
    mysqli_query($conn, $sql);
    header('Location: ../html/customer/profile.php');
  }

?>

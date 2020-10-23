<?php
    session_start();
    require_once('db.php');

    if(empty($_POST['fullname'])){
      switch ($_SESSION['role']) {
        case 2:
          header('Location: ../html/manager/index.php');
          break;
        case 3:
          header('Location: ../html/employee/index.php');
          break;
      }

    }else{

    $customer_id = $_GET['userId'];

    $fullname=$_POST['fullname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $username=$_POST['username'];

    $sql = "UPDATE customer SET full_name='".$fullname."', phone='".$phone."', email='".$email."', username='".$username."' WHERE customer_id=$customer_id";
    mysqli_query($conn, $sql);
    switch ($_SESSION['role']) {
      case 2:
        header('Location: ../html/manager/index.php');
        break;
      case 3:
        header('Location: ../html/employee/index.php');
        break;
    }
  }

?>

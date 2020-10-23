<?php
    session_start();
    require_once('db.php');
    $user_id = $_SESSION['id'];

    if(empty($_POST['fullname'])){
      switch ($_SESSION['role']) {
        case 1:
          header('Location: ../html/admin/index.php');
          break;
        case 2:
            header('Location: ../html/manager/index.php');
          break;
        case 3:
              header('Location: ../html/employee/index.php');
          break;
      }
    }else{

    $fullname=$_POST['fullname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $username=$_POST['username'];

    $sql = "UPDATE user SET full_name='".$fullname."', phone='".$phone."', email='".$email."', username='".$username."' WHERE user_id=$user_id";
    mysqli_query($conn, $sql);
    switch ($_SESSION['role']) {
      case 1:
        header('Location: ../html/admin/profile.php');
        break;
      case 2:
          header('Location: ../html/manager/profile.php');
        break;
      case 3:
            header('Location: ../html/employee/profile.php');
        break;
    }
  }

?>

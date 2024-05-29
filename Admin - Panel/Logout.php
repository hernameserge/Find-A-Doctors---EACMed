<?php
  session_start();
  unset($_SESSION['admin_Id']);
  session_destroy();
  header("Location: ../Admin/Login.php");
?>
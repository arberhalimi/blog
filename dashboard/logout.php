<?php

session_start();
unset($_SESSION['id']);
unset($_SESSION['fullname']);
unset($_SESSION['email']);
unset($_SESSION['is_loggedin']);
unset($_SESSION['role']);

header("Location: ../login.php");

?>
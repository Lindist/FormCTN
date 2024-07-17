<?php

session_start();
unset($_COOKIE['std_id']);
unset($_COOKIE['password']);
session_destroy();
header("Location: ../index.php")

?>
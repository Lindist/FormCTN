<?php

session_start();
$domain = $_SERVER['HTTP_HOST'];
$secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
// ลบคุกกี้โดยการตั้งค่าคุกกี้ให้หมดอายุในอดีต
setcookie('std_id', '', time() - 3600, "/", $domain, $secure, true);
setcookie('password', '', time() - 3600, "/", $domain, $secure, true);
// ทำลายเซสชัน
session_destroy();
// Redirect ไปยังหน้า index.php
header("Location: ../index.php");

?>

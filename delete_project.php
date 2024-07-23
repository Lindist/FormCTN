<?php
session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

try {

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("DELETE FROM project WHERE project_id = '$id'");
    $result->execute();

    if($result){
        $_SESSION['deleteproject'] = "ลบข้อมูลเรียบร้อย";
        header("location: form.php");
    }else{
        echo "something wrong";
    }
}
else{
    echo "Delete Error undefine is id of parameter";
}
} catch (PDOException $e) {
    echo "Registrati3on failed: " . $e->getMessage();
}
?>
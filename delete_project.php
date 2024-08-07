<?php
session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

try {

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result2 = $conn->query("DELETE FROM tb_efficiercy_form WHERE project_id = '$id'")->execute();
    $result3 = $conn->query("DELETE FROM tb_fill_efficiercy WHERE project_id = '$id'")->execute();
    $result4 = $conn->query("DELETE FROM tb_fill_satisfied WHERE project_id = '$id'")->execute();
    $result5 = $conn->query("DELETE FROM tb_satisfied WHERE project_id = '$id'")->execute();
    $result1 = $conn->query("DELETE FROM project WHERE project_id = '$id'")->execute();

    if($result1 || $result2 || $result3 || $result4 || $result5){
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
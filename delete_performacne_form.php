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
    $result = $conn->query("SELECT * FROM tb_efficiercy_form  WHERE form_id = '$id'");
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $form_id = $row['form_id'];

    $conn->query("DELETE FROM tb_efficiercy_form  WHERE form_id = '$id'")->execute(); 

    $conn->query("DELETE FROM tb_fill_efficiercy  WHERE form_id = '$form_id'")->execute(); 

    $_SESSION['delete'] = "ลบข้อมูลเรียบร้อย";
    header("location: form.php?class=columnData");
}
else{
    echo "Delete Error undefine is id of parameter";
}
} catch (PDOException $e) {
    echo "Registrati3on failed: " . $e->getMessage();
}
?>
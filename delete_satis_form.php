<?php
session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

try {

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tb_satisfied  WHERE sati_id = '$id'"); 
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    $ur = $row['ur_id'];
    $fun = $row['fun_id'];
    $uf = $row['uf_id'];
    $ss = $row['ss_id'];
    
    $conn->query("DELETE FROM tb_satisfied  WHERE sati_id = '$id'")->execute(); 

    $conn->query("DELETE FROM tb_user_req  WHERE ur_id = '$ur'")->execute();
    
    $conn->query("DELETE FROM tb_function WHERE fun_id = '$fun'")->execute();
    
    $conn->query("DELETE FROM tb_uesful WHERE uf_id = '$uf'")->execute();
    
    $conn->query("DELETE FROM tb_seurity WHERE ss_id = '$ss'")->execute(); 
}
else{
    echo "Delete Error undefine is id of parameter";
}
header("location: form.php?class=columnData");
} catch (PDOException $e) {
    echo "Registrati3on failed: " . $e->getMessage();
}
?>
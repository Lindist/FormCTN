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
    $sati_id = $row["sati_id"];

    $ur = $row['ur_id'];
    $fun = $row['fun_id'];
    $uf = $row['uf_id'];
    $ss = $row['ss_id'];
    
    $conn->query("DELETE FROM tb_satisfied  WHERE sati_id = '$id'")->execute(); 

    $conn->query("DELETE FROM tb_user_req  WHERE ur_id = '$ur'")->execute();
    
    $conn->query("DELETE FROM tb_function WHERE fun_id = '$fun'")->execute();
    
    $conn->query("DELETE FROM tb_uesful WHERE uf_id = '$uf'")->execute();
    
    $conn->query("DELETE FROM tb_seurity WHERE ss_id = '$ss'")->execute(); 


    $del_tb_fill_satisfied = $conn->query("SELECT * FROM tb_fill_satisfied WHERE sati_id = '$sati_id'");
    $del_tb_fill_satisfied->execute();
    $row_tb_fill_satisfied = $del_tb_fill_satisfied->fetch(PDO::FETCH_ASSOC);
    
    $fill_ur = $row_tb_fill_satisfied['fill_ur_id '];
    $fill_fun = $row_tb_fill_satisfied['fill_fun_id'];
    $fill_uf = $row_tb_fill_satisfied['fill_uf_id'];
    $fill_ss = $row_tb_fill_satisfied['fill_ss_id'];

    $conn->query("DELETE FROM tb_fill_satisfied  WHERE sati_id = '$sati_id'")->execute(); 

    $conn->query("DELETE FROM tb_fill_user_req  WHERE fill_ur_id = '$fill_ur'")->execute();
    
    $conn->query("DELETE FROM tb_fill_function WHERE fill_fun_id = '$fill_fun'")->execute();
    
    $conn->query("DELETE FROM tb_fill_uesful WHERE fill_uf_id = '$fill_uf'")->execute();
    
    $conn->query("DELETE FROM tb_fill_seurity WHERE fill_ss_id = '$fill_ss'")->execute();

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
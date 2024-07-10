<?php
session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

try {

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tb_efficiercy_form  WHERE form_id = '$id'");
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $form_id = $row['form_id'];
    
    $in = $row['input_id'];
    $pr = $row['process_id'];
    $re = $row['report_id'];
    $se = $row['senrity_id'];
    
    $conn->query("DELETE FROM tb_efficiercy_form  WHERE form_id = '$id'")->execute(); 

    $conn->query("DELETE FROM tb_input  WHERE Input_id = '$in'")->execute();
    
    $conn->query("DELETE FROM tb_process WHERE process_id = '$pr'")->execute();
    
    $conn->query("DELETE FROM tb_report WHERE report_id = '$re'")->execute();
    
    $conn->query("DELETE FROM tb_senrity WHERE senrity_id = '$se'")->execute();

    $del_tb_fill_efficiercy = $conn->query("SELECT * FROM tb_fill_efficiercy WHERE form_id = '$form_id'");
    $del_tb_fill_efficiercy->execute();
    $row_tb_fill_efficiercy = $del_tb_fill_efficiercy->fetch(PDO::FETCH_ASSOC);
    
    $fill_in = $row_tb_fill_efficiercy['fill_input_id'];
    $fill_pr = $row_tb_fill_efficiercy['fill_process_id'];
    $fill_re = $row_tb_fill_efficiercy['fill_report_id'];
    $fill_se = $row_tb_fill_efficiercy['fill_senrity_id '];

    $conn->query("DELETE FROM tb_fill_efficiercy  WHERE form_id = '$form_id'")->execute(); 

    $conn->query("DELETE FROM tb_fill_input  WHERE fill_input_id = '$fill_in'")->execute();
    
    $conn->query("DELETE FROM tb_fill_process WHERE fill_process_id = '$fill_pr'")->execute();
    
    $conn->query("DELETE FROM tb_fill_report WHERE fill_report_id = '$fill_re'")->execute();
    
    $conn->query("DELETE FROM tb_fill_senrity WHERE fill_senrity_id = '$fill_se'")->execute();

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
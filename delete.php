<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

try {

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tb_efficiercy_form  WHERE form_id = '$id'"); 
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    $in = $row['input_id'];
    $pr = $row['process_id'];
    $re = $row['report_id'];
    $se = $row['senrity_id'];
    
    $conn->query("DELETE FROM tb_efficiercy_form  WHERE form_id = '$id'")->execute(); 

    $conn->query("DELETE FROM tb_input  WHERE Input_id = '$in'")->execute();
    
    $conn->query("DELETE FROM tb_process WHERE process_id = '$pr'")->execute();
    
    $conn->query("DELETE FROM tb_report WHERE report_id = '$re'")->execute();
    
    $conn->query("DELETE FROM tb_senrity WHERE senrity_id = '$se'")->execute(); 
}
else{
    echo "Delete Error undefine is id of parameter";
}
header("location: form.php?class=columnData");
} catch (PDOException $e) {
    echo "Registrati3on failed: " . $e->getMessage();
}
?>
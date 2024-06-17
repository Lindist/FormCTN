<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

try {

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("DELETE FROM tb_efficiercy_form  WHERE form_id = '$id'"); 
    $result->execute();

}
if (isset($_GET['id_input'])) {
    $input_id = $_GET['id_input'];
    $result1 = $conn->query("DELETE FROM tb_input  WHERE Input_id = '$input_id'"); 
    $result1->execute();

}
if (isset($_GET['id_process'])) {
    $id_process = $_GET['id_process'];
    $result2 = $conn->query("DELETE FROM tb_process WHERE process_id = '$id_process'"); 
    $result2->execute();

}
if (isset($_GET['id_report'])) {
    $id_report = $_GET['id_report'];
    $result3 = $conn->query("DELETE FROM tb_report WHERE report_id = '$id_report'"); 
    $result3->execute();

}
if (isset($_GET['id_senrity'])) {
    $id_senrity = $_GET['id_senrity'];
    $result4 = $conn->query("DELETE FROM tb_senrity WHERE senrity_id = '$id_senrity'"); 
    $result4->execute();

}


header("location: form.php");
} catch (PDOException $e) {
    echo "Registrati3on failed: " . $e->getMessage();
}
?>
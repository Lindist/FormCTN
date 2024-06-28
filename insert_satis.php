<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_POST['save'])) {
    $sata_ep2 = $_POST['sati_ep2'];

    $sati_gender = implode(",", $_POST['sati_gender']);
    $sati_type = implode(",", $_POST['sati_type']);
    $sati_level = implode(",", $_POST['sati_level']);
    $sati_comment = $_POST['sati_comment'];
    
    $ur_topic = implode("@", $_POST['ur_topic']);
    $ur_score = implode("@", $_POST['ur_score']);
    
    $fun_topic = implode("@", $_POST['fun_topic']);
    $fun_score = implode("@", $_POST['fun_score']);

    $uf_topic = implode("@", $_POST['uf_topic']);
    $uf_score = implode("@", $_POST['uf_score']);

    $ss_topic = implode("@", $_POST['ss_topic']);
    $ss_score = implode("@", $_POST['ss_score']);

    // echo $sata_ep2. "<br>";
    // print_r($sati_gender);
    // echo "<br>";
    // print_r($sati_type);
    // echo "<br>";
    // print_r($sati_level);
    // echo "<br>";
    print_r($_POST['ur_topic']);
    echo "<br>";
    print_r($ur_score);
    echo "<br>";
    // print_r($fun_topic);
    // echo "<br>";
    // echo $fun_score;
    // echo "<br>";
    // print_r($uf_topic);
    // echo "<br>";
    // echo $uf_score;
    // echo "<br>";
    // print_r($ss_topic);
    // echo "<br>";
    // echo $ss_score;
    // echo "<br>";
    // echo "<br>comment<br>";
    // echo $sati_comment;

}

?>
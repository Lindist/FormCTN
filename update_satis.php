<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_POST['update'])) {
    $sati_id = $_POST['id'];
    $ur_id = $_POST['ur_id'];
    $fun_id = $_POST['fun_id'];
    $uf_id = $_POST['uf_id'];
    $ss_id = $_POST['ss_id'];

    $sati_ep2 = $_POST['sati_ep2'];

    $sati_gender = implode(",", $_POST['sati_gender']);
    $sati_type = implode(",", $_POST['sati_type']);
    $sati_level = implode(",", $_POST['sati_level']);
    $sati_comment = $_POST['sati_comment'];
    
    $ur_topic = implode("@", $_POST['ur_topic']);
    $fun_topic = implode("@", $_POST['fun_topic']);
    $uf_topic = implode("@", $_POST['uf_topic']);
    $ss_topic = implode("@", $_POST['ss_topic']);

}

if (empty($sati_ep2)) {
    $_SESSION['error'] = "กรุณากรอกชื่อ โปรเจค";
    header("location: insert_satis_form.php");
    exit;
} else if (empty(array_filter($_POST['sati_gender']))) {
    $_SESSION['error'] = "กรุณากรอก เพศ อย่างน้อย 1 เพศ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty(array_filter($_POST['sati_type']))) {
    $_SESSION['error'] = "กรุณากรอก ประเภทผู้ใช้อย่างน้อย 1 ประเภท";
    header("location: insert_satis_form.php");
    exit;
} else if (empty(array_filter($_POST['sati_level']))) {
    $_SESSION['error'] = "กรุณากรอก ระดับการศึกษา อย่างน้อย 1 ระดับ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($ur_topic)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 1 อย่างน้อย 1 หัวข้อ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($fun_topic)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 2 อย่างน้อย 1 หัวข้อ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($uf_topic)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 3 อย่างน้อย 1 หัวข้อ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($ss_topic)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 4 อย่างน้อย 1 หัวข้อ";
    header("location: insert_satis_form.php");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {

            $tb_user_req = $conn->prepare("UPDATE tb_user_req SET ur_topic = ? WHERE ur_id = ?");
            $tb_user_req->execute([$ur_topic, $ur_id]);

            $tb_function = $conn->prepare("UPDATE tb_function SET fun_topic = ? WHERE fun_id = ?");
            $tb_function->execute([$fun_topic, $fun_id]);

            $tb_uesful = $conn->prepare("UPDATE tb_uesful SET uf_topic = ? WHERE uf_id = ?");
            $tb_uesful->execute([$uf_topic, $uf_id]);

            $tb_seurity = $conn->prepare("UPDATE tb_seurity SET ss_topic = ? WHERE ss_id = ?");
            $tb_seurity->execute([$ss_topic, $ss_id]);

            $tb_satisfied = $conn->prepare("UPDATE tb_satisfied SET sati_ep2 = ?, sati_gender = ?, sati_level = ?, sati_type = ?, sati_comment = ? WHERE sati_id = ?");
            $tb_satisfied->execute([$sati_ep2, $sati_gender, $sati_level, $sati_type, $sati_comment, $sati_id]);

            header("location: form.php");

            // echo $sati_id;
            // echo "<br>";
            // echo $ur_id;
            // echo "<br>";
            // echo $fun_id;
            // echo "<br>";
            // echo $uf_id;
            // echo "<br>";
            // echo $ss_id;

        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

?>
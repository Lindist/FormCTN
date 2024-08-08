<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $sati_ep2 = $_POST['sati_ep2'];
    $sati_id = $_POST['sati_id'];

    $combined_subinfo = [];
    for ($i = 1; $i <= count($_POST['sati_info']); $i++) {
        if (isset($_POST['sub_info' . $i])) {
            $combined_subinfo[$i - 1] = implode("Ϫ", $_POST['sub_info' . $i]);
        }
    }

    $combined_subtopic = [];
    for ($i = 1; $i <= count($_POST['sati_topic']); $i++) {
        if (isset($_POST['sub_topic' . $i])) {
            $combined_subtopic[$i - 1] = implode("Ϫ", $_POST['sub_topic' . $i]);
        }
    }

    $sati_info = implode("Ϫ", $_POST['sati_info']);

    $sub_info = implode("ꓘ", $combined_subinfo);

    $sati_topic = implode("Ϫ", $_POST['sati_topic']);

    $sub_topic = implode("ꓘ", $combined_subtopic);

}

if (empty($sati_ep2)) {
    $_SESSION['error'] = "กรุณากรอกชื่อ โปรเจค";
    header("location: edit_satis_form.php?id=".$sati_id);
    exit;
} else if (empty($sati_info)) {
    $_SESSION['error'] = "กรุณากรอก ข้อมูลพื้นฐาน อย่างน้อย 1 ประเภท";
    header("location: edit_satis_form.php?id=".$sati_id);
    exit;
} else if (empty($sati_topic)) {
    $_SESSION['error'] = "กรุณากรอก ด้าน อย่างน้อย 1 ด้าน";
    header("location: edit_satis_form.php?id=".$sati_id);
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {

            $tb_satisfied = $conn->prepare("UPDATE tb_satisfied SET sati_ep2 = ?, sati_info = ?, sub_info = ?, sati_topic = ?, sub_topic = ? WHERE sati_id = ?");
            $tb_satisfied->execute([$sati_ep2, $sati_info, $sub_info, $sati_topic, $sub_topic, $sati_id]);

            $_SESSION['save_form'] = "บึนทึก แบบฟอร์มประเมินความพึงพอใจ เรียบร้อย";
            header("location: form.php");

        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

?>
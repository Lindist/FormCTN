<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if(isset($_SESSION['projectId'])){
    $projectId = $_SESSION['projectId'];
}

if(isset($_POST['class'])){
    if($_POST['class'] == "have"){
        $class = 'columnData';
    }
    else{
        $class = $_POST['class'];
    }
}
if(isset($_POST['class1'])){
    if($_POST['class1'] == "have"){
        $class1 = 'firstshow';
    }
    else{
        $class1 = $_POST['class1'];
    }
}

if (isset($_POST['save'])) {
    $sati_ep2 = $_POST['sati_ep2'];

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
    header("location: insert_satis_form.php?pro_name=$sati_ep2&pro_id=$projectId");
    exit;
} else if (empty($sati_info)) {
    $_SESSION['error'] = "กรุณากรอก ข้อมูลพื้นฐาน อย่างน้อย 1 ประเภท";
    header("location: insert_satis_form.php?pro_name=$sati_ep2&pro_id=$projectId");
    exit;
} else if (empty($sati_topic)) {
    $_SESSION['error'] = "กรุณากรอก ด้าน อย่างน้อย 1 ด้าน";
    header("location: insert_satis_form.php?pro_name=$sati_ep2&pro_id=$projectId");
    exit;
} else if (empty($combined_subinfo)) {
    $_SESSION['error'] = "กรุณากรอก ตัวเลือก ข้อมูลพื้นฐาน อย่างน้อย 1 ประเภท";
    header("location: insert_performance_form.php?pro_name=$sati_ep2&pro_id=$projectId");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {

            $tb_satisfied = $conn->prepare("INSERT INTO tb_satisfied(sati_ep2, sati_info, sub_info, sati_topic, sub_topic, member_id, project_id) VALUES (?, ?, ?, ?, ?, ?,?)");
            $tb_satisfied->execute([$sati_ep2, $sati_info, $sub_info, $sati_topic, $sub_topic, $user_id, $projectId]);

            unset($_SESSION['projectId']);
            $_SESSION['save_form'] = "บึนทึก แบบฟอร์มประเมินความพึงพอใจ เรียบร้อย";
            header("location: form.php");

        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

?>
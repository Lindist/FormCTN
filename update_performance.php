<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $formname = $_POST['formname'];
    $ad = $_POST['ad'];
    $form_id = $_POST['id'];
    $pj_id = $_POST['pj_id'];

    $combined_subinfo = [];
    for ($i = 1; $i <= count($_POST['form_info']); $i++) {
        if (isset($_POST['sub_info' . $i])) {
            $combined_subinfo[$i - 1] = implode("Ϫ", $_POST['sub_info' . $i]);
        }
    }

    $combined_subtopic = [];
    for ($i = 1; $i <= count($_POST['form_topic']); $i++) {
        if (isset($_POST['feature' . $i]) && isset($_POST['setfeature' . $i])) {
            $combined_feature[$i - 1] = implode("Ϫ", $_POST['feature' . $i]);
            $combined_setfeature[$i - 1] = implode("Ϫ", $_POST['setfeature' . $i]);
        }
    }

    $form_info = implode("Ϫ", $_POST['form_info']);

    $sub_info = implode("ꓘ", $combined_subinfo);

    $form_topic = implode("Ϫ", $_POST['form_topic']);

    $feature = implode("ꓘ", $combined_feature);

    $setfeature = implode("ꓘ", $combined_setfeature);

}

if (empty($formname)) {
    $_SESSION['error'] = "กรุณากรอกชื่อ โปรเจค";
    header("location: edit_performance_form.php?id=$form_id");
    exit;
} else if (empty($ad)) {
    $_SESSION['error'] = "กรุณากรอกคำชี้แจง";
    header("location: edit_performance_form.php?id=$form_id");
    exit;
} else if (empty($form_info)) {
    $_SESSION['error'] = "กรุณากรอก ข้อมูลพื้นฐาน อย่างน้อย 1 ประเภท";
    header("location: edit_performance_form.php?id=$form_id");
    exit;
} else if (empty($form_topic)) {
    $_SESSION['error'] = "กรุณากรอก ด้าน อย่างน้อย 1 ด้าน";
    header("location: edit_performance_form.php?id=$form_id");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {
            $tb_efficiercy_form = $conn->prepare("UPDATE tb_efficiercy_form SET form_name = ?, form_ad = ?, form_info = ?, sub_info = ?, form_topic = ?, feature = ?, setfeature = ? WHERE form_id = ?");
            $tb_efficiercy_form->execute([$formname, $ad, $form_info, $sub_info, $form_topic, $feature, $setfeature, $form_id]);

            $_SESSION['save_form'] = "บึนทึก แบบฟอร์มประเมินประสิทธิภาพ เรียบร้อย";
            if(isset($_SESSION['admin_id'])){
                header("location: adminshowcheckEdit.php");
            }else{
                header("location: form.php?class=".$class);
            }
        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

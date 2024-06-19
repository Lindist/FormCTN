<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['update'])) {
    $form_id = $_POST['id'];
    $input_id = $_POST['input_id'];
    $process_id = $_POST['process_id'];
    $report_id = $_POST['report_id'];
    $senrity_id = $_POST['senrity_id'];

    $formname = $_POST['formname'];
    $ad = $_POST['ad'];
    $gender = $_POST['gender'];
    $type_m = $_POST['type_m'];
    $edu = $_POST['edu'];

    $input_name = $_POST['input_name'];
    $input_feature = implode("@", $_POST['input_feature']);
    $input_setfeature = implode("@", $_POST['input_setfeature']);
    $input_result = implode("@", $_POST['input_result']);
    $input_compare = implode("@", $_POST['input_compare']);

    $process_name = $_POST['process_name'];
    $process_feature = implode("@", $_POST['process_feature']);
    $process_setfeature = implode("@", $_POST['process_setfeature']);
    $process_result = implode("@", $_POST['process_result']);
    $process_compare = implode("@", $_POST['process_compare']);

    $report_name = $_POST['report_name'];
    $report_feature = implode("@", $_POST['report_feature']);
    $report_setfeature = implode("@", $_POST['report_setfeature']);
    $report_result = implode("@", $_POST['report_result']);
    $report_compare = implode("@", $_POST['report_compare']);

    $senrity_name = $_POST['senrity_name'];
    $senrity_feature = implode("@", $_POST['senrity_feature']);
    $senrity_setfeature = implode("@", $_POST['senrity_setfeature']);
    $senrity_result = implode("@", $_POST['senrity_result']);
    $senrity_compare = implode("@", $_POST['senrity_compare']);
}

if (empty($formname)) {
    $_SESSION['error'] = "กรุณากรอกชื่อฟอร์ม";
    header("location: editform.php?id=$form_id");
} else if (empty($ad)) {
    $_SESSION['error'] = "กรุณากรอกคำชี้แจง";
    header("location: editform.php?id=$form_id");
} else if (empty($gender)) {
    $_SESSION['error'] = "กรุณาเลือก เพศ";
    header("location: editform.php?id=$form_id");
} else if (empty($type_m)) {
    $_SESSION['error'] = "กรุณาเลือก ประเภทผู้ใช้";
    header("location: editform.php?id=$form_id");
} else if (empty($edu)) {
    $_SESSION['error'] = "กรุณาเลือก ระดับการศึกษา";
    header("location: editform.php?id=$form_id");
} else if (empty($input_name)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 1";
    header("location: editform.php?id=$form_id");
} else if (empty($process_name)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 2";
    header("location: editform.php?id=$form_id");
} else if (empty($report_name)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 3";
    header("location: editform.php?id=$form_id");
} else if (empty($senrity_name)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 4";
    header("location: editform.php?id=$form_id");
} else {
    try {
        if (!isset($_SESSION['error'])) {
            // Update tb_input
            $tb_input = $conn->prepare("UPDATE tb_input SET input_name = ?, input_feature = ?, input_setfeature = ?, input_result = ?, input_compare = ? WHERE input_id = ?");
            $tb_input->execute([$input_name, $input_feature, $input_setfeature, $input_result, $input_compare, $input_id]);

            // Update tb_process
            $tb_process = $conn->prepare("UPDATE tb_process SET process_name = ?, process_feature = ?, process_setfeature = ?, process_result = ?, process_compare = ? WHERE process_id = ?");
            $tb_process->execute([$process_name, $process_feature, $process_setfeature, $process_result, $process_compare, $process_id]);

            // Update tb_report
            $tb_report = $conn->prepare("UPDATE tb_report SET report_name = ?, report_feature = ?, report_setfeature = ?, report_result = ?, report_compare = ? WHERE report_id = ?");
            $tb_report->execute([$report_name, $report_feature, $report_setfeature, $report_result, $report_compare, $report_id]);

            // Update tb_senrity
            $tb_senrity = $conn->prepare("UPDATE tb_senrity SET senrity_name = ?, senrity_feature = ?, senrity_setfeature = ?, senrity_result = ?, senrity_compare = ? WHERE senrity_id = ?");
            $tb_senrity->execute([$senrity_name, $senrity_feature, $senrity_setfeature, $senrity_result, $senrity_compare, $senrity_id]);

            // Update tb_efficiercy_form
            $tb_efficiercy_form = $conn->prepare("UPDATE tb_efficiercy_form SET form_ad = ?, form_gender = ?, form_type = ?, form_education = ?, form_name = ? WHERE form_id = ?");
            $tb_efficiercy_form->execute([$ad, $gender, $type_m, $edu, $formname, $form_id]);

            header("location: form.php");
        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

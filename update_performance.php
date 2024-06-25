<?php

session_start();
require 'session/config.php';

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
    $gender = implode(",", $_POST['genders']);
    $type_m = implode(",", $_POST['kinduser']);
    $edu = implode(",", $_POST['le_education']);

    $input_feature = implode("@", $_POST['input_feature']);

    $process_feature = implode("@", $_POST['process_feature']);

    $report_feature = implode("@", $_POST['report_feature']);

    $senrity_feature = implode("@", $_POST['senrity_feature']);
}

if (empty($formname)) {
    $_SESSION['error'] = "กรุณากรอกชื่อฟอร์ม";
    header("location: edit_performance_form.php?id=$form_id");
} else if (empty($ad)) {
    $_SESSION['error'] = "กรุณากรอกคำชี้แจง";
    header("location: edit_performance_form.php?id=$form_id");
} else if (empty(array_filter($_POST['genders']))) {
    $_SESSION['error'] = "กรุณากรอก เพศ อย่างน้อย 1 เพศ";
    header("location: edit_performance_form.php?id=$form_id");
} else if (empty(array_filter($_POST['kinduser']))) {
    $_SESSION['error'] = "กรุณากรอก ประเภทผู้ใช้อย่างน้อย 1 ประเภท";
    header("location: edit_performance_form.php?id=$form_id");
} else if (empty(array_filter($_POST['le_education']))) {
    $_SESSION['error'] = "กรุณากรอก ระดับการศึกษา อย่างน้อย 1 ระดับ";
    header("location: edit_performance_form.php?id=$form_id");
} else {
    try {
        if (!isset($_SESSION['error'])) {
            // Update tb_input
            $tb_input = $conn->prepare("UPDATE tb_input SET input_feature = ? WHERE input_id = ?");
            $tb_input->execute([$input_feature, $input_id]);

            // Update tb_process
            $tb_process = $conn->prepare("UPDATE tb_process SET process_feature = ? WHERE process_id = ?");
            $tb_process->execute([$process_feature, $process_id]);

            // Update tb_report
            $tb_report = $conn->prepare("UPDATE tb_report SET report_feature = ? WHERE report_id = ?");
            $tb_report->execute([$report_feature, $report_id]);

            // Update tb_senrity
            $tb_senrity = $conn->prepare("UPDATE tb_senrity SET senrity_feature = ? WHERE senrity_id = ?");
            $tb_senrity->execute([$senrity_feature, $senrity_id]);

            // Update tb_efficiercy_form
            $tb_efficiercy_form = $conn->prepare("UPDATE tb_efficiercy_form SET form_ad = ?, form_gender = ?, form_type = ?, form_education = ?, form_name = ? WHERE form_id = ?");
            $tb_efficiercy_form->execute([$ad, $gender, $type_m, $edu, $formname, $form_id]);

            header("location: form.php?class=columnData");
        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

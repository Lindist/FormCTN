<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if(isset($_POST['class'])){
    if($_POST['class'] == "have"){
        $class = 'columnData';
    }
    else{
        $class = $_POST['class'];
    }
}
if (isset($_POST['save'])) {
    $formname = $_POST['formname'];
    $ad = $_POST['ad'];

    $gender = implode(",", $_POST['genders']);
    $type_m = implode(",", $_POST['kinduser']);
    $edu = implode(",", $_POST['le_education']);

    $input_name = $_POST['input_name'];
    $input_feature = implode("@", $_POST['input_feature']);
    $input_setfeature = implode("@", $_POST['input_setfeature']);

    $process_name = $_POST['process_name'];
    $process_feature = implode("@", $_POST['process_feature']);
    $process_setfeature = implode("@", $_POST['process_setfeature']);

    $report_name = $_POST['report_name'];
    $report_feature = implode("@", $_POST['report_feature']);
    $report_setfeature = implode("@", $_POST['report_setfeature']);

    $senrity_name = $_POST['senrity_name'];
    $senrity_feature = implode("@", $_POST['senrity_feature']);
    $senrity_setfeature = implode("@", $_POST['senrity_setfeature']);
}

$_SESSION['formname'] = $formname;
$_SESSION['ad'] = $ad;
$_SESSION['gender'] = $_POST['genders'];
$_SESSION['type_m'] = $_POST['kinduser'];
$_SESSION['edu'] = $_POST['le_education'];

if (empty($formname)) {
    $_SESSION['error'] = "กรุณากรอกชื่อฟอร์ม";
    header("location: insert_performance_form.php");
    exit;
} else if (empty($ad)) {
    $_SESSION['error'] = "กรุณากรอกคำชี้แจง";
    header("location: insert_performance_form.php");
    exit;
} else if (empty(array_filter($_POST['genders']))) {
    $_SESSION['error'] = "กรุณากรอก เพศ อย่างน้อย 1 เพศ";
    header("location: insert_performance_form.php");
    exit;
} else if (empty(array_filter($_POST['kinduser']))) {
    $_SESSION['error'] = "กรุณากรอก ประเภทผู้ใช้อย่างน้อย 1 ประเภท";
    header("location: insert_performance_form.php");
    exit;
} else if (empty(array_filter($_POST['le_education']))) {
    $_SESSION['error'] = "กรุณากรอก ระดับการศึกษา อย่างน้อย 1 ระดับ";
    header("location: insert_performance_form.php");
    exit;
} else if (empty($input_feature) || empty($input_setfeature)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 1 ให้ครบอย่างน้อย 1 หัวข้อ";
    header("location: insert_performance_form.php");
    exit;
} else if (empty($process_feature) || empty($process_setfeature)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 2 ให้ครบอย่างน้อย 1 หัวข้อ";
    header("location: insert_performance_form.php");
    exit;
} else if (empty($report_feature) || empty($report_setfeature)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 3 ให้ครบอย่างน้อย 1 หัวข้อ";
    header("location: insert_performance_form.php");
    exit;
} else if (empty($senrity_feature)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 4 ให้ครบอย่างน้อย 1 หัวข้อ";
    header("location: insert_performance_form.php");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {
            $tb_input = $conn->prepare("INSERT INTO tb_input(Input_name, input_feature, input_setfeature) VALUES(?,?,?)");
            $tb_input->execute([$input_name, $input_feature, $input_setfeature]);

            $tb_process = $conn->prepare("INSERT INTO tb_process(process_name, process_feature, process_setfeature) VALUES(?,?,?)");
            $tb_process->execute([$process_name, $process_feature, $process_setfeature]);

            $tb_report = $conn->prepare("INSERT INTO tb_report(report_name, report_feature, report_setfeature) VALUES(?,?,?)");
            $tb_report->execute([$report_name, $report_feature, $report_setfeature]);
            
            $tb_senrity = $conn->prepare("INSERT INTO tb_senrity(senrity_name, senrity_feature, senrity_setfeature) VALUES(?,?,?)");
            $tb_senrity->execute([$senrity_name, $senrity_feature, $senrity_setfeature]);

            $sql_tb_input = $conn->prepare("SELECT * FROM tb_input WHERE Input_feature = :input_feature");
            $sql_tb_input->bindParam(":input_feature", $input_feature);
            $sql_tb_input->execute();
            $tb_input = $sql_tb_input->fetch();

            $sql_tb_process = $conn->prepare("SELECT * FROM tb_process WHERE process_feature = :process_feature");
            $sql_tb_process->bindParam(":process_feature", $process_feature);
            $sql_tb_process->execute();
            $tb_process = $sql_tb_process->fetch();

            $sql_tb_report = $conn->prepare("SELECT * FROM tb_report WHERE report_feature = :report_feature");
            $sql_tb_report->bindParam(":report_feature", $report_feature);
            $sql_tb_report->execute();
            $tb_report = $sql_tb_report->fetch();

            $sql_tb_senrity = $conn->prepare("SELECT * FROM tb_senrity WHERE senrity_feature = :senrity_feature");
            $sql_tb_senrity->bindParam(":senrity_feature", $senrity_feature);
            $sql_tb_senrity->execute();
            $tb_senrity = $sql_tb_senrity->fetch();

            $sql_tb_member = $conn->prepare("SELECT * FROM tb_member WHERE member_id = :user_id");
            $sql_tb_member->bindParam(":user_id", $user_id);
            $sql_tb_member->execute();
            $tb_member = $sql_tb_member->fetch();

            $tb_efficiercy_form = $conn->prepare("INSERT INTO tb_efficiercy_form(form_name, form_ad, form_gender, form_type, form_education, input_id, process_id, report_id, senrity_id, member_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $tb_efficiercy_form->execute([$formname, $ad, $gender, $type_m, $edu, $tb_input['Input_id'], $tb_process['process_id'], $tb_report['report_id'], $tb_senrity['senrity_id'], $tb_member['member_id']]);
            // print_r([$formname, $ad, $gender, $type_m, $edu, $tb_input['Input_id'], $tb_process['process_id'], $tb_report['report_id'], $tb_senrity['senrity_id'], $tb_member['member_id']]);

            unset($_SESSION['formname']);
            unset($_SESSION['ad']);
            unset($_SESSION['gender']);
            unset($_SESSION['type_m']);
            unset($_SESSION['edu']);

            unset($_SESSION['input_feature']);
            unset($_SESSION['process_feature']);
            unset($_SESSION['report_feature']);
            unset($_SESSION['senrity_feature']);

            header("location: form.php?class=".$class);
        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

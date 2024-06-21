<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['save'])) {
    $formname = $_POST['formname'];
    $ad = $_POST['ad'];

    $gender = implode(",", $_POST['genders']);
    $type_m = implode(",", $_POST['kinduser']);
    $edu = implode(",", $_POST['le_education']);

    // $input_name = $_POST['input_name'];
    $input_feature = implode("@", $_POST['input_feature']);
    // $input_setfeature = implode("@", $_POST['input_setfeature']);
    // $input_result = implode("@", $_POST['input_result']);
    // $input_compare = implode("@", $_POST['input_compare']);

    // $process_name = $_POST['process_name'];
    $process_feature = implode("@", $_POST['process_feature']);
    // $process_setfeature = implode("@", $_POST['process_setfeature']);
    // $process_result = implode("@", $_POST['process_result']);
    // $process_compare = implode("@", $_POST['process_compare']);

    // $report_name = $_POST['report_name'];
    $report_feature = implode("@", $_POST['report_feature']);
    // $report_setfeature = implode("@", $_POST['report_setfeature']);
    // $report_result = implode("@", $_POST['report_result']);
    // $report_compare = implode("@", $_POST['report_compare']);

    // $senrity_name = $_POST['senrity_name'];
    $senrity_feature = implode("@", $_POST['senrity_feature']);
    // $senrity_setfeature = implode("@", $_POST['senrity_setfeature']);
    // $senrity_result = implode("@", $_POST['senrity_result']);
    // $senrity_compare = implode("@", $_POST['senrity_compare']);
}

$_SESSION['formname'] = $formname;
$_SESSION['ad'] = $ad;
$_SESSION['gender'] = $gender;
$_SESSION['type_m'] = $type_m;
$_SESSION['edu'] = $edu;
// $_SESSION['input_name'] = $input_name;
// $_SESSION['process_name'] = $process_name;
// $_SESSION['report_name'] = $report_name;
// $_SESSION['senrity_name'] = $senrity_name;

// $_SESSION['input_feature'] = $_POST['input_feature'];
// $_SESSION['input_setfeature'] = $_POST['input_setfeature'];
// $_SESSION['input_result'] = $_POST['input_result'];
// $_SESSION['input_compare'] = $_POST['input_compare'];

// $_SESSION['process_feature'] = $_POST['process_feature'];
// $_SESSION['process_setfeature'] = $_POST['process_setfeature'];
// $_SESSION['process_result'] = $_POST['process_result'];
// $_SESSION['process_compare'] = $_POST['process_compare'];

// $_SESSION['report_feature'] = $_POST['report_feature'];
// $_SESSION['report_setfeature'] = $_POST['report_setfeature'];
// $_SESSION['report_result'] = $_POST['report_result'];
// $_SESSION['report_compare'] = $_POST['report_compare'];

// $_SESSION['senrity_feature'] = $_POST['senrity_feature'];
// $_SESSION['senrity_setfeature'] = $_POST['senrity_setfeature'];
// $_SESSION['senrity_result'] = $_POST['senrity_result'];
// $_SESSION['senrity_compare'] = $_POST['senrity_compare'];

if (empty($formname)) {
    $_SESSION['error'] = "กรุณากรอกชื่อฟอร์ม";
    header("location: insertform.php");
} else if (empty($ad)) {
    $_SESSION['error'] = "กรุณากรอกคำชี้แจง";
    header("location: insertform.php");
} else if (empty($gender)) {
    $_SESSION['error'] = "กรุณาเลือก เพศ";
    header("location: insertform.php");
} else if (empty($type_m)) {
    $_SESSION['error'] = "กรุณาเลือก ประเภทผู้ใช้";
    header("location: insertform.php");
} else if (empty($edu)) {
    $_SESSION['error'] = "กรุณาเลือก ระดับการศึกษา";
    header("location: insertform.php");
// } else if (empty($input_name)) {
//     $_SESSION['error'] = "กรุณากรอกด้านที่ 1";
//     header("location: insertform.php");
// } else if (empty($process_name)) {
//     $_SESSION['error'] = "กรุณากรอกด้านที่ 2";
//     header("location: insertform.php");
// } else if (empty($report_name)) {
//     $_SESSION['error'] = "กรุณากรอกด้านที่ 3";
//     header("location: insertform.php");
// } else if (empty($senrity_name)) {
//     $_SESSION['error'] = "กรุณากรอกด้านที่ 4";
//     header("location: insertform.php");
} else {
    try {
        if (!isset($_SESSION['error'])) {
            $tb_input = $conn->prepare("INSERT INTO tb_input(input_feature) VALUES(?)");
            $tb_input->execute([$input_feature]);

            $tb_process = $conn->prepare("INSERT INTO tb_process(process_feature) VALUES(?)");
            $tb_process->execute([$process_feature]);

            $tb_report = $conn->prepare("INSERT INTO tb_report(report_feature) VALUES(?)");
            $tb_report->execute([$report_feature]);

            $tb_senrity = $conn->prepare("INSERT INTO tb_senrity(senrity_feature) VALUES(?)");
            $tb_senrity->execute([$senrity_feature]);

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
            // unset($_SESSION['input_name']);
            // unset($_SESSION['process_name']);
            // unset($_SESSION['report_name']);
            // unset($_SESSION['senrity_name']);

            unset($_SESSION['input_feature']);
            // unset($_SESSION['input_setfeature']);
            // unset($_SESSION['input_result']);
            // unset($_SESSION['input_compare']);

            unset($_SESSION['process_feature']);
            // unset($_SESSION['process_setfeature']);
            // unset($_SESSION['process_result']);
            // unset($_SESSION['process_compare']);

            unset($_SESSION['report_feature']);
            // unset($_SESSION['report_setfeature']);
            // unset($_SESSION['report_result']);
            // unset($_SESSION['report_compare']);

            unset($_SESSION['senrity_feature']);
            // unset($_SESSION['senrity_setfeature']);
            // unset($_SESSION['senrity_result']);
            // unset($_SESSION['senrity_compare']);

            header("location: form.php");
        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

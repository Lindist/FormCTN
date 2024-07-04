<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
} else {
    $user_id = $_SESSION['user_id'];
}

if (isset($_POST['save'])) {
    $form_id = $_POST['form_id'];
    $form_name = $_POST['form_name'];

    $input_id = $_POST['input_id'];
    $process_id = $_POST['process_id'];
    $report_id = $_POST['report_id'];
    $senrity_id = $_POST['senrity_id'];

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

function check_empty($array) {
    foreach ($array as $value) {
        if (empty($value)) {
            return true;
        }
    }
    return false;
}

// // Echoing the variables
// echo "input_id: $input_id<br>";
// echo "process_id: $process_id<br>";
// echo "report_id: $report_id<br>";
// echo "senrity_id: $senrity_id<br>";

// echo "Form Name: $form_name<br>";
// echo "Gender: $gender<br>";
// echo "Type M: $type_m<br>";
// echo "Education: $edu<br><br>";

// echo "Input Name: $input_name<br>";
// echo "Input Feature: $input_feature<br>";
// echo "Input Set Feature: $input_setfeature<br>";
// echo "Input Result: $input_result<br>";
// echo "Input Compare: $input_compare<br><br>";

// echo "Process Name: $process_name<br>";
// echo "Process Feature: $process_feature<br>";
// echo "Process Set Feature: $process_setfeature<br>";
// echo "Process Result: $process_result<br>";
// echo "Process Compare: $process_compare<br><br>";

// echo "Report Name: $report_name<br>";
// echo "Report Feature: $report_feature<br>";
// echo "Report Set Feature: $report_setfeature<br>";
// echo "Report Result: $report_result<br>";
// echo "Report Compare: $report_compare<br><br>";

// echo "Senrity Name: $senrity_name<br>";
// echo "Senrity Feature: $senrity_feature<br>";
// echo "Senrity Set Feature: $senrity_setfeature<br>";
// echo "Senrity Result: $senrity_result<br>";
// echo "Senrity Compare: $senrity_compare<br>";

$_SESSION['gender'] = $_POST['gender'];
$_SESSION['type_m'] = $_POST['type_m'];
$_SESSION['edu'] = $_POST['edu'];

$_SESSION['input_setfeature'] = $_POST['input_setfeature'];
$_SESSION['input_result'] = $_POST['input_result'];
$_SESSION['input_compare'] = $_POST['input_compare'];

$_SESSION['process_setfeature'] = $_POST['process_setfeature'];
$_SESSION['process_result'] = $_POST['process_result'];
$_SESSION['process_compare'] = $_POST['process_compare'];

$_SESSION['report_setfeature'] = $_POST['report_setfeature'];
$_SESSION['report_result'] = $_POST['report_result'];
$_SESSION['report_compare'] = $_POST['report_compare'];

$_SESSION['senrity_setfeature'] = $_POST['senrity_setfeature'];
$_SESSION['senrity_result'] = $_POST['senrity_result'];
$_SESSION['senrity_compare'] = $_POST['senrity_compare'];

if (empty($_POST['gender'])) {
    $_SESSION['error'] = "กรุณาเลือก เพศ";
    header("location: fill_performance_form.php?id=$form_id");
    exit;
} else if (empty($_POST['type_m'])) {
    $_SESSION['error'] = "กรุณาเลือก ประเภทผู้ใช้";
    header("location: fill_performance_form.php?id=$form_id");
    exit;
} else if (empty($_POST['edu'])) {
    $_SESSION['error'] = "กรุณาเลือก ระดับการศึกษา";
    header("location: fill_performance_form.php?id=$form_id");
    exit;
} else if (check_empty($_POST['input_setfeature']) || check_empty($_POST['input_result']) || check_empty($_POST['input_compare'])) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 1 ให้ครบ";
    header("location: fill_performance_form.php?id=$form_id");
    exit;
} else if (check_empty($_POST['process_setfeature']) || check_empty($_POST['process_result']) || check_empty($_POST['process_compare'])) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 2 ให้ครบ";
    header("location: fill_performance_form.php?id=$form_id");
    exit;
} else if (check_empty($_POST['report_setfeature']) || check_empty($_POST['report_result']) || check_empty($_POST['report_compare'])) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 3 ให้ครบ";
    header("location: fill_performance_form.php?id=$form_id");
    exit;
} else if (check_empty($_POST['senrity_setfeature']) || check_empty($_POST['senrity_result']) || check_empty($_POST['senrity_compare'])) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 4 ให้ครบ";
    header("location: fill_performance_form.php?id=$form_id");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {
            $conn->beginTransaction();

            // Insert ข้อมูลในตาราง tb_fill_input
            $stmt = $conn->prepare("INSERT INTO tb_fill_input (input_id, input_name, input_feature, input_setfeature, input_result, input_compare) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$input_id, $input_name, $input_feature, $input_setfeature, $input_result, $input_compare]);
            $fill_input_id = $conn->lastInsertId();
        
            // Insert ข้อมูลในตาราง tb_fill_process
            $stmt = $conn->prepare("INSERT INTO tb_fill_process (process_id, process_name, process_feature, process_setfeature, process_result, process_compare) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$process_id, $process_name, $process_feature, $process_setfeature, $process_result, $process_compare]);
            $fill_process_id = $conn->lastInsertId();
        
            // Insert ข้อมูลในตาราง tb_fill_report
            $stmt = $conn->prepare("INSERT INTO tb_fill_report (report_id, report_name, report_feature, report_setfeature, report_result, report_compare) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$report_id, $report_name, $report_feature, $report_setfeature, $report_result, $report_compare]);
            $fill_report_id = $conn->lastInsertId();
        
            // Insert ข้อมูลในตาราง tb_fill_senrity
            $stmt = $conn->prepare("INSERT INTO tb_fill_senrity (senrity_id, senrity_name, senrity_feature, senrity_setfeature, senrity_result, senrity_compare) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$senrity_id, $senrity_name, $senrity_feature, $senrity_setfeature, $senrity_result, $senrity_compare]);
            $fill_senrity_id = $conn->lastInsertId();
        
            // ถ้าทุกอย่างเรียบร้อย ให้ commit การทำงาน
            $conn->commit();
        
            // ใช้ ID ที่ได้สำหรับการทำงานต่อไป
            // echo "Insert successful.</br>";
            // echo "Fill input ID: " . $fill_input_id . "</br>";
            // echo "Fill process ID: " . $fill_process_id . "</br>";
            // echo "Fill report ID: " . $fill_report_id . "</br>";
            // echo "Fill senrity ID: " . $fill_senrity_id . "</br>";
            // echo "Member ID: " . $user_id . "</br>";

            $tb_fill_efficiercy = $conn->prepare("INSERT INTO tb_fill_efficiercy(form_id, form_name, form_gender, form_type, form_education, member_id, fill_input_id, fill_process_id, fill_report_id, fill_senrity_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $tb_fill_efficiercy->execute([$form_id, $form_name, $gender, $type_m, $edu, $user_id, $fill_input_id, $fill_process_id, $fill_report_id, $fill_senrity_id]);

            unset($_SESSION['gender']);
            unset($_SESSION['type_m']);
            unset($_SESSION['edu']);

            unset($_SESSION['input_setfeature']);
            unset($_SESSION['process_setfeature']);
            unset($_SESSION['report_setfeature']);
            unset($_SESSION['$senrity_setfeature']);

            unset($_SESSION['input_result']);
            unset($_SESSION['process_result']);
            unset($_SESSION['report_result']);
            unset($_SESSION['$senrity_result']);

            unset($_SESSION['input_compare']);
            unset($_SESSION['process_compare']);
            unset($_SESSION['report_compare']);
            unset($_SESSION['$senrity_compare']);

            header("location: form.php");
       }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}
?>
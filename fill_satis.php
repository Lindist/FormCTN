<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
} else {
    $user_id = $_SESSION['user_id'];
}

if (isset($_POST['save'])) {
    $sati_id = $_POST['sati_id'];
    $sati_name = $_POST['sati_name'];

    $ur_id = $_POST['ur_id'];
    $fun_id = $_POST['fun_id'];
    $uf_id = $_POST['uf_id'];
    $ss_id = $_POST['ss_id'];

    $sati_gender = $_POST['sati_gender'];
    $sati_type = $_POST['sati_type'];
    $sati_level = $_POST['sati_level'];

    $ur_topic = $_POST['ur_topic'];
    $input_feature = implode("@", $_POST['input_feature']);
    $input_setfeature = implode("@", $_POST['input_setfeature']);
    $input_result = implode("@", $_POST['input_result']);
    $input_compare = implode("@", $_POST['input_compare']);

    $fun_topic = $_POST['fun_topic'];
    $process_feature = implode("@", $_POST['process_feature']);
    $process_setfeature = implode("@", $_POST['process_setfeature']);
    $process_result = implode("@", $_POST['process_result']);
    $process_compare = implode("@", $_POST['process_compare']);

    $uf_topic = $_POST['uf_topic'];
    $report_feature = implode("@", $_POST['report_feature']);
    $report_setfeature = implode("@", $_POST['report_setfeature']);
    $report_result = implode("@", $_POST['report_result']);
    $report_compare = implode("@", $_POST['report_compare']);

    $ss_topic = $_POST['ss_topic'];
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

$_SESSION['gender'] = $_POST['gender'];
$_SESSION['type_m'] = $_POST['type_m'];
$_SESSION['edu'] = $_POST['edu'];

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
        

            $tb_fill_efficiercy = $conn->prepare("INSERT INTO tb_fill_efficiercy(form_id, form_name, form_gender, form_type, form_education, member_id, fill_input_id, fill_process_id, fill_report_id, fill_senrity_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $tb_fill_efficiercy->execute([$form_id, $form_name, $gender, $type_m, $edu, $user_id, $fill_input_id, $fill_process_id, $fill_report_id, $fill_senrity_id]);

            unset($_SESSION['gender']);
            unset($_SESSION['type_m']);
            unset($_SESSION['edu']);

            header("location: form.php");
       }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}
?>
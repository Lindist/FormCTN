<?php 

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_POST['save'])) {
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

    $_SESSION['formname'] = $formname;
    $_SESSION['ad'] = $ad;
    $_SESSION['gender'] = $gender;
    $_SESSION['type_m'] = $type_m;
    $_SESSION['edu'] = $edu;

    // echo $formname . "\n";
    // echo $ad . "\n";
    // echo $gender . "\n";
    // echo $type_m . "\n";
    // echo $edu . "\n";

if (empty($formname)) {
    $_SESSION['error'] = "กรุณากรอกชื่อฟอร์ม";
    header("location: insertform.php");
} else if (empty($ad)) {
    $_SESSION['error'] = "กรุณากรอกคำชี้แจง";
    header("location: insertform.php");
} else {
    try {
        if (!isset($_SESSION['error'])) {
            $tb_efficiercy_form = $conn -> prepare("INSERT INTO tb_efficiercy_form(form_name, form_ad, form_gender, form_type, form_education) VALUES(?, ?, ?, ?, ?)");
            $tb_efficiercy_form -> execute([$formname, $ad, $gender, $type_m, $edu]);

            $tb_input = $conn -> prepare("INSERT INTO tb_input(input_name, input_feature, input_setfeature, input_result, input_compare) VALUES(?, ?, ?, ?, ?)");
            $tb_input -> execute([$input_name, $input_feature, $input_setfeature, $input_result, $input_compare]);

            $tb_process = $conn -> prepare("INSERT INTO tb_process(process_name, process_feature, process_setfeature, process_result, process_compare) VALUES(?, ?, ?, ?, ?)");
            $tb_process -> execute([$process_name, $process_feature, $process_setfeature, $process_result, $process_compare]);

            $tb_report = $conn -> prepare("INSERT INTO tb_report(report_name, report_feature, report_setfeature, report_result, report_compare) VALUES(?, ?, ?, ?, ?)");
            $tb_report -> execute([$report_name, $report_feature, $report_setfeature, $report_result, $report_compare]);
            
            $tb_senrity = $conn -> prepare("INSERT INTO tb_senrity(senrity_name, senrity_feature, senrity_setfeature, senrity_result, senrity_compare) VALUES(?, ?, ?, ?, ?)");
            $tb_senrity -> execute([$senrity_name, $senrity_feature, $senrity_setfeature, $senrity_result, $senrity_compare]);
            
            unset($_SESSION['formname']);
            unset($_SESSION['ad']);

            header("location: form.php");

            // echo $input_feature;
            // print_r($_POST['input_feature']);
        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

?>
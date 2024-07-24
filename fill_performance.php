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
    $ad = $_POST['form_ad'];

    $sub_info_ex = [];
    for ($i = 1; $i <= count($_POST['form_info']); $i++) {
        if (isset($_POST['sub_info' . $i])) {
            $sub_info_ex[$i - 1] = implode("Ϫ", $_POST['sub_info' . $i]);
        }
    }

    for ($i = 1; $i <= count($_POST['form_topic']); $i++) {
        if (isset($_POST['feature' . $i]) && isset($_POST['setfeature' . $i])) {
            $combined_feature[$i - 1] = implode("Ϫ", $_POST['feature' . $i]);
            $combined_setfeature[$i - 1] = implode("Ϫ", $_POST['setfeature' . $i]);
            $combined_result[$i - 1] = implode("Ϫ", $_POST['result' . $i]);
            $combined_compare[$i - 1] = implode("Ϫ", $_POST['compare' . $i]);
        }
    }

    $form_info = implode("Ϫ", $_POST['form_info']);
    $sub_info = implode("ꓘ", $sub_info_ex);
    $form_topic = implode("Ϫ", $_POST['form_topic']);

    $feature = implode("ꓘ", $combined_feature);
    $setfeature = implode("ꓘ", $combined_setfeature);
    $result = implode("ꓘ", $combined_result);
    $compare = implode("ꓘ", $combined_compare);

    // echo $form_id." ";
    // echo $form_name;
    // echo "<br>";
    // echo $ad;
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐาน //";
    // print_r($form_info); // ข้อมูลพื้นฐาน
    // echo "<br>";
    // echo count($_POST['form_info']);
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐานย่อย //";
    // print_r($sub_info); // ข้อมูลพื้นฐานย่อย
    // echo "<br>";
    // echo "// หัวข้อด้าน //";
    // print_r($form_topic); // หัวข้อด้าน
    // echo "<br>";
    // echo count($_POST['form_topic']);
    // echo "<br>";
    // echo "// คุณสมบัติด้านเทคนิค //";
    // print_r($feature); // คุณสมบัติด้านเทคนิค
    // echo "<br>";
    // echo "// คุณสมบัติที่ตั้งไว้ //";
    // print_r($setfeature); // คุณสมบัติที่ตั้งไว้
    // echo "<br>";
    // echo "// คุณสมบัติที่ทำได้ //";
    // print_r($result); // คุณสมบัติที่ทำได้
    // echo "<br>";
    // echo "// ผลการเปรียบเทียบ //";
    // print_r($compare); // ผลการเปรียบเทียบ

}

function check_empty($array) {
    foreach ($array as $value) {
        if (empty($value)) {
            return true;
        }
    }
    return false;
}

if (check_empty($sub_info)) {
    $_SESSION['error'] = "กรุณากรอกข้อมูลพ์้นฐาน ให้ครบ";
    header("location: fill_performance_form.php?id=".$form_id);
    exit;
} else if (check_empty($feature)) {
    $_SESSION['error'] = "กรุณากรอกคุณสมบัติด้านเทคนิค ให้ครบ";
    header("location: fill_performance_form.php?id=".$form_id);
    exit;
} else if (check_empty($setfeature)) {
    $_SESSION['error'] = "กรุณากรอกคุณสมบัติที่ตั้งไว้ ให้ครบ";
    header("location: fill_performance_form.php?id=".$form_id);
    exit;
} else if (check_empty($result)) {
    $_SESSION['error'] = "กรุณากรอกคุณสมบัติที่ทำได้ ให้ครบ";
    header("location: fill_performance_form.php?id=".$form_id);
    exit;
} else if (check_empty($compare)) {
    $_SESSION['error'] = "กรุณากรอกผลการเปรียบเทียบ ให้ครบ";
    header("location: fill_performance_form.php?id=".$form_id);
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {

            $tb_fill_efficiercy = $conn->prepare("INSERT INTO tb_fill_efficiercy(form_id, form_name, form_ad, member_id, form_info, sub_info, form_topic, feature, setfeature, result, compare) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $tb_fill_efficiercy->execute([$form_id, $form_name, $ad, $user_id, $form_info, $sub_info, $form_topic, $feature, $setfeature, $result, $compare]);

            header("location: form.php");
       }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}
?>
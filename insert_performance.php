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

    // $sub_info_ex = preg_split("/ꓘ/", $sub_info);
    
    // echo $formname;
    // echo "<br>";
    // echo $ad;
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐาน //";
    // echo $form_info; // ข้อมูลพื้นฐาน
    // echo "<br>";
    // echo count($_POST['form_info']);
    // echo "// ข้อมูลพื้นฐานย่อย //";
    // print_r($sub_info); // ข้อมูลพื้นฐานย่อย
    // echo "<br>";
    // echo "// หัวข้อด้าน //";
    // print_r($form_topic); // หัวข้อด้าน
    // echo "<br>";
    // echo count($_POST['form_topic']);
    // echo "// คุณสมบัติด้านเทคนิค //";
    // print_r($feature); // คุณสมบัติด้านเทคนิค
    // echo "<br>";
    // echo "// คุณสมบัติที่ตั้งไว้ //";
    // print_r($setfeature); // คุณสมบัติที่ตั้งไว้

}

if (empty($formname)) {
    $_SESSION['error'] = "กรุณากรอกชื่อ โปรเจค";
    header("location: insert_performance_form.php");
    exit;
} else if (empty($ad)) {
    $_SESSION['error'] = "กรุณากรอกคำชี้แจง";
    header("location: insert_performance_form.php");
    exit;
} else if (empty($form_info)) {
    $_SESSION['error'] = "กรุณากรอก ข้อมูลพื้นฐาน อย่างน้อย 1 ประเภท";
    header("location: insert_performance_form.php");
    exit;
} else if (empty($form_topic)) {
    $_SESSION['error'] = "กรุณากรอก ด้าน อย่างน้อย 1 ด้าน";
    header("location: insert_performance_form.php");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {

            $tb_efficiercy_form = $conn->prepare("INSERT INTO tb_efficiercy_form(form_name, form_ad, member_id, form_info, sub_info, form_topic, feature, setfeature) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
            $tb_efficiercy_form->execute([$formname, $ad, $user_id, $form_info, $sub_info, $form_topic, $feature, $setfeature]);

            header("location: form.php?class=".$class);

        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
} else {
    $user_id  = $_SESSION['user_id'];
}

if (isset($_POST['save'])) {
    $sati_id = $_POST['sati_id'];
    $sati_name = $_POST['sati_name'];
    $sati_comment = $_POST['sati_comment'];
    
    $sub_info_ex = [];
    for ($i = 1; $i <= count($_POST['sati_info']); $i++) {
        if (isset($_POST['sub_info' . $i])) {
            $sub_info_ex[$i - 1] = implode("Ϫ", $_POST['sub_info' . $i]);
        }
    }

    for ($i = 1; $i <= count($_POST['sati_topic']); $i++) {
        if (isset($_POST['sub_topic' . $i])) {
            $ur_score_ex[$i - 1] = implode("Ϫ", $_POST['ur_score' . $i]);
        }
    }

    $combined_subtopic = [];
    for ($i = 1; $i <= count($_POST['sati_topic']); $i++) {
        if (isset($_POST['sub_topic' . $i])) {
            $combined_subtopic[$i - 1] = implode("Ϫ", $_POST['sub_topic' . $i]);
        }
    }

    $sati_info = implode("Ϫ", $_POST['sati_info']);
    $sub_info = implode("ꓘ", $sub_info_ex);
    $sati_topic = implode("Ϫ", $_POST['sati_topic']);
    $ur_score = implode("ꓘ", $ur_score_ex);
    $sub_topic = implode("ꓘ", $combined_subtopic);

    // echo $sati_id." ";
    // echo $sati_name;
    // echo "<br>";;
    // echo "// ข้อมูลพื้นฐาน //";
    // print_r($sati_info); // ข้อมูลพื้นฐาน
    // echo "<br>";
    // echo count($_POST['sati_info']);
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐานย่อย //";
    // print_r($sub_info); // ข้อมูลพื้นฐานย่อย
    // echo "<br>";
    // echo "// หัวข้อด้าน //";
    // print_r($sati_topic); // หัวข้อด้าน
    // echo "<br>";
    // echo count($_POST['sati_topic']);
    // echo "<br>";
    // echo "// sub_topic //";
    // print_r($sub_topic); // sub_topic
    // echo "<br>";
    // echo "// ur_score //";
    // print_r($ur_score); // ur_score

}

function check_empty($array)
{
    foreach ($array as $value) {
        if (empty($value)) {
            return true;
        }
    }
    return false;
}

if (empty($sub_info)) {
    $_SESSION['error'] = "กรุณากรอกข้อมูลพ์้นฐาน ให้ครบ";
    header("location: fill_performance_form.php?id=".$form_id);
    exit;
} else if (check_empty($ur_score_ex)) {
    $_SESSION['error'] = "กรุณากรอกคุณสมบัติด้านเทคนิค ให้ครบ";
    header("location: fill_performance_form.php?id=".$form_id);
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {

            $tb_fill_satisfied = $conn->prepare("INSERT INTO tb_fill_satisfied (sati_id, sati_ep2, sati_comment, member_id, sati_info, sub_info, sati_topic, sub_topic, score) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $tb_fill_satisfied->execute([$sati_id, $sati_name, $sati_comment, $user_id, $sati_info, $sub_info, $sati_topic, $sub_topic, $ur_score]);

            header("location: form.php");

        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}
?>
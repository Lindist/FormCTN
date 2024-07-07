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

    $ur_id = $_POST['ur_id'];
    $fun_id = $_POST['fun_id'];
    $uf_id = $_POST['uf_id'];
    $ss_id = $_POST['ss_id'];

    $sati_gender = $_POST['sati_gender'];
    $sati_type = $_POST['sati_type'];
    $sati_level = $_POST['sati_level'];
    $sati_comment = $_POST['sati_comment'];

    $ur_topic = implode($_POST['ur_topic']);
    $ur_score = implode("@", $_POST['ur_score']);

    $fun_topic = implode($_POST['fun_topic']);
    $fun_score = implode("@", $_POST['fun_score']);

    $uf_topic = implode($_POST['uf_topic']);
    $uf_score = implode("@", $_POST['uf_score']);

    $ss_topic = implode($_POST['ss_topic']);
    $ss_score = implode("@", $_POST['ss_score']);

    // // Echo all variables
    // echo "<pre>";
    // echo "sati_id: $sati_id\n";
    // echo "sati_name: $sati_name\n";
    // echo "ur_id: $ur_id\n";
    // echo "fun_id: $fun_id\n";
    // echo "uf_id: $uf_id\n";
    // echo "ss_id: $ss_id\n";
    // echo "sati_gender: $sati_gender\n";
    // echo "sati_type: $sati_type\n";
    // echo "sati_level: $sati_level\n";
    // echo "sati_comment: $sati_comment\n";
    // echo "ur_topic: $ur_topic\n";
    // echo "ur_score: $ur_score\n";
    // echo "fun_topic: $fun_topic\n";
    // echo "fun_score: $fun_score\n";
    // echo "uf_topic: $uf_topic\n";
    // echo "uf_score: $uf_score\n";
    // echo "ss_topic: $ss_topic\n";
    // echo "ss_score: $ss_score\n";
    // echo "</pre>";
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

$_SESSION['sati_gender'] = $_POST['sati_gender'];
$_SESSION['sati_type'] = $_POST['sati_type'];
$_SESSION['sati_level'] = $_POST['sati_level'];
$_SESSION['ur_score'] = $_POST['ur_score'];
$_SESSION['fun_score'] = $_POST['fun_score'];
$_SESSION['uf_score'] = $_POST['uf_score'];
$_SESSION['ss_score'] = $_POST['ss_score'];

if (empty($_POST['sati_gender'])) {
    $_SESSION['error'] = "กรุณาเลือก เพศ";
    header("location: fill_satis_form.php?id=$sati_id");
    exit;
} else if (empty($_POST['sati_type'])) {
    $_SESSION['error'] = "กรุณาเลือก ประเภทผู้ใช้";
    header("location: fill_satis_form.php?id=$sati_id");
    exit;
} else if (empty($_POST['sati_level'])) {
    $_SESSION['error'] = "กรุณาเลือก ระดับการศึกษา";
    header("location: fill_satis_form.php?id=$sati_id");
    exit;
} else if (check_empty($_POST['ur_score'])) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 1 ให้ครบ";
    header("location: fill_satis_form.php?id=$sati_id");
    exit;
} else if (check_empty($_POST['fun_score'])) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 2 ให้ครบ";
    header("location: fill_satis_form.php?id=$sati_id");
    exit;
} else if (check_empty($_POST['uf_score'])) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 3 ให้ครบ";
    header("location: fill_satis_form.php?id=$sati_id");
    exit;
} else if (check_empty($_POST['ss_score'])) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 4 ให้ครบ";
    header("location: fill_satis_form.php?id=$sati_id");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {
            echo "inloop";

            $conn->beginTransaction();

            // Insert ข้อมูลในตาราง tb_fill_user_req
            $stmt = $conn->prepare("INSERT INTO tb_fill_user_req (ur_id, ur_topic, ur_score) VALUES (?, ?, ?)");
            $stmt->execute([$ur_id, $ur_topic, $ur_score]);
            $fill_ur_id = $conn->lastInsertId();

            // Insert ข้อมูลในตาราง tb_fill_function
            $stmt = $conn->prepare("INSERT INTO tb_fill_function (fun_id, fun_topic, fun_score) VALUES (?, ?, ?)");
            $stmt->execute([$fun_id, $fun_topic, $fun_score]);
            $fill_fun_id = $conn->lastInsertId();

            // Insert ข้อมูลในตาราง tb_fill_uesful
            $stmt = $conn->prepare("INSERT INTO tb_fill_uesful (uf_id, uf_topic, uf_score) VALUES (?, ?, ?)");
            $stmt->execute([$uf_id, $uf_topic, $uf_score]);
            $fill_uf_id = $conn->lastInsertId();

            // Insert ข้อมูลในตาราง tb_fill_seurity
            // $stmt = $conn->prepare("INSERT INTO tb_fill_seurity (ss_id, ss_topic, ss_score) VALUES (?, ?, ?)");
            // $stmt->execute([$ss_id, $ss_topic, $ss_score]);
            // $fill_ss_id = $conn->lastInsertId();

            // // ถ้าทุกอย่างเรียบร้อย ให้ commit การทำงาน
            // $conn->commit();


            // $tb_fill_efficiercy = $conn->prepare("INSERT INTO tb_fill_satisfied (sati_id, sati_ep2, sati_gender, sati_type, sati_level, fill_ur_id, fill_fun_id, fill_uf_id, fill_ss_id, sati_comment, member_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // $tb_fill_efficiercy->execute([$sati_id, $sati_name, $sati_gender, $sati_type, $sati_level, $fill_ur_id, $fill_fun_id, $fill_uf_id, $fill_ss_id, $sati_comment, $user_id]);

            unset($_SESSION['sati_gender']);
            unset($_SESSION['sati_type']);
            unset($_SESSION['sati_level']);
            unset($_SESSION['ur_score']);
            unset($_SESSION['fun_score']);
            unset($_SESSION['uf_score']);
            unset($_SESSION['ss_score']);

            // header("location: form.php");
        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}
?>
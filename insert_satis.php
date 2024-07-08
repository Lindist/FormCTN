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
if(isset($_POST['class1'])){
    if($_POST['class1'] == "have"){
        $class1 = 'firstshow';
    }
    else{
        $class1 = $_POST['class1'];
    }
}

if (isset($_POST['save'])) {
    $sati_ep2 = $_POST['sati_ep2'];

    $sati_gender = implode(",", $_POST['sati_gender']);
    $sati_type = implode(",", $_POST['sati_type']);
    $sati_level = implode(",", $_POST['sati_level']);
    // $sati_comment = $_POST['sati_comment'];
    
    $ur_topic = implode("@", $_POST['ur_topic']);
    $fun_topic = implode("@", $_POST['fun_topic']);
    $uf_topic = implode("@", $_POST['uf_topic']);
    $ss_topic = implode("@", $_POST['ss_topic']);

    // echo $sati_ep2. "<br>";
    // print_r($sati_gender);
    // echo "<br>";
    // print_r($sati_type);
    // echo "<br>";
    // print_r($sati_level);
    // echo "<br>";
    // print_r($ur_topic);
    // echo "<br>";
    // // print_r($ur_score);
    // echo "<br>";
    // print_r($fun_topic);
    // echo "<br>";
    // // echo $fun_score;
    // echo "<br>";
    // print_r($uf_topic);
    // echo "<br>";
    // // echo $uf_score;
    // echo "<br>";
    // print_r($ss_topic);
    // echo "<br>";
    // // echo $ss_score;
    // echo "<br>";
    // echo "<br>comment<br>";
    // echo $sati_comment;
}

if (empty($sati_ep2)) {
    $_SESSION['error'] = "กรุณากรอกชื่อ โปรเจค";
    header("location: insert_satis_form.php");
    exit;
} else if (empty(array_filter($_POST['sati_gender']))) {
    $_SESSION['error'] = "กรุณากรอก เพศ อย่างน้อย 1 เพศ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty(array_filter($_POST['sati_type']))) {
    $_SESSION['error'] = "กรุณากรอก ประเภทผู้ใช้อย่างน้อย 1 ประเภท";
    header("location: insert_satis_form.php");
    exit;
} else if (empty(array_filter($_POST['sati_level']))) {
    $_SESSION['error'] = "กรุณากรอก ระดับการศึกษา อย่างน้อย 1 ระดับ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($ur_topic)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 1 อย่างน้อย 1 หัวข้อ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($fun_topic)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 2 อย่างน้อย 1 หัวข้อ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($uf_topic)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 3 อย่างน้อย 1 หัวข้อ";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($ss_topic)) {
    $_SESSION['error'] = "กรุณากรอกด้านที่ 4 อย่างน้อย 1 หัวข้อ";
    header("location: insert_satis_form.php");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {

            $tb_user_req = $conn->prepare("INSERT INTO tb_user_req(ur_topic) VALUES(?)");
            $tb_user_req->execute([$ur_topic]);

            $tb_function = $conn->prepare("INSERT INTO tb_function(fun_topic) VALUES(?)");
            $tb_function->execute([$fun_topic]);

            $tb_uesful = $conn->prepare("INSERT INTO tb_uesful(uf_topic) VALUES(?)");
            $tb_uesful->execute([$uf_topic]);

            $tb_seurity = $conn->prepare("INSERT INTO tb_seurity(ss_topic) VALUES(?)");
            $tb_seurity->execute([$ss_topic]);

            $sql_tb_user_req = $conn->prepare("SELECT * FROM tb_user_req WHERE ur_topic = :ur_topic");
            $sql_tb_user_req->bindParam(":ur_topic", $ur_topic);
            $sql_tb_user_req->execute();
            $tb_user_req = $sql_tb_user_req->fetch();

            $sql_tb_function = $conn->prepare("SELECT * FROM tb_function WHERE fun_topic = :fun_topic");
            $sql_tb_function->bindParam(":fun_topic", $fun_topic);
            $sql_tb_function->execute();
            $tb_function = $sql_tb_function->fetch();

            $sql_tb_uesful = $conn->prepare("SELECT * FROM tb_uesful WHERE uf_topic = :uf_topic");
            $sql_tb_uesful->bindParam(":uf_topic", $uf_topic);
            $sql_tb_uesful->execute();
            $tb_uesful = $sql_tb_uesful->fetch();

            $sql_tb_seurity = $conn->prepare("SELECT * FROM tb_seurity WHERE ss_topic = :ss_topic");
            $sql_tb_seurity->bindParam(":ss_topic", $ss_topic);
            $sql_tb_seurity->execute();
            $tb_seurity = $sql_tb_seurity->fetch();

            $tb_satisfied = $conn->prepare("INSERT INTO tb_satisfied(sati_ep2, sati_gender, sati_level, sati_type, ur_id, fun_id, uf_id, ss_id, member_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $tb_satisfied->execute([$sati_ep2, $sati_gender, $sati_level, $sati_type, $tb_user_req['ur_id'], $tb_function['fun_id'], $tb_uesful['uf_id'], $tb_seurity['ss_id'],$user_id]);

            header("location: form.php");

        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

?>
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

    $combined_subinfo = [];
    for ($i = 1; $i <= 10; $i++) {
        if (isset($_POST['sub_info' . $i])) {
            $combined_subinfo[$i - 1] = implode("Ϫ", $_POST['sub_info' . $i]);
        }
    }

    $combined_subtopic = [];
    for ($i = 1; $i <= 10; $i++) {
        if (isset($_POST['sub_topic' . $i])) {
            $combined_subtopic[$i - 1] = implode("Ϫ", $_POST['sub_topic' . $i]);
        }
    }

    $sati_info = implode("Ϫ", $_POST['sati_info']);

    $sub_info = implode("~", $combined_subinfo);

    $sati_topic = implode("Ϫ", $_POST['sati_topic']);

    $sub_topic = implode("~", $combined_subtopic);

    // $sub_info_ex = preg_split("/~/", $sub_info);
    
    echo $sati_ep2;
    echo "<br>";
    echo "// ข้อมูลพื้นฐาน //";
    echo $sati_info; // ข้อมูลพื้นฐาน
    echo "<br>";
    echo "// ข้อมูลพื้นฐานย่อย //";
    print_r($sub_info); // ข้อมูลพื้นฐานย่อย
    echo "<br>";
    echo "// หัวข้อด้าน //";
    print_r($sati_topic); // หัวข้อด้าน
    echo "<br>";
    echo "// ข้อมูลแต่ละด้าน //";
    print_r($sub_topic); // ข้อมูลแต่ละด้าน

}

if (empty($sati_ep2)) {
    $_SESSION['error'] = "กรุณากรอกชื่อ โปรเจค";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($sati_info)) {
    $_SESSION['error'] = "กรุณากรอก ข้อมูลพื้นฐาน อย่างน้อย 1 ประเภท";
    header("location: insert_satis_form.php");
    exit;
} else if (empty($sati_topic)) {
    $_SESSION['error'] = "กรุณากรอก ด้าน อย่างน้อย 1 ด้าน";
    header("location: insert_satis_form.php");
    exit;
} else {
    try {
        if (!isset($_SESSION['error'])) {

            // $tb_user_req = $conn->prepare("INSERT INTO tb_user_req(ur_topic) VALUES(?)");
            // $tb_user_req->execute([$ur_topic]);

            // $tb_function = $conn->prepare("INSERT INTO tb_function(fun_topic) VALUES(?)");
            // $tb_function->execute([$fun_topic]);

            // $tb_uesful = $conn->prepare("INSERT INTO tb_uesful(uf_topic) VALUES(?)");
            // $tb_uesful->execute([$uf_topic]);

            // $tb_seurity = $conn->prepare("INSERT INTO tb_seurity(ss_topic) VALUES(?)");
            // $tb_seurity->execute([$ss_topic]);

            // $sql_tb_user_req = $conn->prepare("SELECT * FROM tb_user_req WHERE ur_topic = :ur_topic");
            // $sql_tb_user_req->bindParam(":ur_topic", $ur_topic);
            // $sql_tb_user_req->execute();
            // $tb_user_req = $sql_tb_user_req->fetch();

            // $sql_tb_function = $conn->prepare("SELECT * FROM tb_function WHERE fun_topic = :fun_topic");
            // $sql_tb_function->bindParam(":fun_topic", $fun_topic);
            // $sql_tb_function->execute();
            // $tb_function = $sql_tb_function->fetch();

            // $sql_tb_uesful = $conn->prepare("SELECT * FROM tb_uesful WHERE uf_topic = :uf_topic");
            // $sql_tb_uesful->bindParam(":uf_topic", $uf_topic);
            // $sql_tb_uesful->execute();
            // $tb_uesful = $sql_tb_uesful->fetch();

            // $sql_tb_seurity = $conn->prepare("SELECT * FROM tb_seurity WHERE ss_topic = :ss_topic");
            // $sql_tb_seurity->bindParam(":ss_topic", $ss_topic);
            // $sql_tb_seurity->execute();
            // $tb_seurity = $sql_tb_seurity->fetch();

            $tb_satisfied = $conn->prepare("INSERT INTO tb_satisfied(sati_ep2, sati_info, sub_info, sati_topic, sub_topic, member_id) VALUES (?, ?, ?, ?, ?, ?)");
            $tb_satisfied->execute([$sati_ep2, $sati_info, $sub_info, $sati_topic, $sub_topic, $user_id]);

            header("location: form.php");

        }
    } catch (PDOException $e) {
        echo "Registrati3on failed: " . $e->getMessage();
    }
}

?>
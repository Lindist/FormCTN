<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}


$project_name = $_GET["name"];
$project_expired = $_GET["expired"];
$level_edu = $_GET["leveledu"];
$year_edu = $_GET["yearedu"];
$pro_id = $_GET["pro_id"];


try{
    $result = $conn->prepare("UPDATE project SET project_name = :pname ,project_expired = :expired ,project_leveledu = :leveledu ,project_yearedu = :yearedu WHERE project_id = :project_id");
    $result->bindParam(":pname", $project_name);
    $result->bindParam(":expired", $project_expired);
    $result->bindParam(":leveledu", $level_edu);
    $result->bindParam(":yearedu", $year_edu);
    $result->bindParam(":project_id", $pro_id);
    $result->execute();

    $sql = "SELECT * FROM tb_efficiercy_form WHERE project_id = :project_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':project_id', $pro_id, PDO::PARAM_INT);
    $stmt->execute();

    $sql1 = "SELECT * FROM tb_satisfied WHERE project_id = :project_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(':project_id', $pro_id, PDO::PARAM_INT);
    $stmt1->execute();

    $sql2 = "SELECT * FROM tb_fill_efficiercy WHERE project_id = :project_id";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':project_id', $pro_id, PDO::PARAM_INT);
    $stmt2->execute();

    $sql3 = "SELECT * FROM tb_fill_satisfied WHERE project_id = :project_id";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bindParam(':project_id', $pro_id, PDO::PARAM_INT);
    $stmt3->execute();

    if ($stmt->rowCount() > 0) {
        // echo "Record with project_id exists.";
        $tb_efficiercy_form = $conn->prepare("UPDATE tb_efficiercy_form SET form_name = ? WHERE project_id = ?");
        $tb_efficiercy_form->execute([$project_name, $pro_id]);
    }

    if ($stmt1->rowCount() > 0) {
        // echo "Record with project_id exists.";
        $tb_satisfied = $conn->prepare("UPDATE tb_satisfied SET sati_ep2 = ? WHERE project_id = ?");
        $tb_satisfied->execute([$project_name, $pro_id]);
    }

    if ($stmt2->rowCount() > 0) {
        // echo "Record with project_id exists.";
        $tb_fill_efficiercy = $conn->prepare("UPDATE tb_fill_efficiercy SET form_name = ? WHERE project_id = ?");
        $tb_fill_efficiercy->execute([$project_name, $pro_id]);
    }

    if ($stmt3->rowCount() > 0) {
        // echo "Record with project_id exists.";
        $tb_fill_satisfied = $conn->prepare("UPDATE tb_fill_satisfied SET sati_ep2 = ? WHERE project_id = ?");
        $tb_fill_satisfied->execute([$project_name, $pro_id]);
    }

    if($result){
        $_SESSION['addproject'] = "แก้ไขข้อมูลโครงการเรียบร้อย";
        header("location: form.php");
    }else{
        echo "Something Wrong";
    }

} catch (PDOException $e) {
    echo "Registrati3on failed: " . $e->getMessage();
}


?>
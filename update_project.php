<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
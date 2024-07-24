<?php 
session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

$project_name = $_POST["pname"];
$project_expired = $_POST["expired"];
$level_edu = $_POST["level_edu"];
$year_edu = $_POST["year_edu"];

try{
    if(count($project_name) == count($project_expired) && count($level_edu) == count($year_edu) && count($project_expired) == count($year_edu)) {
        for($i = 0;$i<count($project_name);$i++){
            $result = $conn->prepare("INSERT INTO project(project_name,project_expired,project_leveledu,project_yearedu,member_id)VALUES(:pname,:expired,:leveledu,:yearedu,:id)");
            $result->bindParam(":pname", $project_name[$i]);
            $result->bindParam(":expired", $project_expired[$i]);
            $result->bindParam(":leveledu", $level_edu[$i]);
            $result->bindParam(":yearedu", $year_edu[$i]);
            $result->bindParam(":id", $user_id);
            $result->execute();
        }
    }else{
        echo "Data not equal";
    }

    if($result){
        $_SESSION['addproject'] = "เพิ่มข้อมูลโครงการเรียบร้อย";
        header("location: form.php");
    }else{
        echo "Something Wrong";
    }

} catch (PDOException $e) {
    echo "Registrati3on failed: " . $e->getMessage();
}

?>
<?php 

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}


$form_name = $_POST['formname'];
echo $form_name;
$result = $conn->prepare("INSERT INTO tb_efficiercy_form(form_name) VALUES(:form_name)");
$result->bindParam(":form_name",$form_name);
// $result->bindParam(":datelocal",$datetime);
// $result->bindParam(":year",$year);
// $result->bindParam(":edu",$edul);
$result->execute();

if($result){
    echo "<script>";
    echo "alert('เพิ่มข้อมูลเสร็จสิ้น!');";
    echo "location.href='form.php';";
    echo "</script>";
}
else{
    echo mysqli_error($conn);
}

?>
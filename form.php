<?php

    session_start();
    require 'config.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
    }

    $result = $conn->query("SELECT * FROM tb_efficiercy_form");
    $count = count($result->fetchAll());
    $result->execute();
    $input = $conn->query("SELECT * FROM tb_input");
    $input->execute();
    $process = $conn->query("SELECT * FROM tb_process");
    $process->execute();
    $report = $conn->query("SELECT * FROM tb_report");
    $report->execute();
    $senrity = $conn->query("SELECT * FROM tb_senrity");
    $senrity->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/formstyle2.css">
    <title>From</title>
</head>
<body>
    <header>
    <h1>CTN Phrae</h1>
    <div>
        <a href="logout.php" class="logout">ออกจากระบบ <img src="picture/logout.png"></a>
    </div>
    </header>
    <div class="container"> 
        <div class="btnshow">
            <a href="insertform.php" class="adds">เพิ่มแบบสอบถาม</a>  
            <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>  
        </div>
    <div class="form-box" id="adddata"> 
    <?php if($count > 0){ ?>
            <script type="text/javascript">
                const showform = document.querySelector('#adddata');
                showform.classList.remove('form-box');
                showform.classList.add('grid');
                showform.insertAdjacentHTML("beforeend",`
                <?php for($c = 1;$c <= $count;$c++){ ?>
                        <?php $row = $result->fetch(PDO::FETCH_ASSOC); ?>
                        <?php $row1 = $input->fetch(PDO::FETCH_ASSOC); ?>
                        <?php $row2 = $process->fetch(PDO::FETCH_ASSOC); ?>
                        <?php $row3 = $report->fetch(PDO::FETCH_ASSOC); ?>
                        <?php $row4 = $senrity->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120'>
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c; ?></h2>
                        <div class='text'><?php echo $row['form_name']; ?></div>
                        <div class="btns">
                        <a id='btn' onclick="isaddClass(['<?php echo $row['form_id']; ?>','<?php echo $row1['Input_id']; ?>','<?php echo $row2['process_id']; ?>','<?php echo $row3['report_id']; ?>','<?php echo $row4['senrity_id']; ?>'])" >ดูข้อมูล</a>
                        <a href='#?id=<?php echo $row['form_id']; ?>&id_input=<?php echo $row1['Input_id']; ?>&id_process=<?php echo $row2['process_id']; ?>&id_report=<?php echo $row3['report_id']; ?>&id_senrity=<?php echo $row4['senrity_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c; ?>','<?php echo $row['form_id']; ?>','<?php echo $row1['Input_id']; ?>','<?php echo $row2['process_id']; ?>','<?php echo $row3['report_id']; ?>','<?php echo $row4['senrity_id']; ?>'])" >ลบ</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`
                );
            </script>
        <?php }else{ ?>
            <img class='disimg' src="picture/empty-folder.png">
            <h3 class='disimg'>ไม่มีข้อมูลแบบสอบถาม</h3>
        <?php } ?>
    </div>
    </div>
    <script src="script/script_add_data3.js"></script>
</body>
</html>

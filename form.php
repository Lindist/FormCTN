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
                        <div class='container120'>
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c; ?></h2>
                        <div class='text'><?php echo $row['form_name']; ?></div>
                        <div class="btns">
                        <a href='ShowallData.php?id=<?php echo $row['form_id']; ?>&id_input=<?php echo $row1['Input_id']; ?>' id='btn'>ดูข้อมูล</a>
                        <a href='#?id=<?php echo $row['form_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a href='#?id=<?php echo $row['form_id']; ?>' id='btndelete'>ลบ</a>
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
    <script src="script/script_add_data1.js"></script>
</body>
</html>

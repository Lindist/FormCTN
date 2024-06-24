<?php

    session_start();
    require 'config.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
    }

    $result = $conn->query("SELECT * FROM tb_efficiercy_form");
    $count = count($result->fetchAll());
    $result->execute();
    // $input = $conn->query("SELECT * FROM tb_input");
    // $input->execute();
    // $process = $conn->query("SELECT * FROM tb_process");
    // $process->execute();
    // $report = $conn->query("SELECT * FROM tb_report");
    // $report->execute();
    // $senrity = $conn->query("SELECT * FROM tb_senrity");
    // $senrity->execute();

    $result1 = $conn->query("SELECT * FROM tb_satisfied");
    $count1 = count($result1->fetchAll());
    $result1->execute();
    // $user_req = $conn->query("SELECT * FROM tb_user_req");
    // $user_req->execute();
    // $function = $conn->query("SELECT * FROM tb_function");
    // $function->execute();
    // $uesful = $conn->query("SELECT * FROM tb_uesful");
    // $uesful->execute();
    // $seurity = $conn->query("SELECT * FROM tb_seurity");
    // $seurity->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/formstyle7.css">
    <link rel="stylesheet" href="style/tabstyle1.css">
    <title>From</title>
</head>
<body>
    <header>
    <h1>CTN Phrae</h1>
    <div class="tab_box">
    <button class="tab_btn active" id="tab1"><h3>แบบฟอร์มประเมินประสิทธิภาพ</h3></button>
    <button class="tab_btn" id="tab2"><h3>แบบฟอร์มประเมินความพึงพอใจ</h3></button>
    <div class="line"></div>
    </div>
    <div>
        <a href="logout.php" class="logout">ออกจากระบบ <img src="picture/logout.png"></a>
    </div>
    </header>
    <div class="content_box active">
    <div class="container"> 
        <div class="btnshow">
            <a href="#" class="adds" id="addFormperformance">เพิ่มแบบสอบถาม</a>
            <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>  
        </div>
        <div class="form-box" id="adddata"> 
    <?php if($count > 0){ ?>
            <script type="text/javascript">
                const showform = document.querySelectorAll('#adddata');
                showform[0].classList.remove('form-box');
                showform[0].classList.add('grid');
                showform[0].insertAdjacentHTML("beforeend",`
                <?php for($c = 1;$c <= $count;$c++){ ?>
                        <?php $row = $result->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120'>
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c; ?></h2>
                        <div class='text'><?php echo $row['form_name']; ?></div>
                        <div class="btns">
                        <a id='btn' onclick="isaddClass('<?php echo $row['form_id']; ?>')" >ดูข้อมูล</a>
                        <a href='editform.php?id=<?php echo $row['form_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c; ?>','<?php echo $row['form_id']; ?>'])" >ลบ</a>
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

    </div>
    <div class="content_box">
    <div class="container"> 
        <div class="btnshow">
            <a href="#" class="adds" id="addFormsatisfy">เพิ่มแบบสอบถาม</a>
            <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>  
        </div>
        <div class="form-box" id="adddata"> 
    <?php if($count1 > 0){ ?>
            <script type="text/javascript">
                const showform1 = document.querySelectorAll('#adddata');
                showform1[1].classList.remove('form-box');
                showform1[1].classList.add('grid');
                showform1[1].insertAdjacentHTML("beforeend",`
                <?php for($c1 = 1;$c1 <= $count1;$c1++){ ?>
                        <?php $row5 = $result1->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120'>
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c1; ?></h2>
                        <div class='text'><?php echo $row5['sati_ep2']; ?></div>
                        <div class="btns">
                        <a id='btn' onclick="isaddClass('<?php echo $row5['sati_id']; ?>')" >ดูข้อมูล</a>
                        <a href='editform.php?id=<?php echo $row5['sati_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c1; ?>','<?php echo $row5['sati_id']; ?>'])" >ลบ</a>
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

    </div>
    <script src="script/active2.js" type="module"></script>
    <script src="script/script_add_data10.js"></script>
</body>
</html>

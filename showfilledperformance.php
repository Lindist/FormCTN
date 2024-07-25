<?php

session_start();
require 'session/config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id']; 
}
if (isset($_GET['form_id'])) {
    $form_id = $_GET['form_id']; 
}
$result = $conn->query("SELECT * FROM tb_fill_efficiercy WHERE form_id = '$form_id' AND member_id = '$user_id'"); 
$result->execute();
$row = $result->fetch(PDO::FETCH_ASSOC);

$formname = $row['form_name'];
$ad = $row['form_ad'];
$form_info_un = $row['form_info'];
$sub_info_un = $row['sub_info'];
$form_topic_un = $row['form_topic'];
$feature_un = $row['feature'];
$setfeature_un = $row['setfeature'];
$result_un = $row['feature'];
$compare_un = $row['setfeature'];

$form_info = preg_split("/Ϫ/", $form_info_un);
$sub_info = preg_split("/ꓘ/", $sub_info_un);
$form_topic = preg_split("/Ϫ/", $form_topic_un);
$feature = preg_split("/ꓘ/", $feature_un);
$setfeature = preg_split("/ꓘ/", $setfeature_un);
$resultfilled = preg_split("/ꓘ/", $result_un);
$comparefilled = preg_split("/ꓘ/", $compare_un);

$sub_info_ex = [];
 foreach ($sub_info as $index => $info) {
    $sub_info_ex[$index] = preg_split("/Ϫ/", $info);
}
$feature_ex = [];
foreach ($feature as $index => $topic) {
    $feature_ex[$index] = preg_split("/Ϫ/", $topic);
}

$setfeature_ex = [];
foreach ($setfeature as $index => $topic) {
    $setfeature_ex[$index] = preg_split("/Ϫ/", $topic);
}

$resultfilled_ex = [];
foreach ($resultfilled as $index => $topic) {
    $resultfilled_ex[$index] = preg_split("/Ϫ/", $topic);
}

$comparefilled_ex = [];
foreach ($comparefilled as $index => $topic) {
    $comparefilled_ex[$index] = preg_split("/Ϫ/", $topic);
}
// print_r($resultfilled_ex);
// print_r($comparefilled_ex);

if (isset($_GET['class'])) {
    $class = $_GET['class'];
}else{
    $class = 'nohave';
}

?>

<!doctype html>
<html lang="en">

<head>
<head>
    <title>แบบฟอร์มประเมินประสิทธิภาพ</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        body {
            background-color: rgb(180, 180, 180);
        }

        label {
            text-align: start;
            font-weight: bold;
        }

        h1 {
            font-weight: bold;
        }
        .table,
        .rad {
            border: 1px solid #000;
        }

        .table {
            vertical-align: middle;
        }

        @media screen and (min-width: 990px) {
            .content {
                width: 700px;
                margin: auto;
            }

            .container {
                width: 850px;
            }
        }
    </style>
</head>

<body>
    <div class="main container-fluid col-11 bg-white py-1 my-3 rounded">
    <aside style="display: flex; width: 170px; justify-content: space-between; flex-wrap: wrap;">
        <button type="button" onclick="isClass('<?php echo $class; ?>')" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
            กลับหน้าแรก
        </button>
        <button type="button" onclick="history.back()" style="display:flex; background-color:#111; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#333';" onmouseout="this.style.backgroundColor='#111';">
            กลับ
        </button>
    </aside>
        <form>
            <h1 class="text-center my-5">แบบฟอร์มประเมินประสิทธิภาพ</h1>

            <!-- Title_Content -->
            <div class="head_content mt-5 mb-2">
                <label class="form-label">ชื่อแบบฟอร์ม</label>
                <div class="rad form-control text-break">
                    <?php echo $formname; ?>
                </div>

                <label class="form-label mt-2">คำชี้แจง</label>
                <div class="rad form-control text-break">
                <?php echo $ad; ?>
                </div>
            </div>
            <!-- Body_Content -->
            <div class="body_content mt-5">
                <label class="form-label font-bold">ตอนที่ 1</label>
                <label for="">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>
                <?php foreach($form_info as $index => $values){ ?>
                    <div class="group-row mt-3">
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label w-50 text-center"><?= $values; ?></label>
                            <div class="col mt-2">
                                <?php for ($b = 0; $b < count($sub_info_ex[$index]); $b++) { ?>
                                <?php if(!($sub_info_ex[$index][$b] == null)){ ?>
                                <input class="rad form-check-input" type="radio" value="" disabled name="" >
                                <label>
                                <?php echo $sub_info_ex[$index][$b]; ?>
                                </label><br>
                                <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <label class="form-label">ตอนที่ 2</label>
                <label for="">แบบสอบถามความคิดเห็น</label> <br>
                <label class="form-label mt-2">คำชี้แจง</label>
                <label for="">โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label> <br>
                <!-- Start table -->
                 <?php foreach($form_topic as $index => $value){ ?>
                <label class="form-label mt-2">ด้านที่ <?php echo ($index+1)." ".$value; ?></label>
                <div  id="widthfix">
                <table class="table table-bordered table-striped text-center mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ที่</th>
                            <th scope="col">คุณสมบัติด้านเทคนิค</th>
                            <th scope="col">คุณสมบัติที่ตั้งไว้</th>
                            <th scope="col">คุณสมบัติที่ทำได้</th>
                            <th scope="col">ผลการเปรียบเทียบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($b = 0; $b < count($feature_ex[$index]); $b++){ ?>
                        <tr>
                            <th scope="row"><?php echo $b+1 ?></th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $feature_ex[$index][$b]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $setfeature_ex[$index][$b]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $resultfilled_ex[$index][$b]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $comparefilled_ex[$index][$b]; ?></div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                <?php } ?>
                
            </div>
        </form>
        <button type="button" class="btn btn-primary w-100 mt-2 mb-4" onclick="isClass('<?php echo $class; ?>')">กลับหน้าแรก</button>
    </div>
    <style>
        #format{
            overflow-wrap: break-word;
            display:inline-block; 
            position: relative;
            top: 0;
            text-align: justify;
        }
        .form-control1{
            width: 10em;
        }
        #widthfix{
            overflow-x: scroll;
        }
    </style>
    <script src="script/changeclass.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
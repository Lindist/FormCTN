<?php

session_start();
require 'config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tb_efficiercy_form  WHERE form_id = '$id'"); 
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    // echo "<script>";
    // echo "alert('$row');";
    // echo "</script>";
    // print_r($row);
}
if (isset($_GET['id_input'])) {
    $input_id = $_GET['id_input'];
    $result1 = $conn->query("SELECT * FROM tb_input  WHERE Input_id = '$input_id'"); 
    $result1->execute();
    $row1 = $result1->fetch(PDO::FETCH_ASSOC);
    $input_feature = preg_split("/@/", $row1["Input_feature"]);
    $input_setfeature = preg_split("/@/", $row1["Input_setfeature"]);
    $input_result = preg_split("/@/", $row1["Input_result"]);
    $input_compare = preg_split("/@/", $row1["Input_compare"]);
    
}
if (isset($_GET['id_process'])) {
    $id_process = $_GET['id_process'];
    $result2 = $conn->query("SELECT * FROM tb_process WHERE process_id = '$id_process'"); 
    $result2->execute();
    $row2 = $result2->fetch(PDO::FETCH_ASSOC);
    $process_feature = preg_split("/@/", $row2["process_feature"]);
    $process_setfeature = preg_split("/@/", $row2["process_setfeature"]);
    $process_result = preg_split("/@/", $row2["process_result"]);
    $process_compare = preg_split("/@/", $row2["process_compare"]);
    
}
if (isset($_GET['id_report'])) {
    $id_report = $_GET['id_report'];
    $result3 = $conn->query("SELECT * FROM tb_report WHERE report_id = '$id_report'"); 
    $result3->execute();
    $row3 = $result3->fetch(PDO::FETCH_ASSOC);
    $report_feature = preg_split("/@/", $row3["report_feature"]);
    $report_setfeature = preg_split("/@/", $row3["report_setfeature"]);
    $report_result = preg_split("/@/", $row3["report_result"]);
    $report_compare = preg_split("/@/", $row3["report_compare"]);
    
}
if (isset($_GET['id_senrity'])) {
    $id_senrity = $_GET['id_senrity'];
    $result4 = $conn->query("SELECT * FROM tb_senrity WHERE senrity_id = '$id_senrity'"); 
    $result4->execute();
    $row4 = $result4->fetch(PDO::FETCH_ASSOC);
    $senrity_feature = preg_split("/@/", $row4["senrity_feature"]);
    $senrity_setfeature = preg_split("/@/", $row4["senrity_setfeature"]);
    $senrity_result = preg_split("/@/", $row4["senrity_result"]);
    $senrity_compare = preg_split("/@/", $row4["senrity_compare"]);
    
}
if (isset($_GET['class'])) {
    $class = $_GET['class'];
}else{
    $class = 'nohave';
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>แบบฟอร์มประเมินประสิทธิภาพ</title>
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
    <div class="main container col-11 bg-white py-1 my-3 rounded">
    <button type="button" onclick="isClass('<?php echo $class; ?>')" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
            Back to Index
    </button>
        <form>
            <h1 class="text-center my-5">แบบฟอร์มประเมินประสิทธิภาพ</h1>

            <!-- Title_Content -->
            <div class="head_content mt-5 mb-2">
                <label class="form-label">ชื่อแบบฟอร์ม</label>
                <div class="rad form-control">
                    <?php echo $row['form_name']; ?>
                </div>

                <label class="form-label mt-2">คำชี้แจง</label>
                <div class="rad form-control">
                <?php echo $row['form_ad']; ?>
                </div>
            </div>
            <!-- Body_Content -->
            <div class="body_content mt-5">
                <label class="form-label font-bold">ตอนที่ 1</label>
                <label for="">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>
                <div class="group-row mt-3">
                    <div class="mb-3 row">
                        <label class="col-3 col-form-label w-50 text-center">เพศ</label>
                        <div class="col mt-2">
                            <?php if($row['form_gender'] == "ชาย" ) { ?>
                            <input class="rad form-check-input" type="radio" value="ชาย" name="gender" checked>
                            <label class="form-check-label">
                                ชาย
                            </label><br>
                            <?php }else if($row['form_gender'] == "หญิง" ) { ?>
                            <input class="rad form-check-input" type="radio" value="หญิง" name="gender" checked>
                            <label class="form-check-label">
                                หญิง
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-3 col-form-label w-50 text-center">ประเภทผู้ใช้</label>

                    <div class="col mt-2">
                    <?php if($row['form_type'] == "อาจารย์" ) { ?>
                        <input class="rad form-check-input" type="radio" value="อาจารย์" name="type_m" checked>
                        <label class="form-check-label">
                            อาจารย์
                        </label><br>
                    <?php }else if($row['form_type'] == "นักเรียน/นักศึกษา" ) { ?>
                        <input class="rad form-check-input" type="radio" value="นักเรียน/นักศึกษา" name="type_m" checked>
                        <label class="form-check-label">
                            นักเรียน/นักศึกษา
                        </label><br>
                        <?php }else if($row['form_type'] == "บุคคลภายนอก" ) { ?>
                        <input class="rad form-check-input" type="radio" value="บุคคลภายนอก" name="type_m" checked>
                        <label class="form-check-label">
                            บุคคลภายนอก
                        </label>
                        <?php } ?>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-3 col-form-label w-50 text-center">ระดับการศึกษา</label>
                    <div class="col mt-2">
                    <?php if($row['form_education'] == "มัธยมต้น" ) { ?>
                        <input class="rad form-check-input" type="radio" value="มัธยมต้น" name="edu" checked>
                        <label class="form-check-label">
                            มัธยมต้น
                        </label><br>
                    <?php }else if($row['form_education'] == "มัธยมปลาย/ปวช." ) { ?>
                        <input class="rad form-check-input" type="radio" value="มัธยมปลาย/ปวช." name="edu" checked>
                        <label class="form-check-label">
                            มัธยมปลาย/ปวช.
                        </label><br>
                    <?php } else if($row['form_education'] == "อนุปริญญา/ปวส." ) { ?>
                        <input class="rad form-check-input" type="radio" value="อนุปริญญา/ปวส." name="edu" checked>
                        <label class="form-check-label">
                            อนุปริญญา/ปวส.
                        </label><br>
                    <?php } else if($row['form_education'] == "ป.ตรี" ) { ?>
                        <input class="rad form-check-input" type="radio" value="ป.ตรี" name="edu" checked>
                        <label class="form-check-label">
                            ป.ตรี
                        </label><br>
                    <?php } else if($row['form_education'] == "สูงกว่า ป.ตรี" ) { ?>
                        <input class="rad form-check-input" type="radio" value="สูงกว่า ป.ตรี" name="edu" checked>
                        <label class="form-check-label">
                            สูงกว่า ป.ตรี
                        </label>
                    <?php } ?>
                    </div>
                </div>
                <label class="form-label">ตอนที่ 2</label>
                <label for="">แบบสอบถามความคิดเห็น</label> <br>
                <label class="form-label mt-2">คำชี้แจง</label>
                <label for="">โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label> <br>
                <!-- Start table -->
                <label class="form-label mt-2">ด้านที่ 1</label>
                <div class="rad form-control mb-2"><?php echo $row1["Input_name"]; ?></div>
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
                        <tr>
                            <th scope="row">1</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_feature[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_setfeature[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_result[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_compare[0]; ?></div></td>
                        </tr>
                        <!-- <tr>
                            <th scope="row">2</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_feature[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_setfeature[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_result[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_compare[1]; ?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_feature[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_setfeature[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_result[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_compare[2]; ?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_feature[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_setfeature[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_result[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $input_compare[3]; ?></div></td>
                        </tr> -->
                    </tbody>
                </table>
                </div>
                
                <label class="form-label">ด้านที่ 2</label>
                <div class="rad form-control mb-2"><?php echo $row2['process_name']; ?></div>
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
                        <tr>
                            <th scope="row">1</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_feature[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_setfeature[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_result[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_compare[0]; ?></div></td>
                        </tr>
                        <!-- <tr>
                            <th scope="row">2</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_feature[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_setfeature[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_result[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_compare[1]; ?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_feature[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_setfeature[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_result[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_compare[2]; ?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_feature[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_setfeature[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_result[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $process_compare[3]; ?></div></td>
                        </tr> -->
                    </tbody>
                </table>
                </div>
                <label class="form-label">ด้านที่ 3</label>
                <div class="rad form-control mb-2"><?php echo $row3['report_name']; ?></div>
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
                        <tr>
                            <th scope="row">1</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_feature[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_setfeature[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_result[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_compare[0]; ?></div></td>
                        </tr>
                        <!-- <tr>
                            <th scope="row">2</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_feature[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_setfeature[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_result[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_compare[1]; ?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_feature[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_setfeature[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_result[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_compare[2]; ?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_feature[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_setfeature[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_result[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $report_compare[3]; ?></div></td>
                        </tr> -->
                    </tbody>
                </table>
                </div>
                <label class="form-label">ด้านที่ 4</label>
                <div class="rad form-control mb-2"><?php echo $row4['senrity_name']; ?></div>
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
                        <tr>
                            <th scope="row">1</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_feature[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_setfeature[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_result[0]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_compare[0]; ?></div></td>
                        </tr>
                        <!-- <tr>
                            <th scope="row">2</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_feature[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_setfeature[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_result[1]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_compare[1]; ?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_feature[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_setfeature[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_result[2]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_compare[2]; ?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_feature[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_setfeature[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_result[3]; ?></div></td>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $senrity_compare[3]; ?></div></td>
                        </tr> -->
                    </tbody>
                </table>
                </div>
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
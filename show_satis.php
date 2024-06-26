<?php

session_start();
require 'session/config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tb_satisfied  WHERE sati_id = '$id'"); 
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    // echo "<script>";
    // echo "alert('$row');";
    // echo "</script>";
    // $genders = preg_split("/,/", $row["form_gender"]);
    // $form_type = preg_split("/,/", $row["form_type"]);
    // $form_education = preg_split("/,/", $row["form_education"]);
    // print_r($genders);
    $ur = $row['ur_id'];
    $fun = $row['fun_id'];
    $uf = $row['uf_id'];
    $ss = $row['ss_id'];
    
    $result1 = $conn->query("SELECT * FROM tb_user_req  WHERE ur_id = '$ur'"); 
    $result1->execute();
    $row1 = $result1->fetch(PDO::FETCH_ASSOC);
    // $input_feature = preg_split("/@/", $row1["Input_feature"]);
    
    $result2 = $conn->query("SELECT * FROM tb_function WHERE fun_id = '$fun'"); 
    $result2->execute();
    $row2 = $result2->fetch(PDO::FETCH_ASSOC);
    // $process_feature = preg_split("/@/", $row2["process_feature"]);
    
    $result3 = $conn->query("SELECT * FROM tb_uesful WHERE uf_id = '$uf'"); 
    $result3->execute();
    $row3 = $result3->fetch(PDO::FETCH_ASSOC);
    // $report_feature = preg_split("/@/", $row3["report_feature"]);
    
    $result4 = $conn->query("SELECT * FROM tb_seurity WHERE ss_id = '$ss'"); 
    $result4->execute();
    $row4 = $result4->fetch(PDO::FETCH_ASSOC);
    // $senrity_feature = preg_split("/@/", $row4["senrity_feature"]);

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
    <title>แบบฟอร์มประเมินความพึงพอใจ</title>
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
            width: 100%;
        }
        th,td{
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
    <div class="main overflow-x-hidden container col-11 bg-white py-1 my-3 rounded">
    <button type="button" onclick="isClass('<?php echo $class; ?>')" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
            Back to Index
    </button>
        <form>
            <h1 class="text-center my-5">แบบฟอร์มประเมินความพึงพอใจ</h1>

            <!-- Title_Content -->
            <div class="head_content mt-5 mb-2">
                <label class="text-2xl mb-5 font-bold">คำชี้แจง</label> <br>
                <label class="font-bold" for="">ในแบบประเมินความพึงพอใจการใช้งานระบบ แบ่งออกเป็น 3 ตอนดังนี้</label> <br>
                <label class="font-bold" for="">ตอนที่ 1</label> <br>
                <label class="font-bold" for="">เป็นข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label> <br>
                <label class="font-bold" for="">ตอนที่ 2 เป็นแบบสอบถามความคิดเห็นของนักเรียน นักศึกษา และครูอาจารย์ของผู้ใช้งาน 
                </label><br>
                <span class="rad form-control overflow-x-scroll mb-2" style="width: 100%;"><?php echo $row['sati_ep2']; ?></span>
                <div class="position-relative w-50 mb-4 mt-4 me-5">
                    <label class="font-bold position-absolute top-auto start-50 translate-middle-x w-100" for="">โดยแบ่งการประเมินเป็น 4 ด้าน คือ</label> <br>
                </div>
                <div class="position-relative w-50 mb-4 mt-4 me-5">
                    <label class="font-bold position-absolute top-auto start-50 w-100" for="">ด้านที่ 1 ความต้องการของผู้ใช้งานระบบ</label> <br>
                </div>
                <div class="position-relative w-50 mb-4 mt-4 me-5">
                    <label class="font-bold position-absolute top-auto start-50 w-100" for="">ด้านที่ 2 ด้านการทำงานของฟั่งชั่นระบบ</label> <br>
                </div>
                <div class="position-relative w-50 mb-4 mt-4 me-5">
                    <label class="font-bold position-absolute top-auto start-50 w-100" for="">ด้านที่ 3 ด้านความง่ายต่อการใช้ระบบ</label> <br>
                </div>
                <div class="position-relative w-50 mb-5 mt-4 me-5">
                    <label class="font-bold position-absolute top-auto start-50 w-100" for="">ด้านที่ 4 ด้านการใช้งานรักษาความปลอดภัยของข้อมูลในระบบ</label> <br>
                </div>
                <label class="font-bold" for="">ตอนที่ 3 เป็นข้อคิดเห็นและเสนอแนะอื่นๆ</label> <br>
            </div>
            <!-- Body_Content -->
            <div class="body_content mt-5">
                <label class="form-label font-bold">ตอนที่ 1</label>
                <label for="">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label><br>
                <label class="col-3 col-form-label">1.เพศ</label><br>
                <label class="col-3 col-form-label">2.สถานะของผู้สอบถาม</label><br>
                <label class="col-3 col-form-label">3.ระดับการศึกษา</label><br>

                <label class="form-label">ตอนที่ 2</label>
                <label for="">แบบสอบถามความคิดเห็น</label> <br>
                <label class="form-label mt-2">คำชี้แจง</label>
                <label for="">โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label> <br>
                <!-- Start table -->
                <label class="form-label mt-2">ด้านที่ 1</label>
                <div class="rad form-control mb-2"><?php echo $row1["ur_topic"]; ?></div>
                <div  id="widthfix">
                <table class="table table-bordered table-striped text-center mt-3">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2">ที่</th>
                            <th scope="col" rowspan="2">หัวข้อ</th>
                            <th scope="col" colspan="6">ระดับความคิดเห็น</th>
                        </tr>
                        <tr>
                            <th scope="col">5</th>
                            <th scope="col">4</th>
                            <th scope="col">3</th>
                            <th scope="col">2</th>
                            <th scope="col">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $row1['ur_score']; ?></div></td>	
                            <td><div class="form-control1" id="format" rows="3"></div></td>
                            <td><div class="form-control1" id="format" rows="3"></div></td>
                            <td><div class="form-control1" id="format" rows="3"></div></td>
                            <td><div class="form-control1" id="format" rows="3"></div></td>
                            <td><div class="form-control1" id="format" rows="3"></div></td>
                        </tr>
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
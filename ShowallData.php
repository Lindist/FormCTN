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

?>

<!doctype html>
<html lang="en">

<head>
    <title>แบบฟอร์มประเมินประสิทธิภาพ</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
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

        textarea {
            resize: none;
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
        <form action="form.php">
            <h1 class="text-center my-5">แบบฟอร์มประเมินประสิทธิภาพ</h1>

            <!-- Title_Content -->
            <div class="head_content mt-5 mb-2">
                <label class="form-label">ชื่อแบบฟอร์ม</label>
                <div id="formname" class="rad form-control">
                    <?php echo $row['form_name']; ?>
                </div>

                <label class="form-label mt-2">คำชี้แจง</label>
                <div class="rad form-control" id="ad">
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
                <input type="text" name="input_name" class="rad form-control mb-2">
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
                            <td><textarea name="input_feature" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="input_setfeature" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="input_result" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="input_compare" class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <label class="form-label">ด้านที่ 2</label>
                <input type="text" name="process_name" class="rad form-control mb-2">
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
                            <td><textarea name="process_feature" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="process_setfeature" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="process_result" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="process_compare" class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <label class="form-label">ด้านที่ 3</label>
                <input type="text" name="report_name" class="rad form-control mb-2">
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
                            <td><textarea name="report_feature" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="report_setfeature" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="report_result" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="report_compare" class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <label class="form-label">ด้านที่ 4</label>
                <input type="text" name="senrity_name" class="rad form-control mb-2">
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
                            <td><textarea name="senrity_feature" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="senrity_setfeature" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="senrity_result" class="form-control" rows="3"></textarea></td>
                            <td><textarea name="senrity_compare" class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                            <td><textarea class="form-control" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" name="save" class="btn btn-primary w-100 mt-2 mb-4">บันทึก</button>
        </form>
    </div>
    <script>

    </>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
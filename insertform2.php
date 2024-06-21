<?php

session_start();
require('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
    <title>แบบประเมินความพึงพอใจ</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
            background-color: rgb(180, 180, 180);
        }
    </style>
</head>

<body>
    <div class="container mx-auto bg-white p-4 my-4 rounded shadow">
        <button type="button" onclick="isClass('<?php echo $class; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Back to Index
        </button>
        <form action="insertData2.php" method="POST">
            <h1 class="text-center text-3xl mb-5">แบบฟอร์มประเมินความพึงพอใจ</h1>
            <!-- Title_Content -->
            <div class="head_content mt-5 mb-2">
                <label class="text-2xl mb-5 font-bold">คำชี้แจง</label> <br>
                <label class="font-bold" for="">ในแบบประเมินความพึงพอใจการใช้งานระบบ แบ่งออกเป็น 3 ตอนดังนี้</label> <br>
                <label class="font-bold" for="">ตอนที่ 1</label> <br>
                <label class="font-bold" for="">เป็นข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label> <br>
                <label class="font-bold" for="">ตอนที่ 2</label> <br>
                <input class="font-bold" type="text" class="rad form-control mb-2">

            </div>
            <!-- Body_Content -->
            <div class="body_content mt-5">
                <label class="form-label mt-2">ตอนที่ 1</label>
                <label for="">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>
                <div class="group-row mt-3">
                    <div class="mb-3 row">
                        <label class="col-3 col-form-label w-50 text-center">เพศ</label>
                        <div class="col mt-2">
                            <input class="rad form-check-input" type="radio" name="gender" checked>
                            <label class="form-check-label">
                                ชาย
                            </label><br>
                            <input class="rad form-check-input" type="radio" name="gender">
                            <label class="form-check-label">
                                หญิง
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-3 col-form-label w-50 text-center">ประเภทผู้ใช้</label>
                    <div class="col mt-2">
                        <input class="rad form-check-input" type="radio" name="type_m">
                        <label class="form-check-label">
                            อาจารย์
                        </label><br>
                        <input class="rad form-check-input" type="radio" name="type_m" checked>
                        <label class="form-check-label">
                            นักเรียน/นักศึกษา
                        </label><br>
                        <input class="rad form-check-input" type="radio" name="type_m">
                        <label class="form-check-label">
                            บุคคลภายนอก
                        </label>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-3 col-form-label w-50 text-center">ระดับการศึกษา</label>
                    <div class="col mt-2">
                        <input class="rad form-check-input" type="radio" name="edu">
                        <label class="form-check-label">
                            มัธยมต้น
                        </label><br>
                        <input class="rad form-check-input" type="radio" name="edu" checked>
                        <label class="form-check-label">
                            มัธยมปลาย/ปวช.
                        </label><br>
                        <input class="rad form-check-input" type="radio" name="edu">
                        <label class="form-check-label">
                            อนุปริญญา/ปวส.
                        </label><br>
                        <input class="rad form-check-input" type="radio" name="edu">
                        <label class="form-check-label">
                            ป.ตรี
                        </label><br>
                        <input class="rad form-check-input" type="radio" name="edu">
                        <label class="form-check-label">
                            สูงกว่า ป.ตรี
                        </label>
                    </div>
                </div>
                <label class="form-label mt-2">ตอนที่ 2</label>
                <label for="">แบบสอบถามความคิดเห็น</label><br>
                <label class="form-label mt-2">คำชี้แจง</label>



                <div class="d-flex flex-column justify-content-center text-center">
                    <div class="row">
                        <div class="col text-right">
                            ระดับคะแนน 5 หมายถึง
                        </div>
                        <div class="col">
                            พึงพอใจมากที่สุด
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            ระดับคะแนน 4 หมายถึง
                        </div>
                        <div class="col">
                            พึงพอใจมาก
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            ระดับคะแนน 3 หมายถึง
                        </div>
                        <div class="col">
                            พึงใจปานกลาง
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            ระดับคะแนน 2 หมายถึง
                        </div>
                        <div class="col">
                            พึงใจพอน้อย
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            ระดับคะแนน 1 หมายถึง
                        </div>
                        <div class="col">
                            พึงพอใจน้อยที่สุด
                        </div>
                    </div>
                    <!-- Start Table -->
                    <label class="form-label mt-2"> ด้านที่ 1 ด้านความต้องการของผู้ใช้งานระบบ</label>

                    <table class="table table-bordered table-striped text-center mt-3">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2">ที่</th>
                                <th scope="col" rowspan="2">หัวข้อ</th>
                                <th scope="col" colspan="5">ระดับความคิดเห็น</th>
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
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
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
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <label class="form-label mt-2"> ด้านที่ 2 ด้านการทำงานตามฟังก์ชันของระบบ</label>

                    <table class="table table-bordered table-striped text-center mt-3">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2">ที่</th>
                                <th scope="col" rowspan="2">หัวข้อ</th>
                                <th scope="col" colspan="5">ระดับความคิดเห็น</th>
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
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
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
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <label class="form-label mt-2"> ด้านที่ 3 ด้านความง่ายต่อการใช้งานของระบบ</label>

                    <table class="table table-bordered table-striped text-center mt-3">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2">ที่</th>
                                <th scope="col" rowspan="2">หัวข้อ</th>
                                <th scope="col" colspan="5">ระดับความคิดเห็น</th>
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
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
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
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <label class="form-label mt-2"> ด้านที่ 4 ด้านการใช้งานรักษาความปลอดภัยของข้อมูลในระบบ</label>

                    <table class="table table-bordered table-striped text-center mt-3">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2">ที่</th>
                                <th scope="col" rowspan="2">หัวข้อ</th>
                                <th scope="col" colspan="5">ระดับความคิดเห็น</th>
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
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
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
                                <td><textarea class="form-control" rows="3"></textarea></td>
                                <td><textarea class="form-control" rows="3"></textarea></td>
                            </tr>
                        </tbody>
                    </table>

                    <label for=""> <b> ตอนที่ 3 ข้อเสนอแนะอื่นๆ</b></label> <br>
                    <textarea class="form-control mb-2" name="" id="" cols="30" rows="10"></textarea>


                    <button type="submit" class="btn btn-primary w-100 mt-2 mb-4">บันทึก</button>
                </div>
        </form>
    </div>
    <script src="script/changeclass.js"></script>
</body>

</html>
<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_GET['class'])) {
    $class = $_GET['class'];
} else {
    $class = 'nohave';
}

if (isset($_GET['class1'])) {
    $class1 = $_GET['class1'];
} else {
    $class1 = 'nohave';
}

$keys = [];

for ($i = 0; $i < 20; $i++) { // Replace 10 with any large number or condition
    $keys[$i] = null;
}

$formname = isset($_SESSION['formname']) && $_SESSION['formname'] ? $_SESSION['formname'] : '';
unset($_SESSION['formname']); // Clear the session flag after use

$ad = isset($_SESSION['ad']) && $_SESSION['ad'] ? $_SESSION['ad'] : '';
unset($_SESSION['ad']); // Clear the session flag after use

$gender = isset($_SESSION['gender']) && $_SESSION['gender'] ? $_SESSION['gender'] : $keys;
unset($_SESSION['gender']); // Clear the session flag after use

$type_m = isset($_SESSION['type_m']) && $_SESSION['type_m'] ? $_SESSION['type_m'] : $keys;
unset($_SESSION['type_m']); // Clear the session flag after use

$edu = isset($_SESSION['edu']) && $_SESSION['edu'] ? $_SESSION['edu'] : $keys;
unset($_SESSION['edu']); // Clear the session flag after use

$input_feature = isset($_SESSION['input_feature']) && $_SESSION['input_feature'] ? $_SESSION['input_feature'] : $keys;
unset($_SESSION['input_feature']); // Clear the session flag after use

$process_feature = isset($_SESSION['process_feature']) && $_SESSION['process_feature'] ? $_SESSION['process_feature'] : $keys;
unset($_SESSION['process_feature']); // Clear the session flag after use

$report_feature = isset($_SESSION['report_feature']) && $_SESSION['report_feature'] ? $_SESSION['report_feature'] : $keys;
unset($_SESSION['report_feature']); // Clear the session flag after use

$senrity_feature = isset($_SESSION['senrity_feature']) && $_SESSION['senrity_feature'] ? $_SESSION['senrity_feature'] : $keys;
unset($_SESSION['senrity_feature']); // Clear the session flag after use

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
        <button type="button" onclick="isClass('<?php echo $class; ?>','<?php echo $class1; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Back to Index
        </button>
        <form action="insert_satis.php" method="POST">
            <h1 class="text-center text-3xl mb-5">แบบฟอร์มประเมินความพึงพอใจ</h1>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="text-center mb-4 p-3 mt-10 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <!-- Title_Content -->
            <div class="head_content mt-5 mb-2">
                <label class="text-lg"><label class="text-lg font-bold mb-2">คำชี้แจง </label>ในแบบประเมินความพึงพอใจการใช้งานระบบ แบ่งออกเป็น 3 ตอนดังนี้</label><br><br>
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 1 </label>เป็นข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label><br><br>
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label><br>เป็นแบบสอบถามความคิดเห็นของ #แสดงตอนดู#<br>ที่มีต่อ #กรอกชื่อโปรเจ็ก# โดยแบ่งการประเมินเป็น 4 ด้าน คือ</label><br>
                <label class="text-lg ml-8">ด้านที่ 1 ด้านความต้องการของผู้ใช้งานระบบ</label><br>
                <label class="text-lg ml-8">ด้านที่ 2 ด้านการทำงานตามฟังค์ชันของระบบ</label><br>
                <label class="text-lg ml-8">ด้านที่ 3 ด้านความง่ายต่อการใช้งานระบบ</label><br>
                <label class="text-lg ml-8">ด้านที่ 4 ด้านการใช้งานรักษาความปลอดภัยของข้อมูลในระบบ</label><br>

            </div>

            <!-- Body_Content -->
            <div class="mb-4">
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 1 </label>ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

                <!-- Gender -->
                <hr class="my-3">

                <div class="grid grid-cols-2 mb-4">
                    <label class="block text-center mb-1">เพศ</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="genders[]" id="" value="<?= $gender[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="genders[]" id="" value="<?= $gender[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="genders[]" id="" value="<?= $gender[2] ?>">
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-400">***ไม่จำเป็นต้องกรอกครบ***</p>
                        </div>
                    </div>
                </div>

                <!-- User Type -->
                <hr class="my-3">

                <div class="grid grid-cols-2 mb-4">
                    <label class="block text-center mb-1">ประเภทผู้ใช้</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="" value="<?= $type_m[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="" value="<?= $type_m[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="" value="<?= $type_m[2] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="" value="<?= $type_m[3] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="" value="<?= $type_m[4] ?>">
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-400">***ไม่จำเป็นต้องกรอกครบ***</p>
                        </div>
                    </div>
                </div>

                <!-- Education Level -->
                <hr class="my-3">

                <div class="grid grid-cols-2 mb-4">
                    <label class="block text-center mb-1">ระดับการศึกษา</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="" value="<?= $edu[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="" value="<?= $edu[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="" value="<?= $edu[2] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="" value="<?= $edu[3] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="" value="<?= $edu[4] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="" value="<?= $edu[5] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="" value="<?= $edu[6] ?>">
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-400">***ไม่จำเป็นต้องกรอกครบ***</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Survey Section 2 -->
            <hr class="my-3">

            <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label>แบบสอบถามความคิดเห็น</label><br>
            <label class="text-lg"><label class="text-lg font-bold mb-2">คำชี้แจง </label>โปรดใส่เครื่องหมาย ✔ ลงในช่องระดับความคิดเห็น (ข้อละ 1 ช่อง) ให้ตรงกับความคิดเห็นของ ท่านมากที่สุด</label><br>

            <div class="text-lg mb-4 mt-2">
                <div class="row ml-8">
                    ระดับคะแนน 5 หมายถึง พึงพอใจมากที่สุด
                </div>
                <div class="row ml-8">
                    ระดับคะแนน 4 หมายถึง พึงพอใจมาก
                </div>
                <div class="row ml-8">
                    ระดับคะแนน 3 หมายถึง พึงพอใจปานกลาง
                </div>
                <div class="row ml-8">
                    ระดับคะแนน 2 หมายถึง พึงพอใจน้อย
                </div>
                <div class="row ml-8">
                    ระดับคะแนน 1 หมายถึง พึงพอใจน้อยที่สุด
                </div>
            </div>

            <div>

                <!-- Start Table -->
                <label class="text-lg"><label class="text-lg font-bold">ด้านที่ 1 </label>ด้านความต้องการของผู้ใช้งานระบบ</label><br>
                <input type="hidden" name="" value="ด้านความต้องการของผู้ใช้งานระบบ">

                <table class="w-full border border-gray-300 text-center my-3">
                    <thead>
                        <tr class="bg-gray-200">
                            <th scope="col" rowspan="2" class="border border-gray-300 py-2">ที่</th>
                            <th scope="col" rowspan="2" class="border border-gray-300 py-2">หัวข้อ</th>
                            <th scope="col" colspan="5" class="border border-gray-300 py-2">ระดับความคิดเห็น</th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 py-2">5</th>
                            <th scope="col" class="border border-gray-300 py-2">4</th>
                            <th scope="col" class="border border-gray-300 py-2">3</th>
                            <th scope="col" class="border border-gray-300 py-2">2</th>
                            <th scope="col" class="border border-gray-300 py-2">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd :bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                            <td class="border border-gray-300 py-2">1</td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><input class="w-full h-16 border border-gray-300 px-2 py-1 flex items-center" type="radio" name="group1" id=""></td>
                            <td class="border border-gray-300 py-2"><input class="w-full h-16 border border-gray-300 px-2 py-1 flex items-center" type="radio" name="group1" id=""></td>
                            <td class="border border-gray-300 py-2"><input class="w-full h-16 border border-gray-300 px-2 py-1 flex items-center" type="radio" name="group1" id=""></td>
                            <td class="border border-gray-300 py-2"><input class="w-full h-16 border border-gray-300 px-2 py-1 flex items-center" type="radio" name="group1" id=""></td>
                            <td class="border border-gray-300 py-2"><input class="w-full h-16 border border-gray-300 px-2 py-1 flex items-center" type="radio" name="group1" id=""></td>
                        </tr>

                        <!-- <tr class="odd :bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="odd :bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="odd :bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="odd :bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                            <td class="border border-gray-300 py-2">5</td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr> -->
                    </tbody>
                </table>
                <button type="button" id="section3addbtn" onclick="section3add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section3removebtn" onclick="section3remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 2 </label>ด้านการทำงานตามฟังก์ชันของระบบ</label>
                <input type="hidden" name="" value="ด้านการทำงานตามฟังก์ชันของระบบ">

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

                    </tbody>
                </table>

                <label for=""> <b> ตอนที่ 3 ข้อเสนอแนะอื่นๆ</b></label> <br>
                <textarea class="form-control mb-2" name="" id="" cols="30" rows="10"></textarea>


                <button type="submit" class="btn btn-primary w-100 mt-2 mb-4">บันทึก</button>
            </div>
        </form>
    </div>
    <script src="script/changeclassforform2.js"></script>
</body>

</html>
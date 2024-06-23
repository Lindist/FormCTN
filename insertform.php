<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_GET['class'])) {
    $class = $_GET['class'];
} else {
    $class = 'nohave';
}

$keys = [];

for ($i = 0; $i < 20; $i++) { // Replace 10 with any large number or condition
    $keys[$i] = null;
}

$formname = isset($_SESSION['formname']) && $_SESSION['formname'] ? $_SESSION['formname'] : '';
unset($_SESSION['formname']); // Clear the session flag after use

$ad = isset($_SESSION['ad']) && $_SESSION['ad'] ? $_SESSION['ad'] : '';
unset($_SESSION['ad']); // Clear the session flag after use

$gender = isset($_SESSION['gender']) && $_SESSION['gender'] ? $_SESSION['gender'] : '';
unset($_SESSION['gender']); // Clear the session flag after use

$type_m = isset($_SESSION['type_m']) && $_SESSION['type_m'] ? $_SESSION['type_m'] : '';
unset($_SESSION['type_m']); // Clear the session flag after use

$edu = isset($_SESSION['edu']) && $_SESSION['edu'] ? $_SESSION['edu'] : '';
unset($_SESSION['edu']); // Clear the session flag after use

$input_name = isset($_SESSION['input_name']) && $_SESSION['input_name'] ? $_SESSION['input_name'] : '';
unset($_SESSION['input_name']); // Clear the session flag after use

$process_name = isset($_SESSION['process_name']) && $_SESSION['process_name'] ? $_SESSION['process_name'] : '';
unset($_SESSION['process_name']); // Clear the session flag after use

$report_name = isset($_SESSION['report_name']) && $_SESSION['report_name'] ? $_SESSION['report_name'] : '';
unset($_SESSION['report_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$input_feature = isset($_SESSION['input_feature']) && $_SESSION['input_feature'] ? $_SESSION['input_feature'] : $keys;
unset($_SESSION['input_feature']); // Clear the session flag after use

$input_setfeature = isset($_SESSION['input_setfeature']) && $_SESSION['input_setfeature'] ? $_SESSION['input_setfeature'] : $keys;
unset($_SESSION['input_setfeature']); // Clear the session flag after use

$input_result = isset($_SESSION['input_result']) && $_SESSION['input_result'] ? $_SESSION['input_result'] : $keys;
unset($_SESSION['input_result']); // Clear the session flag after use

$input_compare = isset($_SESSION['input_compare']) && $_SESSION['input_compare'] ? $_SESSION['input_compare'] : $keys;
unset($_SESSION['input_compare']); // Clear the session flag after use

$process_feature = isset($_SESSION['process_feature']) && $_SESSION['process_feature'] ? $_SESSION['process_feature'] : $keys;
unset($_SESSION['process_feature']); // Clear the session flag after use

$process_setfeature = isset($_SESSION['process_setfeature']) && $_SESSION['process_setfeature'] ? $_SESSION['process_setfeature'] : $keys;
unset($_SESSION['process_setfeature']); // Clear the session flag after use

$process_result = isset($_SESSION['process_result']) && $_SESSION['process_result'] ? $_SESSION['process_result'] : $keys;
unset($_SESSION['process_result']); // Clear the session flag after use

$process_compare = isset($_SESSION['process_compare']) && $_SESSION['process_compare'] ? $_SESSION['process_compare'] : $keys;
unset($_SESSION['process_compare']); // Clear the session flag after use

$report_feature = isset($_SESSION['report_feature']) && $_SESSION['report_feature'] ? $_SESSION['report_feature'] : $keys;
unset($_SESSION['report_feature']); // Clear the session flag after use

$report_setfeature = isset($_SESSION['report_setfeature']) && $_SESSION['report_setfeature'] ? $_SESSION['report_setfeature'] : $keys;
unset($_SESSION['report_setfeature']); // Clear the session flag after use

$report_result = isset($_SESSION['report_result']) && $_SESSION['report_result'] ? $_SESSION['report_result'] : $keys;
unset($_SESSION['report_result']); // Clear the session flag after use

$report_compare = isset($_SESSION['report_compare']) && $_SESSION['report_compare'] ? $_SESSION['report_compare'] : $keys;
unset($_SESSION['report_compare']); // Clear the session flag after use

$senrity_feature = isset($_SESSION['senrity_feature']) && $_SESSION['senrity_feature'] ? $_SESSION['senrity_feature'] : $keys;
unset($_SESSION['senrity_feature']); // Clear the session flag after use

$senrity_setfeature = isset($_SESSION['senrity_setfeature']) && $_SESSION['senrity_setfeature'] ? $_SESSION['senrity_setfeature'] : $keys;
unset($_SESSION['senrity_setfeature']); // Clear the session flag after use

$senrity_result = isset($_SESSION['senrity_result']) && $_SESSION['senrity_result'] ? $_SESSION['senrity_result'] : $keys;
unset($_SESSION['senrity_result']); // Clear the session flag after use

$senrity_compare = isset($_SESSION['senrity_compare']) && $_SESSION['senrity_compare'] ? $_SESSION['senrity_compare'] : $keys;
unset($_SESSION['senrity_compare']); // Clear the session flag after use


?>

<!doctype html>
<html lang="en">

<head>
    <title>แบบฟอร์มประเมินประสิทธิภาพ</title>
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
    <script src="js/addtable.js"></script>
</head>

<body>
    <div class="container mx-auto bg-white p-4 my-4 rounded shadow">
        <button type="button" onclick="isClass('<?php echo $class; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Back to Index
        </button>
        <form action="insertData.php" method="POST">
            <h1 class="text-center text-2xl mb-5">แบบฟอร์มประเมินประสิทธิภาพ</h1>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="text-center mb-4 p-3 mt-10 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <!-- Title_Content -->
            <div class="mb-4">
                <label class="block text-lg font-bold mb-2">ชื่อแบบฟอร์ม</label>
                <input type="text" value="<?= $formname ?>" name="formname" id="formname" class="block w-full border border-gray-300 rounded px-3 py-2 mb-3">

                <label class="block text-lg font-bold mb-2">คำชี้แจง</label>
                <textarea name="ad" class="block w-full border border-gray-300 rounded px-3 py-2" rows="5"><?= $ad ?></textarea>
            </div>

            <!-- Body_Content -->
            <div class="mb-4">
                <label class="block text-lg font-bold mb-2">ตอนที่ 1 ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

                <!-- Gender -->
                <hr class="my-3">

                <div class="grid grid-cols-2 mb-4">
                    <label class="block text-center mb-1">เพศ</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="genders[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="genders[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="genders[]" id="">
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
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="kinduser[]" id="">
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
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3" name="le_education[]" id="">
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-400">***ไม่จำเป็นต้องกรอกครบ***</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Survey Section 2 -->
            <hr class="my-3">

            <div class="mb-4">
                <label for="" class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label>แบบสอบถามความคิดเห็น</label>

                <label for="" class="block text-lg"><label class=" text-lg font-bold mb-2">คำชี้แจง </label>โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label>

                <!-- Section 1 -->

                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 1 </label>ด้านการนำเข้าข้อมูลระบบ</label>
                <input type="hidden" name="input_name" value="ด้านการนำเข้าข้อมูลระบบ">

                <table class="w-full border border-gray-300 text-center my-3">
                    <thead>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 py-2">ที่</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติด้านเทคนิค</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติที่ตั้งไว้</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติที่ทำได้</th>
                            <th scope="col" class="border border-gray-300 py-2">ผลการเปรียบเทียบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                            <td class="border border-gray-300 py-2">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_feature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_setfeature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_result[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_compare[0] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section1tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_feature[]" id="section1tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_setfeature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_result[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_compare[1] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section1tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_feature[]" id="section1tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_setfeature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_result[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_compare[2] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section1tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_feature[]" id="section1tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_setfeature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_result[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_compare[3] ?></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="section1addbtn" onclick="section1add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section1removebtn" onclick="section1remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 2 -->

                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 2 </label>ด้านการประมวลผล</label>
                <input type="hidden" name="process_name" value="ด้านการประมวลผล">

                <table class="w-full border border-gray-300 text-center my-3">
                    <thead>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 py-2">ที่</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติด้านเทคนิค</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติที่ตั้งไว้</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติที่ทำได้</th>
                            <th scope="col" class="border border-gray-300 py-2">ผลการเปรียบเทียบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                            <td class="border border-gray-300 py-2">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_feature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_setfeature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_result[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_compare[0] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section2tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_setfeature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_result[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_compare[1] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section2tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_setfeature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_result[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_compare[2] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section2tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_setfeature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_result[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_compare[3] ?></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="section2addbtn" onclick="section2add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section2removebtn" onclick="section2remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 3 -->


                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 3 </label>ด้านการรายงานข้อมูล</label>
                <input type="hidden" name="report_name" value="ด้านการรายงานข้อมูล">

                <table class="w-full border border-gray-300 text-center my-3">
                    <thead>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 py-2">ที่</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติด้านเทคนิค</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติที่ตั้งไว้</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติที่ทำได้</th>
                            <th scope="col" class="border border-gray-300 py-2">ผลการเปรียบเทียบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="border border-gray-300 py-2">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_setfeature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_result[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_compare[0] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section3tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_setfeature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_result[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_compare[1] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd :bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section3tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_setfeature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_result[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_compare[2] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section3tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_setfeature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_result[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_compare[3] ?></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="section3addbtn" onclick="section3add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section3removebtn" onclick="section3remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 4 -->

                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 4 </label>ด้านความปลอดภัย</label>
                <input type="hidden" name="senrity_name" value="ด้านความปลอดภัย">

                <table class="w-full border border-gray-300 text-center my-3">
                    <thead>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 py-2">ที่</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติด้านเทคนิค</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติที่ตั้งไว้</th>
                            <th scope="col" class="border border-gray-300 py-2">คุณสมบัติที่ทำได้</th>
                            <th scope="col" class="border border-gray-300 py-2">ผลการเปรียบเทียบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                            <td class="border border-gray-300 py-2">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_setfeature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_result[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_compare[0] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section4tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_setfeature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_result[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_compare[1] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section4tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_setfeature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_result[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_compare[2] ?></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section4tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_setfeature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_result[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_compare[3] ?></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="section4addbtn" onclick="section4add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section4removebtn" onclick="section4remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

            </div>
            <div class="text-center mt-5">
                <button type="submit" name="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
            </div>
    </div>


    </form>
    </div>
    <script src="script/changeclass.js"></script>
</body>

</html>
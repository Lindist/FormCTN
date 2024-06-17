<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$formname = isset($_SESSION['formname']) && $_SESSION['formname'] ? $_SESSION['formname'] : '';
unset($_SESSION['formname']); // Clear the session flag after use

$ad = isset($_SESSION['ad']) && $_SESSION['ad'] ? $_SESSION['ad'] : '';
unset($_SESSION['ad']); // Clear the session flag after use

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
</head>

<body>
    <div class="container mx-auto bg-white p-4 my-4 rounded shadow">
        <form action="insertData.php" method="POST">
            <h1 class="text-center text-2xl mb-5">แบบฟอร์มประเมินประสิทธิภาพ</h1>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert bg-yellow-200 text-center py-2 mb-4 rounded">
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
                <label class="block text-lg font-bold mb-2">ตอนที่ 1</label>
                <label class="block mb-6">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

                <!-- Gender -->
                <div class="grid grid-cols-2 mb-4">
                    <label class="block text-center mb-1">เพศ</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="ชาย" name="gender" checked>
                            <label class="ml-2">ชาย</label>
                        </div>
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="หญิง" name="gender">
                            <label class="ml-2">หญิง</label>
                        </div>
                    </div>
                </div>

                <!-- User Type -->
                <div class="grid grid-cols-2 mb-4">
                    <label class="block text-center mb-1">ประเภทผู้ใช้</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="อาจารย์" name="type_m">
                            <label class="ml-2">อาจารย์</label>
                        </div>
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="นักเรียน/นักศึกษา" name="type_m" checked>
                            <label class="ml-2">นักเรียน/นักศึกษา</label>
                        </div>
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="บุคคลภายนอก" name="type_m">
                            <label class="ml-2">บุคคลภายนอก</label>
                        </div>
                    </div>
                </div>

                <!-- Education Level -->
                <div class="grid grid-cols-2 mb-4">
                    <label class="block text-center mb-1">ระดับการศึกษา</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="มัธยมต้น" name="edu">
                            <label class="ml-2">มัธยมต้น</label>
                        </div>
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="มัธยมปลาย/ปวช." name="edu" checked>
                            <label class="ml-2">มัธยมปลาย/ปวช.</label>
                        </div>
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="อนุปริญญา/ปวส." name="edu">
                            <label class="ml-2">อนุปริญญา/ปวส.</label>
                        </div>
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="ป.ตรี" name="edu">
                            <label class="ml-2">ป.ตรี</label>
                        </div>
                        <div class="flex items-center">
                            <input class="my-2 h-6 w-6" type="radio" value="สูงกว่า ป.ตรี" name="edu">
                            <label class="ml-2">สูงกว่า ป.ตรี</label>
                        </div>
                    </div>
                </div>

                <!-- Survey Section 2 -->
                <div class="mb-4">

                    <label class="block text-lg font-bold mb-2">ตอนที่ 2</label>
                    <label class="block mb-2">แบบสอบถามความคิดเห็น</label>
                    <label class="block mb-2">โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label>

                    <!-- Section 1 -->
                    <label class="block text-lg font-bold my-2">ด้านที่ 1</label>
                    <input type="text" name="input_name" class="block w-full border border-gray-300 rounded px-3 py-2 mb-2">

                    <table class="w-full border border-gray-300 text-center mt-3">
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
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Section 2 -->
                    <label class="block text-lg font-bold my-2">ด้านที่ 2</label>
                    <input type="text" name="process_name" class="block w-full border border-gray-300 rounded px-3 py-2 mb-2">

                    <table class="w-full border border-gray-300 text-center mt-3">
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
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Section 3 -->
                    <label class="block text-lg font-bold my-2">ด้านที่ 3</label>
                    <input type="text" name="report_name" class="block w-full border border-gray-300 rounded px-3 py-2 mb-2">
                    
                    <table class="w-full border border-gray-300 text-center mt-3">
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
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Section 4 -->
                    <label class="block text-lg font-bold my-2">ด้านที่ 4</label>
                    <input type="text" name="senrity_name" class="block w-full border border-gray-300 rounded px-3 py-2 mb-2">
                    
                    <table class="w-full border border-gray-300 text-center mt-3">
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
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" name="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</body>

</html>
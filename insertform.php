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

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$input_feature = isset($_SESSION['input_feature']) && $_SESSION['input_feature'] ? $_SESSION['input_feature'] : '';
unset($_SESSION['input_feature']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

$senrity_name = isset($_SESSION['senrity_name']) && $_SESSION['senrity_name'] ? $_SESSION['senrity_name'] : '';
unset($_SESSION['senrity_name']); // Clear the session flag after use

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
        <button type="button" onclick="window.location.href='form.php';" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                <label class="block text-lg font-bold mb-2">ตอนที่ 1</label>
                <label class="block mb-6">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

                <!-- Gender -->
                <?php if (empty($gender)) { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">เพศ</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="ชาย" name="gender">
                                <label class="ml-2">ชาย</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="หญิง" name="gender">
                                <label class="ml-2">หญิง</label>
                            </div>
                        </div>
                    </div>
                <?php } else if ($gender == "ชาย") { ?>
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
                <?php } else if ($gender == "หญิง") { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">เพศ</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="ชาย" name="gender">
                                <label class="ml-2">ชาย</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="หญิง" name="gender" checked>
                                <label class="ml-2">หญิง</label>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <!-- User Type -->
                <?php if (empty($type_m)) { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">ประเภทผู้ใช้</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="อาจารย์" name="type_m">
                                <label class="ml-2">อาจารย์</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="นักเรียน/นักศึกษา" name="type_m">
                                <label class="ml-2">นักเรียน/นักศึกษา</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="บุคคลภายนอก" name="type_m">
                                <label class="ml-2">บุคคลภายนอก</label>
                            </div>
                        </div>
                    </div>
                <?php } else if ($type_m == "อาจารย์") { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">ประเภทผู้ใช้</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="อาจารย์" name="type_m" checked>
                                <label class="ml-2">อาจารย์</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="นักเรียน/นักศึกษา" name="type_m">
                                <label class="ml-2">นักเรียน/นักศึกษา</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="บุคคลภายนอก" name="type_m">
                                <label class="ml-2">บุคคลภายนอก</label>
                            </div>
                        </div>
                    </div>
                <?php } else if ($type_m == "นักเรียน/นักศึกษา") { ?>
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
                <?php } else if ($type_m == "บุคคลภายนอก") { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">ประเภทผู้ใช้</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="อาจารย์" name="type_m">
                                <label class="ml-2">อาจารย์</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="นักเรียน/นักศึกษา" name="type_m">
                                <label class="ml-2">นักเรียน/นักศึกษา</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="บุคคลภายนอก" name="type_m" checked>
                                <label class="ml-2">บุคคลภายนอก</label>
                            </div>
                        </div>
                    </div>
                <?php }?>

                <!-- Education Level -->
                <?php if (empty($edu)) { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">ระดับการศึกษา</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมต้น" name="edu">
                                <label class="ml-2">มัธยมต้น</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมปลาย/ปวช." name="edu">
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
                <?php } else if ($edu == "มัธยมต้น") { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">ระดับการศึกษา</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมต้น" name="edu" checked>
                                <label class="ml-2">มัธยมต้น</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมปลาย/ปวช." name="edu">
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
                <?php } else if ($edu == "มัธยมปลาย/ปวช.") { ?>
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
                <?php } else if ($edu == "อนุปริญญา/ปวส.") { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">ระดับการศึกษา</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมต้น" name="edu">
                                <label class="ml-2">มัธยมต้น</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมปลาย/ปวช." name="edu">
                                <label class="ml-2">มัธยมปลาย/ปวช.</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="อนุปริญญา/ปวส." name="edu" checked>
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
                <?php } else if ($edu == "ป.ตรี") { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">ระดับการศึกษา</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมต้น" name="edu">
                                <label class="ml-2">มัธยมต้น</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมปลาย/ปวช." name="edu">
                                <label class="ml-2">มัธยมปลาย/ปวช.</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="อนุปริญญา/ปวส." name="edu">
                                <label class="ml-2">อนุปริญญา/ปวส.</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="ป.ตรี" name="edu" checked>
                                <label class="ml-2">ป.ตรี</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="สูงกว่า ป.ตรี" name="edu">
                                <label class="ml-2">สูงกว่า ป.ตรี</label>
                            </div>
                        </div>
                    </div>
                <?php } else if ($edu == "สูงกว่า ป.ตรี") { ?>
                    <div class="grid grid-cols-2 mb-4">
                        <label class="block text-center mb-1">ระดับการศึกษา</label>
                        <div class="mx-2">
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมต้น" name="edu">
                                <label class="ml-2">มัธยมต้น</label>
                            </div>
                            <div class="flex items-center">
                                <input class="my-2 h-6 w-6" type="radio" value="มัธยมปลาย/ปวช." name="edu">
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
                                <input class="my-2 h-6 w-6" type="radio" value="สูงกว่า ป.ตรี" name="edu" checked>
                                <label class="ml-2">สูงกว่า ป.ตรี</label>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <!-- Survey Section 2 -->
                <div class="mb-4">

                    <label class="block text-lg font-bold mb-2">ตอนที่ 2</label>
                    <label class="block mb-2">แบบสอบถามความคิดเห็น</label>
                    <label class="block mb-2">โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label>

                    <!-- Section 1 -->
                    <label class="block text-lg font-bold my-2">ด้านที่ 1</label>
                    <input type="text" name="input_name" class="block w-full border border-gray-300 rounded px-3 py-2 mb-2" value="<?= $input_name ?>">

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
                    <input type="text" name="process_name" class="block w-full border border-gray-300 rounded px-3 py-2 mb-2" value="<?= $process_name ?>">

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
                    <input type="text" name="report_name" class="block w-full border border-gray-300 rounded px-3 py-2 mb-2" value="<?= $report_name ?>">

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
                    <input type="text" name="senrity_name" class="block w-full border border-gray-300 rounded px-3 py-2 mb-2" value="<?= $senrity_name ?>">

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
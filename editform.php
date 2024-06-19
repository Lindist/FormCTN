<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $form_id = $_GET['id'];

    $query = $conn -> prepare("SELECT * FROM tb_efficiercy_form WHERE form_id = :form_id");
    $query -> bindParam(":form_id", $form_id);
    $query -> execute();
    $row = $query -> fetch();

    $tb_input = $conn -> prepare("SELECT * FROM tb_input WHERE Input_id = :input_id");
    $tb_input -> bindParam(":input_id", $row['input_id']);
    $tb_input -> execute();
    $row1 = $tb_input -> fetch();
    $input_name = $row1['Input_name'];
    $input_feature = preg_split("/@/", $row1["Input_feature"]);
    $input_setfeature = preg_split("/@/", $row1["Input_setfeature"]);
    $input_result = preg_split("/@/", $row1["Input_result"]);
    $input_compare = preg_split("/@/", $row1["Input_compare"]);

    $tb_process = $conn -> prepare("SELECT * FROM tb_process WHERE process_id = :process_id");
    $tb_process -> bindParam(":process_id", $row['process_id']);
    $tb_process -> execute();
    $row2 = $tb_process -> fetch();
    $process_name = $row2['process_name'];
    $process_feature = preg_split("/@/", $row2["process_feature"]);
    $process_setfeature = preg_split("/@/", $row2["process_setfeature"]);
    $process_result = preg_split("/@/", $row2["process_result"]);
    $process_compare = preg_split("/@/", $row2["process_compare"]);

    $tb_report = $conn -> prepare("SELECT * FROM tb_report WHERE report_id = :report_id");
    $tb_report -> bindParam(":report_id", $row['report_id']);
    $tb_report -> execute();
    $row3 = $tb_report -> fetch();
    $report_name = $row3['report_name'];
    $report_feature = preg_split("/@/", $row3["report_feature"]);
    $report_setfeature = preg_split("/@/", $row3["report_setfeature"]);
    $report_result = preg_split("/@/", $row3["report_result"]);
    $report_compare = preg_split("/@/", $row3["report_compare"]);

    $tb_senrity = $conn -> prepare("SELECT * FROM tb_senrity WHERE senrity_id = :senrity_id");
    $tb_senrity -> bindParam(":senrity_id", $row['senrity_id']);
    $tb_senrity -> execute();
    $row4 = $tb_senrity -> fetch();
    $senrity_name = $row4['senrity_name'];
    $senrity_feature = preg_split("/@/", $row4["senrity_feature"]);
    $senrity_setfeature = preg_split("/@/", $row4["senrity_setfeature"]);
    $senrity_result = preg_split("/@/", $row4["senrity_result"]);
    $senrity_compare = preg_split("/@/", $row4["senrity_compare"]);
}



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
        <button type="button" onclick="window.location.href='form.php?class=columnData';" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Back to Index
        </button>
        <form action="update.php" method="POST">
            <h1 class="text-center text-2xl mb-5">แก้ไขแบบฟอร์มประเมินประสิทธิภาพ</h1>

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
                <input type="text" value="<?= $row['form_name'] ?>" name="formname" id="formname" class="block w-full border border-gray-300 rounded px-3 py-2 mb-3">

                <input type="hidden" name="id" class="block border" value="<?= $row['form_id'] ?>">
                <input type="hidden" name="input_id" class="block border" value="<?= $row1['Input_id'] ?>">
                <input type="hidden" name="process_id" class="block border" value="<?= $row2['process_id'] ?>">
                <input type="hidden" name="report_id" class="block border" value="<?= $row3['report_id'] ?>">
                <input type="hidden" name="senrity_id" class="block border" value="<?= $row4['senrity_id'] ?>">

                <label class="block text-lg font-bold mb-2">คำชี้แจง</label>
                <textarea name="ad" class="block w-full border border-gray-300 rounded px-3 py-2" rows="5"><?= $row['form_ad'] ?></textarea>
            </div>

            <!-- Body_Content -->
            <div class="mb-4">
                <label class="block text-lg font-bold mb-2">ตอนที่ 1</label>
                <label class="block mb-6">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

                <!-- Gender -->
                <?php if (empty($row['form_gender'])) { ?>
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
                <?php } else if ($row['form_gender'] == "ชาย") { ?>
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
                <?php } else if ($row['form_gender'] == "หญิง") { ?>
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
                <?php if (empty($row['form_type'])) { ?>
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
                <?php } else if ($row['form_type'] == "อาจารย์") { ?>
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
                <?php } else if ($row['form_type'] == "นักเรียน/นักศึกษา") { ?>
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
                <?php } else if ($row['form_type'] == "บุคคลภายนอก") { ?>
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
                <?php if (empty($row['form_education'])) { ?>
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
                <?php } else if ($row['form_education'] == "มัธยมต้น") { ?>
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
                <?php } else if ($row['form_education'] == "มัธยมปลาย/ปวช.") { ?>
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
                <?php } else if ($row['form_education'] == "อนุปริญญา/ปวส.") { ?>
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
                <?php } else if ($row['form_education'] == "ป.ตรี") { ?>
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
                <?php } else if ($row['form_education'] == "สูงกว่า ป.ตรี") { ?>
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
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_feature[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_setfeature[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_result[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_compare[0] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_feature[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_setfeature[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_result[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_compare[1] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_feature[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_setfeature[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_result[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_compare[2] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_feature[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_setfeature[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_result[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $input_compare[3] ?></textarea></td>
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
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_feature[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_setfeature[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_result[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_compare[0] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_feature[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_setfeature[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_result[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_compare[1] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_feature[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_setfeature[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_result[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_compare[2] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_feature[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_setfeature[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_result[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $process_compare[3] ?></textarea></td>
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
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_setfeature[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_result[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_compare[0] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_setfeature[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_result[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_compare[1] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_setfeature[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_result[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_compare[2] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_setfeature[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_result[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_compare[3] ?></textarea></td>
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
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_setfeature[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_result[0] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_compare[0] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_setfeature[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_result[1] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_compare[1] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_setfeature[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_result[2] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_compare[2] ?></textarea></td>
                            </tr>
                            <tr class="odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_setfeature[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_result[3] ?></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_compare[3] ?></textarea></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" name="update" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</body>

</html>
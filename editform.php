<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $form_id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM tb_efficiercy_form WHERE form_id = :form_id");
    $query->bindParam(":form_id", $form_id);
    $query->execute();
    $row = $query->fetch();

    $gender = preg_split("/,/", $row['form_gender']);
    $type_m = preg_split("/,/", $row['form_type']);
    $edu = preg_split("/,/", $row['form_education']);

    $tb_input = $conn->prepare("SELECT * FROM tb_input WHERE Input_id = :input_id");
    $tb_input->bindParam(":input_id", $row['input_id']);
    $tb_input->execute();
    $row1 = $tb_input->fetch();

    $input_name = $row1['Input_name'];
    $input_feature = preg_split("/@/", $row1["Input_feature"]);
    $input_setfeature = preg_split("/@/", $row1["Input_setfeature"]);
    $input_result = preg_split("/@/", $row1["Input_result"]);
    $input_compare = preg_split("/@/", $row1["Input_compare"]);

    $tb_process = $conn->prepare("SELECT * FROM tb_process WHERE process_id = :process_id");
    $tb_process->bindParam(":process_id", $row['process_id']);
    $tb_process->execute();
    $row2 = $tb_process->fetch();

    $process_name = $row2['process_name'];
    $process_feature = preg_split("/@/", $row2["process_feature"]);
    $process_setfeature = preg_split("/@/", $row2["process_setfeature"]);
    $process_result = preg_split("/@/", $row2["process_result"]);
    $process_compare = preg_split("/@/", $row2["process_compare"]);

    $tb_report = $conn->prepare("SELECT * FROM tb_report WHERE report_id = :report_id");
    $tb_report->bindParam(":report_id", $row['report_id']);
    $tb_report->execute();
    $row3 = $tb_report->fetch();

    $report_name = $row3['report_name'];
    $report_feature = preg_split("/@/", $row3["report_feature"]);
    $report_setfeature = preg_split("/@/", $row3["report_setfeature"]);
    $report_result = preg_split("/@/", $row3["report_result"]);
    $report_compare = preg_split("/@/", $row3["report_compare"]);

    $tb_senrity = $conn->prepare("SELECT * FROM tb_senrity WHERE senrity_id = :senrity_id");
    $tb_senrity->bindParam(":senrity_id", $row['senrity_id']);
    $tb_senrity->execute();
    $row4 = $tb_senrity->fetch();

    $senrity_name = $row4['senrity_name'];
    $senrity_feature = preg_split("/@/", $row4["senrity_feature"]);
    $senrity_setfeature = preg_split("/@/", $row4["senrity_setfeature"]);
    $senrity_result = preg_split("/@/", $row4["senrity_result"]);
    $senrity_compare = preg_split("/@/", $row4["senrity_compare"]);

    // print_r($edu);
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
    <script src="js/add_renove_edit.js"></script>
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
                <label class="block text-lg font-bold mb-2">ตอนที่ 1 ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

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

            <div class="mb-4">
                <label for="" class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label>แบบสอบถามความคิดเห็น</label>

                <label for="" class="block text-lg"><label class=" text-lg font-bold mb-2">คำชี้แจง </label>โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label>

                <!-- Section 1 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 1 </label><?= $input_name ?></label>

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
                        <?php
                        for ($i = 0; $i < 4; $i++) {
                            $class = ($i == 0 || (!empty($input_feature[$i]))) ? '' : 'hidden';
                            echo "<tr id='section2tr$i' class='$class'>
                                <td class='border border-gray-300 py-2'>" . ($i + 1) . "</td>
                                <td class='border border-gray-300 py-2'><textarea name='input_feature[]' id='section1tr{$i}td' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'>" . htmlspecialchars($input_feature[$i] ?? '') . "</textarea></td>
                                <td class='border border-gray-300 py-2'><textarea disabled name='input_setfeature[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
                                <td class='border border-gray-300 py-2'><textarea disabled name='input_result[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
                                <td class='border border-gray-300 py-2'><textarea disabled name='input_compare[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="section1addbtn" onclick="section1add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section1removebtn" onclick="section1remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 2 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 2 </label><?= $process_name ?></label>

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
                        <?php
                        for ($i = 0; $i < 4; $i++) {
                            $class = ($i == 0 || (!empty($process_feature[$i]))) ? '' : 'hidden';
                            echo "<tr id='section1tr$i' class='$class odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700'>
                                <td class='border border-gray-300 py-2'>" . ($i + 1) . "</td>
                                <td class='border border-gray-300 py-2'><textarea name='process_feature[]' id='section2tr{$i}td' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'>" . htmlspecialchars($process_feature[$i] ?? '') . "</textarea></td>
                                <td class='border border-gray-300 py-2'><textarea disabled name='process_setfeature[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
                                <td class='border border-gray-300 py-2'><textarea disabled name='process_result[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
                                <td class='border border-gray-300 py-2'><textarea disabled name='process_compare[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="section2addbtn" onclick="section2add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section2removebtn" onclick="section2remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 3 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 3 </label><?= $report_name ?></label>

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
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section3tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd :bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section3tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section3tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $report_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="section3addbtn" onclick="section3add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section3removebtn" onclick="section3remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 4 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 4 </label><?= $senrity_name ?></label>

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
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section4tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section4tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white odd:white:bg-gray-900 even:bg-gray-100 even:white:bg-gray-800 border-b white:border-gray-700" id="section4tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"><?= $senrity_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="section4addbtn" onclick="section4add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section4removebtn" onclick="section4remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

            </div>
            <div class="text-center mt-5">
                <button type="submit" name="update" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
            </div>

    </div>

    </form>
    </div>
</body>

</html>
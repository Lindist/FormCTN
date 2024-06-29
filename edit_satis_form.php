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

if (isset($_GET['id'])) {
    $sati_id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM tb_satisfied WHERE sati_id = :sati_id");
    $query->bindParam(":sati_id", $sati_id);
    $query->execute();
    $row = $query->fetch();

    // print_r($row['ur_id']);
    // echo "<br>";
    // echo $sati_id;

    $sati_gender = preg_split("/,/", $row['sati_gender']);
    $sati_type = preg_split("/,/", $row['sati_type']);
    $sati_level = preg_split("/,/", $row['sati_level']);

    $tb_user_req = $conn->prepare("SELECT * FROM tb_user_req WHERE ur_id = :ur_id");
    $tb_user_req->bindParam(":ur_id", $row['ur_id']);
    $tb_user_req->execute();
    $row1 = $tb_user_req->fetch();

    // print_r($row1["ur_topic"]);

    $tb_function = $conn->prepare("SELECT * FROM tb_function WHERE fun_id = :fun_id");
    $tb_function->bindParam(":fun_id", $row['fun_id']);
    $tb_function->execute();
    $row2 = $tb_function->fetch();

    $tb_uesful = $conn->prepare("SELECT * FROM tb_uesful WHERE uf_id = :uf_id");
    $tb_uesful->bindParam(":uf_id", $row['uf_id']);
    $tb_uesful->execute();
    $row3 = $tb_uesful->fetch();

    $tb_seurity = $conn->prepare("SELECT * FROM tb_seurity WHERE ss_id = :ss_id");
    $tb_seurity->bindParam(":ss_id", $row['ss_id']);
    $tb_seurity->execute();
    $row4 = $tb_seurity->fetch();

    $ur_topic = preg_split("/@/", $row1["ur_topic"]);
    $fun_topic = preg_split("/@/", $row2["fun_topic"]);
    $uf_topic = preg_split("/@/", $row3["uf_topic"]);
    $ss_topic = preg_split("/@/", $row4["ss_topic"]);
} else {
    header("Location: index.php");
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
    <script src="script/add_remove_satis_edit.js"></script>
</head>

<body>
    <div class="container mx-auto bg-white p-4 my-4 rounded shadow">
        <button type="button" onclick="isClass('<?php echo $class; ?>','<?php echo $class1; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Back to Index
        </button>
        <form action="update_satis.php" method="POST">
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
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label><br>เป็นแบบสอบถามความคิดเห็น<br>ที่มีต่อ
                    <input type="text" id="" name="sati_ep2" class="p-1 text-lg text-gray-900 border border-gray-300 rounded bg-gray-50 w-86 sm:w-96" value="<?= $row['sati_ep2'] ?>">
                    โดยแบ่งการประเมินเป็น 4 ด้าน คือ</label><br>
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

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">เพศ</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_gender[]" id="" value="<?= $sati_gender[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_gender[]" id="" value="<?= $sati_gender[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_gender[]" id="" value="<?= $sati_gender[2] ?>">
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-gray-400">***ไม่จำเป็นต้องกรอกครบ***</p>
                        </div>
                    </div>
                </div>


                <!-- User Type -->
                <hr class="my-3">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">ประเภทผู้ใช้</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_type[]" id="" value="<?= $sati_type[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_type[]" id="" value="<?= $sati_type[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_type[]" id="" value="<?= $sati_type[2] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_type[]" id="" value="<?= $sati_type[3] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_type[]" id="" value="<?= $sati_type[4] ?>">
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-gray-400">***ไม่จำเป็นต้องกรอกครบ***</p>
                        </div>
                    </div>
                </div>

                <!-- Education Level -->
                <hr class="my-3">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">ระดับการศึกษา</label>
                    <div class="mx-2">
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_level[]" id="" value="<?= $sati_level[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_level[]" id="" value="<?= $sati_level[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_level[]" id="" value="<?= $sati_level[2] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_level[]" id="" value="<?= $sati_level[3] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_level[]" id="" value="<?= $sati_level[4] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_level[]" id="" value="<?= $sati_level[5] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="sati_level[]" id="" value="<?= $sati_level[6] ?>">
                        </div>
                        <div class="flex items-center justify-center">
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

                <!-- Section 1 -->
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
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            $class = ($i == 0 || (!empty($ur_topic[$i]))) ? '' : 'hidden';
                            echo "<tr id='section1tr$i' class='$class odd:bg-white even:bg-gray-100'>
                                <td class='border border-gray-300 py-2 text-center'>" . ($i + 1) . "</td>
                                <td class='border border-gray-300 py-2'><textarea name='ur_topic[]' id='section1tr{$i}td' class='w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center' rows='3'>" . htmlspecialchars($ur_topic[$i] ?? '') . "</textarea></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ur_score[0]' value='พึงพอใจมากที่สุด'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ur_score[0]' value='พึงพอใจมาก'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ur_score[0]' value='พึงพอใจปานกลาง'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ur_score[0]' value='พึงพอใจน้อย'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ur_score[0]' value='พึงพอใจน้อยที่สุด'></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="section1addbtn" onclick="section1add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section1removebtn" onclick="section1remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 2 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 2 </label>ด้านการทำงานตามฟังก์ชันของระบบ</label>
                <input disabled type="hidden" name="" value="ด้านการทำงานตามฟังก์ชันของระบบ">

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
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            $class = ($i == 0 || (!empty($fun_topic[$i]))) ? '' : 'hidden';
                            echo "<tr id='section2tr$i' class='$class odd:bg-white even:bg-gray-100'>
                                <td class='border border-gray-300 py-2 text-center'>" . ($i + 1) . "</td>
                                <td class='border border-gray-300 py-2'><textarea name='fun_topic[]' id='section2tr{$i}td' class='w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center' rows='3'>" . htmlspecialchars($fun_topic[$i] ?? '') . "</textarea></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='fun_score[0]' value='พึงพอใจมากที่สุด'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='fun_score[0]' value='พึงพอใจมาก'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='fun_score[0]' value='พึงพอใจปานกลาง'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='fun_score[0]' value='พึงพอใจน้อย'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='fun_score[0]' value='พึงพอใจน้อยที่สุด'></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="section2addbtn" onclick="section2add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section2removebtn" onclick="section2remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 3 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 3 </label>ด้านความง่ายต่อการใช้งานของระบบ</label>
                <input disabled type="hidden" name="" value="ด้านความง่ายต่อการใช้งานของระบบ">

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
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            $class = ($i == 0 || (!empty($uf_topic[$i]))) ? '' : 'hidden';
                            echo "<tr id='section3tr$i' class='$class odd:bg-white even:bg-gray-100'>
                                <td class='border border-gray-300 py-2 text-center'>" . ($i + 1) . "</td>
                                <td class='border border-gray-300 py-2'><textarea name='uf_topic[]' id='section3tr{$i}td' class='w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center' rows='3'>" . htmlspecialchars($uf_topic[$i] ?? '') . "</textarea></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='uf_score[0]' value='พึงพอใจมากที่สุด'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='uf_score[0]' value='พึงพอใจมาก'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='uf_score[0]' value='พึงพอใจปานกลาง'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='uf_score[0]' value='พึงพอใจน้อย'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='uf_score[0]' value='พึงพอใจน้อยที่สุด'></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="section3addbtn" onclick="section3add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section3removebtn" onclick="section3remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- Section 4 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 4 </label>ด้านการใช้งานรักษาความปลอดภัยของข้อมูลในระบบ</label>
                <input disabled type="hidden" name="" value="ด้านการใช้งานรักษาความปลอดภัยของข้อมูลในระบบ">

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
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            $class = ($i == 0 || (!empty($ss_topic[$i]))) ? '' : 'hidden';
                            echo "<tr id='section4tr$i' class='$class odd:bg-white even:bg-gray-100'>
                                <td class='border border-gray-300 py-2 text-center'>" . ($i + 1) . "</td>
                                <td class='border border-gray-300 py-2'><textarea name='ss_topic[]' id='section4tr{$i}td' class='w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center' rows='3'>" . htmlspecialchars($ss_topic[$i] ?? '') . "</textarea></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ss_score[0]' value='พึงพอใจมากที่สุด'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ss_score[0]' value='พึงพอใจมาก'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ss_score[0]' value='พึงพอใจปานกลาง'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ss_score[0]' value='พึงพอใจน้อย'></td>
                                <td class='border border-gray-300 py-2 text-center'><input disabled class='w-full h-10 flex items-center' type='radio' name='ss_score[0]' value='พึงพอใจน้อยที่สุด'></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="section4addbtn" onclick="section4add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section4removebtn" onclick="section4remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- comment -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ตอนที่ 3 </label>ข้อเสนอแนะอื่นๆ</label>
                <textarea class="p-2 text-lg text-gray-900 border border-gray-300 rounded bg-gray-50 w-full" name="sati_comment" id="" cols="30" rows="10" placeholder="ไม่จำเป็นต้องกรอก . . . . ."></textarea>

                <div class="text-center mt-5">
                    <button type="submit" name="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
                </div>
            </div>
        </form>
    </div>
    <script src="script/changeclassforform2.js"></script>
</body>

</html>
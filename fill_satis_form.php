<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>กรอกแบบฟอร์มประเมินความพึงพอใจ</title>
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
    <div class="mx-5 sm:mx-16 bg-white p-4 my-4 rounded shadow">
        <button type="button" onclick="isClass('<?php echo $class; ?>','<?php echo $class1; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            กลับหน้าแรก
        </button>
        <form action="insert_satis.php" method="POST">
            <h1 class="text-center text-3xl mb-5">กรอกแบบฟอร์มประเมินความพึงพอใจ</h1>
            <input type="hidden" name="class" id="class" value="<?php echo $class; ?>">
            <input type="hidden" name="class1" id="class1" value="<?php echo $class1; ?>">
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
                    <input type="text" id="" name="sati_ep2" class="p-1 text-lg text-gray-900 border border-gray-300 rounded bg-gray-50 w-86 sm:w-96" placeholder="ชื่อโปรเจค . . . . .">
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
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2 text-center">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" class="w-full h-16 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section1tr1">
                            <td class="border border-gray-300 py-2 text-center">2</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" disabled id="section1tr1td" class="w-full h-16 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section1tr2">
                            <td class="border border-gray-300 py-2 text-center">3</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" disabled id="section1tr2td" class="w-full h-16 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section1tr3">
                            <td class="border border-gray-300 py-2 text-center">4</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" disabled id="section1tr3td" class="w-full h-16 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section1tr4">
                            <td class="border border-gray-300 py-2 text-center">5</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" disabled id="section1tr4td" class="w-full h-16 border border-gray-300 rounded px-2 py-1" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                    </tbody>
                </table>

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
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2 text-center">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section2tr1">
                            <td class="border border-gray-300 py-2 text-center">2</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" disabled id="section2tr1td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section2tr2">
                            <td class="border border-gray-300 py-2 text-center">3</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" disabled id="section2tr2td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section2tr3">
                            <td class="border border-gray-300 py-2 text-center">4</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" disabled id="section2tr3td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section2tr4">
                            <td class="border border-gray-300 py-2 text-center">5</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" disabled id="section2tr4td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                    </tbody>
                </table>

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
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2 text-center">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section3tr1">
                            <td class="border border-gray-300 py-2 text-center">2</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" disabled id="section3tr1td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section3tr2">
                            <td class="border border-gray-300 py-2 text-center">3</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" disabled id="section3tr2td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section3tr3">
                            <td class="border border-gray-300 py-2 text-center">4</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" disabled id="section3tr3td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section3tr4">
                            <td class="border border-gray-300 py-2 text-center">5</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" disabled id="section3tr4td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                    </tbody>
                </table>

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
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2 text-center">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section4tr1">
                            <td class="border border-gray-300 py-2 text-center">2</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" disabled id="section4tr1td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section4tr2">
                            <td class="border border-gray-300 py-2 text-center">3</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" disabled id="section4tr2td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section4tr3">
                            <td class="border border-gray-300 py-2 text-center">4</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" disabled id="section4tr3td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section4tr4">
                            <td class="border border-gray-300 py-2 text-center">5</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" disabled id="section4tr4td" class="w-full h-16 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                    </tbody>
                </table>

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
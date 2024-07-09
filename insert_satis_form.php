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

for ($i = 0; $i < 10; $i++) { // Replace 10 with any large number or condition
    $keys[$i] = null;
}

$sati_gender = isset($_SESSION['sati_gender']) && $_SESSION['sati_gender'] ? $_SESSION['sati_gender'] : $keys;
unset($_SESSION['sati_gender']); // Clear the session flag after use

$sati_type = isset($_SESSION['sati_type']) && $_SESSION['sati_type'] ? $_SESSION['sati_type'] : $keys;
unset($_SESSION['sati_type']); // Clear the session flag after use

$sati_level = isset($_SESSION['sati_level']) && $_SESSION['sati_level'] ? $_SESSION['sati_level'] : $keys;
unset($_SESSION['sati_level']); // Clear the session flag after use

$ur_topic = isset($_SESSION['ur_topic']) && $_SESSION['ur_topic'] ? $_SESSION['ur_topic'] : $keys;
unset($_SESSION['ur_topic']); // Clear the session flag after use

$fun_topic = isset($_SESSION['fun_topic']) && $_SESSION['fun_topic'] ? $_SESSION['fun_topic'] : $keys;
unset($_SESSION['fun_topic']); // Clear the session flag after use

$uf_topic = isset($_SESSION['uf_topic']) && $_SESSION['uf_topic'] ? $_SESSION['uf_topic'] : $keys;
unset($_SESSION['uf_topic']); // Clear the session flag after use

$ss_topic = isset($_SESSION['ss_topic']) && $_SESSION['ss_topic'] ? $_SESSION['ss_topic'] : $keys;
unset($_SESSION['ss_topic']); // Clear the session flag after use

?>

<!doctype html>
<html lang="en">

<head>
    <title>แบบประเมินความพึงพอใจ</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
            background-color: rgb(180, 180, 180);
        }
    </style>
    <script src="script/add_remove_satis_insertt.js"></script>
</head>

<body>
    <div class="mx-5 sm:mx-16 bg-white p-4 my-4 rounded shadow">
        <button type="button" onclick="isClass('<?php echo $class; ?>','<?php echo $class1; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            กลับหน้าแรก
        </button>
        <form action="insert_satis.php" method="POST">
            <h1 class="text-center text-3xl mb-5">แบบฟอร์มประเมินความพึงพอใจ</h1>
            <input type="hidden" name="class" id="class" value="<?php echo $class; ?>">
            <input type="hidden" name="class1" id="class1" value="<?php echo $class1; ?>">

            <?php if (isset($_SESSION['error'])) { ?>
                <script>
                    Swal.fire({
                        title: "คำเตือน",
                        text: "<?= $_SESSION['error'] ?>",
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: 'ตกลง'
                    });
                </script>
                <?php unset($_SESSION['error']); ?>
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
                            <th scope="col" rowspan="2" class="border border-gray-300 p-1">ที่</th>
                            <th scope="col" rowspan="2" class="border border-gray-300 p-1">หัวข้อ</th>
                            <th scope="col" colspan="5" class="border border-gray-300 p-1">ระดับความคิดเห็น</th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 p-1">5</th>
                            <th scope="col" class="border border-gray-300 p-1">4</th>
                            <th scope="col" class="border border-gray-300 p-1">3</th>
                            <th scope="col" class="border border-gray-300 p-1">2</th>
                            <th scope="col" class="border border-gray-300 p-1">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2 text-center">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[0]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section1tr1">
                            <td class="border border-gray-300 py-2 text-center">2</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" disabled id="section1tr1td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[1]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section1tr2">
                            <td class="border border-gray-300 py-2 text-center">3</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" disabled id="section1tr2td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[2]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section1tr3">
                            <td class="border border-gray-300 py-2 text-center">4</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" disabled id="section1tr3td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[3]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section1tr4">
                            <td class="border border-gray-300 py-2 text-center">5</td>
                            <td class="border border-gray-300 py-2"><textarea name="ur_topic[]" disabled id="section1tr4td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ur_score[4]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
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
                            <th scope="col" rowspan="2" class="border border-gray-300 p-1">ที่</th>
                            <th scope="col" rowspan="2" class="border border-gray-300 p-1">หัวข้อ</th>
                            <th scope="col" colspan="5" class="border border-gray-300 p-1">ระดับความคิดเห็น</th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 p-1">5</th>
                            <th scope="col" class="border border-gray-300 p-1">4</th>
                            <th scope="col" class="border border-gray-300 p-1">3</th>
                            <th scope="col" class="border border-gray-300 p-1">2</th>
                            <th scope="col" class="border border-gray-300 p-1">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2 text-center">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[0]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section2tr1">
                            <td class="border border-gray-300 py-2 text-center">2</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" disabled id="section2tr1td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[1]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section2tr2">
                            <td class="border border-gray-300 py-2 text-center">3</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" disabled id="section2tr2td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[2]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section2tr3">
                            <td class="border border-gray-300 py-2 text-center">4</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" disabled id="section2tr3td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[3]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section2tr4">
                            <td class="border border-gray-300 py-2 text-center">5</td>
                            <td class="border border-gray-300 py-2"><textarea name="fun_topic[]" disabled id="section2tr4td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="fun_score[4]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
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
                            <th scope="col" rowspan="2" class="border border-gray-300 p-1">ที่</th>
                            <th scope="col" rowspan="2" class="border border-gray-300 p-1">หัวข้อ</th>
                            <th scope="col" colspan="5" class="border border-gray-300 p-1">ระดับความคิดเห็น</th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 p-1">5</th>
                            <th scope="col" class="border border-gray-300 p-1">4</th>
                            <th scope="col" class="border border-gray-300 p-1">3</th>
                            <th scope="col" class="border border-gray-300 p-1">2</th>
                            <th scope="col" class="border border-gray-300 p-1">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2 text-center">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[0]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section3tr1">
                            <td class="border border-gray-300 py-2 text-center">2</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" disabled id="section3tr1td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[1]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section3tr2">
                            <td class="border border-gray-300 py-2 text-center">3</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" disabled id="section3tr2td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[2]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section3tr3">
                            <td class="border border-gray-300 py-2 text-center">4</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" disabled id="section3tr3td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[3]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section3tr4">
                            <td class="border border-gray-300 py-2 text-center">5</td>
                            <td class="border border-gray-300 py-2"><textarea name="uf_topic[]" disabled id="section3tr4td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="uf_score[4]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
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
                            <th scope="col" rowspan="2" class="border border-gray-300 p-1">ที่</th>
                            <th scope="col" rowspan="2" class="border border-gray-300 p-1">หัวข้อ</th>
                            <th scope="col" colspan="5" class="border border-gray-300 p-1">ระดับความคิดเห็น</th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th scope="col" class="border border-gray-300 p-1">5</th>
                            <th scope="col" class="border border-gray-300 p-1">4</th>
                            <th scope="col" class="border border-gray-300 p-1">3</th>
                            <th scope="col" class="border border-gray-300 p-1">2</th>
                            <th scope="col" class="border border-gray-300 p-1">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2 text-center">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[0]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section4tr1">
                            <td class="border border-gray-300 py-2 text-center">2</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" disabled id="section4tr1td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[1]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section4tr2">
                            <td class="border border-gray-300 py-2 text-center">3</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" disabled id="section4tr2td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[2]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section4tr3">
                            <td class="border border-gray-300 py-2 text-center">4</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" disabled id="section4tr3td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[3]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100 hidden" id="section4tr4">
                            <td class="border border-gray-300 py-2 text-center">5</td>
                            <td class="border border-gray-300 py-2"><textarea name="ss_topic[]" disabled id="section4tr4td" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1 flex items-center"></textarea></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจมากที่สุด"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจมาก"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจปานกลาง"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจน้อย"></td>
                            <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" name="ss_score[4]" value="พึงพอใจน้อยที่สุด"></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="section4addbtn" onclick="section4add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section4removebtn" onclick="section4remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                <!-- comment -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ตอนที่ 3 </label>ข้อเสนอแนะอื่นๆ</label>
                <textarea disabled class="p-2 text-lg text-gray-900 border border-gray-300 rounded bg-gray-50 w-full" name="sati_comment" id="" cols="30" rows="10" placeholder="ไม่จำเป็นต้องกรอก . . . . ."></textarea>

                <div class="text-center mt-5">
                    <button type="submit" name="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
                </div>
            </div>
        </form>
    </div>
    <script src="script/changeclassforform2.js"></script>
</body>

</html>
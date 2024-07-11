<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $sati_id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM tb_satisfied WHERE sati_id = :sati_id");
    $query->bindParam(":sati_id", $sati_id);
    $query->execute();
    $row = $query->fetch();

    // echo $row['sati_ep2'];

    $sati_gender = preg_split("/,/", $row['sati_gender']);
    $sati_type = preg_split("/,/", $row['sati_type']);
    $sati_level = preg_split("/,/", $row['sati_level']);
    $sati_name = $row['sati_ep2'];

    $tb_user_req = $conn->prepare("SELECT * FROM tb_user_req WHERE ur_id = :ur_id");
    $tb_user_req->bindParam(":ur_id", $row['ur_id']);
    $tb_user_req->execute();
    $row1 = $tb_user_req->fetch();

    // echo $row1['ur_topic'];
    $ur_topic = preg_split("/@/", $row1['ur_topic']);

    $tb_function = $conn->prepare("SELECT * FROM tb_function WHERE fun_id = :fun_id");
    $tb_function->bindParam(":fun_id", $row['fun_id']);
    $tb_function->execute();
    $row2 = $tb_function->fetch();

    // echo $row2['fun_topic'];
    $fun_topic = preg_split("/@/", $row2['fun_topic']);

    $tb_uesful = $conn->prepare("SELECT * FROM tb_uesful WHERE uf_id = :uf_id");
    $tb_uesful->bindParam(":uf_id", $row['uf_id']);
    $tb_uesful->execute();
    $row3 = $tb_uesful->fetch();

    // echo $row3['uf_topic'];
    $uf_topic = preg_split("/@/", $row3['uf_topic']);

    $tb_seurity = $conn->prepare("SELECT * FROM tb_seurity WHERE ss_id = :ss_id");
    $tb_seurity->bindParam(":ss_id", $row['ss_id']);
    $tb_seurity->execute();
    $row4 = $tb_seurity->fetch();

    // echo $row4['ss_topic'];
    $ss_topic = preg_split("/@/", $row4['ss_topic']);

    // print_r($sati_gender);
} else {
    header("Location: index.php");
}

$keys = [];

for ($i = 0; $i < 10; $i++) { // Replace 10 with any large number or condition
    $keys[$i] = null;
}

$sati_gender_ss = isset($_SESSION['sati_gender']) && $_SESSION['sati_gender'] ? $_SESSION['sati_gender'] : '';
unset($_SESSION['sati_gender']);

$sati_type_ss = isset($_SESSION['sati_type']) && $_SESSION['sati_type'] ? $_SESSION['sati_type'] : '';
unset($_SESSION['sati_type']);

$sati_level_ss = isset($_SESSION['sati_level']) && $_SESSION['sati_level'] ? $_SESSION['sati_level'] : '';
unset($_SESSION['sati_level']);

// $ur_score = isset($_SESSION['ur_score']) && $_SESSION['ur_score'] ? $_SESSION['ur_score'] : $keys;
// unset($_SESSION['ur_score']);

// $fun_score = isset($_SESSION['fun_score']) && $_SESSION['fun_score'] ? $_SESSION['fun_score'] : $keys;
// unset($_SESSION['fun_score']);

// $uf_score = isset($_SESSION['uf_score']) && $_SESSION['uf_score'] ? $_SESSION['uf_score'] : $keys;
// unset($_SESSION['uf_score']);

// $ss_score = isset($_SESSION['ss_score']) && $_SESSION['ss_score'] ? $_SESSION['ss_score'] : $keys;
// unset($_SESSION['ss_score']);

?>

<!doctype html>
<html lang="en">

<head>
    <title>กรอกแบบฟอร์มประเมินความพึงพอใจ</title>
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
</head>

<body>
    <div class="mx-2 sm:mx-16 bg-white p-4 my-2 sm:my-4 rounded shadow">
        <button type="button" onclick="window.location.href='form.php';" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            กลับหน้าแรก
        </button>
        <form action="fill_satis.php" method="POST">
            <h1 class="text-center text-3xl mb-5">กรอกแบบฟอร์มประเมินความพึงพอใจ</h1>

            <input type="text" name="sati_id" class="hidden" value="<?= $_GET['id'] ?>">
            <input type="text" name="sati_name" class="hidden" value="<?= $sati_name ?>">
            <input type="text" name="ur_id" class="hidden" value="<?= $row['ur_id'] ?>">
            <input type="text" name="fun_id" class="hidden" value="<?= $row['fun_id'] ?>">
            <input type="text" name="uf_id" class="hidden" value="<?= $row['uf_id'] ?>">
            <input type="text" name="ss_id" class="hidden" value="<?= $row['ss_id'] ?>">

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
                    <p class="text-lg inline"> <?= $sati_name ?> โดยแบ่งการประเมินเป็น 4 ด้าน คือ</p><br>
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
                        <?php foreach ($sati_gender as $value) { ?>
                            <?php if (!empty($value)) { ?>
                                <div class="flex items-center justify-center sm:justify-start">
                                    <?php if ($value == $sati_gender_ss) { ?>
                                        <input type="radio" name="sati_gender" class="w-6 h-6" value="<?= $value ?>" checked>
                                    <?php } else { ?>
                                        <input type="radio" required name="sati_gender" class="w-6 h-6" value="<?= $value ?>">
                                    <?php } ?>
                                    <p class="mx-3 my-2"><?= $value ?></p>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

                <!-- User Type -->
                <hr class="my-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">ประเภทผู้ใช้</label>
                    <div class="mx-2">
                        <?php foreach ($sati_type as $value) { ?>
                            <?php if (!empty($value)) { ?>
                                <div class="flex items-center justify-center sm:justify-start">
                                    <?php if ($value == $sati_type_ss) { ?>
                                        <input type="radio" name="sati_type" class="w-6 h-6" value="<?= $value ?>" checked>
                                    <?php } else { ?>
                                        <input type="radio" required name="sati_type" class="w-6 h-6" value="<?= $value ?>">
                                    <?php } ?>
                                    <p class="mx-3 my-2"><?= $value ?></p>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

                <!-- Education Level -->
                <hr class="my-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">ประเภทผู้ใช้</label>
                    <div class="mx-2">
                        <?php foreach ($sati_level as $value) { ?>
                            <?php if (!empty($value)) { ?>
                                <div class="flex items-center justify-center sm:justify-start">
                                    <?php if ($value == $sati_level_ss) { ?>
                                        <input type="radio" name="sati_level" class="w-6 h-6" value="<?= $value ?>" checked>
                                    <?php } else { ?>
                                        <input type="radio" required name="sati_level" class="w-6 h-6" value="<?= $value ?>">
                                    <?php } ?>
                                    <p class="mx-3 my-2"><?= $value ?></p>
                                </div>
                            <?php } ?>
                        <?php } ?>
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
                            <?php for ($i = 0; $i < count($ur_topic); $i++) { ?>
                                <tr class='odd:bg-white even:bg-gray-100'>
                                    <td class='border border-gray-300 py-2 text-center'><?= $i + 1 ?></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="ur_topic[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"><?= $ur_topic[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ur_score[<?= $i ?>]" value="พึงพอใจมากที่สุด"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ur_score[<?= $i ?>]" value="พึงพอใจมาก"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ur_score[<?= $i ?>]" value="พึงพอใจปานกลาง"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ur_score[<?= $i ?>]" value="พึงพอใจน้อย"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ur_score[<?= $i ?>]" value="พึงพอใจน้อยที่สุด"></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

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
                            <?php for ($i = 0; $i < count($fun_topic); $i++) { ?>
                                <tr class='odd:bg-white even:bg-gray-100'>
                                    <td class='border border-gray-300 py-2 text-center'><?= $i + 1 ?></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="fun_topic[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"><?= $fun_topic[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="fun_score[<?= $i ?>]" value="พึงพอใจมากที่สุด"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="fun_score[<?= $i ?>]" value="พึงพอใจมาก"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="fun_score[<?= $i ?>]" value="พึงพอใจปานกลาง"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="fun_score[<?= $i ?>]" value="พึงพอใจน้อย"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="fun_score[<?= $i ?>]" value="พึงพอใจน้อยที่สุด"></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

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
                            <?php for ($i = 0; $i < count($uf_topic); $i++) { ?>
                                <tr class='odd:bg-white even:bg-gray-100'>
                                    <td class='border border-gray-300 py-2 text-center'><?= $i + 1 ?></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="uf_topic[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"><?= $uf_topic[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="uf_score[<?= $i ?>]" value="พึงพอใจมากที่สุด"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="uf_score[<?= $i ?>]" value="พึงพอใจมาก"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="uf_score[<?= $i ?>]" value="พึงพอใจปานกลาง"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="uf_score[<?= $i ?>]" value="พึงพอใจน้อย"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="uf_score[<?= $i ?>]" value="พึงพอใจน้อยที่สุด"></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

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
                            <?php for ($i = 0; $i < count($ss_topic); $i++) { ?>
                                <tr class='odd:bg-white even:bg-gray-100'>
                                    <td class='border border-gray-300 py-2 text-center'><?= $i + 1 ?></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="ss_topic[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"><?= $ss_topic[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ss_score[<?= $i ?>]" value="พึงพอใจมากที่สุด"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ss_score[<?= $i ?>]" value="พึงพอใจมาก"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ss_score[<?= $i ?>]" value="พึงพอใจปานกลาง"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ss_score[<?= $i ?>]" value="พึงพอใจน้อย"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input required class="w-8 sm:w-full h-10 flex items-center" type="radio" name="ss_score[<?= $i ?>]" value="พึงพอใจน้อยที่สุด"></td>
                                </tr>
                            <?php } ?>
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
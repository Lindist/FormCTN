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

    $member_id = $row['member_id'];
    $sati_name = $row['sati_ep2'];
    $sati_info_un = $row['sati_info'];
    $sub_info_un = $row['sub_info'];
    $sati_topic_un = $row['sati_topic'];
    $sub_topic_un = $row['sub_topic'];

    $sati_info = preg_split("/Ϫ/", $sati_info_un);
    $sub_info = preg_split("/ꓘ/", $sub_info_un);
    $sati_topic = preg_split("/Ϫ/", $sati_topic_un);
    $sub_topic = preg_split("/ꓘ/", $sub_topic_un);

    $sub_info_ex = [];
    foreach ($sub_info as $index => $info) {
        $sub_info_ex[$index] = preg_split("/Ϫ/", $info);
    }

    $sub_topic_ex = [];
    foreach ($sub_topic as $index => $topic) {
        $sub_topic_ex[$index] = preg_split("/Ϫ/", $topic);
    }

    // echo "sub_topic_ex = ";
    // print_r($sub_topic_ex);
    // echo "<br>";
    // echo "sub_info_ex = ";
    // print_r($sub_info_ex);
    // echo "<br>";
    // echo $sati_name;
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐาน // ";
    // print_r($sati_info); // ข้อมูลพื้นฐาน
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐานย่อย // ";
    // print_r($sub_info_ex); // ข้อมูลพื้นฐานย่อย
    // echo "<br>";
    // echo "// หัวข้อด้าน // ";
    // print_r($sati_topic); // หัวข้อด้าน
    // echo "<br>";
    // echo "// ข้อมูลแต่ละด้าน // ";
    // print_r($sub_topic_ex); // ข้อมูลแต่ละด้าน

    // echo "<br>";
    // echo $sati_ep2;
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐาน // ";
    // echo $sati_info_un; // ข้อมูลพื้นฐาน
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐานย่อย // ";
    // print_r($sub_info_un); // ข้อมูลพื้นฐานย่อย
    // echo "<br>";
    // echo "// หัวข้อด้าน // ";
    // print_r($sati_topic_un); // หัวข้อด้าน
    // echo "<br>";
    // echo "// ข้อมูลแต่ละด้าน // ";
    // print_r($sub_topic_un); // ข้อมูลแต่ละด้าน

} else {
    header("Location: index.php");
}

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

                <!-- Info -->
                <div id="info-section">
                    <?php $i = 0; ?>
                    <?php while ($i < count($sati_info)) { ?>
                        <hr class="my-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <label class="block text-center mb-1 sm:mb-0 sm:self-center"><?= $sati_info[$i] ?></label>
                            <input type="hidden" name="sati_info[]" value="<?= $sati_info[$i] ?>">
                            <div class="mx-2">
                                <?php for ($c = 0; $c < count($sub_info_ex[$i]); $c++) { ?>
                                    <div class="flex items-center justify-center sm:justify-start">
                                        <input type="radio" name="sub_info<?= $i + 1 ?>[]" class="w-6 h-6" value="<?= $sub_info_ex[$i][$c] ?>" required>
                                        <p class="mx-3 my-2"><?= $sub_info_ex[$i][$c] ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php $i++;
                    } ?>
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

                    <div id="sections-container">
                        <?php $t = 0; ?>
                        <?php while ($t < count($sati_topic)) { ?>
                            <div id="section-<?= $t + 1 ?>" class="mt-12">
                                <label class="text-lg"><label class="text-lg font-bold">ด้านที่ <?= $t + 1 ?> </label>ด้าน <?= $sati_topic[$t] ?></label><br>
                                <input type="hidden" name="sati_topic[]" value="<?= $sati_topic[$t] ?>">

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
                                    <tbody id="section<?= $t + 1 ?>-tbody">
                                        <?php for ($b = 0; $b < count($sub_topic_ex[$t]); $b++) { ?>
                                            <tr class='odd:bg-white even:bg-gray-100'>
                                                <td class='border border-gray-300 py-2 text-center'><?= $b + 1 ?></td>
                                                <td class="border border-gray-300 py-2"><textarea readonly name="sub_topic<?= $t + 1 ?>[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1"><?= $sub_topic_ex[$t][$b] ?></textarea></td>
                                                <td class="border border-gray-300 py-2 text-center px-0.5"><input required class="w-full h-10 flex items-center" type="radio" name="ur_score<?= $t + 1 ?>[<?= $b ?>]" value="พึงพอใจมากที่สุด"></td>
                                                <td class="border border-gray-300 py-2 text-center px-0.5"><input required class="w-full h-10 flex items-center" type="radio" name="ur_score<?= $t + 1 ?>[<?= $b ?>]" value="พึงพอใจมาก"></td>
                                                <td class="border border-gray-300 py-2 text-center px-0.5"><input required class="w-full h-10 flex items-center" type="radio" name="ur_score<?= $t + 1 ?>[<?= $b ?>]" value="พึงพอใจปานกลาง"></td>
                                                <td class="border border-gray-300 py-2 text-center px-0.5"><input required class="w-full h-10 flex items-center" type="radio" name="ur_score<?= $t + 1 ?>[<?= $b ?>]" value="พึงพอใจน้อย"></td>
                                                <td class="border border-gray-300 py-2 text-center px-0.5"><input required class="w-full h-10 flex items-center" type="radio" name="ur_score<?= $t + 1 ?>[<?= $b ?>]" value="พึงพอใจน้อยที่สุด"></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php $t++;
                        } ?>
                    </div>

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
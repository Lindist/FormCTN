<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $form_id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM tb_efficiercy_form WHERE form_id = :form_id");
    $query->bindParam(":form_id", $form_id);
    $query->execute();
    $row = $query->fetch();

    $member_id = $row['member_id'];
    $pj_id = $row['project_id'];
    $form_name = $row['form_name'];
    $ad = $row['form_ad'];
    $form_info_un = $row['form_info'];
    $sub_info_un = $row['sub_info'];
    $form_topic_un = $row['form_topic'];
    $feature_un = $row['feature'];
    $setfeature_un = $row['setfeature'];

    $form_info = preg_split("/Ϫ/", $form_info_un);
    $sub_info = preg_split("/ꓘ/", $sub_info_un);
    $form_topic = preg_split("/Ϫ/", $form_topic_un);
    $feature = preg_split("/ꓘ/", $feature_un);
    $setfeature = preg_split("/ꓘ/", $setfeature_un);

    $sub_info_ex = [];
    foreach ($sub_info as $index => $info) {
        $sub_info_ex[$index] = preg_split("/Ϫ/", $info);
    }

    $feature_ex = [];
    foreach ($feature as $index => $topic) {
        $feature_ex[$index] = preg_split("/Ϫ/", $topic);
    }

    $setfeature_ex = [];
    foreach ($setfeature as $index => $topic) {
        $setfeature_ex[$index] = preg_split("/Ϫ/", $topic);
    }

    if ($_SESSION['user_id'] == $member_id) {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
    exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>กรอกแบบฟอร์มประเมินประสิทธิภาพ</title>
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
        <input type="hidden" name="pj_id" value="<?= $pj_id ?>">
        <form action="fill_performance.php" method="POST">
            <h1 class="text-center text-3xl mb-5">กรอกแบบฟอร์มประเมินประสิทธิภาพ</h1>

            <input type="hidden" name="form_id" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="form_name" value="<?= $form_name ?>">
            <input type="hidden" name="form_ad" value="<?= $ad ?>">

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
            <div class="mb-4">
                <label class="inline block text-lg font-bold mb-2">ชื่อแบบฟอร์ม</label>
                <p name="form_name" class="inline mx-2"><?= $form_name ?></p></br>
                <label class="inline block text-lg font-bold">คำชี้แจง</label>
                <p name="ad" class="inline mx-2"><?= $ad ?></p>
            </div>

            <!-- Body_Content -->
            <div class="mb-4">
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 1 </label>ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

                <!-- Info -->
                <div id="info-section">
                    <?php $i = 0; ?>
                    <?php while ($i < count($form_info)) { ?>
                        <hr class="my-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <label class="block text-center mb-1 sm:mb-0 sm:self-center"><?= $form_info[$i] ?></label>
                            <input type="hidden" name="form_info[]" value="<?= $form_info[$i] ?>">
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

            </div>

            <!-- Survey Section 2 -->
            <hr class="my-3">

            <div class="mb-4">
                <label for="" class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label>แบบสอบถามความคิดเห็น</label>

                <label for="" class="block text-lg"><label class=" text-lg font-bold mb-2">คำชี้แจง </label>โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label>

                <!-- Start Table -->

                <div id="sections-container">
                    <?php $t = 0; ?>
                    <?php while ($t < count($form_topic)) { ?>
                        <div id="section-<?= $t + 1 ?>" class="mt-12">
                            <label for="" class="block text-lg mb-5"><label class="text-lg font-bold mb-2">ด้านที่ <?= $t + 1 ?> </label>ด้าน <?= $form_topic[$t] ?></label>
                            <input type="hidden" name="form_topic[]" value="<?= $form_topic[$t] ?>">

                            <div class="overflow-x-auto my-2">
                                <table class="w-full border border-gray-300 text-center">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th scope="col" class="border border-gray-300 p-2">ที่</th>
                                            <th scope="col" class="border border-gray-300 p-2">คุณสมบัติด้านเทคนิค</th>
                                            <th scope="col" class="border border-gray-300 p-2">คุณสมบัติที่ตั้งไว้</th>
                                            <th scope="col" class="border border-gray-300 p-2">คุณสมบัติที่ทำได้</th>
                                            <th scope="col" class="border border-gray-300 p-2">ผลการเปรียบเทียบ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="section<?= $t + 1 ?>-tbody">
                                        <?php for ($b = 0; $b < count($feature_ex[$t]); $b++) { ?>
                                            <tr class="odd:bg-white even:bg-gray-100">
                                                <td class="border border-gray-300 py-2"><?= $b + 1 ?></td>
                                                <td class="border border-gray-300 py-2"><textarea readonly name="feature<?= $t + 1 ?>[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $feature_ex[$t][$b] ?></textarea></td>
                                                <td class="border border-gray-300 py-2"><textarea readonly name="setfeature<?= $t + 1 ?>[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $setfeature_ex[$t][$b] ?></textarea></td>
                                                <td class="border border-gray-300 py-2"><textarea name="result<?= $t + 1 ?>[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required></textarea></td>
                                                <td class="border border-gray-300 py-2"><textarea name="compare<?= $t + 1 ?>[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required></textarea></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php $t++;
                    } ?>
                </div>

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
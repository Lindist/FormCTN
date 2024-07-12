<?php

session_start();
require 'session/config.php';

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
    $form_name = $row['form_name'];
    $ad = $row['form_ad'];
    $member_id = $row['member_id'];

    if($_SESSION['user_id'] == $member_id) {
        header("Location: index.php");
    }

    $tb_input = $conn->prepare("SELECT * FROM tb_input WHERE Input_id = :input_id");
    $tb_input->bindParam(":input_id", $row['input_id']);
    $tb_input->execute();
    $row1 = $tb_input->fetch();

    $input_feature = preg_split("/@/", $row1["Input_feature"]);
    $input_setfeature = preg_split("/@/", $row1["Input_setfeature"]);

    $tb_process = $conn->prepare("SELECT * FROM tb_process WHERE process_id = :process_id");
    $tb_process->bindParam(":process_id", $row['process_id']);
    $tb_process->execute();
    $row2 = $tb_process->fetch();

    $process_feature = preg_split("/@/", $row2["process_feature"]);
    $process_setfeature = preg_split("/@/", $row2["process_setfeature"]);

    $tb_report = $conn->prepare("SELECT * FROM tb_report WHERE report_id = :report_id");
    $tb_report->bindParam(":report_id", $row['report_id']);
    $tb_report->execute();
    $row3 = $tb_report->fetch();

    $report_feature = preg_split("/@/", $row3["report_feature"]);
    $report_setfeature = preg_split("/@/", $row3["report_setfeature"]);

    $tb_senrity = $conn->prepare("SELECT * FROM tb_senrity WHERE senrity_id = :senrity_id");
    $tb_senrity->bindParam(":senrity_id", $row['senrity_id']);
    $tb_senrity->execute();
    $row4 = $tb_senrity->fetch();

    $senrity_feature = preg_split("/@/", $row4["senrity_feature"]);
    $senrity_setfeature = preg_split("/@/", $row4["senrity_setfeature"]);
} else {
    header("Location: index.php");
}

$keys = [];

for ($i = 0; $i < 10; $i++) { // Replace 10 with any large number or condition
    $keys[$i] = null;
}

$gender_ss = isset($_SESSION['gender']) && $_SESSION['gender'] ? $_SESSION['gender'] : '';
unset($_SESSION['gender']);

$type_m_ss = isset($_SESSION['type_m']) && $_SESSION['type_m'] ? $_SESSION['type_m'] : '';
unset($_SESSION['type_m']);

$edu_ss = isset($_SESSION['edu']) && $_SESSION['edu'] ? $_SESSION['edu'] : '';
unset($_SESSION['edu']);

$input_result = isset($_SESSION['input_result']) && $_SESSION['input_result'] ? $_SESSION['input_result'] : $keys;
unset($_SESSION['input_result']);

$input_compare = isset($_SESSION['input_compare']) && $_SESSION['input_compare'] ? $_SESSION['input_compare'] : $keys;
unset($_SESSION['input_compare']);

$process_result = isset($_SESSION['process_result']) && $_SESSION['process_result'] ? $_SESSION['process_result'] : $keys;
unset($_SESSION['process_result']);

$process_compare = isset($_SESSION['process_compare']) && $_SESSION['process_compare'] ? $_SESSION['process_compare'] : $keys;
unset($_SESSION['process_compare']);

$report_result = isset($_SESSION['report_result']) && $_SESSION['report_result'] ? $_SESSION['report_result'] : $keys;
unset($_SESSION['report_result']);

$report_compare = isset($_SESSION['report_compare']) && $_SESSION['report_compare'] ? $_SESSION['report_compare'] : $keys;
unset($_SESSION['report_compare']);

$senrity_result = isset($_SESSION['senrity_result']) && $_SESSION['senrity_result'] ? $_SESSION['senrity_result'] : $keys;
unset($_SESSION['senrity_result']);

$senrity_compare = isset($_SESSION['senrity_compare']) && $_SESSION['senrity_compare'] ? $_SESSION['senrity_compare'] : $keys;
unset($_SESSION['senrity_compare']);

// print_r($gender)
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
        <form action="fill_performance.php" method="POST">
            <h1 class="text-center text-3xl mb-5">กรอกแบบฟอร์มประเมินประสิทธิภาพ</h1>

            <input type="text" name="form_id" class="hidden" value="<?= $_GET['id'] ?>">
            <input type="text" name="input_id" class="hidden" value="<?= $row['input_id'] ?>">
            <input type="text" name="process_id" class="hidden" value="<?= $row['process_id'] ?>">
            <input type="text" name="report_id" class="hidden" value="<?= $row['report_id'] ?>">
            <input type="text" name="senrity_id" class="hidden" value="<?= $row['senrity_id'] ?>">

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
                <input type="text" name="form_name" class="hidden" value="<?= $form_name ?>">
                <p name="form_name" class="inline mx-2"><?= $form_name ?></p></br>

                <label class="inline block text-lg font-bold">คำชี้แจง</label>
                <p name="ad" class="inline mx-2"><?= $ad ?></p>
            </div>

            <!-- Body_Content -->
            <div class="mb-4">
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 1 </label>ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

                <!-- Gender -->
                <hr class="my-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">เพศ</label>
                    <div class="mx-2">
                        <?php foreach ($gender as $value) { ?>
                            <?php if (!empty($value)) { ?>
                                <div class="flex items-center justify-center sm:justify-start">
                                    <?php if ($value == $gender_ss) { ?>
                                        <input type="radio" name="gender" class="w-6 h-6" value="<?= $value ?>" checked>
                                    <?php } else { ?>
                                        <input type="radio" required name="gender" class="w-6 h-6" value="<?= $value ?>">
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
                        <?php foreach ($type_m as $value) { ?>
                            <?php if (!empty($value)) { ?>
                                <div class="flex items-center justify-center sm:justify-start">
                                    <?php if ($value == $type_m_ss) { ?>
                                        <input type="radio" name="type_m" class="w-6 h-6" value="<?= $value ?>" checked>
                                    <?php } else { ?>
                                        <input type="radio" required name="type_m" class="w-6 h-6" value="<?= $value ?>">
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
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">ระดับการศึกษา</label>
                    <div class="mx-2">
                        <?php foreach ($edu as $value) { ?>
                            <?php if (!empty($value)) { ?>
                                <div class="flex items-center justify-center sm:justify-start">
                                    <?php if ($value == $edu_ss) { ?>
                                        <input type="radio" name="edu" class="w-6 h-6" value="<?= $value ?>" checked>
                                    <?php } else { ?>
                                        <input type="radio" required name="edu" class="w-6 h-6" value="<?= $value ?>">
                                    <?php } ?>
                                    <p class="mx-3 my-2"><?= $value ?></p>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

            </div>

            <!-- Survey Section 2 -->
            <hr class="my-3">

            <div class="mb-4">
                <label for="" class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label>แบบสอบถามความคิดเห็น</label>

                <label for="" class="block text-lg"><label class=" text-lg font-bold mb-2">คำชี้แจง </label>โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label>

                <!-- Section 1 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 1 </label>ด้านการนำเข้าข้อมูลระบบ</label>
                <input type="hidden" name="input_name" value="ด้านการนำเข้าข้อมูลระบบ">

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
                        <tbody>
                            <?php for ($i = 0; $i < count($input_feature); $i++) { ?>
                                <tr class='odd:bg-white even:bg-gray-100'>
                                    <td class='border border-gray-300 py-2'><?= $i + 1 ?></td>
                                    <td class='border border-gray-300 py-2'><textarea readonly name='input_feature[]' class='border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center'><?= $input_feature[$i] ?></textarea></td>
                                    <td class='border border-gray-300 py-2'><textarea readonly name='input_setfeature[]' class='border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center'><?= $input_setfeature[$i] ?></textarea></td>
                                    <td class='border border-gray-300 py-2'><textarea required name='input_result[]' class='border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center'><?= $input_result[$i] ?></textarea></td>
                                    <td class='border border-gray-300 py-2'><textarea required name='input_compare[]' class='border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center'><?= $input_compare[$i] ?></textarea></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Section 2 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 2 </label>ด้านการประมวลผล</label>
                <input type="hidden" name="process_name" value="ด้านการประมวลผล">

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
                        <tbody>
                            <?php for ($i = 0; $i < count($process_feature); $i++) { ?>
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="border border-gray-300 py-2"><?= $i + 1 ?></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="process_feature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $process_feature[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="process_setfeature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $process_setfeature[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea required name="process_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $process_result[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea required name="process_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $process_compare[$i] ?></textarea></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Section 3 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 3 </label>ด้านการรายงานข้อมูล</label>
                <input type="hidden" name="report_name" value="ด้านการรายงานข้อมูล">

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
                        <tbody>
                            <?php for ($i = 0; $i < count($report_feature); $i++) { ?>
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="border border-gray-300 py-2"><?= $i + 1 ?></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="report_feature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $report_feature[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="report_setfeature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $report_setfeature[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea required name="report_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $report_result[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea required name="report_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $report_compare[$i] ?></textarea></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Section 4 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 4 </label>ด้านความปลอดภัย</label>
                <input type="hidden" name="senrity_name" value="ด้านความปลอดภัย">

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
                        <tbody>
                            <?php for ($i = 0; $i < count($senrity_feature); $i++) { ?>
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="border border-gray-300 py-2"><?= $i + 1 ?></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="senrity_feature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $senrity_feature[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea readonly name="senrity_setfeature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $senrity_setfeature[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea required name="senrity_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $senrity_result[$i] ?></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea required name="senrity_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"><?= $senrity_compare[$i] ?></textarea></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
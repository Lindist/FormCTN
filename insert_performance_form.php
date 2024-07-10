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

$keys = [];

for ($i = 0; $i < 10; $i++) { // Replace 10 with any large number or condition
    $keys[$i] = null;
}

$formname = isset($_SESSION['formname']) && $_SESSION['formname'] ? $_SESSION['formname'] : '';
unset($_SESSION['formname']); // Clear the session flag after use

$ad = isset($_SESSION['ad']) && $_SESSION['ad'] ? $_SESSION['ad'] : '';
unset($_SESSION['ad']); // Clear the session flag after use

$gender = isset($_SESSION['gender']) && $_SESSION['gender'] ? $_SESSION['gender'] : $keys;
unset($_SESSION['gender']); // Clear the session flag after use

$type_m = isset($_SESSION['type_m']) && $_SESSION['type_m'] ? $_SESSION['type_m'] : $keys;
unset($_SESSION['type_m']); // Clear the session flag after use

$edu = isset($_SESSION['edu']) && $_SESSION['edu'] ? $_SESSION['edu'] : $keys;
unset($_SESSION['edu']); // Clear the session flag after use

?>

<!doctype html>
<html lang="en">

<head>
    <title>แบบฟอร์มประเมินประสิทธิภาพ</title>
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
    <script src="script/add_remove_performance_insert.js"></script>
</head>

<body>
    <div class="mx-5 sm:mx-16 bg-white p-4 my-4 rounded shadow">
        <button type="button" onclick="isClass('<?php echo $class; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            กลับหน้าแรก
        </button>
        <form action="insert_performance.php" method="POST">
            <input type="hidden" name="class" id="class" value="<?php echo $class; ?>">
            <h1 class="text-center text-3xl mb-5">แบบฟอร์มประเมินประสิทธิภาพ</h1>

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
                <label class="block text-lg font-bold mb-2">ชื่อแบบฟอร์ม</label>
                <input type="text" value="<?= $formname ?>" name="formname" id="formname" class="block w-full border border-gray-300 rounded px-3 py-2 mb-3">

                <label class="block text-lg font-bold mb-2">คำชี้แจง</label>
                <textarea name="ad" class="block w-full border border-gray-300 rounded px-3 py-2" rows="5"><?= $ad ?></textarea>
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
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="genders[]" id="" value="<?= $gender[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="genders[]" id="" value="<?= $gender[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="genders[]" id="" value="<?= $gender[2] ?>">
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
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="kinduser[]" id="" value="<?= $type_m[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="kinduser[]" id="" value="<?= $type_m[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="kinduser[]" id="" value="<?= $type_m[2] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="kinduser[]" id="" value="<?= $type_m[3] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="kinduser[]" id="" value="<?= $type_m[4] ?>">
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
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="le_education[]" id="" value="<?= $edu[0] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="le_education[]" id="" value="<?= $edu[1] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="le_education[]" id="" value="<?= $edu[2] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="le_education[]" id="" value="<?= $edu[3] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="le_education[]" id="" value="<?= $edu[4] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="le_education[]" id="" value="<?= $edu[5] ?>">
                        </div>
                        <div class="flex items-center">
                            <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="le_education[]" id="" value="<?= $edu[6] ?>">
                        </div>
                        <div class="flex items-center justify-center">
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
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="border border-gray-300 py-2">1</td>
                                <td class="border border-gray-300 py-2"><textarea name="input_feature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="input_setfeature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section1tr1">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_feature[]" id="section1tr1td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_setfeature[]" id="section1tr1tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section1tr2">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_feature[]" id="section1tr2td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_setfeature[]" id="section1tr2tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section1tr3">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_feature[]" id="section1tr3td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_setfeature[]" id="section1tr3tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="input_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="section1addbtn" onclick="section1add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section1removebtn" onclick="section1remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

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
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="border border-gray-300 py-2">1</td>
                                <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="process_setfeature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section2tr1">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr1td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" id="section2tr1tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section2tr2">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr2td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" id="section2tr2tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section2tr3">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr3td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" id="section2tr3tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="section2addbtn" onclick="section2add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section2removebtn" onclick="section2remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

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
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="border border-gray-300 py-2">1</td>
                                <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="report_setfeature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section3tr1">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr1td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" id="section3tr1tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section3tr2">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr2td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" id="section3tr2tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section3tr3">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr3td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" id="section3tr3tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="section3addbtn" onclick="section3add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section3removebtn" onclick="section3remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

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
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="border border-gray-300 py-2">1</td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea name="senrity_setfeature[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section4tr1">
                                <td class="border border-gray-300 py-2">2</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr1td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" id="section4tr1tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section4tr2">
                                <td class="border border-gray-300 py-2">3</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr2td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" id="section4tr2tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                            <tr class="hidden odd:bg-white even:bg-gray-100" id="section4tr3">
                                <td class="border border-gray-300 py-2">4</td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr3td" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" id="section4tr3tdf" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="section4addbtn" onclick="section4add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                <button type="button" id="section4removebtn" onclick="section4remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

                </>
                <div class="text-center mt-5">
                    <button type="submit" name="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
                </div>
            </div>

        </form>
    </div>
    <script src="script/changeclass.js"></script>
</body>

</html>
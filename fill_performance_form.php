<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$test = ['line1', 'line2,', 'line3', 'line4', 'line5'];
$gender = ['gender1', 'gender2', 'gender3', 'gender4', 'gender5'];
$type_m = ['type1', 'type2', 'type3', 'type4', 'type5'];
$edu = ['edu1', 'edu2', 'edu3', 'edu4', 'edu5']

?>

<!doctype html>
<html lang="en">

<head>
    <title>กรอกแบบฟอร์มประเมินประสิทธิภาพ</title>
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
        <button type="button" onclick="isClass('<?php echo $class; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            กลับหน้าแรก
        </button>
        <form action="insert_performance.php" method="POST">
            <input type="hidden" name="class" id="class" value="<?php echo $class; ?>">
            <h1 class="text-center text-3xl mb-5">กรอกแบบฟอร์มประเมินประสิทธิภาพ</h1>

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
                        <?php for ($i = 0; $i < count($gender); $i++) { ?>
                            <div class="flex items-center">
                                <p class="px-3 py-2 mb-3 w-full" name="genders[]"><?= $gender[$i] ?></p>
                                
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- User Type -->
                <hr class="my-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">ประเภทผู้ใช้</label>
                    <div class="mx-2">
                        <?php for ($i = 0; $i < count($type_m); $i++) { ?>
                            <div class="flex items-center">
                                <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="kinduser[]" id="" value="<?= $type_m[$i] ?>">
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Education Level -->
                <hr class="my-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">ระดับการศึกษา</label>
                    <div class="mx-2">
                        <?php for ($i = 0; $i < count($edu); $i++) { ?>
                            <div class="flex items-center">
                                <input type="text" class="border border-gray-300 rounded px-3 py-2 mb-3 w-full" name="le_education[]" id="" value="<?= $edu[0] ?>">
                            </div>
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
                        <?php for ($i = 0; $i < count($test); $i++) { ?>
                            <tr class='odd:bg-white even:bg-gray-100'>
                                <td class='border border-gray-300 py-2'><?= $i + 1 ?></td>
                                <td class='border border-gray-300 py-2'><textarea readonly name='input_feature[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center' rows='3'><?= $test[$i] ?></textarea></td>
                                <td class='border border-gray-300 py-2'><textarea name='input_setfeature[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center' rows='3'></textarea></td>
                                <td class='border border-gray-300 py-2'><textarea name='input_result[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center' rows='3'></textarea></td>
                                <td class='border border-gray-300 py-2'><textarea name='input_compare[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center' rows='3'></textarea></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Section 2 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 2 </label>ด้านการประมวลผล</label>
                <input type="hidden" name="process_name" value="ด้านการประมวลผล">

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
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="process_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $process_feature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section2tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $process_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section2tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $process_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section2tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_feature[]" id="section2tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $process_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="process_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Section 3 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 3 </label>ด้านการรายงานข้อมูล</label>
                <input type="hidden" name="report_name" value="ด้านการรายงานข้อมูล">

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
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="report_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $report_feature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section3tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $report_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section3tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $report_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section3tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_feature[]" id="section3tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $report_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="report_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Section 4 -->
                <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ 4 </label>ด้านความปลอดภัย</label>
                <input type="hidden" name="senrity_name" value="ด้านความปลอดภัย">

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
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 py-2">1</td>
                            <td class="border border-gray-300 py-2"><textarea name="senrity_feature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $senrity_feature[0] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section4tr1">
                            <td class="border border-gray-300 py-2">2</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr1td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $senrity_feature[1] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section4tr2">
                            <td class="border border-gray-300 py-2">3</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr2td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $senrity_feature[2] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                        <tr class="hidden odd:bg-white even:bg-gray-100" id="section4tr3">
                            <td class="border border-gray-300 py-2">4</td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_feature[]" id="section4tr3td" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"><?= $senrity_feature[3] ?></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_setfeature[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_result[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                            <td class="border border-gray-300 py-2"><textarea disabled name="senrity_compare[]" class="w-full h-40 border border-gray-300 rounded px-2 py-1 flex items-center" rows="3"></textarea></td>
                        </tr>
                    </tbody>
                </table>

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
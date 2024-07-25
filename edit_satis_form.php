<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} else if (isset($_SESSION['user_id'])) {
    $member_id = $_SESSION['user_id'];
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

    if ($row['member_id'] != $member_id) {
        header("Location: index.php");
        exit();
    }

    $sati_ep2 = $row['sati_ep2'];
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

    $query = $conn->prepare("SELECT * FROM project WHERE project_id = :project_id");
    $query->bindParam(":project_id", $row['project_id']);
    $query->execute();
    $rowp = $query->fetch();

    $project_name = $rowp['project_name'];

    // echo "sub_topic_ex = ";
    // print_r($sub_topic_ex[0]);
    // echo "<br>";
    // echo "sub_info_ex = ";
    // print_r($sub_info_ex[0]);
    // echo "<br>";
    // echo $sati_ep2;
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐาน //";
    // print_r($sati_info); // ข้อมูลพื้นฐาน
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐานย่อย //";
    // print_r($sub_info); // ข้อมูลพื้นฐานย่อย
    // echo "<br>";
    // echo "// หัวข้อด้าน //";
    // print_r($sati_topic); // หัวข้อด้าน
    // echo "<br>";
    // echo "// ข้อมูลแต่ละด้าน //";
    // print_r($sub_topic); // ข้อมูลแต่ละด้าน

    // echo "<br>";
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐาน //";
    // echo $sati_info_un; // ข้อมูลพื้นฐาน
    // echo "<br>";
    // echo "// ข้อมูลพื้นฐานย่อย //";
    // print_r($sub_info_un); // ข้อมูลพื้นฐานย่อย
    // echo "<br>";
    // echo "// หัวข้อด้าน //";
    // print_r($sati_topic_un); // หัวข้อด้าน
    // echo "<br>";
    // echo "// ข้อมูลแต่ละด้าน //";
    // print_r($sub_topic_un); // ข้อมูลแต่ละด้าน

} else {
    header("Location: index.php");
    exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>แก้ไขแบบประเมินความพึงพอใจ</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
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
    <!-- <script src="script/add_remove_satis_edit.js"></script> -->
</head>

<body>
    <div class="mx-2 sm:mx-16 bg-white p-4 my-2 sm:my-4 rounded shadow">
        <button type="button" onclick="isClass('<?php echo $class; ?>','<?php echo $class1; ?>')" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            กลับหน้าแรก
        </button>
        <form action="update_satis.php" method="POST">
            <input type="hidden" name="sati_id" value="<?= $_GET['id'] ?>">
            <h1 class="text-center text-3xl mb-5">แก้ไขแบบฟอร์มประเมินความพึงพอใจ</h1>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="text-center mb-4 p-3 mt-10 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <input type="hidden" name="id" class="block border" value="<?= $row['sati_id'] ?>">

            <!-- Title_Content -->
            <div class="head_content mt-5 mb-2">
                <label class="text-lg"><label class="text-lg font-bold mb-2">คำชี้แจง </label>ในแบบประเมินความพึงพอใจการใช้งานระบบ แบ่งออกเป็น 3 ตอนดังนี้</label><br><br>
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 1 </label>เป็นข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label><br><br>
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label><br>เป็นแบบสอบถามความคิดเห็น<br>ที่มีต่อ
                    <input type="text" id="" name="sati_ep2" class="p-1 text-lg text-gray-900 border border-gray-300 rounded bg-gray-50 w-86 sm:w-96" value="<?= $project_name ?>" required>
                    โดยแบ่งการประเมินเป็น 4 ด้าน คือ</label><br>
                <label class="text-lg ml-8">ด้านที่ 1 ด้านความต้องการของผู้ใช้งานระบบ</label><br>
                <label class="text-lg ml-8">ด้านที่ 2 ด้านการทำงานตามฟังค์ชันของระบบ</label><br>
                <label class="text-lg ml-8">ด้านที่ 3 ด้านความง่ายต่อการใช้งานระบบ</label><br>
                <label class="text-lg ml-8">ด้านที่ 4 ด้านการใช้งานรักษาความปลอดภัยของข้อมูลในระบบ</label><br>

            </div>

            <!-- Body_Content -->
            <div class="mb-4">
                <label class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 1 </label>ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

                <!-- Info -->
                <hr class="my-3">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                    <label class="block text-center mb-1 sm:mb-0 sm:self-center">เพิ่มข้อมูลพื้นฐาน</label>
                    <div class="flex justify-center">
                        <button type="button" id="addinfo" class="bg-green-500 text-white py-2 rounded hover:bg-green-600 w-5/12 mx-2">เพิ่มหัวข้อ</button>
                        <button type="button" id="removeinfo" class="bg-red-500 text-white py-2 rounded hover:bg-red-600 w-5/12 mx-2">ลบหัวข้อ</button>
                    </div>
                </div>

                <div id="info-section">
                    <?php $i = 0; ?>
                    <?php while ($i < count($sati_info)) { ?>
                        <hr class="my-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2" id="info-container_<?= $i + 1 ?>">
                            <div class="flex sm:block flex-col justify-center">
                                <input type="text" class="border border-gray-300 rounded px-3 py-2 w-full my-1 mb-2" name="sati_info[]" value="<?= $sati_info[$i] ?>" required>
                                <button type="button" id="addsubinfo_<?= $i + 1 ?>" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 justify-start">เพิ่มข้อมูลพื้นฐานที่ <?= $i + 1 ?></button>
                            </div>
                            <div id="sub-info_<?= $i + 1 ?>">
                                <?php for ($c = 0; $c < count($sub_info_ex[$i]); $c++) { ?>
                                    <div class="flex items-center my-1">
                                        <input required value="<?= $sub_info_ex[$i][$c] ?>" type="text" class="border border-gray-300 rounded px-3 py-2 w-full" name="sub_info<?= $i + 1 ?>[]">
                                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 ml-2 remove-subinfo">ลบ</button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php $i++;
                    } ?>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        let sectionCount = document.querySelectorAll('#info-section > .grid').length; // Initialize count based on existing sections
                        // console.log(sectionCount);
                        // Function to add a new main info section
                        function addInfoSection(index) {
                            const infoSection = document.getElementById('info-section');

                            const newInfoContainer = document.createElement('div');
                            newInfoContainer.id = `info-container_${index}`;

                            newInfoContainer.innerHTML = `
                                <hr class="my-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                                    <div class="flex sm:block flex-col justify-center">
                                        <input type="text" class="border border-gray-300 rounded px-3 py-2 w-full my-1 mb-2" name="sati_info[]" required>
                                        <button type="button" id="addsubinfo_${index}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 justify-start">เพิ่มข้อมูลพื้นฐานที่ ${index}</button>
                                    </div>
                                    <div id="sub-info_${index}"></div>
                                </div>
                            `;

                            infoSection.appendChild(newInfoContainer);

                            // Add event listener for the new "เพิ่มข้อมูลพื้นฐานที่" button
                            document.getElementById(`addsubinfo_${index}`).addEventListener('click', () => {
                                addSubInfo(index);
                            });
                        }

                        // Function to add a sub-info field
                        function addSubInfo(infoIndex) {
                            const subInfoContainer = document.getElementById(`sub-info_${infoIndex}`);
                            const subInfoCount = subInfoContainer.children.length;

                            const newSubInfoField = document.createElement('div');
                            newSubInfoField.className = 'flex items-center my-1';
                            newSubInfoField.innerHTML = `
                                <input required type="text" class="border border-gray-300 rounded px-3 py-2 w-full" name="sub_info${infoIndex}[]">
                                <button type="button" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 ml-2 remove-subinfo">ลบ</button>
                            `;

                            subInfoContainer.appendChild(newSubInfoField);

                            // Add event listener for the new "ลบ" button
                            newSubInfoField.querySelector('.remove-subinfo').addEventListener('click', () => {
                                subInfoContainer.removeChild(newSubInfoField);
                            });
                        }

                        // Add event listener for "เพิ่มหัวข้อ" button
                        document.getElementById('addinfo').addEventListener('click', () => {
                            sectionCount++;
                            addInfoSection(sectionCount);
                        });

                        // Function to handle existing and newly added "เพิ่มข้อมูลพื้นฐานที่" buttons
                        function handleAddSubInfoButtons() {
                            document.querySelectorAll('[id^=addsubinfo_]').forEach(button => {
                                button.addEventListener('click', () => {
                                    const infoIndex = button.id.split('_')[1];
                                    addSubInfo(infoIndex);
                                });
                            });
                        }

                        // Initial setup for existing "เพิ่มข้อมูลพื้นฐานที่" buttons
                        handleAddSubInfoButtons();

                        // Remove the last main info section
                        document.getElementById('removeinfo').addEventListener('click', () => {
                            const infoSection = document.getElementById('info-section');

                            if (sectionCount > 0) {
                                const lastInfoContainer = infoSection.querySelector(`#info-container_${sectionCount}`);
                                const hrElement = lastInfoContainer.previousElementSibling; // The <hr> preceding the container

                                if (lastInfoContainer) {
                                    if (hrElement && hrElement.tagName.toLowerCase() === 'hr') {
                                        infoSection.removeChild(hrElement); // Remove the preceding <hr>
                                    }
                                    infoSection.removeChild(lastInfoContainer);
                                    sectionCount--;
                                }
                            }
                        });

                        // Initial setup for existing sub-info fields and their remove buttons
                        document.querySelectorAll('.addsubinfo').forEach(button => {
                            button.addEventListener('click', () => {
                                const infoIndex = button.id.split('_')[1];
                                addSubInfo(infoIndex);
                            });
                        });

                        document.querySelectorAll('.remove-subinfo').forEach(button => {
                            button.addEventListener('click', () => {
                                button.parentElement.remove();
                            });
                        });
                    });
                </script>

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
                    <div class="flex justify-end">
                        <button type="button" id="add-section" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-4">เพิ่มจำนวนด้าน</button>
                        <button type="button" id="remove-section" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบจำนวนด้าน</button>
                    </div>

                    <div id="sections-container">
                        <?php $t = 0; ?>
                        <?php while ($t < count($sati_topic)) { ?>
                            <div id="section-<?= $t + 1 ?>" class="mt-6">
                                <label class="text-lg">
                                    <label class="text-lg font-bold">ด้านที่ <?= $t + 1 ?> </label>ด้าน
                                    <input type="text" name="sati_topic[]" class="p-1 text-lg border border-gray-300 rounded w-full sm:w-86 md:w-96 ml-0 sm:ml-1" value="<?= $sati_topic[$t] ?>" required>
                                </label><br>
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
                                            <tr class="odd:bg-white even:bg-gray-100">
                                                <td class="border border-gray-300 py-2 text-center"><?= $b + 1 ?></td>
                                                <td class="border border-gray-300 py-2"><textarea name="sub_topic<?= $t + 1 ?>[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1" required><?= $sub_topic_ex[$t][$b] ?></textarea></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจมากที่สุด"></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจมาก"></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจปานกลาง"></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจน้อย"></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจน้อยที่สุด"></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <button type="button" onclick="sectionAdd(<?= $t + 1 ?>)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                                <button type="button" onclick="sectionRemove(<?= $t + 1 ?>)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>
                            </div>
                        <?php $t++;
                        } ?>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let sectionCount = document.querySelectorAll('#sections-container > div[id^="section-"]').length;

                            function addTopicSection(index) {
                                const topicSection = document.getElementById('sections-container');

                                const newTopicContainer = document.createElement('div');
                                newTopicContainer.id = `section-${index}`;
                                newTopicContainer.className = 'mt-6';

                                newTopicContainer.innerHTML = `
                                    <label class="text-lg">
                                        <span class="text-lg font-bold">ด้านที่ ${index} </span>ด้าน
                                        <input type="text" name="sati_topic[]" class="p-1 text-lg border border-gray-300 rounded w-full sm:w-86 md:w-96 ml-0 sm:ml-1" required>
                                    </label><br>
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
                                        <tbody id="section${index}-tbody">
                                            <tr class="odd:bg-white even:bg-gray-100">
                                                <td class="border border-gray-300 py-2 text-center">1</td>
                                                <td class="border border-gray-300 py-2">
                                                    <textarea name="sub_topic${index}[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1" required></textarea>
                                                </td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจมากที่สุด"></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจมาก"></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจปานกลาง"></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจน้อย"></td>
                                                <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจน้อยที่สุด"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" onclick="sectionAdd(${index})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                                    <button type="button" onclick="sectionRemove(${index})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>
                                `;

                                topicSection.appendChild(newTopicContainer);
                                updateRemoveButtonVisibility(index); // Ensure button visibility is correct when a new section is added
                            }

                            function addSubTopic(topicIndex) {
                                const subTopicContainer = document.getElementById(`section${topicIndex}-tbody`);
                                const subTopicCount = subTopicContainer.children.length;

                                const newSubTopicField = document.createElement('tr');
                                newSubTopicField.className = 'odd:bg-white even:bg-gray-100';
                                newSubTopicField.innerHTML = `
                                    <td class="border border-gray-300 py-2 text-center">${subTopicCount + 1}</td>
                                    <td class="border border-gray-300 py-2">
                                        <textarea name="sub_topic${topicIndex}[]" class="w-full h-28 sm:h-16 border border-gray-300 rounded px-2 py-1" required></textarea>
                                    </td>
                                    <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจมากที่สุด"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจมาก"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจปานกลาง"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจน้อย"></td>
                                    <td class="border border-gray-300 py-2 text-center"><input disabled class="w-full h-10 flex items-center" type="radio" value="พึงพอใจน้อยที่สุด"></td>
                                `;

                                subTopicContainer.appendChild(newSubTopicField);
                                updateRemoveButtonVisibility(topicIndex);
                            }

                            window.sectionAdd = function(sectionIndex) {
                                addSubTopic(sectionIndex);
                            };

                            window.sectionRemove = function(sectionIndex) {
                                const subTopicContainer = document.getElementById(`section${sectionIndex}-tbody`);
                                if (subTopicContainer && subTopicContainer.children.length > 1) {
                                    subTopicContainer.removeChild(subTopicContainer.lastElementChild);
                                }
                                updateRemoveButtonVisibility(sectionIndex);
                            };

                            // Call updateRemoveButtonVisibility for each section initially
                            document.querySelectorAll('#sections-container > div[id^="section-"]').forEach((section) => {
                                const index = section.id.split('-')[1];
                                updateRemoveButtonVisibility(index);
                            });

                            document.getElementById('add-section').addEventListener('click', () => {
                                sectionCount++;
                                addTopicSection(sectionCount);
                            });

                            document.getElementById('remove-section').addEventListener('click', () => {
                                if (sectionCount > 0) {
                                    const sectionContainer = document.getElementById('sections-container');
                                    sectionContainer.removeChild(sectionContainer.lastElementChild);
                                    sectionCount--;
                                }
                            });

                            function updateRemoveButtonVisibility(sectionIndex) {
                                const subTopicContainer = document.getElementById(`section${sectionIndex}-tbody`);
                                const removeButton = document.querySelector(`#section-${sectionIndex} button[onclick*="sectionRemove"]`);
                                if (subTopicContainer && subTopicContainer.children.length <= 1) {
                                    removeButton.classList.add('hidden');
                                } else {
                                    removeButton.classList.remove('hidden');
                                }
                            }
                        });
                    </script>

                    <div class="text-center mt-5">
                        <button type="submit" name="update" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
                    </div>

                </div>
        </form>
    </div>
    <script src="script/changeclassforform2.js"></script>
</body>

</html>
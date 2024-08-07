<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} else if (isset($_SESSION['user_id'])) {
    $member_id = $_SESSION['user_id'];
}

if (isset($_GET['id'])) {
    $form_id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM tb_efficiercy_form WHERE form_id = :form_id");
    $query->bindParam(":form_id", $form_id);
    $query->execute();
    $row = $query->fetch();

    if ($row['member_id'] != $member_id) {
        header("Location: index.php");
        exit();
    }

    $pj_id = $row['project_id'];
    $formname = $row['form_name'];
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

    $query = $conn->prepare("SELECT * FROM project WHERE project_id = :project_id");
    $query->bindParam(":project_id", $row['project_id']);
    $query->execute();
    $rowp = $query->fetch();

    $project_name = $rowp['project_name'];
} else {
    header("Location: index.php");
    exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>แก้ไขแบบฟอร์มประเมินประสิทธิภาพ</title>
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
        <button type="button" onclick="window.location.href='form.php?class=columnData';" class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            กลับหน้าแรก
        </button>
        <form action="update_performance.php" method="POST" id="myform">
            <input type="hidden" name="pj_id" value="<?= $pj_id ?>">
            <h1 class="text-center text-2xl mb-5">แก้ไขแบบฟอร์มประเมินประสิทธิภาพ</h1>

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
                <input type="text" readonly value="<?= $project_name ?>" name="formname" id="formname" class="block w-full border border-gray-300 rounded px-3 py-2 mb-3" required>

                <input type="hidden" name="id" class="block border" value="<?= $form_id ?>">

                <label class="block text-lg font-bold mb-2">คำชี้แจง</label>
                <textarea name="ad" class="block w-full border border-gray-300 rounded px-3 py-2" rows="5" required><?= $row['form_ad'] ?></textarea>
            </div>

            <!-- Body_Content -->
            <div class="mb-4">
                <label class="block text-lg font-bold mb-2">ตอนที่ 1 ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label>

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
                    <?php while ($i < count($form_info)) { ?>
                        <hr class="my-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2" id="info-container_<?= $i + 1 ?>">
                            <div class="flex sm:block flex-col justify-center">
                                <input type="text" class="border border-gray-300 rounded px-3 py-2 w-full my-1 mb-2" name="form_info[]" value="<?= $form_info[$i] ?>" required>
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
                                        <input type="text" class="border border-gray-300 rounded px-3 py-2 w-full my-1 mb-2" name="form_info[]" required>
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

                <div class="mb-4">
                    <label for="" class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label>แบบสอบถามความคิดเห็น</label>

                    <label for="" class="block text-lg"><label class=" text-lg font-bold mb-2">คำชี้แจง </label>โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label>

                    <!-- Start Table -->
                    <div class="flex justify-end">
                        <button type="button" id="add-section" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-4">เพิ่มจำนวนด้าน</button>
                        <button type="button" id="remove-section" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบจำนวนด้าน</button>
                    </div>

                    <div id="sections-container">
                        <?php $t = 0; ?>
                        <?php while ($t < count($form_topic)) { ?>
                            <div id="section-<?= $t + 1 ?>" class="mt-12">
                                <label for="" class="block text-lg mb-5"><label class="text-lg font-bold mb-2">ด้านที่ <?= $t + 1 ?> </label>ด้าน<input type="text" name="form_topic[]" class="p-1 text-lg border border-gray-300 rounded w-full sm:w-86 md:w-96 ml-0 sm:ml-1" value="<?= $form_topic[$t] ?>" required></label>

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
                                                    <td class="border border-gray-300 py-2"><textarea name="feature<?= $t + 1 ?>[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required><?= $feature_ex[$t][$b] ?></textarea></td>
                                                    <td class="border border-gray-300 py-2"><textarea name="setfeature<?= $t + 1 ?>[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required><?= $setfeature_ex[$t][$b] ?></textarea></td>
                                                    <td class="border border-gray-300 py-2"><textarea disabled name="" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                                    <td class="border border-gray-300 py-2"><textarea disabled name="" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
                                newTopicContainer.className = 'mt-12';

                                newTopicContainer.innerHTML = `
                                    <label for="" class="block text-lg mb-5"><label class="text-lg font-bold mb-2">ด้านที่ ${index} </label>ด้าน<input type="text" name="form_topic[]" class="p-1 text-lg border border-gray-300 rounded w-full sm:w-86 md:w-96 ml-0 sm:ml-1" required></label>
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
                                        <tbody id="section${index}-tbody">
                                            <tr class="odd:bg-white even:bg-gray-100">
                                                <td class="border border-gray-300 py-2">1</td>
                                                <td class="border border-gray-300 py-2"><textarea name="feature${index}[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required></textarea></td>
                                                <td class="border border-gray-300 py-2"><textarea name="setfeature${index}[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required></textarea></td>
                                                <td class="border border-gray-300 py-2"><textarea disabled name="" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                                <td class="border border-gray-300 py-2"><textarea disabled name="" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
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
                                    <td class="border border-gray-300 py-2">${subTopicCount + 1}</td>
                                    <td class="border border-gray-300 py-2"><textarea name="feature${topicIndex}[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea name="setfeature${topicIndex}[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea disabled name="" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                    <td class="border border-gray-300 py-2"><textarea disabled name="" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
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

                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
                    <input type="hidden" name="update" value="update" readonly>

                    <script>
                        document.getElementById("myform").addEventListener("submit", (event) => {
                            event.preventDefault(); // ป้องกันไม่ให้ฟอร์มถูกส่งโดยทันที

                            Swal.fire({
                                title: "ยืนยันการบันทึกหรือไม่?",
                                text: "ตรวจสอบให้แน่ใจว่าคุณกรอกข้อมูลถูกต้อง!",
                                icon: "info",
                                showCancelButton: true,
                                confirmButtonColor: "#16a34a",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "บันทึก",
                                cancelButtonText: "ยกเลิก",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // ส่งฟอร์ม
                                    document.getElementById("myform").submit();
                                }
                            });
                        });
                    </script>
                </div>

            </div>

        </form>
    </div>
</body>

</html>
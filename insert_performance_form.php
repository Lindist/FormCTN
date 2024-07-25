<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['class'])) {
    $class = $_GET['class'];
} else {
    $class = 'nohave';
}

if(isset($_GET['pro_name'])){
    $projectName = $_GET['pro_name'];
}
if(isset($_GET['pro_id'])){
    $_SESSION['projectId'] = $_GET['pro_id'];
}

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
    <!-- <script src="script/add_remove_performance_insert.js"></script> -->
</head>

<body>
    <div class="mx-2 sm:mx-16 bg-white p-4 my-2 sm:my-4 rounded shadow">
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
                <input type="text" name="formname" id="formname" value="<?= $projectName; ?>" class="block w-full border border-gray-300 rounded px-3 py-2 mb-3" readonly>

                <label class="block text-lg font-bold mb-2">คำชี้แจง</label>
                <textarea name="ad" class="block w-full border border-gray-300 rounded px-3 py-2" rows="5" required></textarea>
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

                <div id="info-section"></div>

                <script>
                    document.getElementById('addinfo').addEventListener('click', function() {
                        var infoSection = document.getElementById('info-section');

                        // Get current number of blocks
                        var currentBlocks = infoSection.children.length;

                        // Ensure the number of inputs does not exceed 10
                        // if (currentBlocks < 10) {
                        var newBlock = document.createElement('div');
                        newBlock.innerHTML = `
                                <hr class="my-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2" id="info-container_${currentBlocks + 1}">
                                    <div class="flex sm:block flex-col justify-center">
                                        <input type="text" class="border border-gray-300 rounded px-3 py-2 w-full my-1 mb-2" name="form_info[]" value="" required>
                                        <button type="button" id="addsubinfo_${currentBlocks + 1}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 justify-start">เพิ่มข้อมูลพื้นฐานที่ ${currentBlocks + 1}</button>
                                    </div>
                                    <div id="sub-info_${currentBlocks + 1}"></div>
                                </div>
                            `;
                        infoSection.appendChild(newBlock);

                        document.getElementById(`addsubinfo_${currentBlocks + 1}`).addEventListener('click', function() {

                            // Creating a new div to contain the new input field and remove button
                            var containerId = this.id.replace('addsubinfo_', '');
                            var subInfoSection = document.getElementById(`sub-info_${containerId}`);

                            const newSubInfoField = document.createElement('div');
                            newSubInfoField.className = 'flex items-center my-1';
                            newSubInfoField.innerHTML = `
                                <input required type="text" class="border border-gray-300 rounded px-3 py-2 w-full" name="sub_info${containerId}[]">
                                <button type="button" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 ml-2 remove-subinfo">ลบ</button>
                            `;

                            // Finding the container and appending the new element
                            subInfoSection.appendChild(newSubInfoField);

                            // Adding an event listener to the new remove button
                            newSubInfoField.querySelector('.remove-subinfo').addEventListener('click', function() {
                                newSubInfoField.remove();
                            });
                        });

                        // // Add event listener for the "เพิ่มข้อมูลพื้นฐานที่" button
                        // document.getElementById(`addsubinfo_${currentBlocks + 1}`).addEventListener('click', function() {
                        //     var containerId = this.id.replace('addsubinfo_', '');
                        //     var subInfoSection = document.getElementById(`sub-info_${containerId}`);
                        //     var newInput = document.createElement('input');
                        //     newInput.required = true;
                        //     newInput.type = 'text';
                        //     newInput.className = 'border border-gray-300 rounded px-3 py-2 my-1 w-full sm:w-10/12';
                        //     newInput.name = `sub_info${containerId}[]`;

                        //     var newButton = document.createElement('button');
                        //     newButton.type = 'button';
                        //     newButton.className = 'bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 mx-2';
                        //     newButton.textContent = 'ลบ';

                        //     newButton.addEventListener('click', function() {
                        //         newInput.remove();
                        //         newButton.remove();
                        //     });

                        //     subInfoSection.appendChild(newInput);
                        //     subInfoSection.appendChild(newButton);
                        // });

                        // Add event listener for the "ลบ" button to remove the block
                        document.getElementById(`removeinfo_${currentBlocks + 1}`).addEventListener('click', function() {
                            newBlock.remove();
                        });
                        // }
                    });

                    document.getElementById('removeinfo').addEventListener('click', function() {
                        var infoSection = document.getElementById('info-section');
                        var currentBlocks = infoSection.children.length;

                        // Remove the last block if any exist
                        if (currentBlocks > 0) {
                            infoSection.removeChild(infoSection.lastChild);
                        }
                    });

                    save = document.getElementById('save');

                    if (currentBlocks < 0) {
                        save.classList.add('hidden');
                    } else {
                        save.classList.remove('hidden');
                    }
                </script>

                <!-- Survey Section 2 -->
                <hr class="my-3">

                <div class="mb-4">
                    <label for="" class="text-lg"><label class="text-lg font-bold mb-2">ตอนที่ 2 </label>แบบสอบถามความคิดเห็น</label>

                    <label for="" class="block text-lg"><label class=" text-lg font-bold mb-2">คำชี้แจง </label>โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label>

                    <!-- Section -->
                    <div class="flex justify-end">
                        <button type="button" id="add-section" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-4">เพิ่มจำนวนด้าน</button>
                        <button type="button" id="remove-section" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบจำนวนด้าน</button>
                    </div>

                    <div id="sections-container">

                    </div>

                    <script>
                        let sectionNumber = 1;

                        // เมื่อคลิกที่ปุ่ม "เพิ่มด้าน"
                        document.getElementById('add-section').addEventListener('click', function() {
                            addSection();
                        });

                        function addSection() {
                            // สร้าง div ของด้านใหม่
                            const newSection = document.createElement('div');
                            newSection.id = 'section-' + sectionNumber;
                            newSection.className = 'mt-12'

                            // HTML สำหรับด้านใหม่
                            newSection.innerHTML = `
                                    <label for="" class="block text-lg my-5"><label class="text-lg font-bold mb-2">ด้านที่ ${sectionNumber} </label>ด้าน<input type="text" name="form_topic[]" class="p-1 text-lg border border-gray-300 rounded w-full sm:w-86 md:w-96 ml-0 sm:ml-1" required></label>

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
                                                    <td class="border border-gray-300 py-2"><textarea name="feature${sectionNumber}[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required></textarea></td>
                                                    <td class="border border-gray-300 py-2"><textarea name="setfeature${sectionNumber}[]" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center" required></textarea></td>
                                                    <td class="border border-gray-300 py-2"><textarea disabled name="" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                                    <td class="border border-gray-300 py-2"><textarea disabled name="" class="border border-gray-300 rounded w-42 sm:w-56 md:w-80 lg:w-80 xl:w-80 2xl:w-full h-40 px-2 py-1 flex items-center"></textarea></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <button type="button" onclick="sectionAdd(${sectionNumber})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
                                <button type="button" onclick="sectionRemove(${sectionNumber})" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>
                            `;

                            // เพิ่ม div ใหม่ลงใน container ของ sections
                            document.getElementById('sections-container').appendChild(newSection);

                            // เพิ่มหมายเลขด้าน
                            sectionNumber++;
                            updateSectionNumbers();
                        }

                        // ฟังก์ชันเพิ่มแถวใหม่สำหรับแต่ละด้าน
                        function sectionAdd(sectionNumber) {
                            // คัดลอกแถวแม่ของด้านนี้
                            const originalRow = document.querySelector(`#section-${sectionNumber} tbody tr`);
                            const newRow = originalRow.cloneNode(true);

                            // เคลียร์ค่าใน textarea
                            const textareas = newRow.querySelectorAll('textarea');
                            textareas.forEach(textarea => textarea.value = '');

                            // เพิ่มแถวใหม่ลงในตาราง
                            const tbody = document.querySelector(`#section-${sectionNumber} tbody`);
                            tbody.appendChild(newRow);

                            // อัปเดตหมายเลขของแถวในตาราง
                            updateRowNumbers(sectionNumber);

                            // แสดงปุ่มลบ (หากยังไม่มีแถวใหม่)
                            const removeBtn = document.querySelector(`#section-${sectionNumber} button[type="button"][onclick="sectionRemove(${sectionNumber})"]`);
                            if (tbody.children.length > 1) {
                                removeBtn.classList.remove('hidden');
                            }
                        }

                        // ฟังก์ชันลบแถวล่าสุดสำหรับแต่ละด้าน
                        function sectionRemove(sectionNumber) {
                            const tbody = document.querySelector(`#section-${sectionNumber} tbody`);
                            if (tbody.children.length > 1) {
                                tbody.removeChild(tbody.lastChild);

                                // อัปเดตหมายเลขของแถวในตาราง
                                updateRowNumbers(sectionNumber);
                            }

                            // ซ่อนปุ่มลบ (หากไม่มีแถวเลย)
                            const removeBtn = document.querySelector(`#section-${sectionNumber} button[type="button"][onclick="sectionRemove(${sectionNumber})"]`);
                            if (tbody.children.length === 1) {
                                removeBtn.classList.add('hidden');
                            }
                        }

                        // ฟังก์ชันลบ "ด้าน" ล่าสุด
                        document.getElementById('remove-section').addEventListener('click', function() {
                            if (sectionNumber > 1) {
                                sectionNumber--;
                                const lastSection = document.getElementById('section-' + sectionNumber);
                                lastSection.remove();
                                updateSectionNumbers();
                            }
                        });

                        // ฟังก์ชันอัปเดตหมายเลข "ที่" ของแต่ละ "ด้าน"
                        function updateSectionNumbers() {
                            const sections = document.querySelectorAll('#sections-container > div');
                            sections.forEach((section, index) => {
                                const sectionLabel = section.querySelector('label.text-lg font-bold');
                                sectionLabel.innerText = `ด้านที่ ${index + 1} `;
                                updateRowNumbers(index + 1);
                            });
                        }

                        // ฟังก์ชันอัปเดตหมายเลข "ที่" ของแต่ละแถวในตาราง
                        function updateRowNumbers(sectionNumber) {
                            const rows = document.querySelectorAll(`#section-${sectionNumber} tbody tr`);
                            rows.forEach((row, rowIndex) => {
                                row.querySelector('td:first-child').innerText = rowIndex + 1;
                            });
                        }
                    </script>

                    <div class="text-center mt-5">
                        <button type="submit" name="save" id="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">บันทึกข้อมูล</button>
                    </div>
                </div>

        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var save = document.getElementById('save');
            let i = 0;
            let c = 0;

            // Function to update the visibility of the save button
            function updateSaveButton() {
                if (i > 0 && c > 0) {
                    save.classList.remove('hidden');
                } else {
                    save.classList.add('hidden');
                }
            }

            // Add event listener for adding info
            document.getElementById('addinfo').addEventListener('click', function() {
                i++;
                console.log(i);
                updateSaveButton(); // Update save button visibility
            });

            // Add event listener for removing info
            document.getElementById('removeinfo').addEventListener('click', function() {
                if (i > 0) { // Ensure i doesn't go below 0
                    i--;
                    console.log(i);
                    updateSaveButton(); // Update save button visibility
                }
            });

            document.getElementById("add-section").addEventListener('click', function() {
                c++;
                console.log(c);
                updateSaveButton();
            });

            document.getElementById("remove-section").addEventListener('click', function() {
                if (c > 0) {
                    c--;
                    console.log(c);
                    updateSaveButton();
                }
            });

            // Initial call to set the correct visibility of the save button
            updateSaveButton();
        });
    </script>
    <script src="script/changeclass.js"></script>
</body>

</html>
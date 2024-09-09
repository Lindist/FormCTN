<?php
session_start();
require('session/config.php');

if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$form_id = $_GET['form_id'];

$stmt = $conn->prepare("SELECT * FROM tb_efficiercy_form WHERE form_id = :form_id");
$stmt->bindParam(":form_id", $form_id);
$stmt->execute();

$main = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array

$form_info_un = $main['form_info'];
$sub_info_un = $main['sub_info'];

$form_info = preg_split("/Ϫ/", $form_info_un);
$sub_info_unin = preg_split("/ꓘ/", $sub_info_un);

// print_r($sub_info_unin[0]);

$main_sub_info = [];
for ($i = 1; $i <= count($form_info); $i++) {
    if (isset($sub_info_unin[$i - 1])) {
        $main_sub_info[$i - 1] = preg_split("/Ϫ/", $sub_info_unin[$i - 1]);
    }
}

$query = $conn->prepare("SELECT * FROM tb_fill_efficiercy WHERE form_id = :form_id");
$query->bindParam(":form_id", $form_id);
$query->execute();

$rows = $query->fetchAll(PDO::FETCH_ASSOC); // Fetch as an associative array

// Extract only the 'sub_info' field from each record
$sub_info = array_map(function ($row) {
    return ['sub_info' => $row['sub_info']];
}, $rows);

$sub_info_ex = [];
foreach ($rows as $row) {
    // Get the sub_info value
    $sub_info = $row['sub_info'];
    // Split the sub_info by 'ꓘ'
    $split_sub_info = preg_split("/ꓘ/", $sub_info);
    // Add only the split results to the array
    $sub_info_ex[] = $split_sub_info;
}

if (isset($_GET['class'])) {
    $class = $_GET['class'];
}else{
    $class = 'nohave';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <title>ผลสรุปแบบประเมิณประสิทธิภาพ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
            background-color: rgb(180, 180, 180);
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="mx-2 sm:mx-16 bg-white p-4 my-2 sm:my-4 rounded shadow">
        <aside class="my-5" style="display: flex; width: 170px; justify-content: space-between; flex-wrap: wrap;">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <button type="button" onclick="isClass('<?php echo $class; ?>')" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
                    กลับหน้าแรก
                </button>
            <?php } else if (isset($_SESSION['admin_id'])) { ?>
                <button type="button" onclick="window.location.href = 'adminpanel.php'" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
                    กลับหน้าแรก
                </button>
            <?php } ?>
            <button type="button" onclick="history.back()" style="display:flex; background-color:#111; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#333';" onmouseout="this.style.backgroundColor='#111';">
                กลับ
            </button>
        </aside>
        <div>
            <p class="text-2xl font-medium mb-2">ตอนที่ 1 ผลการวิเคราะห์ข้อมูลพื้นฐานของผู้ตอบแบบสอบถาม</p>

            <?php
            $c = 0;
            ?>
            <?php for ($i = 0; $i < count($form_info); $i++) { ?>
                <p class="flex text-xl font-medium mt-4 justify-center"><?= htmlspecialchars($form_info[$i], ENT_QUOTES, 'UTF-8') ?></p>
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 text-center my-1">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-1">คุณลักษณะ</th>
                                <th class="border border-gray-300 px-1">จำนวน</th>
                                <th class="border border-gray-300 px-1">เปอร์เซ็นต์</th>
                                <th class="border border-gray-300 px-1">รวม(คน)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // รีเซ็ตตัวนับสำหรับแต่ละตารางใหม่
                            $total_count = 0;
                            $match_counts = array_fill(0, count($main_sub_info[$i]), 0);

                            for ($b = 0; $b < count($main_sub_info[$i]); $b++) {
                                // นับจำนวนการจับคู่สำหรับแต่ละ sub_info_ex
                                foreach ($sub_info_ex as $sub_info) {
                                    if (isset($sub_info[$i]) && $sub_info[$i] == $main_sub_info[$i][$b]) {
                                        $match_counts[$b]++;
                                        $total_count++;
                                    }
                                }
                            }
                            ?>
                            <?php for ($b = 0; $b < count($main_sub_info[$i]); $b++) { ?>
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="border border-gray-300 px-1"><?= htmlspecialchars($main_sub_info[$i][$b], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td class="border border-gray-300 px-1"><?= $match_counts[$b] ?></td>
                                    <td class="border border-gray-300 px-1"><?= ($total_count > 0) ? number_format(($match_counts[$b] / $total_count) * 100, 2) : 0 ?>%</td>
                                    <td class="border border-gray-300 px-1"><?= $total_count ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php
                // สร้างข้อความสรุปอัตโนมัติ
                $summary = "จากตาราง " . $form_info[$i] . " พบว่าผู้ตอบแบบสอบถามทั้งหมด " . $total_count . " คน ";
                foreach ($main_sub_info[$i] as $index => $attribute) {
                    $percentage = ($total_count > 0) ? number_format(($match_counts[$index] / $total_count) * 100, 2) : 0;
                    $summary .= "เป็น " . htmlspecialchars($attribute, ENT_QUOTES, 'UTF-8') . " " . $match_counts[$index] . " คน คิดเป็น " . $percentage . "% ";
                }
                echo "<p>" . $summary . "</p>";
                ?>
            <?php } ?>
        </div>
    </div>
    <script src="script/changeclass.js"></script>
</body>
</html>
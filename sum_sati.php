<?php
session_start();
require('session/config.php');

$sati_id = $_GET['sati_id'];

$stmt = $conn->prepare("SELECT * FROM tb_satisfied WHERE sati_id = :sati_id");
$stmt->bindParam(":sati_id", $sati_id);
$stmt->execute();

$main = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array

$sati_info_un = $main['sati_info'];
$sub_info_un = $main['sub_info'];

$sati_info = preg_split("/Ϫ/", $sati_info_un);
$sub_info_unin = preg_split("/ꓘ/", $sub_info_un);

// print_r($sub_info_unin[0]);

$main_sub_info = [];
for ($i = 1; $i <= count($sati_info); $i++) {
    if (isset($sub_info_unin[$i - 1])) {
        $main_sub_info[$i - 1] = preg_split("/Ϫ/", $sub_info_unin[$i - 1]);
    }
}

$sati_topic_un = $main['sati_topic'];
$sub_topic_un = $main['sub_topic'];

// echo $sati_topic_un;

$sati_topic = preg_split("/Ϫ/", $sati_topic_un);
$sub_topic_unin = preg_split("/ꓘ/", $sub_topic_un);

$main_sub_topic = [];
for ($i = 1; $i <= count($sati_topic); $i++) {
    if (isset($sub_topic_unin[$i - 1])) {
        $main_sub_topic[$i - 1] = preg_split("/Ϫ/", $sub_topic_unin[$i - 1]);
    }
}

$query = $conn->prepare("SELECT * FROM tb_fill_satisfied WHERE sati_id = :sati_id");
$query->bindParam(":sati_id", $sati_id);
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

// Extract only the 'score' field from each record
$scores = array_map(function ($row) {
    return ['score' => $row['score']];
}, $rows);

$scores_ex = [];
foreach ($rows as $row) {
    // Get the score value
    $score = $row['score'];
    // Split the score by 'ꓘ'
    $split_scores = preg_split("/ꓘ/", $score);
    // Add only the split results to the array
    $scores_ex[] = $split_scores;
}

$scores_split = [];
foreach ($scores_ex as $score_group) {
    $group_split = [];
    foreach ($score_group as $score) {
        $group_split[] = preg_split("/Ϫ/", $score);
    }
    $scores_split[] = $group_split;
}

// ฟังก์ชันแปลงข้อความเป็นตัวเลข
function convert_satisfaction_to_number($text) {
    $map = [
        "พึงพอใจมากที่สุด" => 5,
        "พึงพอใจมาก" => 4,
        "พึงพอใจปานกลาง" => 3,
        "พึงพอใจน้อย" => 2,
        "พึงพอใจน้อยที่สุด" => 1
    ];
    return isset($map[$text]) ? $map[$text] : 0;
}

// แปลงคะแนนในอาร์เรย์
foreach ($scores_split as &$score_group) {
    foreach ($score_group as &$score) {
        foreach ($score as &$part) {
            $part = convert_satisfaction_to_number($part);
        }
    }
}
unset($score_group, $score, $part);

echo "หัวข้อ<br>";
print_r($sati_info);
echo "<br>คำตอบแต่ละหัวข้อ<br>";
print_r($main_sub_info);
echo "<br>คำตอบที่ user ตอบ<br>";
print_r($sub_info_ex);
echo "<br>";
echo "<-----score----->";
echo "<br>";
echo "หัวข้อ<br>";
print_r($sati_topic);
echo "<br>คำตอบแต่ละหัวข้อ<br>";
print_r($main_sub_topic);
echo "<br>คำตอบที่ user ตอบ<br>";
print_r($scores_split);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        <div>
            <p class="text-2xl font-medium mb-2">ตอนที่ 1 ผลการวิเคราะห์ข้อมูลพื้นฐานของผู้ตอบแบบสอบถาม</p>

            <?php
            $c = 0;
            ?>
            <?php for ($i = 0; $i < count($sati_info); $i++) { ?>
                <p class="flex text-xl font-medium mt-4 justify-center"><?= htmlspecialchars($sati_info[$i], ENT_QUOTES, 'UTF-8') ?></p>
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
                                    if ($sub_info[$i] == $main_sub_info[$i][$b]) {
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
                $summary = "จากตาราง " . $sati_info[$i] . " พบว่าผู้ตอบแบบสอบถามทั้งหมด " . $total_count . " คน ";
                foreach ($main_sub_info[$i] as $index => $attribute) {
                    $percentage = ($total_count > 0) ? number_format(($match_counts[$index] / $total_count) * 100, 2) : 0;
                    $summary .= "เป็น " . htmlspecialchars($attribute, ENT_QUOTES, 'UTF-8') . " " . $match_counts[$index] . " คน คิดเป็น " . $percentage . "% ";
                }
                echo "<p>" . $summary . "</p>";
                ?>
            <?php } ?>
        </div>

        <div class="mt-6">
            <p class="text-2xl font-medium mb-2">ตอนที่ 2 แบบสอบถามความคิดเห็น</p>
            <p class="text-lg font-medium mb-2 mt-4">ผลการวิเคราะห์ประเมินผลการใช้งานระบบ</p>

            <?php
            $s = 0;
            ?>
            <?php for ($i = 0; $i < count($sati_topic); $i++) { ?>
                <p class="text-lg font-medium mb-2 mt-4">ด้านที่ <?= $i + 1 ?> ด้าน<?= $sati_topic[$i] ?></p>
                <table class="w-full border border-gray-300 text-center my-3">
                    <thead>
                        <tr class="bg-gray-200">
                            <th rowspan="2" class="border border-gray-300 w-9/12">หัวข้อ</th>
                            <th colspan="3" class="border border-gray-300 w-1/4">ระดับความเหมาะสม</th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-1">X</th>
                            <th class="border border-gray-300 px-1">S.D.</th>
                            <th class="border border-gray-300 px-1">การแปลผล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 text-center">test</td>
                            <td class="border border-gray-300 text-center">test</td>
                            <td class="border border-gray-300 text-center">test</td>
                            <td class="border border-gray-300 text-center">test</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            <?php } ?>

        </div>

    </div>
</body>

</html>
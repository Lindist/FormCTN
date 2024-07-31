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
function convert_number_to_satisfaction($number) {
    $Z_Scores_to_convert = [];
    $map = [
        5 => "พึงพอใจมากที่สุด",
        4 => "พึงพอใจมาก",
        3 => "พึงพอใจปานกลาง",
        2 => "พึงพอใจน้อย",
        1 => "พึงพอใจน้อยที่สุด"
    ];
    foreach($number as $index => $value){
        $Z_Scores_to_convert[] = [];
        foreach($number[$index] as $value0){
            if($value0 <= 1 && $value0 < 2){
                $Z_Scores_to_convert[$index][] = $map[1];
            }else if($value0 >= 2 && $value0 < 3){
                $Z_Scores_to_convert[$index][] = $map[2];
            }else if($value0 >= 3 && $value0 < 4){
                $Z_Scores_to_convert[$index][] = $map[3];
            }else if($value0 >= 4 && $value0 < 5){
                $Z_Scores_to_convert[$index][] = $map[4];
            }else if($value0 >= 5){
                $Z_Scores_to_convert[$index][] = $map[5];
            }else{
                $Z_Scores_to_convert[$index][] = "พึงพอใจระดับปรับปรุง";
            }
        }
    }
    return $Z_Scores_to_convert;
}
function convert_number_to_satisfaction_sum($number) {
    $Z_Scores_to_convert = [];
    $map = [
        5 => "พึงพอใจมากที่สุด",
        4 => "พึงพอใจมาก",
        3 => "พึงพอใจปานกลาง",
        2 => "พึงพอใจน้อย",
        1 => "พึงพอใจน้อยที่สุด"
    ];
    foreach($number as $index => $value){
        if($value <= 1 && $value < 2){
            $Z_Scores_to_convert[] = $map[1];
        }else if($value >= 2 && $value < 3){
            $Z_Scores_to_convert[] = $map[2];
        }else if($value >= 3 && $value < 4){
            $Z_Scores_to_convert[] = $map[3];
        }else if($value >= 4 && $value < 5){
            $Z_Scores_to_convert[] = $map[4];
        }else if($value >= 5){
            $Z_Scores_to_convert[] = $map[5];
        }else{
            $Z_Scores_to_convert[] = "พึงพอใจระดับปรับปรุง";
        }
    }
    return $Z_Scores_to_convert;
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

// echo "หัวข้อ<br>";
// print_r($sati_info);
// echo "<br>คำตอบแต่ละหัวข้อ<br>";
// print_r($main_sub_info);
// echo "<br>คำตอบที่ user ตอบ<br>";
// print_r($sub_info_ex);
// echo "<br>";
// echo "<-----score----->";
// echo "<br>";
// echo "หัวข้อ<br>";
// print_r($sati_topic);
// echo "<br>คำตอบแต่ละหัวข้อ<br>";
// print_r($main_sub_topic);
// echo "<br>คำตอบที่ user ตอบ<br>";
// print_r($scores_split);
// echo "<br>----------<br>";

// print_r($sub_info_ex);

$main_sub_topic_Array = json_encode($main_sub_topic);

$collect_sub = [];
$count_collect_sub = [];
$N = [];



for($b = 0;$b < count($scores_split); $b++){
    for($j = 0;$j < count($scores_split[$b]); $j++){
        $collect_sub[$j] = [];
        $count_collect_sub[$j] = [];
        for ($i = 0; $i < count($scores_split[$b][$j]); $i++) {
            $collect_sub[$j][] = 0;
            $count_collect_sub[$j][] = 0;
        }
    }
}

for($j = 0;$j < count($scores_split); $j++){
    $N[] = [];
    $N[$j][] = [];
    for ($i = 0; $i < count($scores_split[$j]); $i++) {
        $N[$j][$i][] = 0;
    }
}
// print_r($scores_split);
// print_r($main_sub_topic);
// print_r($collect_sub);

$ispersoncount = 0;
$countdontback = 0;
for($j = 0;$j < count($scores_split); $j++){
    for ($i = 0; $i < count($scores_split[$j]); $i++) {       
        $index_sum_sub =0; 
        foreach($scores_split[$j][$i] as $key => $value){
            if($index_sum_sub === count($scores_split[$j][$i])){
                $index_sum_sub=0;
            }
            $collect_sub[$i][$index_sum_sub] = $collect_sub[$i][$index_sum_sub] + $value;
            $count_collect_sub[$i][$index_sum_sub]++;
            $N[$j][$i][$index_sum_sub] = $value;
            $index_sum_sub++;
        }
    }
    $ispersoncount++;
}
// print_r($scores_split);

// print_r($count_collect_sub);
// print_r($collect_sub);
// print_r($n);
// print_r($N);
$sumjamphen1 = [];

foreach($N as $index0 => $value0){
    foreach($value0 as $index1 => $value1){
        foreach($value1 as $value2){
            $sumjamphen1[$index1][] = 0;
        }
    }
}
foreach($N as $index0 => $value0){
    foreach($value0 as $index1 => $value1){
        foreach($value1 as $index2 => $value2){
            $sumjamphen1[$index1][$index2] += $value2;
        }
    }
}
// print_r($sumjamphen1);
// foreach($sumn as $index0 => $value0){
//     foreach($value0 as $index1 => $value1){
//         $sumn2[$index1][] = $value1;
//     }
// }

$isoneperson = false;

if($ispersoncount == 1){
    $isoneperson = true;
}



$xBar = [];
$sumxBar = [];

$checktopic = 0;
foreach($collect_sub as $index => $value){
    $xBar[] = [];
    foreach($collect_sub[$index] as $index0 => $value0){
        if(!($value0 == 0)){
            $xBar[$index][] =  $value0/$count_collect_sub[$index][$index0];
        }
        else{
            $checktopic++;
        }
    }
}


foreach($xBar as $index => $value){
    $sum = 0;
    foreach($xBar[$index] as $index0 => $value0){
        $sum += $value0;
        if($index0 == array_key_last($xBar[$index])){
            $sum = $sum/($index0+1);
        }
    }
    $sumxBar[] = $sum;
}

// print_r($sumxBar);
// print_r($xBar);
// print_r($xBar_overlap_Array);
// print_r($xBar_overlap_count);

$sumN = [];

// print_r($collect_sub);
// print_r($xBar);
foreach($N as $index0 => $value0){
    $sumN[]=[];
    foreach($value0 as $index1 => $value1){
        foreach($value1 as $value2){
            $sumN[$index0][] = $value2;
        }
    }
}
// print_r($N);
$SD = [];
$sumSD = [];
$sum = [];
foreach($collect_sub as $index => $value){
    $sum[] = [];
    foreach($collect_sub[$index] as $value0){
        $sum[$index][] =  0;
    }
}
// print_r($sum);
foreach($sumN as $index => $value){
    $SD[] = [];
    foreach($N[$index] as $index0 => $value0){
        foreach($N[$index][$index0] as $index1 => $value1){
            $sum[$index0][$index1] +=  pow($value1-$xBar[$index0][$index1],2);
        }
    }
}

// print_r($N);
// print_r($sum);

foreach($sum as $index0 => $value0){
    foreach($count_collect_sub[$index0] as $index1 => $value1){
        if($isoneperson){
            $SD[$index0][] =  sqrt($sum[$index0][$index1]/$value1); 
        }
        else if($sum[$index0][$index1] === 0){
            $SD[$index0][] =  sqrt($sum[$index0][$index1]/$value1);      
        }else{
            $SD[$index0][] =  sqrt($sum[$index0][$index1]/($value1-1));
        }
    }
}
// print_r($SD);

foreach($SD as $index => $value){
    $sum = 0;
    foreach($SD[$index] as $index0 => $value0){
        $sum += $value0;
        if($index0 == array_key_last($SD[$index])){
            $sum = $sum/($index0+1);
        }
    }
    $sumSD[] = $sum;
}
// print_r($sumSD);
// print_r($SD);

$Z_Scores = [];
$sumZ_Scores = [];

foreach($sumjamphen1 as $index0 => $value0){
    $Z_Scores[] = [];
    foreach($value0 as $index1 => $value1){
        if(!($value1==0)){
            // echo round($xBar[$index0][$index1],2).",";
            // echo $xBar[$index0][$index1]-round($SD[$index0][$index1],1).",";
            if($isoneperson){
                $Z_Scores[$index0][] = $xBar[$index0][$index1];
            }else{
                $Z_Scores[$index0][] =  $xBar[$index0][$index1];
            }
        }
    }
}
// print_r($Z_Scores);


foreach($Z_Scores as $index => $value){
    $sum = 0;

    if($isoneperson){
        $sum += $sumxBar[$index];
    }else{
        // $sum += $sumxBar[$index]-$sumSD[$index]/2;
        $sum += $sumxBar[$index];
    }

    if($index0 == array_key_last($sumjamphen1[$index])){
        $sum = $sum/($index0+1);
    }
    $sumZ_Scores[] = $sum;
}

// print_r($sumZ_Scores);
// print_r($Z_Scores);
$Z_Scores_to_convert = convert_number_to_satisfaction($Z_Scores);
// print_r($Z_Scores_to_convert);
$Z_Scores_to_convert_sum = convert_number_to_satisfaction_sum($sumZ_Scores);
// print_r($Z_Scores_to_convert_sum);
// print_r($Z_Scores_to_convert);
$xBar_Array = json_encode($xBar);

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
        <aside class="my-5" style="display: flex; width: 170px; justify-content: space-between; flex-wrap: wrap;">
            <button type="button" onclick="isClass('<?php echo $class; ?>')" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
                กลับหน้าแรก
            </button>
            <button type="button" onclick="history.back()" style="display:flex; background-color:#111; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#333';" onmouseout="this.style.backgroundColor='#111';">
                กลับ
            </button>
        </aside>
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
                                // Count matches for each $sub_info_ex
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
            <?php for ($i = 0; $i < count($sati_topic)-$checktopic; $i++) { ?>
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
                        <?php foreach($main_sub_topic[$i] as $key => $value){ ?>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 text-center"><?= $value; ?></td>
                            <td class="border border-gray-300 text-center"><?php echo round($xBar[$i][$key],2); ?></td>
                            <td class="border border-gray-300 text-center"><?=  round($SD[$i][$key],2); ?></td>
                            <td class="border border-gray-300 text-center"><?= $Z_Scores_to_convert[$i][$key]; ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td class="border border-gray-300 text-center">รวม</td>
                            <td class="border border-gray-300 text-center"><?= round($sumxBar[$i],2); ?></td>
                            <td class="border border-gray-300 text-center"><?= round($sumSD[$i],2); ?></td>
                            <td class="border border-gray-300 text-center"><?= $Z_Scores_to_convert_sum[$i]; ?></td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
                <p>จากตารางด้านที่<?= $sati_topic[$i] ?>  ความพึงพอใจภาพรวมมีความพึงพอใจในระดับ <?= $Z_Scores_to_convert_sum[$i]; ?> (x̄ = <?= round($sumxBar[$i],2); ?> ) </p>
                เมื่อพิจารณารายข้อ พบว่า ด้านที่<?= $sati_topic[$i] ?> 
                    <?php foreach($main_sub_topic[$i] as $key => $value){ ?>
                        มีความพึงพอใจ <?= $value; ?> โดยมีความพึงพอใจในระดับ มากที่สุด (x̄ = <?php echo round($xBar[$i][$key],2); ?>)
                    <?php } ?>
                <div style="width:65vw; height:auto; position: relative; left: 50%; transform: translateX(-50%); ">
                    <canvas id="myChart"></canvas>
                </div>
      
            
            <?php } ?>

        </div>

    </div>
            <script>
                    function getRandomNumber(min, max) {
                        return Math.floor(Math.random() * (max - min + 1)) + min;
                    }

                    const ctx = document.querySelectorAll('#myChart');
                    var $main_sub_topic = <?php echo $main_sub_topic_Array; ?>;
                    var $xBar = <?php echo $xBar_Array; ?>;
                    const topic = [...$main_sub_topic];
                    const topic_data = $xBar;
                    let xBarindex = 0;
                    const colours = ['#7C00FE','#F9E400','#FFAF00','#F5004F','#522258','#8C3061','#C63C51','#D95F59','#C9DABF','#5F6F65','#180161','#021526',
                        '#FF8225','#6EACDA','#E3A5C7','#399918','#FFDE4D','#EB5B00','#36C2CE','#77E4C8'
                    ];
                    let barcolour = [];
                    topic.forEach((top,itop) => {
                        barcolour.push([]);
                        topic[itop].forEach((subtop,subitop) => {
                            let randomNumber = getRandomNumber(0, colours.length);
                            barcolour[itop].push(colours[randomNumber]);
                        });
                    });
                    ctx.forEach((element,i) => {
                        new Chart(element, {
                        type: 'bar',
                        data: {
                            labels: topic[i],
                            datasets: [{
                            label: '',
                            data: topic_data[i],
                            backgroundColor: barcolour[i],
                            borderColor: barcolour[i],
                            borderWidth: 1
                            }
                        ]},
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                        });
                });
                    
            </script>
            <script src="script/changeclass.js"></script>
</body>

</html>
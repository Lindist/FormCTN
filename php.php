<?php
require('config.php');

$input_id = 27;

$tb_input = $conn->prepare("SELECT * FROM tb_input WHERE Input_id = :input_id");
$tb_input->bindParam(":input_id", $input_id);
$tb_input->execute();
$row1 = $tb_input->fetch();

$input_feature = preg_split("/@/", $row1["Input_feature"]);
$input_setfeature = preg_split("/@/", $row1["Input_setfeature"]);
$input_result = preg_split("/@/", $row1["Input_result"]);
$input_compare = preg_split("/@/", $row1["Input_compare"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Conditional Table Rows</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="js/add_renove_edit.js"></script>
</head>

<body>

    <form action="test.php" method="POST">

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
            <tbody id="section1tbody">
                <?php
                for ($i = 0; $i < 4; $i++) {
                    $class = ($i == 0 || (!empty($input_feature[$i]) || !empty($input_setfeature[$i]))) ? '' : 'hidden';
                    echo "<tr id='section1tr$i' class='$class'>
                <td class='border border-gray-300 py-2'>" . ($i + 1) . "</td>
                <td class='border border-gray-300 py-2'><textarea name='input_feature[]' id='section1tr{$i}td' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'>" . htmlspecialchars($input_feature[$i] ?? '') . "</textarea></td>
                <td class='border border-gray-300 py-2'><textarea disabled name='input_setfeature[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
                <td class='border border-gray-300 py-2'><textarea disabled name='input_result[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
                <td class='border border-gray-300 py-2'><textarea disabled name='input_compare[]' class='w-full h-40 border border-gray-300 rounded px-2 py-1' rows='3'></textarea></td>
            </tr>";
                }
                ?>
            </tbody>
        </table>

        <button type="button" id="section1addbtn" onclick="section1add()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่ม</button>
        <button type="button" id="section1removebtn" onclick="section1remove()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">ลบ</button>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">กด</button>

    </form>

</body>

</html>
<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
} else if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
}

// echo $admin_id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.7/dist/full.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

<body class="bg-gray-100">

    <!-- Sidebar for Desktop & Navbar for Mobile -->
    <div class="flex min-h-screen">

        <!-- Sidebar (Visible on Desktop) -->
        <aside class="w-64 bg-gray-800 text-gray-100 hidden md:block fixed h-full">
            <div class="p-4 flex justify-center">
                <!-- Logo -->
                <img src="https://i.imgur.com/m0H7jcN.png" alt="Logo" class="w-24 h-24 rounded-full">
            </div>
            <div class="text-center mt-4">
                <h1 class="text-xl font-bold">COMPUTER TECHNIQUE</h1>
                <h2 class="text-sm">PRAE TECHNICAL COLLEGE</h2>
            </div>
            <nav class="mt-5">
                <ul>
                    <li>
                        <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700 text-white">
                            <i class="flex items-center fa-solid fa-house h-6 w-6 mr-2"></i>
                            หน้าแรก
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700 text-white">
                            <i class="flex items-center fa-solid fa-right-from-bracket h-6 w-6 mr-2"></i>
                            ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </nav>

        </aside>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64">
            <!-- Navbar for Mobile (Visible on Mobile) -->
            <nav class="bg-gray-800 text-gray-100 p-4 md:hidden">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Admin Panel</h1>
                    <button id="mobileMenuToggle" class="text-gray-200 focus:outline-none">☰</button>
                </div>
                <!-- Mobile Menu (Initially Hidden) -->
                <div id="mobileMenu" class="hidden mt-4">
                    <ul>
                        <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">หน้าแรก</a></li>
                        <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Content Section -->
            <main class="p-6">
                <!-- Statistics Section -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <!-- Card 1: จำนวนแบบประเมิน -->
                    <div class="bg-blue-400 p-6 rounded-lg shadow-md text-center">
                        <div class="text-white">
                            <i class="fa-solid fa-file text-5xl mx-auto"></i>
                            <h3 class="text-lg font-semibold mt-4">จำนวนโครงการ</h3>
                            <?php
                            $sqlp = "SELECT * FROM project";
                            $resultp = $conn->query($sqlp);

                            echo '<p class="text-4xl font-bold">' . $resultp->rowCount() . '</p>'
                            ?>
                        </div>
                    </div>

                    <!-- Card 2: จำนวนแบบประเมิน -->
                    <div class="bg-blue-400 p-6 rounded-lg shadow-md text-center">
                        <div class="text-white">
                            <i class="fa-solid fa-file text-5xl mx-auto"></i>
                            <h3 class="text-lg font-semibold mt-4">จำนวนแบบประเมินประสิทธิภาพ</h3>
                            <?php
                            $sqle = "SELECT * FROM tb_efficiercy_form";
                            $resulte = $conn->query($sqle);

                            echo '<p class="text-4xl font-bold">' . $resulte->rowCount() . '</p>'
                            ?>
                        </div>
                    </div>

                    <!-- Card 3: จำนวนสมาชิก -->
                    <div class="bg-blue-400 p-6 rounded-lg shadow-md text-center">
                        <div class="text-white">
                            <i class="fa-solid fa-file text-5xl mx-auto"></i>
                            <h3 class="text-lg font-semibold mt-4">จำนวนแบบประเมินความพึงพอใจ</h3>
                            <?php
                            $sqls = "SELECT * FROM tb_satisfied";
                            $results = $conn->query($sqls);

                            echo '<p class="text-4xl font-bold">' . $results->rowCount() . '</p>'
                            ?>
                        </div>
                    </div>

                    <!-- Card 4: จำนวนสมาชิก -->
                    <div class="bg-yellow-400 p-6 rounded-lg shadow-md text-center">
                        <div class="text-gray-800">
                            <i class="fa-solid fa-user text-5xl mx-auto"></i>
                            <h3 class="text-lg font-semibold mt-4">จำนวนสมาชิกในระบบทั้งหมด</h3>
                            <?php
                            $sqla = "SELECT * FROM tb_member";
                            $resulta = $conn->query($sqla);

                            echo '<p class="text-4xl font-bold">' . $resulta->rowCount() . '</p>'
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Report List Section -->
                <div>

                    <?php

                    $sql = "SELECT * FROM project";
                    $result = $conn->query($sql);

                    $count = 0;
                    if ($result->rowCount() > 0) {  // Use rowCount() instead of num_rows
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {  // Fetch results as an associative array
                            $count++; ?>

                            <div class="border-t border-gray-300 pt-4 pb-2">
                                <p class="text-gray-900"><strong>ชื่อหัวข้อโครงการ:</strong> <a href="#" class="text-blue-500"><?= $row['project_name'] ?></a></p>
                                <p class="text-gray-900">วันหมดอายุ : <?= $row['project_expired'] ?></p>

                                <?php

                                $pj_id = $row['project_id'];

                                $sqlef = "SELECT * FROM tb_efficiercy_form WHERE project_id = $pj_id";
                                $resultef = $conn->query($sqlef);
                                $rowef = $resultef->fetch(PDO::FETCH_ASSOC);

                                if ($resultef->rowCount() > 0) {
                                    $form_id = $rowef['form_id'];
                                    echo '<p class="text-gray-900">รายละเอียด แบบประเมินประสิทธิภาพ : <a href="showlistperformance.php?id=' . $form_id . '" class="text-blue-500">' . $row['project_name'] . '</a></p>';
                                } else {
                                    echo '<p class="text-gray-900">ยังไม่ได้สร้าง แบบประเมินประสิทธิภาพ</p>';
                                }

                                $sqlsa = "SELECT * FROM tb_satisfied WHERE project_id = $pj_id";
                                $resultsa = $conn->query($sqlsa);
                                $rowsa = $resultsa->fetch(PDO::FETCH_ASSOC);

                                if ($resultsa->rowCount() > 0) {
                                    $sati_id = $rowsa['sati_id'];
                                    echo '<p class="text-gray-900">รายละเอียด แบบประเมินความพึงพอใจ : <a href="showlistsatis.php?id=' . $sati_id . '" class="text-blue-500">' . $row['project_name'] . '</a></p>';
                                } else {
                                    echo '<p class="text-gray-900">ยังไม่ได้สร้าง แบบประเมินความพึงพอใจ</p>';
                                }

                                ?>
                            </div>

                    <?php }
                    }

                    ?>
                    <hr class="border-gray-300">
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript for mobile menu toggle -->
    <script>
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
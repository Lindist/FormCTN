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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.7/dist/full.css" rel="stylesheet">
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
                <img src="path_to_logo" alt="Logo" class="w-24 h-24 rounded-full">
            </div>
            <div class="text-center mt-4">
                <h1 class="text-xl font-bold">COMPUTER TECHNIQUE</h1>
                <h2 class="text-sm">PRAE TECHNICAL COLLEGE</h2>
            </div>
            <nav class="mt-5">
                <ul>
                    <li><a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 4h16v16H4z" />
                            </svg>หน้าแรก</a></li>
                    <li><a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M16 12l-4-4-4 4" />
                            </svg>ออกจากระบบ</a></li>
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Card 1: จำนวนแบบประเมิน -->
                    <div class="bg-blue-400 p-6 rounded-lg shadow-md text-center">
                        <div class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" stroke="currentColor">
                                <path d="M8 14l-4 4h16l-4-4m-6-4l-4 4h16l-4-4m-6-4l-4 4h16l-4-4" />
                            </svg>
                            <h3 class="text-lg font-semibold mt-4">จำนวนแบบประเมินประสิทธิภาพ</h3>
                            <p class="text-4xl font-bold">4 เรื่อง</p>
                        </div>
                    </div>

                    <!-- Card 2: จำนวนสมาชิก -->
                    <div class="bg-blue-400 p-6 rounded-lg shadow-md text-center">
                        <div class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" stroke="currentColor">
                                <path d="M8 14l-4 4h16l-4-4m-6-4l-4 4h16l-4-4m-6-4l-4 4h16l-4-4" />
                            </svg>
                            <h3 class="text-lg font-semibold mt-4">จำนวนแบบประเมินความพึงพอใจ</h3>
                            <p class="text-4xl font-bold">4 เรื่อง</p>
                        </div>
                    </div>

                    <!-- Card 3: จำนวนสมาชิก -->
                    <div class="bg-yellow-400 p-6 rounded-lg shadow-md text-center">
                        <div class="text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" stroke="currentColor">
                                <path d="M5 12h14m-7-7l-7 7 7 7" />
                            </svg>
                            <h3 class="text-lg font-semibold mt-4">จำนวนสมาชิกในระบบทั้งหมด</h3>
                            <p class="text-4xl font-bold">1692</p>
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
                            $count++;?>

                            <div class="border-t border-gray-300 pt-4 pb-2">
                                <p class="text-gray-900"><strong>ชื่อหัวข้อโครงการ:</strong> <a href="#" class="text-blue-500"><?= $row['project_name'] ?></a></p>
                                <p class="text-gray-900">วันหมดอายุ : <?= $row['project_expired'] ?></p>
                                <p class="text-gray-900">รายละเอียด แบบประเมินประสิทธิภาพ : <a href="#" class="text-blue-500"><?= $row['project_name'] ?></a></p>
                                <p class="text-gray-900">รายละเอียด แบบประเมินความพึงพอใจ : <a href="#" class="text-blue-500"><?= $row['project_name'] ?></a></p>
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
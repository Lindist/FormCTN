<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: form.php");
    exit();
}

$registerClass = isset($_SESSION['show_register']) && $_SESSION['show_register'] ? '' : 'hidden';
unset($_SESSION['show_register']); // Clear the session flag after use

$loginClass = isset($_SESSION['show_login']) && $_SESSION['show_login'] ? '' : 'hidden';
unset($_SESSION['show_login']); // Clear the session flag after use

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTN Phrae</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .popup,
        .register {
            display: none;
        }
    </style>
</head>

<body class="bg-blue-600">
    
    <div>
        <nav class="bg-white border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <!-- Logo and brand -->
                <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://i.imgur.com/m0H7jcN.png" class="h-8" alt="CTN Logo" />
                    <span class="text-2xl font-semibold">CTN Phrae</span>
                </a>
                <!-- Mobile menu button -->
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-8 h-8 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
                <!-- Desktop menu -->
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="text-xl font-semibold flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-white md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                        <li>
                            <button class="block w-full py-2 px-3 text-gray-900 rounded hover:bg-sky-100 md:hover:bg-transparent md:border-0 md:hover:text-sky-500 md:p-0" onclick="openRegister()">
                                สมัครสมาชิก
                            </button>
                        </li>
                        <li>
                            <button class="block w-full py-2 px-3 text-gray-900 rounded hover:bg-sky-100 md:hover:bg-transparent md:border-0 md:hover:text-sky-500 md:p-0" onclick="openPopup()">
                                เข้าสู่ระบบ
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Login Popup -->
    <div id="loginPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 <?= $loginClass; ?>">
        <div class="bg-white p-8 rounded-lg shadow-lg relative w-full max-w-sm mx-4 sm:mx-auto overflow-y-auto">
            <button class="text-3xl absolute top-2 right-2 text-gray-600 hover:text-gray-900" onclick="closePopup()">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-2xl font-bold mb-4 text-center">เข้าสู่ระบบ</h2>
            <!-- Add your login form here -->
            <form action="session/login_db.php" method="POST">

                <?php if (isset($_SESSION['login_error'])) { ?>
                    <script>
                        Swal.fire({
                            title: "คำเตือน",
                            text: "<?= $_SESSION['login_error'] ?>",
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: 'ตกลง'
                        });
                    </script>
                    <?php unset($_SESSION['login_error']); ?>
                <?php } ?>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="std_id">
                        รหัสนักศึกษา หรือ เบอร์โทรศัพท์
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="std_id" type="text" placeholder="รหัสนักศึกษา หรือ เบอร์โทรศัพท์">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        รหัสผ่าน
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password" type="password" placeholder="******************">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="login" type="submit">
                        เข้าสู่ระบบ
                    </button>
                </div>
                <div class="flex mt-4 text-sm">
                    <p>ยังไม่เป็นสมาชิกใช่ไหม</p><a href="#" class="mx-1 hover:underline underline-offset-1" onclick="openRegister()">คลิกที่นี่</a>
                    <p>เพื่อสมัครสมาชิก</p>
                </div>
            </form>
        </div>
    </div>

    <!-- Register Popup -->
    <div id="registerPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 <?= $registerClass; ?>">
        <div class="bg-white p-8 rounded-lg shadow-lg relative w-full max-w-sm mx-4 sm:mx-auto overflow-y-auto">
            <button class="text-3xl absolute top-2 right-2 text-gray-600 hover:text-gray-900" onclick="closePopup()">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-2xl font-bold mb-4 text-center">สมัครสมาชิก</h2>
            <!-- Add your register form here -->
            <form action="session/register_db.php" method="POST">

                <?php if (isset($_SESSION['register_success'])) { ?>
                    <script>
                        Swal.fire({
                            title: "สมัครสมาชิกสำเร็จ",
                            text: "<?= $_SESSION['register_success'] ?>",
                            icon: "success",
                            confirmButtonColor: "#16a34a",
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                openPopup();
                            }
                        });
                    </script>
                    <?php unset($_SESSION['register_success']); ?>
                <?php } ?>

                <?php if (isset($_SESSION['register_error'])) { ?>
                    <script>
                        Swal.fire({
                            title: "คำเตือน",
                            text: "<?= $_SESSION['register_error'] ?>",
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: 'ตกลง'
                        });
                    </script>
                    <?php unset($_SESSION['register_error']); ?>
                <?php } ?>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        คำนำหน้า
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="title">
                        <option name="title" value="นาย">นาย</option>
                        <option name="title" value="นางสาว">นางสาว</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fname">
                        ชื่อ
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="fname" type="text" placeholder="ชื่อ">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lname">
                        นามสกุล
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="lname" type="text" placeholder="นามสกุล">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="std_id">
                        รหัสนักศึกษา หรือ เบอร์โทรศัพท์
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="std_id" type="number" placeholder="รหัสนักศึกษา หรือ เบอร์โทรศัพท์">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="register" type="submit">
                        สมัครสมาชิก
                    </button>
                </div>
                <div class="flex mt-4 text-sm">
                    <p>เป็นสมาชิกแล้วใช่ไหม</p><a href="#" class="mx-1 hover:underline underline-offset-1" onclick="openPopup()">คลิกที่นี่</a>
                    <p>เพื่อเข้าสู่ระบบ</p>
                </div>
            </form>
        </div>
    </div>

    <div class="pt-16 flex-grow flex items-center justify-center mx-6 md:mx-16">
        <div class="block lg:flex items-center max-w-screen-xl">
            <div class="w-auto lg:w-1/2 xl:w-[600px] mx-auto lg:text-left lg:mr-8">
                <p class="text-white text-5xl sm:text-6xl">ระบบแบบสอบถามออนไลน์</p>
                <p class="text-white text-2xl mt-2 mb-6 sm:mb-10">ระบบแบบสอบถามนี้เป็นส่วนช่วยในการกรอกแบบสอบถามของ วิชาโครงการ บทที่ 3 ช่วยให้ผู้ใช้งานสามารถสร้างแบบสอบถามเพื่อนำไปใช้ในรายวิชาพร้อมผลสรุป</p>
                <a class="text-white text-2xl p-2 px-4 border border-white rounded-full mb-1 inline-block" href="http://www.project.ctnphrae.com/">วิชาโครงการ</a>
            </div>
            <div class="flex w-auto lg:w-1/2 justify-center">
                <img class="w-[300px] lg:w-[500px] mx-auto lg:mx-0 my-4 sm:my-0" src="https://i.imgur.com/P8jl1rq.png" alt="Survey Image">
            </div>
        </div>
    </div>

    <footer class="bg-blue-950 text-white text-center py-6 w-full mt-auto">
        <p class="text-xs sm:text-sm">© 2024 CTN Phrae. All rights reserved. | <a class="no-underline hover:underline" href="https://www.ctnphrae.com/">Privacy Policy</a></p>
    </footer>

    <script>
        const loginPopup = document.getElementById('loginPopup');
        const registerPopup = document.getElementById('registerPopup');
        const toggleButton = document.querySelector('[data-collapse-toggle="navbar-default"]');
        const navbarMenu = document.getElementById('navbar-default');

        function openPopup() {
            loginPopup.classList.remove("hidden");
            registerPopup.classList.add("hidden");
            navbarMenu.classList.add('hidden');
        }

        function closePopup() {
            loginPopup.classList.add("hidden");
            registerPopup.classList.add("hidden");
            navbarMenu.classList.add('hidden');
        }

        function openRegister() {
            registerPopup.classList.remove("hidden");
            loginPopup.classList.add("hidden");
            navbarMenu.classList.add('hidden');
        }

        toggleButton.addEventListener('click', function() {
            navbarMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', function(event) {
            if (!navbarMenu.contains(event.target) && !toggleButton.contains(event.target)) {
                navbarMenu.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
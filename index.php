<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: form.php");
}

$registerClass = isset($_SESSION['show_register']) && $_SESSION['show_register'] ? '' : 'hidden';
unset($_SESSION['show_register']); // Clear the session flag after use

$loginClass = isset($_SESSION['show_login']) && $_SESSION['show_login'] ? '' : 'hidden';
unset($_SESSION['show_login']); // Clear the session flag after use

$fname = isset($_SESSION['fname']) && $_SESSION['fname'] ? $_SESSION['fname'] : '';
unset($_SESSION['fname']); // Clear the session flag after use

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <script src="scripts.js"></script> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <title>CTN Phrae</title>
</head>

<body class="bg-blue-600">

    <div class="bg-blue-50 overflow-hidden">
        <nav class="flex justify-between mx-4 my-4 items-center">
            <div class="flex items-center text-3xl font-bold">
                <img src="https://i.imgur.com/m0H7jcN.png" class="w-6 h-6 mr-1">
                CTN Phrae
            </div>
            <ul class="">
                <li class="flex space-x-3">
                    <a href="#" class="flex items-center " onclick="openRegister()">
                        สมัครสมาชิก
                    </a>
                    <a href="#" class="flex items-center " onclick="openPopup()">
                        เข้าสู่ระบบ
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="popup fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 <?= $loginClass; ?> z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg relative w-full max-w-sm">
            <button class="text-3xl absolute top-2 right-2 text-gray-600 hover:text-gray-900" onclick="closePopup()">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-2xl font-bold mb-4 text-center">เข้าสู่ระบบ</h2>
            <!-- Add your login form here -->
            <form action="session/login_db.php" method="POST">

                <?php if (isset($_SESSION['login_error'])) { ?>
                    <div class="text-center p-3 my-4 bg-red-100 text-red-500 border border-red-300 rounded" role="alert">
                        <?php
                        echo $_SESSION['login_error'];
                        unset($_SESSION['login_error']);
                        ?>
                    </div>
                <?php } ?>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="std_id">
                        รหัสนักศึกษา
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="std_id" type="number" placeholder="รหัสนักศึกษา">
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
                <div class="flex mt-4">
                    <p>ยังไม่เป็นสมาชิกใช่ไหม</p><a href="#" class="mx-1 hover:underline underline-offset-1" onclick="openRegister()">คลิกที่นี่</a>
                    <p>เพื่อสมัครสมาชิก</p>
                </div>
            </form>
        </div>
    </div>

    <div class="register fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 <?= $registerClass; ?> z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg relative w-full max-w-sm">
            <button class="text-3xl absolute top-2 right-2 text-gray-600 hover:text-gray-900" onclick="closePopup()">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-2xl font-bold mb-4 text-center">สมัครสมาชิก</h2>
            <!-- Add your register form here -->
            <form action="register_db.php" method="POST">

                <?php if (isset($_SESSION['register_success'])) { ?>
                    <div class="flex justify-center text-center p-3 my-4 bg-green-100 text-green-500 border border-green-300 rounded" role="alert">
                        <?php
                        echo $_SESSION['register_success'];
                        unset($_SESSION['register_success']);
                        ?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION['register_error'])) { ?>
                    <div class="text-center p-3 my-4 bg-red-100 text-red-500 border border-red-300 rounded" role="alert">
                        <?php
                        echo $_SESSION['register_error'];
                        unset($_SESSION['register_error']);
                        ?>
                    </div>
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
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= $fname ?>" name="fname" type="text" placeholder="ชื่อ">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lname">
                        นามสกุล
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="lname" type="text" placeholder="นามสกุล">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="std_id">
                        รหัสนักศึกษา
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="std_id" type="number" placeholder="รหัสนักศึกษา">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="register" type="submit">
                        สมัครสมาชิก
                    </button>
                </div>
                <div class="flex mt-4">
                    <p>เป็นสมาชิกแล้วใช่ไหม</p><a href="#" class="mx-1 hover:underline underline-offset-1" onclick="openPopup()">คลิกที่นี่</a>
                    <p>เพื่อเข้าสู่ระบบ</p>
                </div>
            </form>
        </div>
    </div>

    <div class="block lg:grid items-center mx-6 md:mx-16 my-6 md:my-6 grid-cols-2 gap-8">
        <div class="w-auto lg:inline xl:w-[600px] mx-auto">
            <p class="text-white text-6xl">ระบบแบบสอบถามออนไลน์</p>
            <p class="text-white text-2xl mt-2 mb-10">ระบบแบบสอบถามนี้เป็นส่วนช่วยในการกรอกแบบสอบถามของ วิชาโครงการ บทที่ 3 ช่วยให้ผู้ใช้งานสามาถสร้างแบบสอบถามเพื่อนำไปใช้ในรายวิชาพร้อมผลสรุป</p>
            <a class="text-white text-2xl p-2 px-4 border border-white rounded-full mb-1" href="#">วิชาโครงการ</a>
        </div>
        <div>
            <img class="hidden lg:mt-0 lg:col-span-5 lg:flex w-[500px]" src="https://i.imgur.com/CdoHEKs.png">
        </div>
    </div>

    <footer class="fixed left-0 bottom-0 w-full bg-blue-950 text-white text-center py-6">
        <p>*footer info*</p>
    </footer>

    <script>
        const popup = document.querySelector('.popup');
        const register = document.querySelector('.register');

        function openPopup() {
            popup.classList.remove("hidden");
            register.classList.add("hidden");
        }

        function closePopup() {
            popup.classList.add("hidden");
            register.classList.add("hidden");
        }

        function openRegister() {
            register.classList.remove("hidden");
            popup.classList.add("hidden");
        }

        // window.onclick = function(event) {
        //     if (event.target === popup || event.target === register) {
        //         popup.classList.add("hidden");
        //         register.classList.add("hidden");
        //     }
        // }
    </script>

</body>

</html>
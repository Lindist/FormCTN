<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: form.php");
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
    <title>CTN Phrae</title>
</head>

<body class="bg-blue-600">

    <div class="bg-blue-50">
        <nav class="flex justify-between mx-4 my-4 items-center">
            <div class="flex items-center text-3xl font-bold">
                <img src="https://i.imgur.com/m0H7jcN.png" class="w-6 h-6 mr-1">
                CTN Phrae
            </div>
            <ul class="flex space-x-3 sm:space-x-5">
                <li>
                    <a href="#" class="flex items-center font-bold" onclick="openRegister()">
                        สมัครสมาชิก <i class="fa-solid fa-right-to-bracket ml-1 hidden sm:inline"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center font-bold" onclick="openPopup()">
                        เข้าสู่ระบบ <i class="fa-solid fa-right-to-bracket ml-1 hidden sm:inline"></i>
                    </a>
                </li>
            </ul>
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
                        รหัสนักศึกษา
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="std_id" type="number" placeholder="รหัสนักศึกษา">
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

    <div class="flex-grow flex items-center justify-center mx-6 md:mx-16">
        <div class="block lg:flex items-center max-w-screen-xl">
            <div class="w-auto lg:w-1/2 xl:w-[600px] mx-auto lg:text-left lg:mr-8">
                <p class="text-white text-5xl sm:text-6xl">ระบบแบบสอบถามออนไลน์</p>
                <p class="text-white text-2xl mt-2 mb-6 sm:mb-10">ระบบแบบสอบถามนี้เป็นส่วนช่วยในการกรอกแบบสอบถามของ วิชาโครงการ บทที่ 3 ช่วยให้ผู้ใช้งานสามารถสร้างแบบสอบถามเพื่อนำไปใช้ในรายวิชาพร้อมผลสรุป</p>
                <a class="text-white text-2xl p-2 px-4 border border-white rounded-full mb-1 inline-block" href="#">วิชาโครงการ</a>
            </div>
            <div class="flex w-auto lg:w-1/2 justify-center">
                <img class="w-[300px] lg:w-[500px] mx-auto lg:mx-0 my-4 sm:my-0" src="https://i.imgur.com/P8jl1rq.png" alt="Survey Image">
            </div>
        </div>
    </div>

    <footer class="bg-blue-950 text-white text-center py-6 w-full mt-auto">
        <p>*footer info*</p>
    </footer>

    <script>
        const loginPopup = document.getElementById('loginPopup');
        const registerPopup = document.getElementById('registerPopup');

        function openPopup() {
            loginPopup.classList.remove("hidden");
            registerPopup.classList.add("hidden");
        }

        function closePopup() {
            loginPopup.classList.add("hidden");
            registerPopup.classList.add("hidden");
        }

        function openRegister() {
            registerPopup.classList.remove("hidden");
            loginPopup.classList.add("hidden");
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
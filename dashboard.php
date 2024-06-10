<?php

    session_start();
    require 'config.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
    }

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

    </style>
    <title>CTN Phrae</title>
</head>
<body>
    <div class="px-4 py-5 my-5 text-center">
        <?php
        
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            }

            try {

                $stmt = $conn -> prepare("SELECT * FROM tb_member WHERE member_id = ?");
                $stmt -> execute([$user_id]);
                $userData = $stmt -> fetch();

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
        ?>
    </div>
    
    <div class="text-center text-3xl">
        <h1><?php echo $userData['member_title'] . " " . $userData['member_firstname'] . " " . $userData['member_lastname'] ?></h1>
        <h1 class="mb-8"><?php echo $userData['member_code'] ?></h1>
        <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="logout.php">Log out</a>
    </div>
</body>
</html>
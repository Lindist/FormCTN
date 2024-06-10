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
    <link rel="stylesheet" href="style/formstyle.css">
    <title>From</title>
</head>
<body>
    <header>
    <h1>CTN Phrae</h1>
    <div>
        <a href="logout.php" class="logout">ออกจากระบบ <img src="picture/logout.png"></a>
    </div>
    </header>
    <div class="container"> 
    <a href="#" class="adds">เพิ่มแบบสอบถาม</a>  
    <div class="form-box" id= "adddata"> 
        <img class='disimg' src="picture/empty-folder.png">
        <h3 class='disimg'>ไม่มีข้อมูลแบบสอบถาม</h3>
    </div>
    </div>
    <style>
    .container120{
        place-self: center;
    }
    .subform{
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        flex: 1;
        width: 20rem;
        height: 15rem;
        background-color: #DCD;
        border-radius: 10px;
        padding: 1rem;
        border-bottom-width: 3px;
        border-bottom-style: solid;
        border-bottom-color: rgba(88, 88, 88, 0.685);
    }
    
    .subform > h2{
        margin-bottom: 1rem;
    }
    .subform > h2{
        align-self: center;
    }
    .subform > a{
        margin-top: 2rem;
        align-self: center;
        text-align: center;
        text-decoration: none;
        width: 100px;
        color: #fff;
        padding: 0.5rem;
        background-color: #00f;
        border-radius: 5px;
    }
        </style>
    <script src="script/script_add_data.js"></script>
</body>
</html>

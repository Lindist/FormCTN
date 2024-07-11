<?php
    session_start();
    require 'session/config.php';
    
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
    } else if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $result = $conn->query("SELECT * FROM tb_member WHERE member_id = '$user_id'");
    $count = count($result->fetchAll());
    $result->execute();


    $tb_fill_efficiercy = $conn->query("SELECT * FROM tb_fill_efficiercy WHERE form_id = '$id'");
    $tb_fill_efficiercy->execute();

    $nofiller = array();
    $filler = array();
        while($row_tb_fill_efficiercy = $tb_fill_efficiercy->fetch(PDO::FETCH_ASSOC)){
            $nofiller[] = $row_tb_fill_efficiercy["member_id"];
        }
        for($i = 0; $i < count($nofiller);$i++){
            $member_id = $conn->query("SELECT * FROM tb_member WHERE member_id = '$nofiller[$i]'");
            $member_id->execute();
            $row = $member_id->fetch(PDO::FETCH_ASSOC);
            $filler[] = $row;
        }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
            background-color: rgb(180, 180, 180);
            color: #000;
        }
        body > div {
            height: 95vh;
        }
        body > div #form{
            width: 100%;
            padding: 1rem;
            height: 100%;
            overflow-y: scroll;
        }

        main{
            display: grid;
            grid-template-columns: 1fr;
            grid-row-gap: 10px;
            padding: 0 2rem;
            width: 100%;
        }
        main > div{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 1rem;
            width: 100%;
            background-color: rgb(200, 200, 200);
            border-radius: 10px;
            overflow-wrap: break-word;
            font-size: 18px;
            border-bottom-width: 3px;
            border-bottom-style: solid;
            border-bottom-color: rgba(88, 88, 88, 0.685);
        }
        @media all and (max-width:800px) {
            body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
            background-color: rgb(180, 180, 180);
            color: #000;
            }
            body > div {
                height: 95vh;
            }
            body > div #form{
                width: 100%;
                padding: 1rem;
                height: 100%;
                overflow-y: scroll;
            }

            main{
                display: grid;
                grid-template-columns: 1fr;
                grid-row-gap: 10px;
                padding: 0 2rem;
                width: 100%;
            }
            main > div{
                place-self: center;
                display: flex;
                text-align: center;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
                padding: 2rem 1rem;
                width: 250px;
                background-color: rgb(200, 200, 200);
                border-radius: 10px;
                overflow-wrap: break-word;
                font-size: 18px;
                border-bottom-width: 3px;
                border-bottom-style: solid;
                border-bottom-color: rgba(88, 88, 88, 0.685);
            }
        }
    </style>
</head>
<body>
    <div class="main container-fluid col-11 bg-white py-1 my-3 rounded">
        <form action="" id="form">
            <button type="button" onclick="backtoindex()" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
                กลับหน้าแรก
            </button>
            <h1 class="header text-center my-5 text-break">รายชื่อผู้กรอกและผู้สร้างฟอร์ม</h1>
            <main>
                    
            </main>
        </form>
    </div>
    <script type="text/javascript">
        const showform = document.querySelector('main');
            showform.insertAdjacentHTML("beforeend", `
            <?php for ($c = 1; $c <= $count; $c++) { ?>
                <?php $row = $result->fetch(PDO::FETCH_ASSOC); ?>
                    <div>
                    <div>ลำดับที่ <?php echo $c; ?></div>
                    <div class='text'><?php echo $row['member_title']." ".$row['member_firstname']." ".$row['member_lastname']." ".$row['member_code']." "."(ผู้สร้าง)"; ?></div>
                    <div class="btns">
                    <a id='btn' href="showfilled.php?id=<?php echo $row['member_id']; ?>&isper=1" >ดูข้อมูล</a>
                    </div>
                    </div>
                <?php } ?>
                <?php for ($i = 0; $i < count($nofiller); $i++) { ?>
                        <div>
                        <div>ลำดับที่ <?php echo $i+2; ?></div>
                        <div class='text'><?php echo $filler[$i]['member_title']." ".$filler[$i]['member_firstname']." ".$filler[$i]['member_lastname']." ".$filler[$i]['member_code']; ?></div>
                        <div class="btns">
                        <a id='btn' href="showfilled.php?id=<?php echo $filler[$i]['member_id']; ?>&isper=1" >ดูข้อมูล</a>
                        </div>
                        </div>
                <?php } ?>
                `);
        backtoindex = () =>{
            window.location.href = 'form.php';
        };
    </script>
    <style>
        .btns > a{
            margin: 0;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            width: 100px;
            padding: 0.5rem;
            background-color: #00f;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
            cursor: pointer;
            color: #fff;
            transition: all .2s ease-in-out;

        }
        .btns > a:hover{
            background-color: rgb(3, 3, 159);
        }
    </style>
</body>
</html>
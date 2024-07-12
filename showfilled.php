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
    if(isset($_GET['isper'])){ 
        $isper = 'show active';
    }else{
        $isper = '';
    }
    if(isset($_GET['issta'])){
        $issta = 'show active';
    }else{
        $issta = '';
    }

    $member = $conn->query("SELECT * FROM tb_member WHERE member_id = '$id'");
    $member->execute();
    $row_member = $member->fetch(PDO::FETCH_ASSOC);

    $tb_efficiercy_form = $conn->query("SELECT * FROM tb_efficiercy_form WHERE member_id = '$id'");
    $count = count($tb_efficiercy_form->fetchAll());
    $tb_efficiercy_form->execute();

    $tb_satisfied = $conn->query("SELECT * FROM tb_satisfied WHERE member_id = '$id'");
    $count1 = count($tb_satisfied->fetchAll());
    $tb_satisfied->execute();


    $tb_fill_efficiercy = $conn->query("SELECT * FROM tb_fill_efficiercy WHERE member_id = '$id'");
    $count0 = count($tb_fill_efficiercy->fetchAll());
    $tb_fill_efficiercy->execute();

    $tb_fill_satisfied = $conn->query("SELECT * FROM tb_fill_satisfied WHERE member_id = '$id'");
    $count2 = count($tb_fill_satisfied->fetchAll());
    $tb_fill_satisfied->execute();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

        main .tabbtn {
            display: grid;
            grid-template-columns: 1fr;
            grid-row-gap: 10px;
            padding: 0 2rem;
            width: 100%;
        }
        main .tabbtn .disimg{
            place-self: center;
        }
        main .tabbtn > div{
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
        #hidden1 .text,
        #hidden2 .text{
            width: 50%;
            text-align: left;
            overflow-wrap: break-word;
        }
        .nameuser{
            display: flex;
            justify-content: flex-end;
        }
        .nameuser > i{
            font-size: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
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

        main .tabbtn {
            display: grid;
            grid-template-columns: 1fr;
            grid-row-gap: 10px;
            padding: 0 2rem;
            width: 100%;
        }
        main .tabbtn .disimg{
            place-self: center;
        }
        main .tabbtn > div{
            display: flex;
            flex-direction: column;
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
        #hidden1 .text,
        #hidden2 .text{
            width: 100%;
            text-align: center;
            overflow-wrap: break-word;
        }
        .nameuser{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .btn-group{
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }
        .nav-item{
            position: relative;
            left: 25%;
            transform: translateX(-25%);
        }
        .nameuser > i{
            font-size: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        }
        @media all and (max-width:500px) {
            .nav-item{
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            }
        }
    </style>
</head>
<body>
    <div class="main container-fluid col-11 bg-white py-1 my-3 rounded">
        <form action="" id="form">
            <aside style="display: flex; width: 170px; justify-content: space-between; flex-wrap: wrap;">
                <button type="button" onclick="backtoindex()" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
                    กลับหน้าแรก
                </button>
                <button type="button" onclick="history.back()" style="display:flex; background-color:#111; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#333';" onmouseout="this.style.backgroundColor='#111';">
                    กลับ
                </button>
            </aside>

            <h1 class="header text-center my-2 text-break">แสดงฟอร์มที่สร้างและเคยกรอก</h1>
            <div class="nameuser">
                <i class='bx bxs-user-circle'></i>
                <?= "ชื่อ ".$row_member['member_title']." ".$row_member['member_firstname']." นามสกุล ".$row_member['member_lastname']." รหัส ".$row_member['member_code']; ?>
            </div>
            <ul class="nav nav-tabs my-3" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $isper; ?> text-secondary-emphasis" id="tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">แบบฟอร์มประเมินประสิทธิภาพ</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $issta; ?> text-secondary-emphasis" id="tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">แบบฟอร์มประเมินความพึงพอใจ</button>
                </li>
            </ul>
                <!-- dropdown -->
                <div class="btn-group my-3">
                <button type="button" class="btn btn-secondary dropdown-toggle text-break" style="width: 190px;" data-bs-toggle="dropdown" aria-expanded="false">
                ฟอร์มทั้งหมดที่เกี่ยวข้อง
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item">ฟอร์มที่สร้าง</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item">ฟอร์มที่กรอก</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item">ฟอร์มทั้งหมดที่เกี่ยวข้อง</a></li>
                </ul>
                </div>

            <main>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?= $isper; ?>" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="tabbtn">

                        </div>
                    </div>
                    <div class="tab-pane fade <?= $issta; ?>" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="tabbtn">

                        </div>
                    </div>
                </div>
            </main>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
            const showform = document.querySelectorAll('.tabbtn');
            showform[0].insertAdjacentHTML("beforeend", `
            <?php if($count > 0){ ?>
            <?php for ($i = 0; $i < $count; $i++) { ?>
                <?php if($i==0){ ?>
                    <span class="fs-4 fw-semibold mt-3" id='hidden1'>
                        ฟอร์มที่สร้าง
                        <hr>
                    </span>
                <?php } ?>
                        <div id='hidden1'>
                        <?php $row_tb_efficiercy_form = $tb_efficiercy_form->fetch(PDO::FETCH_ASSOC); ?>
                        <div style="font-weight: bold;">ลำดับที่ <?php echo $i+1; ?></div>
                        <div class='text'><?php echo "(แบบฟอร์มที่สร้างไว้)"." ".$row_tb_efficiercy_form['form_name']; ?></div>
                        </div>
            <?php } ?>
            <?php } ?>
            <?php if($count0 > 0){ ?>
            <?php for ($i = 0; $i < $count0; $i++) { ?>
                <?php if($i==0){ ?>
                    <span class="fs-4 fw-semibold mt-3" id='hidden2'>
                        ฟอร์มที่กรอก
                        <hr>
                    </span>
                <?php } ?>
                        <div id='hidden2'>
                        <?php $row_tb_fill_efficiercy = $tb_fill_efficiercy->fetch(PDO::FETCH_ASSOC); ?>
                        <div style="font-weight: bold;">ลำดับที่ <?php echo $i+1; ?></div>
                        <div class='text'><?php echo $row_tb_fill_efficiercy['form_name']; ?></div>
                        </div>
            <?php } ?>
            <?php } ?>
            <?php if($count >= 0 && $count0 <= 0){ ?>
                <img class='disimg' style="width:250px;" src="picture/empty-folder.png">
                <h3 class='disimg fs-4 fw-semibold' style="width:250px;">ไม่มีข้อมูลแบบสอบถาม</h3>
            <?php } ?>
            `);
            showform[1].insertAdjacentHTML("beforeend", `
            <?php if($count1 > 0){ ?>
            <?php for ($i = 0; $i < $count1; $i++) { ?>
                <?php if($i==0){ ?>
                    <span class="fs-4 fw-semibold mt-3" id='hidden1'>
                        ฟอร์มที่สร้าง
                        <hr>
                    </span>
                <?php } ?>
                        <div id='hidden1'>
                        <?php $row_tb_satisfied = $tb_satisfied->fetch(PDO::FETCH_ASSOC); ?>
                        <div style="font-weight: bold;">ลำดับที่ <?php echo $i+1; ?></div>
                        <div class='text'><?php echo "(แบบฟอร์มที่สร้างไว้)"." ".$row_tb_satisfied['sati_ep2']; ?></div>
                        </div>
            <?php } ?>
            <?php } ?>
            <?php if($count2 > 0){ ?>
            <?php for ($i = 0; $i < $count2; $i++) { ?>
                <?php if($i==0){ ?>
                    <span class="fs-4 fw-semibold mt-3" id='hidden2'>
                        ฟอร์มที่กรอก
                        <hr>
                    </span>
                <?php } ?>
                        <div id='hidden2'>
                        <?php $row_tb_fill_satisfied = $tb_fill_satisfied->fetch(PDO::FETCH_ASSOC); ?>
                        <div style="font-weight: bold;">ลำดับที่ <?php echo $i+1; ?></div>
                        <div class='text'><?php echo $row_tb_fill_satisfied['sati_ep2']; ?></div>
                        </div>
            <?php } ?>
            <?php } ?>
            <?php if($count1 >= 0 && $count2 <= 0){ ?>
                <img class='disimg' style="width:250px;" src="picture/empty-folder.png">
                <h3 class='disimg fs-4 fw-semibold' style="width:250px;">ไม่มีข้อมูลแบบสอบถาม</h3>
            <?php } ?>
            `);
        const clickD = document.querySelectorAll('.dropdown-item');


        clickD[0].addEventListener('click' , () =>{
            document.querySelectorAll('#hidden2').forEach(element => {element.classList.add('d-none')});
            document.querySelectorAll('#hidden1').forEach(element => {
                element.classList.remove('d-none');
                document.querySelector('.btn').innerText = clickD[0].textContent;
            });
        });
        clickD[1].addEventListener('click' , () =>{
            document.querySelectorAll('#hidden1').forEach(element => {element.classList.add('d-none')});
            document.querySelectorAll('#hidden2').forEach(element => {
                element.classList.remove('d-none');
                document.querySelector('.btn').innerText = clickD[1].textContent;
            });
        });
        clickD[2].addEventListener('click' , () =>{
            document.querySelectorAll('#hidden1').forEach(element => {element.classList.remove('d-none')});
            document.querySelectorAll('#hidden2').forEach(element => {
                element.classList.remove('d-none');
                document.querySelector('.btn').innerText = clickD[2].textContent;
            });
        });
        document.querySelectorAll('#tab').forEach(e => {
            if(e.classList.contains('active')){
                e.style.backgroundColor = "#e9ecef";
            }
        });
        document.querySelectorAll('#tab')[0].addEventListener('click', () => {
                if(document.querySelectorAll('#tab')[0].classList.contains('active')){
                    document.querySelectorAll('#tab')[0].style.backgroundColor = "#e9ecef";
                    document.querySelectorAll('#tab')[1].style.backgroundColor = "#fff";
                }
                if(!document.querySelectorAll('#tab')[0].classList.contains('active')){
                    document.querySelectorAll('#tab')[0].style.backgroundColor = "#fff";
                    document.querySelectorAll('#tab')[1].style.backgroundColor = "#e9ecef";
                };
        });
        document.querySelectorAll('#tab')[1].addEventListener('click', () => {
                if(document.querySelectorAll('#tab')[1].classList.contains('active')){
                    document.querySelectorAll('#tab')[1].style.backgroundColor = "#e9ecef";
                    document.querySelectorAll('#tab')[0].style.backgroundColor = "#fff";
                }
                if(!document.querySelectorAll('#tab')[1].classList.contains('active')){
                    document.querySelectorAll('#tab')[1].style.backgroundColor = "#fff";
                    document.querySelectorAll('#tab')[0].style.backgroundColor = "#e9ecef";
                };
        });

        
        backtoindex = () =>{
            window.location.href = 'form.php';
        };
    </script>
</body>
</html>
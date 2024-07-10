<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
} else if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

$result = $conn->query("SELECT * FROM tb_efficiercy_form WHERE member_id = '$user_id'");
$count = count($result->fetchAll());
$result->execute();


$result1 = $conn->query("SELECT * FROM tb_satisfied WHERE member_id = '$user_id'");
$count1 = count($result1->fetchAll());
$result1->execute();

$countdropbox = array();
$result2 = $conn->query("SELECT * FROM tb_efficiercy_form");
array_push($countdropbox, count($result2->fetchAll()));
$result2->execute();


$result3 = $conn->query("SELECT * FROM tb_satisfied");
array_push($countdropbox, count($result3->fetchAll()));
$result3->execute();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/formstyle2.css">
    <link rel="stylesheet" href="style/tabstyle.css">
    <title>From</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <?php if (isset($_SESSION['login_success'])) { ?>
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "<?= $_SESSION['login_success'] ?>",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
        <?php unset($_SESSION['login_success']); ?>
    <?php } ?>
    <?php if (isset($_SESSION['delete'])) { ?>
        <script>
            Swal.fire({
                position: "center",
                title: "ลบข้อมูลเรียบร้อย",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
        <?php unset($_SESSION['delete']); ?>
    <?php } ?>

    <header>
        <div class="responsive">
            <h1>CTN Phrae</h1>
            <div class="caret"></div>
        </div>
        <div class="tab_box">
            <button class="tab_btn active" id="tab1">
                <h3>แบบฟอร์มประเมินประสิทธิภาพ</h3>
            </button>
            <button class="tab_btn" id="tab2">
                <h3>แบบฟอร์มประเมินความพึงพอใจ</h3>
            </button>
            <div class="dropdown">
                <div class="select">
                    <span class="selected">
                        <h3>เลือกฟอร์มสำหรับกรอก</h3>
                    </span>
                    <div class="caret"></div>
                </div>
                <ul class="menunavbar">
                    <li class=""><button class="tab_btn dropline" id="tab3">
                            <h4>ฟอร์มประเมินประสิทธิภาพ</h4>
                        </button></li>
                    <li class=""><button class="tab_btn dropline" id="tab3">
                            <h4>ฟอร์มประเมินความพึงพอใจ</h4>
                        </button></li>
                </ul>
                <div class="linedropdown"></div>
            </div>

            <div class="line"></div>
        </div>
        <div class="logout">
            <a onclick="logout(event, 'session/logout.php')" class="logout">ออกจากระบบ<img style="margin-left: 8px;" src="picture/logout.png"></a>
        </div>
    </header>
    <div class="content_box active">
        <div class="container">
            <div class="btnshow">
                <a href="#" class="adds" id="addFormperformance">เพิ่มแบบสอบถาม</a>
                <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>
            </div>
            <div class="form-box" id="adddata">
                <?php if ($count > 0) { ?>
                    <script type="text/javascript">
                        const showform = document.querySelectorAll('#adddata');
                        showform[0].classList.remove('form-box');
                        showform[0].classList.add('grid');
                        showform[0].insertAdjacentHTML("beforeend", `
                <?php for ($c = 1; $c <= $count; $c++) { ?>
                        <?php $row = $result->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120'>
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c; ?></h2>
                        <div class='text'><?php echo $row['form_name']; ?></div>
                        <div class="btns">
                        <a id='btn' href='showlist.php'>ดูรายชื่อ</a>
                        <a id='btn' onclick="isaddClass('<?php echo $row['form_id']; ?>')" >ดูข้อมูล</a>
                        <a href='edit_performance_form.php?id=<?php echo $row['form_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c; ?>','<?php echo $row['form_id']; ?>'])" >ลบ</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`);
                    </script>
                <?php } else { ?>
                    <img class='disimg' src="picture/empty-folder.png">
                    <h3 class='disimg'>ไม่มีข้อมูลแบบสอบถาม</h3>
                <?php } ?>
            </div>
        </div>

    </div>
    <div class="content_box">
        <div class="container">
            <div class="btnshow">
                <a href="#" class="adds" id="addFormsatisfy">เพิ่มแบบสอบถาม</a>
                <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>
            </div>
            <div class="form-box" id="adddata">
                <?php if ($count1 > 0) { ?>
                    <script type="text/javascript">
                        const showform1 = document.querySelectorAll('#adddata');
                        showform1[1].classList.remove('form-box');
                        showform1[1].classList.add('grid');
                        showform1[1].insertAdjacentHTML("beforeend", `
                <?php for ($c1 = 1; $c1 <= $count1; $c1++) { ?>
                        <?php $row5 = $result1->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120'>
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c1; ?></h2>
                        <div class='text'><?php echo $row5['sati_ep2']; ?></div>
                        <div class="btns">
                        <a id='btn' href='showlist.php'>ดูรายชื่อ</a>
                        <a id='btn' onclick="isaddClass('<?php echo $row5['sati_id']; ?>','true')" >ดูข้อมูล</a>
                        <a href='edit_satis_form.php?id=<?php echo $row5['sati_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c1; ?>','<?php echo $row5['sati_id']; ?>'],'true')" >ลบ</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`);
                    </script>
                <?php } else { ?>
                    <img class='disimg' src="picture/empty-folder.png">
                    <h3 class='disimg'>ไม่มีข้อมูลแบบสอบถาม</h3>
                <?php } ?>
            </div>
        </div>

    </div>
    <div class="content_box">
        <div class="container" style="margin-top: 3em;">
            <div class="form-box" id="adddata">
                <?php if ($countdropbox[0] > 0) { ?>
                    <script type="text/javascript">
                        const showform2 = document.querySelectorAll('#adddata');
                        showform2[2].classList.remove('form-box');
                        showform2[2].classList.add('grid');
                        showform2[2].insertAdjacentHTML("beforeend", `
                <?php for ($c = 1; $c <= $countdropbox[0]; $c++) { ?>
                        <?php $row6 = $result2->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120'>
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c; ?></h2>
                        <div class='text'><?php echo $row6['form_name']; ?></div>
                        <div class="btns">
                        <a id='btn' href='fill_performance_form.php?id=<?= $row6['form_id'] ?>' >กรอกข้อมูล</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`);
                    </script>
                <?php } else { ?>
                    <img class='disimg' src="picture/empty-folder.png">
                    <h3 class='disimg'>ไม่มีข้อมูลแบบสอบถาม</h3>
                <?php } ?>
            </div>
        </div>

    </div>
    <div class="content_box">
        <div class="container" style="margin-top: 3em;">
            <div class="form-box" id="adddata">
                <?php if ($countdropbox[1] > 0) { ?>
                    <script type="text/javascript">
                        const showform3 = document.querySelectorAll('#adddata');
                        showform3[3].classList.remove('form-box');
                        showform3[3].classList.add('grid');
                        showform3[3].insertAdjacentHTML("beforeend", `
                <?php for ($c1 = 1; $c1 <= $countdropbox[1]; $c1++) { ?>
                        <?php $row7 = $result3->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120'>
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c1; ?></h2>
                        <div class='text'><?php echo $row7['sati_ep2']; ?></div>
                        <div class="btns">
                        <a id='btn' href='fill_satis_form.php?id=<?= $row7['sati_id'] ?>'>กรอกข้อมูล</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`);
                    </script>
                <?php } else { ?>
                    <img class='disimg' src="picture/empty-folder.png">
                    <h3 class='disimg'>ไม่มีข้อมูลแบบสอบถาม</h3>
                <?php } ?>
            </div>
        </div>

    </div>
    <style>
        .subform {
            overflow-wrap: break-word;
        }

        .subform.columnData>.text {
            overflow-wrap: break-word;
        }

        .subform>h2 {
            text-align: center;
            width: 250px;
            overflow-wrap: break-word;
        }

        .subform.columnData>h2 {
            text-align: center;
            width: 250px;
            overflow-wrap: break-word;
        }

        .subform>.text {
            text-align: center;
            width: 100%;
            overflow-wrap: break-word;
        }

    </style>
    <script src="script/active.js" type="module"></script>
    <script src="script/dropdown1.js"></script>
    <script src="script/dropdownforreponsive.js"></script>
    <script src="script/script_add_data1.js"></script>
    <script>
        logout = (event, url) => {
            Swal.fire({
                title: 'คุณต้องการออกจากระบบหรือไม่?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่',
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        };
    </script>
</body>

</html>
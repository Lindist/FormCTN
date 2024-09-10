<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} else if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

$result = $conn->query("SELECT * FROM tb_efficiercy_form WHERE member_id = '$user_id'");
$count = count($result->fetchAll());
$result->execute();


$result1 = $conn->query("SELECT * FROM tb_satisfied WHERE member_id = '$user_id'");
$count1 = count($result1->fetchAll());
$result1->execute();


$tb_fill_efficiercy = $conn->query("SELECT * FROM tb_fill_efficiercy WHERE member_id = '$user_id'");
$tb_fill_efficiercy->execute();

$efficiercy_form_id = array();
while ($efficiercy_member_id = $tb_fill_efficiercy->fetch(PDO::FETCH_ASSOC)) {
    $efficiercy_form_id[] = $efficiercy_member_id['form_id'];
}

$tb_fill_satisfied = $conn->query("SELECT * FROM tb_fill_satisfied WHERE member_id = '$user_id'");
$tb_fill_satisfied->execute();

$satisfied_sati_id = array();
while ($satisfied_member_id = $tb_fill_satisfied->fetch(PDO::FETCH_ASSOC)) {
    $satisfied_sati_id[] = $satisfied_member_id['sati_id'];
}


$countdropbox = array();
$str1 = "SELECT * FROM tb_efficiercy_form WHERE NOT member_id = '$user_id'";
foreach ($efficiercy_form_id as $row1) {
    $str1 .= " AND NOT form_id = '$row1'";
}
$result2 = $conn->query($str1);
array_push($countdropbox, count($result2->fetchAll()));
$result2->execute();

$str2 = "SELECT * FROM tb_satisfied WHERE NOT member_id = '$user_id'";
foreach ($satisfied_sati_id as $row2) {
    $str2 .= " AND NOT sati_id = '$row2'";
}
$result3 = $conn->query($str2);
array_push($countdropbox, count($result3->fetchAll()));
$result3->execute();


$project = $conn->query("SELECT * FROM project WHERE member_id = '$user_id'");
$projectcount = count($project->fetchAll());
$project->execute();

$projectedit = $conn->query("SELECT * FROM project WHERE member_id = '$user_id'");
$projectedit->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/formstyle1.css">
    <link rel="stylesheet" href="style/tabstyle.css">
    <link rel="stylesheet" href="style/inputsearchstyle.css">
    <link rel="stylesheet" href="style/addProjectname1_2.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://unpkg.com/qr-code-styling/lib/qr-code-styling.js"></script>
    <title>Form</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <style>
        .custom-swal-title {
            font-size: 20px;
            /* Add any other styles you need */
        }
    </style>
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
    <?php } else if (isset($_SESSION['save_form'])) { ?>
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "<?= $_SESSION['save_form'] ?>",
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    title: 'custom-swal-title'
                }
            });
        </script>
        <?php unset($_SESSION['save_form']); ?>
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
    <div class="modal">
        <form class="modal-content animate" action="addprojecton.php" id="myform" method="post">
            <div class="containerformodal">
                <span class="close" title="Close Modal">&times;</span>
                <div class="title" style="text-align: center; margin-top: 0.5rem;">
                    <h1>โครงการ</h1>
                </div>
                <div class="tab_box">
                    <button type="button" class="tab_btn_pro active">
                        <h4>สร้างหัวข้อโครงการ</h4>
                    </button>
                    <button type="button" class="tab_btn_pro">
                        <h4>หัวข้อโครงการที่มีอยู่แล้ว</h4>
                    </button>
                </div>
                <div class="tab_content_for_project active">
                    <div class="addproject">
                        <label for=""><b>เพิ่มหัวข้อโครงการ</b></label>
                        <div class="dropdownforaddproject">
                            <div class="input-box" id="topic_index">1</div>
                            <button type="button" id="delete_topic" style="margin-left: 10px;" class="confirmbtn btncrease">เพิ่ม</button>
                            <div class="list">
                                <script src="script/add_remove_project10.js"></script>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab_content_for_project">
                    <?php if ($projectcount > 0) { ?>
                        <?php while ($rowproject = $project->fetch(PDO::FETCH_ASSOC)) { ?>
                            <input type="hidden" name="" id="pd" value="<?= $rowproject['project_id']; ?>">
                            <hr style="border-width: 0.7mm; margin: 2rem 0;">
                            <div class="editManager">
                                <div class="isEdit" id="editpro<?= $rowproject['project_id']; ?>">
                                    <label for=""><b>ชื่อโครงการ</b></label>
                                    <input type="text" id="p1" value="<?= $rowproject['project_name']; ?>" readonly>
                                    <div>
                                        <button type="button" class="confirmbtn" id="addper_" onclick="nextToper('<?= $rowproject['project_name']; ?>','<?= $rowproject['project_id']; ?>')">เพิ่มแบบฟอร์มประเมินประสิทธิภาพ</button>
                                        <button type="button" class="confirmbtn" id="addsta_" onclick="nextTosta('<?= $rowproject['project_name']; ?>','<?= $rowproject['project_id']; ?>')">เพิ่มแบบฟอร์มประเมินความพึงพอใจ</button>
                                    </div>
                                    <label for=""><b>วันหมดอายุ</b></label><br>
                                    <input type="hidden" name="" id="p1" value="<?= $rowproject['project_expired']; ?>">
                                    <input type="text" id="" value="<?= $rowproject['project_expired']; ?>" readonly>
                                    <label for=""><b>ระดับการศึกษา</b></label><br>
                                    <input type="text" id="p1" value="<?= $rowproject['project_leveledu']; ?>" readonly>
                                    <label for=""><b>ปีการศึกษา</b></label><br>
                                    <input type="text" id="p1" value="<?= $rowproject['project_yearedu']; ?>" readonly>

                                </div>
                                <div id="cancelproject<?= $rowproject['project_id']; ?>" class="ispressedit d-none">
                                    <button type="button" class="confirmbtn" onclick="Editformcomfirm(<?= $rowproject['project_id']; ?> , '<?= $rowproject['project_name']; ?>')">ยืนยันการแก้ไข</button>
                                    <button type="button" class="cancelbtn cancelproject" id="cancelproject<?= $rowproject['project_id']; ?>" onclick="cancelEditproject('<?= $rowproject['project_id']; ?>','<?= $rowproject['project_name']; ?>','<?= $rowproject['project_expired']; ?>','<?= $rowproject['project_leveledu']; ?>','<?= $rowproject['project_yearedu']; ?>')">ยกเลิกการแก้ไข</button>
                                </div>
                                <div id="editproject<?= $rowproject['project_id']; ?>" class="preedit">
                                    <button type="button" class="editbtn editproject" id="editproject<?= $rowproject['project_id']; ?>" onclick="Editproject(<?= $rowproject['project_id']; ?>)">แก้ไขข้อมูลโครงการ</button>
                                    <button type="button" class="cancelbtn" onclick="Delproject(<?= $rowproject['project_id']; ?>, '<?= $rowproject['project_name']; ?>')">ลบข้อมูลโครงการ</button>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <img class='disimg' style="width: 160px;" src="picture/form.png">
                            <h3 class='disimg'>ไม่มีข้อมูลโครงการ</h3>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div id="btnform" class="moreaddproject d-none">
                <!-- ฟิลด์ฟอร์มของคุณจะอยู่ที่นี่ -->
                <button type="submit" class="confirmbtn" id="submit_pj">ยืนยัน</button>
                <button type="button" class="cancelbtn" id="cancelbtn">ยกเลิก</button>

                <script>
                    document.getElementById("myform").addEventListener("submit", (event) => {
                        event.preventDefault(); // ป้องกันไม่ให้ฟอร์มถูกส่งโดยทันที

                        Swal.fire({
                            title: "ยืนยันการบันทึกหรือไม่?",
                            text: "ตรวจสอบให้แน่ใจว่าคุณกรอกข้อมูลถูกต้อง!",
                            icon: "info",
                            showCancelButton: true,
                            confirmButtonColor: "#16a34a",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "บันทึก",
                            cancelButtonText: "ยกเลิก",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // ส่งฟอร์ม
                                document.getElementById("myform").submit();
                            }
                        });
                    });
                </script>
            </div>

        </form>
        <script src="script/tabbox_to_btnProject.js"></script>
        <script>
            document.querySelector(".btncrease").addEventListener('click', () => {
                document.querySelector(".moreaddproject").classList.remove("d-none");
            })
        </script>
    </div>
    <?php if (isset($_SESSION['addproject'])) { ?>
        <script>
            Swal.fire({
                position: "center",
                title: "<?= $_SESSION['addproject']; ?>",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
            const tabs13 = document.querySelectorAll(".tab_btn_pro");
            const all_content13 = document.querySelectorAll(".tab_content_for_project");
            tabs13.forEach(tab => {
                tab.classList.remove('active')
            })
            tabs13[1].classList.add('active');
            all_content13.forEach(content => {
                content.classList.remove('active')
            });
            all_content13[1].classList.add('active');
            const modalpopup = document.querySelector('.modal');
            modalpopup.style.display = 'block';
            document.querySelector('.close').addEventListener('click', () => {
                modalpopup.style.display = 'none';
            })
            document.querySelector('#cancelbtn').addEventListener('click', () => {
                modalpopup.style.display = 'none';
            })
            tabs13[1].addEventListener('click', () => {
                document.querySelector("#btnform").classList.add("d-none");
            })
            tabs13[0].addEventListener('click', () => {
                if (document.querySelectorAll(".openbtn").length > 0) {
                    document.querySelector("#btnform").classList.remove("d-none");
                }
            })
        </script>
        <?php unset($_SESSION['addproject']); ?>
    <?php } ?>


    <?php if (isset($_SESSION['deleteproject'])) { ?>
        <script>
            Swal.fire({
                position: "center",
                title: "ลบข้อมูลโครงการเรียบร้อย",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
            });
            const tabs23 = document.querySelectorAll(".tab_btn_pro");
            const all_content23 = document.querySelectorAll(".tab_content_for_project");
            tabs23.forEach(tab => {
                tab.classList.remove('active')
            })
            tabs23[1].classList.add('active');
            all_content23.forEach(content => {
                content.classList.remove('active')
            });
            all_content23[1].classList.add('active');
            const modalpopup1 = document.querySelector('.modal');
            modalpopup1.style.display = 'block';
            document.querySelector('.close').addEventListener('click', () => {
                modalpopup1.style.display = 'none';
            })
            document.querySelector('#cancelbtn').addEventListener('click', () => {
                modalpopup1.style.display = 'none';
            })
            tabs23[1].addEventListener('click', () => {
                document.querySelector("#btnform").classList.add("d-none");
            })
            tabs23[0].addEventListener('click', () => {
                if (document.querySelectorAll(".openbtn").length > 0) {
                    document.querySelector("#btnform").classList.remove("d-none");
                }
            })
        </script>
        <?php unset($_SESSION['deleteproject']); ?>
    <?php } ?>
    <header>
        <div class="responsive">
            <h1>CTN Phrae</h1>
            <div class="toggle-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
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
                <a href="#" class="adds" id="addFormperformance">สร้าง/แก้ไขหัวข้อโครงการ</a>
                <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>
            </div>
            <div class="search-wrapper">
                <span class="search-icon material-symbols-outlined">search</span>
                <!-- <label for="search">Search Project</label> -->
                <input type="search" placeholder="ชื่อแบบฟอร์มทีต้องการค้นหา..." name="" id="search" data-search>
            </div>
            <div class="padding">
                <div class="form-box" id="adddata" without-data0>
                    <?php if ($count > 0) { ?>
                        <script type="text/javascript">
                            const showform = document.querySelectorAll('#adddata');
                            showform[0].classList.remove('form-box');
                            showform[0].classList.add('grid');
                            showform[0].insertAdjacentHTML("beforeend", `
                <?php for ($c = 1; $c <= $count; $c++) { ?>
                        <?php $row = $result->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120' id="data0">
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c; ?></h2>
                        <div class='text'><?php echo $row['form_name']; ?></div>
                        <div class="btns">
                        <a id='btn' href='showlistperformance.php?id=<?php echo $row['form_id']; ?>'>ดูรายชื่อ</a>
                                <button id='btn' onclick="download_btn_fillperfor(<?php echo $row['form_id']; ?>)" class="qr_btn">
                                    Download QR Code
                                </button>
                        <a id='btnshow' onclick="isaddClass('<?php echo $row['form_id']; ?>')" >ดูข้อมูล</a>
                        <a href='edit_performance_form.php?id=<?php echo $row['form_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c; ?>', '<?php echo $row['form_name']; ?>', '<?php echo $row['form_id']; ?>'])" >ลบ</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`);
                        </script>
                    <?php } else { ?>
                        <img class='disimg0' src="picture/empty-folder.png">
                        <h3 class='disimg0'>ไม่มีข้อมูลแบบสอบถาม</h3>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <div class="content_box">
        <div class="container">
            <div class="btnshow">
                <a href="#" class="adds" id="addFormsatisfy">สร้าง/แก้ไขหัวข้อโครงการ</a>
                <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>
            </div>
            <div class="search-wrapper">
                <span class="search-icon material-symbols-outlined">search</span>
                <!-- <label for="search">Search Project</label> -->
                <input type="search" placeholder="ชื่อแบบฟอร์มทีต้องการค้นหา..." name="" id="search" data-search>
            </div>
            <div class="padding">
                <div class="form-box" id="adddata" without-data1>
                    <?php if ($count1 > 0) { ?>
                        <script type="text/javascript">
                            const showform1 = document.querySelectorAll('#adddata');
                            showform1[1].classList.remove('form-box');
                            showform1[1].classList.add('grid');
                            showform1[1].insertAdjacentHTML("beforeend", `
                <?php for ($c1 = 1; $c1 <= $count1; $c1++) { ?>
                        <?php $row5 = $result1->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120' id="data1">
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c1; ?></h2>
                        <div class='text'><?php echo $row5['sati_ep2']; ?></div>
                        <div class="btns">
                        <a id='btn' href='showlistsatis.php?id=<?php echo $row5['sati_id']; ?>'>ดูรายชื่อ</a>
                        <button id='btn' onclick="download_btn_sati(<?php echo $row5['sati_id']; ?>)" class="qr_btn">
                            Download QR Code
                        </button>
                        <a id='btnshow' onclick="isaddClass('<?php echo $row5['sati_id']; ?>','true')" >ดูข้อมูล</a>
                        <a href='edit_satis_form.php?id=<?php echo $row5['sati_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c1; ?>', '<?php echo $row5['sati_ep2']; ?>', '<?php echo $row5['sati_id']; ?>'], 'true')" >ลบ</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`);
                        </script>
                    <?php } else { ?>
                        <img class='disimg1' src="picture/empty-folder.png">
                        <h3 class='disimg1'>ไม่มีข้อมูลแบบสอบถาม</h3>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <div class="content_box">
        <div class="container" style="margin-top: 3em;">
            <div class="search-wrapper seachmargin">
                <span class="search-icon material-symbols-outlined">search</span>
                <!-- <label for="search">Search Project</label> -->
                <input type="search" placeholder="ชื่อแบบฟอร์มทีต้องการค้นหา..." name="" id="search" data-search>
            </div>
            <div class="padding">
                <div class="form-box" id="adddata" without-data2>
                    <?php if ($countdropbox[0] > 0) { ?>
                        <script type="text/javascript">
                            const showform2 = document.querySelectorAll('#adddata');
                            showform2[2].classList.remove('form-box');
                            showform2[2].classList.add('grid');
                            showform2[2].insertAdjacentHTML("beforeend", `
                <?php for ($c = 1; $c <= $countdropbox[0]; $c++) { ?>
                        <?php $row6 = $result2->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120' id="data2">
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c; ?></h2>
                        <div class='text'><?php echo $row6['form_name']; ?></div>
                        <div class="btns">
                        <a id='btn1' href='fill_performance_form.php?id=<?= $row6['form_id'] ?>' >กรอกข้อมูล</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`);
                        </script>
                    <?php } else { ?>
                        <img class='disimg2' src="picture/empty-folder.png">
                        <h3 class='disimg2'>ไม่มีข้อมูลแบบสอบถาม</h3>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <div class="content_box">
        <div class="container" style="margin-top: 3em;">
            <div class="search-wrapper seachmargin">
                <span class="search-icon material-symbols-outlined">search</span>
                <!-- <label for="search">Search Project</label> -->
                <input type="search" placeholder="ชื่อแบบฟอร์มทีต้องการค้นหา..." name="" id="search" data-search>
            </div>
            <div class="padding">
                <div class="form-box" id="adddata" without-data3>
                    <?php if ($countdropbox[1] > 0) { ?>
                        <script type="text/javascript">
                            const showform3 = document.querySelectorAll('#adddata');
                            showform3[3].classList.remove('form-box');
                            showform3[3].classList.add('grid');
                            showform3[3].insertAdjacentHTML("beforeend", `
                <?php for ($c1 = 1; $c1 <= $countdropbox[1]; $c1++) { ?>
                        <?php $row7 = $result3->fetch(PDO::FETCH_ASSOC); ?>
                        <div class='container120' id="data3">
                        <div class='subform'>
                        <h2>แบบฟอร์มที่ <?php echo $c1; ?></h2>
                        <div class='text'><?php echo $row7['sati_ep2']; ?></div>
                        <div class="btns">
                        <a id='btn1' href='fill_satis_form.php?id=<?= $row7['sati_id'] ?>'>กรอกข้อมูล</a>
                        </div>
                        </div>
                        </div>
                <?php } ?>`);
                        </script>
                    <?php } else { ?>
                        <img class='disimg3' src="picture/empty-folder.png">
                        <h3 class='disimg3'>ไม่มีข้อมูลแบบสอบถาม</h3>
                    <?php } ?>
                </div>
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

        .tab_content_for_project,
        .d-none {
            display: none;
        }

        .tab_content_for_project.active {
            display: block;
        }
        .qr_btn{
            margin-left: 8px;
            border-style: none;
            display: inline-block;
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            padding: 0.5rem;
            background-color: #F5004F;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
            cursor: pointer;
            transition: all .2s ease-in-out;
        }

        .qr_btn:hover{
            background-color: #D5004F;
        }
    </style>
    <script src="script/active.js" type="module"></script>
    <script src="script/searchscipt.js"></script>
    <script src="script/dropdown1.js"></script>
    <script src="script/dropdownforreponsive1.js"></script>
    <script src="script/script_add_update1.js"></script>
    <script src="script/scriptSelector1.js"></script>
    <script src="script/datepicker1.js"></script>
    <script src="script/thaidatepicker1.js"></script>
    <script>
        let date = []
        document.querySelectorAll("#pd").forEach(element => {
            date.push("#pdate" + element.value.toString());
        });
        document.querySelector(".btncrease").addEventListener('click', () => {
            let ids = document.querySelectorAll('.datepicker')
            ids.forEach((element, i) => {
                date.push("#d" + (i + 1).toString());
            });
            // console.log(date)
            // console.log(ids)
            $(function() {
                $(".datepicker1").datetimepicker()
                thaiDatepicker(date.join(','))
            })
            // $(function() {thaiDatepicker("#d1,#d2,#d3")})
        })
        document.querySelectorAll(".editproject").forEach(element => {
            element.addEventListener('click', () => {
                const checkid = element.id.toString();
                document.querySelectorAll(".preedit").forEach((e, index) => {
                    document.querySelectorAll(".ispressedit")[index].classList.add('d-none')
                    e.classList.add('d-none')
                    if (e.id === checkid) {
                        document.querySelectorAll(".ispressedit")[index].classList.remove('d-none')
                    }
                });
                $(function() {
                    $(".datepicker1").datetimepicker()
                    thaiDatepicker(date.join(','))
                })
            })
        })
        document.querySelectorAll(".cancelproject").forEach(element => {
            element.addEventListener('click', () => {
                const checkid = element.id.toString();
                document.querySelectorAll(".ispressedit").forEach((e, index) => {
                    document.querySelectorAll(".preedit")[index].classList.remove('d-none')
                    if (e.id === checkid) {
                        e.classList.toggle('d-none')
                    }
                });
            })
        })
    </script>
    <script src="script/editproject.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->
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
        nextToper = (name, id) => {
            window.location.href = "insert_performance_form.php?pro_name=" + name.toString() + "&pro_id=" + id.toString();
        }
        nextTosta = (name, id) => {
            window.location.href = "insert_satis_form.php?pro_name=" + name.toString() + "&pro_id=" + id.toString();
        }

        download_btn_fillperfor = (index) => {
            let qrCode = new QRCodeStyling({
                width: 300,
                height: 300,
                data: `http://form.ctnphrae.com/FormCTN/fill_performance_form.php?id=${index}`,
                dotsOptions: {
                    color: "#000000",
                },
                backgroundOptions: {
                    color: "#ffffff",
                },
                imageOptions: {
                    crossOrigin: "anonymous",
                    margin: 20
                }
            });

            qrCode.download({
                name: "qr-code",
                extension: "png"
            }).then(() => {
                // หลังจากการดาวน์โหลดเสร็จสมบูรณ์ ให้กลับมายังหน้าที่ต้องการ
                window.location.href = `http://form.ctnphrae.com/FormCTN/form.php`;
            });
        };
        download_btn_sati = (index) => {
            let qrCode = new QRCodeStyling({
                width: 300,
                height: 300,
                data: `http://form.ctnphrae.com/FormCTN/fill_satis_form.php?id=${index}`,
                dotsOptions: {
                    color: "#000000",
                },
                backgroundOptions: {
                    color: "#ffffff",
                },
                imageOptions: {
                    crossOrigin: "anonymous",
                    margin: 20
                }
            });

            qrCode.download({
                name: "qr-code",
                extension: "png"
            }).then(() => {
                // หลังจากการดาวน์โหลดเสร็จสมบูรณ์ ให้กลับมายังหน้าที่ต้องการ
                window.location.href = `http://form.ctnphrae.com/FormCTN/form.php`;
            });
        };
    </script>
</body>

</html>
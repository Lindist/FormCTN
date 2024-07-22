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


$tb_fill_efficiercy = $conn->query("SELECT * FROM tb_fill_efficiercy WHERE member_id = '$user_id'");
$tb_fill_efficiercy->execute();

$efficiercy_form_id = array();
while($efficiercy_member_id = $tb_fill_efficiercy->fetch(PDO::FETCH_ASSOC)){
    $efficiercy_form_id[] = $efficiercy_member_id['form_id'];
}

$tb_fill_satisfied = $conn->query("SELECT * FROM tb_fill_satisfied WHERE member_id = '$user_id'");
$tb_fill_satisfied->execute();

$satisfied_sati_id = array();
while($satisfied_member_id = $tb_fill_satisfied->fetch(PDO::FETCH_ASSOC)){
    $satisfied_sati_id[] = $satisfied_member_id['sati_id'];
}


$countdropbox = array();
$str1 = "SELECT * FROM tb_efficiercy_form WHERE NOT member_id = '$user_id'";
foreach($efficiercy_form_id as $row1){
    $str1 .= " AND NOT form_id = '$row1'";
}
$result2 = $conn->query($str1);
array_push($countdropbox, count($result2->fetchAll()));
$result2->execute();

$str2 = "SELECT * FROM tb_satisfied WHERE NOT member_id = '$user_id'";
foreach($satisfied_sati_id as $row2){
    $str2 .= " AND NOT sati_id = '$row2'";
}
$result3 = $conn->query($str2);
array_push($countdropbox, count($result3->fetchAll()));
$result3->execute();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/formstyle1.css">
    <link rel="stylesheet" href="style/tabstyle.css">
    <link rel="stylesheet" href="style/inputsearchstyle.css">
    <link rel="stylesheet" href="style/addProjectnames.css">
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>From</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
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
    <?php if (isset($_SESSION['addproject'])) { ?>
        <script>
            Swal.fire({
                position: "center",
                title: "เพิ่มข้อมูลเรียบร้อย",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
        <?php unset($_SESSION['addproject']); ?>
    <?php } ?>
<div class="modal">
    <form class="modal-content animate" action="addprojecton.php" id="myform" method="post">
        <div class="containerformodal">
            <span class="close" title="Close Modal">&times;</span>
            <div class="title" style="text-align: center; margin-top: 0.5rem;"><h1>โครงการ</h1></div>
            <div class="addproject">
            <label for=""><b>เพิ่มหัวข้อโครงการ</b></label>
            <div class="dropdownforaddpriject">
                <div class="input-box">1</div>
                <button type="button" style="margin-left: 10px;" class="confirmbtn btncrease">เพิ่ม</button>

                    <div class="list">
                        <script src="script/add_remove_project.js"></script>
                    </div>
                </div>
            </div>
        </div>
        <div id="btnform" class="moreaddproject d-none">
            <button type="submit" class="confirmbtn">ยืนยัน</button>
            <button type="button" class="cancelbtn">ยกเลิก</button>
        </div>

    </form>
    <script>
        document.querySelector(".btncrease").addEventListener('click', () => {
            document.querySelector(".moreaddproject").classList.remove("d-none");
        })
    </script>
</div>
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
                <a href="#" class="adds" id="addFormperformance">เพิ่มแบบสอบถาม</a>
                <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>
            </div>
            <div class="search-wrapper">
                <span class="search-icon material-symbols-outlined">search</span>
                <!-- <label for="search">Search Project</label> -->
                <input type="search" placeholder="ชื่อแบบฟอร์มทีต้องการค้นหา..." name="" id="search" data-search>
            </div>
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
                        <a id='btnshow' onclick="isaddClass('<?php echo $row['form_id']; ?>')" >ดูข้อมูล</a>
                        <a href='edit_performance_form.php?id=<?php echo $row['form_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c; ?>','<?php echo $row['form_id']; ?>'])" >ลบ</a>
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
    <div class="content_box">
        <div class="container">
            <div class="btnshow">
                <a href="#" class="adds" id="addFormsatisfy">เพิ่มแบบสอบถาม</a>
                <a href="#" class="adds" id="check-edit">ตรวจสอบและแก้ไข</a>
            </div>
            <div class="search-wrapper">
                <span class="search-icon material-symbols-outlined">search</span>
                <!-- <label for="search">Search Project</label> -->
                <input type="search" placeholder="ชื่อแบบฟอร์มทีต้องการค้นหา..." name="" id="search" data-search>
            </div>
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
                        <a id='btnshow' onclick="isaddClass('<?php echo $row5['sati_id']; ?>','true')" >ดูข้อมูล</a>
                        <a href='edit_satis_form.php?id=<?php echo $row5['sati_id']; ?>' id='btnedit'>แก้ไข</a>
                        <a id='btndelete' onclick="confirmdel(['<?php echo $c1; ?>','<?php echo $row5['sati_id']; ?>'],'true')" >ลบ</a>
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
    <div class="content_box">
        <div class="container" style="margin-top: 3em;">
            <div class="search-wrapper">
                <span class="search-icon material-symbols-outlined">search</span>
                <!-- <label for="search">Search Project</label> -->
                <input type="search" placeholder="ชื่อแบบฟอร์มทีต้องการค้นหา..." name="" id="search" data-search>
            </div>
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
    <div class="content_box">
        <div class="container" style="margin-top: 3em;">
            <div class="search-wrapper">
                <span class="search-icon material-symbols-outlined">search</span>
                <!-- <label for="search">Search Project</label> -->
                <input type="search" placeholder="ชื่อแบบฟอร์มทีต้องการค้นหา..." name="" id="search" data-search>
            </div>
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
        .d-none{
            display: none;
        }
    </style>
    <script src="script/active.js" type="module"></script>
    <script src="script/searchscipt.js"></script>
    <script src="script/dropdown1.js"></script>
    <script src="script/dropdownforreponsives.js"></script>
    <script src="script/script_add_data.js"></script>
    <script src="script/scriptSelector101.js"></script>
    <script src="script/datepicker1.js"></script>
    <!-- <script src="script/isiperandisstatis1.js"></script> -->
    <script src="script/thaidatepicker.js"></script>
    <script>
        document.querySelector(".btncrease").addEventListener('click', () => {
            let date= []
            let ids = document.querySelectorAll('.datepicker')
            ids.forEach((element,i) => {
                date.push("#d"+(i+1).toString());
            });
            // console.log(date)
            // console.log(ids)
            $(function() {
            //original datepicker
            $(".datepicker1").datetimepicker()
            //thai datepicker
            thaiDatepicker(date.join(','))
            })
            // $(function() {thaiDatepicker("#d1,#d2,#d3")})
        })
    </script>
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
    </script>
</body>

</html>
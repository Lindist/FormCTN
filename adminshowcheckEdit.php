<?php

session_start();
require 'session/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
} else if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
}

if(isset($_GET["id"])){
    $_SESSION['adminpro_id'] = $_GET["id"];
    $id = $_GET["id"];
    $sql = "SELECT * FROM project WHERE project_id = $id";
    $project = $conn->query($sql);
}else if(isset($_SESSION['adminpro_id'])){
    $id = $_SESSION['adminpro_id'];
    $sql = "SELECT * FROM project WHERE project_id = $id";
    $project = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.7/dist/full.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/adminProject1.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
            background-color: rgb(180, 180, 180);
        }
    </style>
</head>

<body class="bg-gray-100">
    <?php if (isset($_SESSION['save_form'])) { ?>
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
    <?php if (isset($_SESSION['addproject'])) { ?>
        <script>
            Swal.fire({
                position: "center",
                title: "<?= $_SESSION['addproject']; ?>",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php unset($_SESSION['addproject']); ?>
    <?php } ?>

<div class="modal2" style="display: block;">
        <form class="modal-content animate" action="" id="myform" method="post">
        <div class="containerformodal">
                <span class="close" title="Close Modal">&times;</span>
                <div class="title" style="text-align: center; margin-top: 0.5rem;">
                    <h1>โครงการ</h1>
                </div>
            <?php while ($rowproject = $project->fetch(PDO::FETCH_ASSOC)) { 
                $idjforJS = json_encode($rowproject['project_id']);
            ?>
                <input type="hidden" name="" id="pd" value="<?= $rowproject['project_id']; ?>">
                <div class="editManager">
                    <div class="isEdit" id="editpro<?= $rowproject['project_id']; ?>">
                        <label for=""><b>ชื่อโครงการ</b></label>
                        <input type="text" id="p1" value="<?= $rowproject['project_name']; ?>" readonly>
                        <div>
                            <?php 
                            $sql1 = "SELECT * FROM tb_efficiercy_form WHERE project_id = '$rowproject[project_id]'";
                            $sql2 = "SELECT * FROM tb_satisfied WHERE project_id = '$rowproject[project_id]'";
                            $ef = $conn->query($sql1);
                            $sa = $conn->query($sql2);
                            $rowef = $ef->fetch();
                            $rowsa = $sa->fetch();
                            if(isset($rowef["project_id"])){
                            ?>
                            <button type="button" class="editbtn" id="addper_" style="background-image: linear-gradient(to bottom right, #F9E400,#FFB200);" onclick="nextToper('<?= $rowproject['project_id']; ?>')">แก้แบบฟอร์มประเมินประสิทธิภาพ</button>
                            <?php } else{ ?>
                            <button type="button" class="editbtn" style="background-color: #FCDD95; color: #EE0000;" disabled id="addper_" >โครงการนี้ยังไม่ได้สร้างแบบฟอร์มประเมินประสิทธิภาพ!!!</button>
                            <?php }if(isset($rowsa["project_id"])){ ?>
                            <button type="button" class="editbtn" id="addsta_" style="background-image: linear-gradient(to bottom right, #F9E400,#FFB200);" onclick="nextTosta('<?= $rowproject['project_id']; ?>')">แก้แบบฟอร์มประเมินความพึงพอใจ</button>
                            <?php }else{ ?>
                                <button type="button" class="editbtn" style="background-color: #FCDD95; color: #EE0000;" id="addsta_" disabled>โครงการนี้ยังไม่ได้สร้างแก้แบบฟอร์มประเมินความพึงพอใจ!!!</button>
                            <?php } ?>  
                        </div>
                        <label for=""><b>วันหมดอายุ</b></label><br>
                        <input type="hidden" name="" id="p1" value="<?= $rowproject['project_expired']; ?>">
                        <input type="text" id="" value="<?= $rowproject['project_expired']; ?>" readonly>
                        <label for=""><b>ระดับการศึกษา</b></label><br>
                        <input type="text" id="p1" value="<?= $rowproject['project_leveledu']; ?>" readonly>
                        <label for=""><b>ปีการศึกษา</b></label><br>
                        <input type="text" id="p1" value="<?= $rowproject['project_yearedu']; ?>" readonly>

                    </div>
                    <div id="cancelproject<?= $rowproject['project_id']; ?>" class="ispressedit hidden">
                        <button type="button" class="confirmbtn" onclick="Editformcomfirm(<?= $rowproject['project_id']; ?>, '<?= $rowproject['project_name']; ?>')">ยืนยันการแก้ไข</button>
                        <button type="button" style="background-color: #F4CE14;" class="cancelbtn cancelproject" id="cancelproject<?= $rowproject['project_id']; ?>" onclick="cancelEditproject('<?= $rowproject['project_id']; ?>')">ยกเลิกการแก้ไข</button>
                    </div>
                    <div id="editproject<?= $rowproject['project_id']; ?>" class="preedit">
                        <button type="button" class="editbtn editproject" id="editproject<?= $rowproject['project_id']; ?>" onclick="Editproject(<?= $rowproject['project_id']; ?>)">แก้ไขข้อมูลโครงการ</button>
                        <button type="button" class="cancelbtn" style="background-image: linear-gradient(to right,#f44336, #C7253E);" onclick="Delproject(<?= $rowproject['project_id']; ?>, '<?= $rowproject['project_name']; ?>')">ลบข้อมูลโครงการ</button>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div id="btnform" class="moreaddproject">
                <button type="button" class="cancelbtn" id="cancelbtn" onclick="Close()">ยกเลิก</button>
            </div>

        </form>
    </div>  
    <script src="script/editproject.js"></script>
    <script src="script/thaidatepicker1.js"></script>
    <script type="text/javascript">
        
        document.querySelectorAll(".editproject").forEach(element => {
            element.addEventListener('click', () => {
            const checkid = element.id.toString();
            document.querySelectorAll(".preedit").forEach((e, index) => {
                document.querySelectorAll(".ispressedit")[index].classList.add('hidden')
                e.classList.add('hidden')
                if (e.id === checkid) {
                    document.querySelectorAll(".ispressedit")[index].classList.remove('hidden')
                }
            });
            const datepic = document.getElementById("datepic");
            var $x = <?php echo $idjforJS; ?>;
            $(function() {
                $(".datepicker1").datetimepicker()
                thaiDatepicker("#pdate"+$x.toString())
            })
            })
        })
        document.querySelectorAll(".cancelproject").forEach(element => {
            element.addEventListener('click', () => {
                const checkid = element.id.toString();
                document.querySelectorAll(".ispressedit").forEach((e, index) => {
                    document.querySelectorAll(".preedit")[index].classList.remove('hidden')
                    if (e.id === checkid) {
                        e.classList.toggle('hidden')
                    }
                });
            })
        })
        Delproject = (id, pj_name) => {
            Swal.fire({
                title: "ลบฟอร์มข้อมูล",
                text: `ยืนยันที่จะลบ โครงการ ${pj_name} หรือไม่  หากลบข้อมูลที่สร้างไว้และข้อมูลที่ถูกกรอกจะหายไปทั้งหมด`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#333",
                confirmButtonText: "ลบ",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete_project.php?id=${id}`;
                }
            });
        }
        nextToper = (id) => {
            window.location.href = "edit_performance_form.php?idpj=" + id.toString();
        }
        nextTosta = (id) => {
            window.location.href = "edit_satis_form.php?idpj=" + id.toString();
        }
        document.querySelector('.close').addEventListener('click', () => {
            window.location.href='adminpanel.php';
            unset($_SESSION['adminpro_id']);
        })
        Close = () =>{
            window.location.href='adminpanel.php';
            unset($_SESSION['adminpro_id']);
        }
    </script>
    <style>
        h1{
            font-weight: 800;
            font-size: 28px;
        }
        label{
            font-weight: 600;
        }
        .alertedit,h3{
            margin-top: 0.5rem;
            font-weight: 700;
            font-size: 16px;
            color: #d33;
        }
    </style>
</body>

</html>
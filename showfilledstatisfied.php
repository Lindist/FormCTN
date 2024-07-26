<?php

session_start();
require 'session/config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id']; 
}
if (isset($_GET['form_id'])) {
    $form_id = $_GET['form_id']; 
}

    $result = $conn->query("SELECT * FROM tb_fill_satisfied  WHERE sati_id = '$form_id' AND member_id = '$user_id'"); 
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    $sati_ep2 = $row['sati_ep2'];
    $sati_info_un = $row['sati_info'];
    $sub_info_un = $row['sub_info'];
    $sati_topic_un = $row['sati_topic'];
    $sub_topic_un = $row['sub_topic'];

    $score_un = $row['score'];

    $sati_info = preg_split("/Ϫ/", $sati_info_un);
    $sub_info = preg_split("/ꓘ/", $sub_info_un);
    $sati_topic = preg_split("/Ϫ/", $sati_topic_un);
    $sub_topic = preg_split("/ꓘ/", $sub_topic_un);

    $score = preg_split("/ꓘ/", $score_un);

    $sub_info_ex = [];
    foreach ($sub_info as $index => $info) {
        $sub_info_ex[$index] = preg_split("/Ϫ/", $info);
    }

    $sub_topic_ex = [];
    foreach ($sub_topic as $index => $topic) {
        $sub_topic_ex[$index] = preg_split("/Ϫ/", $topic);
    }

    $score_ex = [];
    foreach ($score as $index => $topic) {
        $score_ex[$index] = preg_split("/Ϫ/", $topic);
    }
    // print_r($score_ex);


    
if (isset($_GET['class'])) {
    $class = $_GET['class'];
}else{
    $class = 'nohave';
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>แบบฟอร์มประเมินความพึงพอใจ</title>
    <link rel="icon" type="icon" href="https://i.imgur.com/m0H7jcN.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');

        body {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        body {
            background-color: rgb(180, 180, 180);
        }

        label {
            text-align: start;
            font-weight: bold;
        }

        h1 {
            font-weight: bold;
        }
        .table,
        .rad {
            border: 1px solid #000;
        }

        .table {
            width: 100%;
        }
        th,td{
            vertical-align: middle;
        }
        ul{
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 50;
        }
        ul > li {
            list-style: none;

        }

        @media screen and (min-width: 990px) {
            .content {
                width: 700px;
                margin: auto;
            }

            .container {
                width: 850px;
            }
        }
    </style>
</head>

<body onload="putradio()" >
    <div class="main overflow-x-hidden container-fluid col-11 bg-white py-1 my-3 rounded">
    <aside style="display: flex; width: 170px; justify-content: space-between; flex-wrap: wrap;">
        <button type="button" onclick="isClass('<?php echo $class; ?>')" style="display:flex; background-color:#1a75ff; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#00f';" onmouseout="this.style.backgroundColor='#1a75ff';">
            กลับหน้าแรก
        </button>
        <button type="button" onclick="history.back()" style="display:flex; background-color:#111; color:#fff; font-weight:bold; border-style: none; border-radius:10px; padding: 10px; border-color: #444; transition:all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#333';" onmouseout="this.style.backgroundColor='#111';">
            กลับ
        </button>
    </aside>
        <form>
            <h1 class="text-center my-5">แบบฟอร์มประเมินความพึงพอใจ</h1>

            <!-- Title_Content -->
            <div class="head_content mt-5 mb-2">
                <label class="text-2xl mb-5 font-bold">คำชี้แจง ในแบบประเมินความพึงพอใจจะแบ่งออกเป็น 3 ตอน ดังนี้</label> <br>
                <label class="font-bold" for="">ในแบบประเมินความพึงพอใจการใช้งานระบบ แบ่งออกเป็น 3 ตอนดังนี้</label> <br>
                <label class="font-bold" for="">ตอนที่ 1</label> <br>
                <label class="font-bold" for="">เป็นข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label> <br>
                <label class="font-bold" for="">ตอนที่ 2 เป็นแบบสอบถามความคิดเห็นของ ครู อาจารย์ นักเรียน นักศึกษา และบุคคลภายนอก
                </label><br>
                <span class="rad form-control text-break mb-2" style="width: 100%;"><?php echo $row['sati_ep2']; ?></span>
                <div class="d-flex flex-column w-50 align-items-center">
                <label class="font-bold d-flex justify-content-start w-100">โดยแบ่งการประเมินเป็น <?= count($sati_topic); ?> ด้าน คือ</label>
                    <div class="w-50">
                        <ul class="w-100">
                        <?php for($b=0;$b < count($sati_topic);$b++){ ?>
                            <li class="" for="">ด้านที่ <?= ($b+1)." ".$sati_topic[$b]; ?></li> <br>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
                <label class="font-bold" for="">ตอนที่ 3 เป็นข้อคิดเห็นและเสนอแนะอื่นๆ</label> <br>
            </div>
            <!-- Body_Content -->
            <div class="body_content mt-5">
                <label class="form-label font-bold">ตอนที่ 1</label>
                <label for="">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label><br>
                <?php for($b=0;$b < count($sati_info);$b++){ ?>
                <div class="w-100">
                    <label class="col-3 col-form-label w-100"><?= ($b+1).".".$sati_info[$b]; ?>
                    <?php for($i=0;$i < count($sub_info_ex[$b]);$i++){ ?>
                    <?php if(!($sub_info_ex[$b][$i] == null)){ ?>
                    <input class="rad form-check-input ms-4" type="radio" value="" checked name="" >
                    <?php echo $sub_info_ex[$b][$i]; ?>
                    <?php } ?>
                    <?php } ?>
                    </label><br>
                </div>
                <?php } ?>

                <label class="form-label">ตอนที่ 2</label>
                <label for="">แบบสอบถามความคิดเห็น</label> <br>
                <label class="form-label mt-2">คำชี้แจง</label>
                <label for="">โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label> <br>
                <!-- Start table -->
                <?php for($b=0;$b < count($sati_topic);$b++){ ?>
                <label class="form-label mt-2">ด้านที่ <?= $b+1; ?></label>
                <label class="form-label mb-2" id="format"><?= $sati_topic[$b];?></label>
                <div  id="widthfix">
                <table class="table table-bordered table-striped text-center mt-3">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2">ที่</th>
                            <th scope="col" rowspan="2">หัวข้อ</th>
                            <th scope="col" colspan="6">ระดับความคิดเห็น</th>
                        </tr>
                        <tr>
                            <th scope="col">5</th>
                            <th scope="col">4</th>
                            <th scope="col">3</th>
                            <th scope="col">2</th>
                            <th scope="col">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0;$i < count($sub_topic_ex[$b]);$i++){ ?>
                            <?php if(!($sub_topic_ex[$b][$i] == null)){ ?>
                        <tr>
                            <th scope="row"><?php echo $i+1; ?></th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $sub_topic_ex[$b][$i]; ?></div></td>	

                                <?php  if($score_ex[$b][$i] == "พึงพอใจมากที่สุด"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r5"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r5"></div></td>
                                <?php  } ?>

                                <?php if($score_ex[$b][$i] == "พึงพอใจมาก"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r4"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r4"></div></td>
                                <?php  } ?>

                                <?php if($score_ex[$b][$i] == "พึงพอใจปานกลาง"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r3"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r3"></div></td>
                                <?php  } ?>

                                <?php if($score_ex[$b][$i] == "พึงพอใจน้อย"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r2"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r2"></div></td>
                                <?php  } ?>

                                <?php if($score_ex[$b][$i] == "พึงพอใจน้อยที่สุด"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r1"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r1"></div></td>
                                <?php  } ?>

                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                <?php } ?>
                <label class="form-label mt-2">ตอนที่3 ข้อเสนอแนะอื่นๆ</label>
                <div class="rad form-control" id="format">
                    <?php if($row['sati_comment'] != null) { ?>
                        <?php echo $row['sati_comment']; ?>
                    <?php }else { ?>
                        ----เสนอแนะ----
                    <?php } ?>
                </div>
                
            </div>
        </form>
        <button type="button" class="btn btn-primary w-100 mt-2 mb-4" onclick="isClass('<?php echo $class; ?>')">กลับหน้าแรก</button>
    </div>
    <style>
        #format{
            overflow-wrap: break-word;
            display:inline-block; 
            position: relative;
            top: 0;
            text-align: justify;
        }
        .form-control1{
            position: relative;
            
        }
        input[type="radio"]:where(#r1, #r2, #r3, #r4, #r5) {
            height:35px; 
            width:35px; 
            vertical-align: middle;
        }
        #widthfix{
            overflow-x: scroll;
        }
    </style>
    <script type="text/javascript">
        putradio = () =>{
            document.querySelectorAll(`#r5`).forEach(e => {
                if(!e.checked){
                    e.disabled = true;
                }
            });
            document.querySelectorAll(`#r4`).forEach(e => {
                if(!e.checked){
                    e.disabled = true;
                }
            });
            document.querySelectorAll(`#r3`).forEach(e => {
                if(!e.checked){
                    e.disabled = true;
                }
            });
            document.querySelectorAll(`#r2`).forEach(e => {
                if(!e.checked){
                    e.disabled = true;
                }
            });
            document.querySelectorAll(`#r1`).forEach(e => {
                if(!e.checked){
                    e.disabled = true;
                }
            });
        
            
        }
    </script>
    <script src="script/changeclass.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
<?php

session_start();
require 'session/config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
    // echo "<script>";
    // echo "alert('$row');";
    // echo "</script>";
    $genders = preg_split("/,/", $row["sati_gender"]);
    $form_type = preg_split("/,/", $row["sati_type"]);
    $form_education = preg_split("/,/", $row["sati_level"]);
    // print_r($genders);
    $ur = $row['fill_ur_id'];
    $fun = $row['fill_fun_id'];
    $uf = $row['fill_uf_id'];
    $ss = $row['fill_ss_id'];
    
    $result1 = $conn->query("SELECT * FROM tb_fill_user_req  WHERE fill_ur_id = '$ur'"); 
    $result1->execute();
    $row1 = $result1->fetch(PDO::FETCH_ASSOC);
    $ur_topic = preg_split("/@/", $row1["ur_topic"]);
    $ur_radio = preg_split("/@/", $row1["ur_score"]);
    $ur_score = $row1["ur_score"];
    
    $result2 = $conn->query("SELECT * FROM tb_fill_function WHERE fill_fun_id = '$fun'"); 
    $result2->execute();
    $row2 = $result2->fetch(PDO::FETCH_ASSOC);
    $fun_topic = preg_split("/@/", $row2["fun_topic"]);
    $fun_radio = preg_split("/@/", $row2["fun_score"]);
    $fun_score = $row2["fun_score"];
    
    $result3 = $conn->query("SELECT * FROM tb_fill_uesful WHERE fill_uf_id = '$uf'"); 
    $result3->execute();
    $row3 = $result3->fetch(PDO::FETCH_ASSOC);
    $uf_topic = preg_split("/@/", $row3["uf_topic"]);
    $uf_radio = preg_split("/@/", $row3["uf_score"]);
    $uf_score = $row3["uf_score"];
    
    $result4 = $conn->query("SELECT * FROM tb_fill_seurity WHERE fill_ss_id = '$ss'"); 
    $result4->execute();
    $row4 = $result4->fetch(PDO::FETCH_ASSOC);
    $ss_topic = preg_split("/@/", $row4["ss_topic"]);
    $ss_radio = preg_split("/@/", $row4["ss_score"]);
    $ss_score = $row4["ss_score"];


    
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

<body onload="putradio('<?= $ur_score; ?>','<?= $fun_score; ?>','<?= $uf_score; ?>','<?= $ss_score; ?>')" >
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
                <label class="font-bold" for="">ตอนที่ 2 เป็นแบบสอบถามความคิดเห็นของ
                <?php for($i=0;$i < count($form_type);$i++){ ?>
                    <?php if(!($form_type[$i] == null)){ ?>
                    <span class="ms-2"><?php echo $form_type[$i]; ?></span>
                    <?php } ?>
                    <?php } ?> 
                </label><br>
                <span class="rad form-control text-break mb-2" style="width: 100%;"><?php echo $row['sati_ep2']; ?></span>
                <div class="d-flex flex-column w-50 align-items-center">
                    <label class="font-bold d-flex justify-content-start w-100">โดยแบ่งการประเมินเป็น 4 ด้าน คือ</label>
                    <ul class="">
                        <li class="" for="">ด้านที่ 1 ความต้องการของผู้ใช้งานระบบ</li> <br>
                        <li class="" for="">ด้านที่ 2 ด้านการทำงานของฟั่งชั่นระบบ</li> <br>
                        <li class="" for="">ด้านที่ 3 ด้านความง่ายต่อการใช้ระบบ</li> <br>
                        <li class="" for="">ด้านที่ 4 ด้านการใช้งานรักษาความปลอดภัยของข้อมูลในระบบ</li> <br>
                    </ul>
                </div>
                <label class="font-bold" for="">ตอนที่ 3 เป็นข้อคิดเห็นและเสนอแนะอื่นๆ</label> <br>
            </div>
            <!-- Body_Content -->
            <div class="body_content mt-5">
                <label class="form-label font-bold">ตอนที่ 1</label>
                <label for="">ข้อมูลพื้นฐานของผู้กรอกแบบสอบถาม</label><br>
                <div class="w-100">
                    <label class="col-3 col-form-label w-100">1.เพศ 
                    <?php for($i=0;$i < count($genders);$i++){ ?>
                    <?php if(!($genders[$i] == null)){ ?>
                    <input class="rad form-check-input ms-4" type="radio" value="" checked name="" >
                    <?php echo $genders[$i]; ?>
                    <?php } ?>
                    <?php } ?>
                    </label><br>
                    <label class="col-3 col-form-label w-100">2.สถานะของผู้สอบถาม 
                    <?php for($i=0;$i < count($form_type);$i++){ ?>
                    <?php if(!($form_type[$i] == null)){ ?>
                    <input class="rad form-check-input ms-4" type="radio" value="" checked name="" >
                    <?php echo $form_type[$i]; ?>
                    <?php } ?>
                    <?php } ?>
                    </label><br>
                    <label class="col-3 col-form-label w-100">3.ระดับการศึกษา 
                    <?php for($i=0;$i < count($form_education);$i++){ ?>
                    <?php if(!($form_education[$i] == null)){ ?>
                    <input class="rad form-check-input ms-4" type="radio" value="" checked name="" >
                    <?php echo $form_education[$i]; ?>
                    <?php } ?>
                    <?php } ?>
                </div>
                </label><br>

                <label class="form-label">ตอนที่ 2</label>
                <label for="">แบบสอบถามความคิดเห็น</label> <br>
                <label class="form-label mt-2">คำชี้แจง</label>
                <label for="">โปรดบันทึกความคิดเห็นของท่านลงในช่องว่างในแต่ละข้อ</label> <br>
                <!-- Start table -->
                <label class="form-label mt-2">ด้านที่ 1</label>
                <label class="form-label mb-2" id="format">ด้านการนำเข้าข้อมูลระบบ</label>
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
                        <?php for($i = 0;$i < count($ur_topic);$i++){ ?>
                            <?php if(!($ur_topic[$i] == null)){ ?>
                        <tr>
                            <th scope="row"><?php echo $i+1; ?></th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $ur_topic[$i]; ?></div></td>	

                                <?php  if($ur_radio[$i] == "พึงพอใจมากที่สุด"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r5"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r5"></div></td>
                                <?php  } ?>

                                <?php if($ur_radio[$i] == "พึงพอใจมาก"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r4"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r4"></div></td>
                                <?php  } ?>

                                <?php if($ur_radio[$i] == "พึงพอใจปานกลาง"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r3"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r3"></div></td>
                                <?php  } ?>

                                <?php if($ur_radio[$i] == "พึงพอใจน้อย"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r2"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r2"></div></td>
                                <?php  } ?>

                                <?php if($ur_radio[$i] == "พึงพอใจน้อยที่สุด"){ ?>
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
                <label class="form-label mt-2">ด้านที่ 2</label>
                <label class="form-label mb-2" id="format">ด้านการประมวลผล</label>
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
                    <?php for($i = 0;$i < count($fun_topic);$i++){ ?>
                        <?php if(!($fun_topic[$i] == null)){ ?>
                        <tr>
                            <th scope="row"><?php echo $i+1; ?></th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $fun_topic[$i]; ?></div></td>	
                            <?php  if($fun_radio[$i] == "พึงพอใจมากที่สุด"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r5"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r5"></div></td>
                                <?php  } ?>

                                <?php if($fun_radio[$i] == "พึงพอใจมาก"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r4"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r4"></div></td>
                                <?php  } ?>

                                <?php if($fun_radio[$i] == "พึงพอใจปานกลาง"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r3"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r3"></div></td>
                                <?php  } ?>

                                <?php if($fun_radio[$i] == "พึงพอใจน้อย"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r2"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r2"></div></td>
                                <?php  } ?>

                                <?php if($fun_radio[$i] == "พึงพอใจน้อยที่สุด"){ ?>
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
                <label class="form-label mt-2">ด้านที่ 3</label>
                <label class="form-label mb-2" id="format">ด้านการรายงานข้อมูล</label>
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
                    <?php for($i = 0;$i < count($uf_topic);$i++){ ?>
                        <?php if(!($uf_topic[$i] == null)){ ?>
                        <tr>
                            <th scope="row"><?php echo $i+1; ?></th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $uf_topic[$i]; ?></div></td>	
                            <?php  if($uf_radio[$i] == "พึงพอใจมากที่สุด"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r5"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r5"></div></td>
                                <?php  } ?>

                                <?php if($uf_radio[$i] == "พึงพอใจมาก"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r4"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r4"></div></td>
                                <?php  } ?>

                                <?php if($uf_radio[$i] == "พึงพอใจปานกลาง"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r3"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r3"></div></td>
                                <?php  } ?>

                                <?php if($uf_radio[$i] == "พึงพอใจน้อย"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r2"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r2"></div></td>
                                <?php  } ?>

                                <?php if($uf_radio[$i] == "พึงพอใจน้อยที่สุด"){ ?>
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
                <label class="form-label mt-2">ด้านที่ 4</label>
                <label class="form-label mb-2" id="format">ด้านความปลอดภัย</label>
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
                    <?php for($i = 0;$i < count($ss_topic);$i++){ ?>
                        <?php if(!($ss_topic[$i] == null)){ ?>
                        <tr>
                            <th scope="row"><?php echo $i+1; ?></th>
                            <td><div class="form-control1" id="format" rows="3"><?php echo $ss_topic[$i]; ?></div></td>	
                            <?php  if($ss_radio[$i] == "พึงพอใจมากที่สุด"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r5"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r5"></div></td>
                                <?php  } ?>

                                <?php if($ss_radio[$i] == "พึงพอใจมาก"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r4"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r4"></div></td>
                                <?php  } ?>

                                <?php if($ss_radio[$i] == "พึงพอใจปานกลาง"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r3"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r3"></div></td>
                                <?php  } ?>

                                <?php if($ss_radio[$i] == "พึงพอใจน้อย"){ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" checked id="r2"></div></td>
                                <?php  }else{ ?>
                                    <td><div class="form-control1" id="format" rows="3"><input type="radio" name="" id="r2"></div></td>
                                <?php  } ?>

                                <?php if($ss_radio[$i] == "พึงพอใจน้อยที่สุด"){ ?>
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
            /* position: absolute;
            left: 50%;
            transform: translateX(-50%); */
            height:35px; 
            width:35px; 
            vertical-align: middle;
        }
        #widthfix{
            overflow-x: scroll;
        }
    </style>
    <script type="text/javascript">
        putradio = (ur_score,fun_score,uf_score,ss_score) =>{
            const ur_radio = ur_score.split("@");
            const fun_radio = fun_score.split("@");
            const uf_radio = uf_score.split("@");
            const ss_radio = ss_score.split("@");
        //     const rows = document.querySelectorAll('tbody > tr');
        //     console.log(rows);
        //     for (let i in rows) {
        //     for (let key in ur_radio) {
        //         if(ur_radio[key] === "พึงพอใจมากที่สุด"){
        //             document.querySelectorAll(`#r5`)[i].checked = true;
        //         }
        //         else if(ur_radio[key] === "พึงพอใจมาก"){
        //             document.querySelectorAll(`#r4`)[i+1].checked = true;
        //         }
        //         else if(ur_radio[key] === "พึงพอใจปานกลาง"){
        //             document.querySelectorAll(`#r3`)[i].checked = true;
        //         }
        //         else if(ur_radio[key] === "พึงพอใจน้อย"){
        //             document.querySelectorAll(`#r2`)[i].checked = true;
        //         }
        //         else if(ur_radio[key] === "พึงพอใจน้อยที่สุด"){
        //             document.querySelectorAll(`#r1`)[i].checked = true;
        //         }
        //     }
        
        //     fun_radio.forEach((element,key) => {
        //         if(element === "พึงพอใจมากที่สุด"){
        //             document.querySelectorAll(`#r5`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจมาก"){
        //             document.querySelectorAll(`#r4`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจปานกลาง"){
        //             document.querySelectorAll(`#r3`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจน้อย"){
        //             document.querySelectorAll(`#r2`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจน้อยที่สุด"){
        //             document.querySelectorAll(`#r1`)[i].checked = true;
        //         }
        //     });

        //     uf_radio.forEach((element,key) => {
        //         if(element === "พึงพอใจมากที่สุด"){
        //             document.querySelectorAll(`#r5`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจมาก"){
        //             document.querySelectorAll(`#r4`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจปานกลาง"){
        //             document.querySelectorAll(`#r3`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจน้อย"){
        //             document.querySelectorAll(`#r2`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจน้อยที่สุด"){
        //             document.querySelectorAll(`#r1`)[i].checked = true;
        //         }
        //     });

        //     ss_radio.forEach((element,key) => {
        //         if(element === "พึงพอใจมากที่สุด"){
        //             document.querySelectorAll(`#r5`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจมาก"){
        //             document.querySelectorAll(`#r4`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจปานกลาง"){
        //             document.querySelectorAll(`#r3`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจน้อย"){
        //             document.querySelectorAll(`#r2`)[i].checked = true;
        //         }
        //         else if(element === "พึงพอใจน้อยที่สุด"){
        //             document.querySelectorAll(`#r1`)[i].checked = true;
        //         }
        //     });
        // }
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
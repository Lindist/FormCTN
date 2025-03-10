<?php

    session_start();
    require 'config.php';

    if (isset($_POST['register'])) {
        $title = $_POST['title'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $std_id = $_POST['std_id'];
    }

    $_SESSION['show_register'] = true; // Flag to show the register element
    $_SESSION['title'] = $title;
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['std_id'] = $std_id;

    if (empty($fname)) {
        $_SESSION['register_error'] = "กรุณากรอกชื่อจริงของคุณ";
        header("Location: ../index.php");
        exit();
    } else if (empty($lname)) {
        $_SESSION['register_error'] = "กรุณากรอกนามสกุลของคุณ";
        header("location: ../index.php");
        exit();
    } else if (empty($std_id)) {
        $_SESSION['register_error'] = "กรุณากรอกรหัสนักศึกษาของคุณ";
        header("location: ../index.php");
        exit();
    } else if (strlen($std_id) !== 10 && strlen($std_id) !== 11) {
        $_SESSION['register_error'] = "จำนวนรหัสนักศึกษาของคุณไม่กูกต้อง";
        header("location: ../index.php");
        exit();
    } else {

        $checkstd_id = $conn -> prepare("SELECT COUNT(*) FROM tb_member WHERE member_code = ?");
        $checkstd_id -> execute([$std_id]);
        $std_idExists = $checkstd_id -> fetchColumn();

        if ($std_idExists) {
            $_SESSION['register_error'] = "รหัสนักศึกษานี้อยู่ในฐานข้อมูลแล้ว";
            header("location: ../index.php");
            exit();
        } else {

            // if you want to hash std_id
            // $hashedstd_id = password_hash($std_id, PASSWORD_DEFAULT);

            try {

                $stmt = $conn -> prepare("INSERT INTO tb_member(member_title, member_firstname, member_lastname, member_code) VALUES(?, ?, ?, ?)");
                $stmt -> execute([$title, $fname, $lname, $std_id]);

                $_SESSION['register_success'] = "สมัครสมาชิกสำเร็จ คลิก ตกลง เพื่อเข้าสู่ระบบ";
                // echo $title;
                // echo $fname;
                // echo $lname;
                // echo $std_id;
                header("location: ../index.php");
                exit();

            } catch (PDOException $e) {
                $_SESSION['register_error'] = "มีบางอย่างผิดพลาดกรุณาลองใหม่อักครั้ง";
                echo "Registration failed: " . $e->getMessage();
                header("location: ../index.php");
                exit();
            }

        }

    }

?>
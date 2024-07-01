<?php

    session_start();
    require 'config.php';

    $Length = 11;

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
    } else if (empty($lname)) {
        $_SESSION['register_error'] = "กรุณากรอกนามสกุลของคุณ";
        header("location: ../index.php");
    } else if (empty($std_id)) {
        $_SESSION['register_error'] = "กรุณากรอกรหัสนักศึกษาของคุณ";
        header("location: ../index.php");
    } else if (strlen($std_id) !== $Length) {
        $_SESSION['register_error'] = "จำนวนรหัสนักศึกษาของคุณไม่กูกต้อง";
        header("location: ../index.php");
    } else {

        $checkstd_id = $conn -> prepare("SELECT COUNT(*) FROM tb_member WHERE member_code = ?");
        $checkstd_id -> execute([$std_id]);
        $std_idExists = $checkstd_id -> fetchColumn();

        if ($std_idExists) {
            $_SESSION['register_error'] = "รหัสนักศึกษานี้อยู่ในฐานข้อมูลแล้ว";
            header("location: ../index.php");
        } else {

            // if you want to hash std_id
            // $hashedstd_id = password_hash($std_id, PASSWORD_DEFAULT);

            try {

                $stmt = $conn -> prepare("INSERT INTO tb_member(member_title, member_firstname, member_lastname, member_code) VALUES(?, ?, ?, ?)");
                $stmt -> execute([$title, $fname, $lname, $std_id]);

                $_SESSION['register_success'] = "<p>สมัครสมาชิกสำเร็จ</p><a href='#' class='mx-1 hover:underline underline-offset-1' onclick='openPopup()'>คลิกที่นี่</a><p>เพื่อเข้าสู่ระบบ</p>";
                // echo $title;
                // echo $fname;
                // echo $lname;
                // echo $std_id;
                header("location: ../index.php");

            } catch (PDOException $e) {
                $_SESSION['register_error'] = "มีบางอย่างผิดพลาดกรุณาลองใหม่อักครั้ง";
                echo "Registration failed: " . $e->getMessage();
                header("location: ../index.php");
            }

        }

    }

?>
<?php

    session_start();
    require 'config.php';

    $Length = 11;

    // $query 

    if (isset($_POST['login'])) {
        $std_id = $_POST['std_id'];
        $password = $_POST['password'];
    }

    if (empty($std_id)) {
        $_SESSION['login_error'] = 'กรุณากรอกรหัสนักศึกษาของคุณ';
        $_SESSION['show_login'] = true; // Flag to show the login element
        header("location: ../index.php");
    } else if (strlen($std_id) !== $Length) {
        $_SESSION['login_error'] = 'จำนวนรหัสนักศึกษาของคุณไม่กูกต้อง';
        $_SESSION['show_login'] = true; // Flag to show the login element
        header("location: ../index.php");
    } else if (empty($password)) {
        $_SESSION['login_error'] = 'กรุณากรอกรหัสผ่านของคุณ';
        $_SESSION['show_login'] = true; // Flag to show the login element
        header("location: ../index.php");
    } else {
        try {

            $stmt = $conn -> prepare("SELECT * FROM tb_member WHERE member_code = ?");
            $stmt -> execute([$std_id]);
            $userData = $stmt -> fetch();

            if ($password == $userData['member_code']) {
                $_SESSION['user_id'] = $userData['member_id'];
                header("location: ../form.php");
            } else {
                $_SESSION['login_error'] = "รหัสนักศึกษาหรือรหัสผ่านไม่ถูกต้อง";
                $_SESSION['show_login'] = true; // Flag to show the login element
                header("location: ../index.php");
            }

        } catch (PDOException $e) {
            $_SESSION['login_error'] = "มีบางอย่างผิดพลาดกรุณาลองใหม่อักครั้ง";
            $_SESSION['show_login'] = true; // Flag to show the login element
            header("location: ../index.php");
        }
    }

?>
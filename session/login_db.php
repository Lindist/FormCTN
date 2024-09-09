<?php

    session_start();
    require 'config.php';

    // $query 

    if (isset($_POST['login']) && $_POST['std_id'] == "dangtoy" && $_POST['password'] == "adminctn") {
        $_SESSION['admin_id'] = "admin";
        header("Location: ../adminpanel.php");
        exit();
    }

    if (isset($_POST['login'])) {
        $std_id = $_POST['std_id'];
        $password = $_POST['password'];
    } elseif (isset($_SESSION['std_id']) && $_SESSION['password']) {
        $std_id = $_SESSION['std_id'];
        $password = $_SESSION['password'];
    }

    if (empty($std_id)) {
        $_SESSION['login_error'] = 'กรุณากรอกรหัสนักศึกษาของคุณ';
        $_SESSION['show_login'] = true; // Flag to show the login element
        header("location: ../index.php");
        exit();
    } else if (strlen($std_id) !== 10 && strlen($std_id) !== 11) {
        $_SESSION['login_error'] = 'จำนวนรหัสนักศึกษาของคุณไม่กูกต้อง';
        $_SESSION['show_login'] = true; // Flag to show the login element
        header("location: ../index.php");
        exit();
    } else if (empty($password)) {
        $_SESSION['login_error'] = 'กรุณากรอกรหัสผ่านของคุณ';
        $_SESSION['show_login'] = true; // Flag to show the login element
        header("location: ../index.php");
        exit();
    } else {
        try {

            $stmt = $conn -> prepare("SELECT * FROM tb_member WHERE member_code = ?");
            $stmt -> execute([$std_id]);
            $userData = $stmt -> fetch();

            if ($password == $userData['member_code']) {

                if (isset($_POST['login'])) {
                    $_SESSION['user_id'] = $userData['member_id'];
                    $_SESSION['login_success'] = "เข้าสู่ระบบสำเร็จ";
                    header("location: ../form.php");
                    exit();
                } elseif (isset($_SESSION['std_id']) && $_SESSION['password']) {
                    $_SESSION['user_id'] = $userData['member_id'];
                    unset($_SESSION['std_id']);
                    unset($_SESSION['password']);
                    header("location: ../form.php");
                    exit();
                }

                exit();
            } else {
                $_SESSION['login_error'] = "รหัสนักศึกษาหรือรหัสผ่านไม่ถูกต้อง";
                $_SESSION['show_login'] = true; // Flag to show the login element
                header("location: ../index.php");
                exit();
            }

        } catch (PDOException $e) {
            $_SESSION['login_error'] = "มีบางอย่างผิดพลาดกรุณาลองใหม่อักครั้ง";
            $_SESSION['show_login'] = true; // Flag to show the login element
            // setcookie('std_id', '', time() - 3600, "/", $domain, $secure, true);
            // setcookie('password', '', time() - 3600, "/", $domain, $secure, true);
            header("location: ../index.php");
            exit();
        }
    }

?>
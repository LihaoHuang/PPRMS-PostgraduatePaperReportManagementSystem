<?php
    session_start();
    session_destroy();

    $_SESSION['message'] = '帳號已登出';
    print '<script>window.location.replace("../login.php");</script>';
?>
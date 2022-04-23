<?php

try {
    session_start();

    $_SESSION = array();

    session_destroy();

    header('Location:/web日報登録/login.php');
    
} catch (Exception $e) {
    // エラー時の処理
    header('Location:/web日報登録/error.php');
    exit;
}

?>
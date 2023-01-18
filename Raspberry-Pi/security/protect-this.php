<?php
    /* User Password */
    $password = 'Final22';

    if (empty($_COOKIE['password']) || $_COOKIE['password'] !== $password) {
        // When password is incorrect, circle back to login.php
        header('Location: login.php');
        exit;
    }
?>

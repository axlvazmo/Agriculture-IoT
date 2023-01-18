<?php
    /* User Password */
    $password = 'YOUR PASSWORD';

    if (empty($_COOKIE['password']) || $_COOKIE['password'] !== $password) {
        // When password is incorrect, circle back to login.php
        header('Location: login.php');
        exit;
    }
?>

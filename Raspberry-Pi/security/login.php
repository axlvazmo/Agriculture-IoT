<?php
    /* User Password */
    $password = 'Final22';

    /* Redirects to data display after login */
    $redirect_after_login = 'esp-data.php';

    /* Will not ask password again for */
    $remember_password = strtotime('+30 seconds'); // 30 seconds

    if (isset($_POST['password']) && $_POST['password'] == $password) {
        setcookie("password", $password, $remember_password);
        header('Location: ' . $redirect_after_login);
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password protected</title>
</head>
<body>
    <div style="text-align:center;margin-top:50px;">
        You must enter the password to view this content.
        <form method="POST">
            <input type="text" name="password">
        </form>
    </div>
</body>
</html>

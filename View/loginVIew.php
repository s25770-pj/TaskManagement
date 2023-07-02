<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Log in screen</title>
    <link rel="stylesheet" href="<?php echo $login_css?>">
</head>
<body>
    <div id="login_box">
        <h2>Login</h2>
        <form method='POST' id="loginForm"> 
            <div class="user_box">
            <input type="text" name="username" required><br />
            <label>Username</label>
            </div>
            <div class="user_box">
            <input type="password" name="password" required><br />
            <label>Password</label>
            </div>
            <a href="" onclick="document.getElementById('loginForm').submit(); return false;">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Login
            </a>
        </form>
    </div>
    <?php if (!empty($error)): ?>
    <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
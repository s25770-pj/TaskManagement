<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="../CSS/styleRegister.css">
    </head>
    <body>
        <div class="container">
            <h1>Registration</h1>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="error"><?= $_SESSION['error'] ?></div>
            <?php endif; ?>

            <?php if (!empty($data['validationErrors'])): ?>
                <div class="error">
                    <?php foreach ($data['validationErrors'] as $error): ?>
                        <div><?= $error ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username"
                        value="<?= isset($data['username']) ? $data['username'] : '' ?>">
                    <?php if (isset($data['validationErrors']['username'])): ?>
                        <div class="error"><?= $data['validationErrors']['username'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email"
                        value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                    <?php if (isset($data['validationErrors']['email'])): ?>
                        <div class="error"><?= $data['validationErrors']['email'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <?php if (isset($data['validationErrors']['password'])): ?>
                        <div class="error"><?= $data['validationErrors']['password'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="second_password">Repeat Password</label>
                    <input type="password" name="second_password" id="second_password">
                </div>

                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </body>
</html>

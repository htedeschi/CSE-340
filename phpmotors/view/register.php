<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
    <link rel="stylesheet" media="screen" href="../assets/css/login.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Register</h1>
            <main>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

                <form action="/phpmotors/accounts/index.php" method="post">
                    <!-- action name for registering -->
                    <input type="hidden" name="action" value="registerPost">

                    <label for="clientFirstname">* First Name:</label><br>
                    <input type="text" id="clientFirstname" name="clientFirstname" value="<?php echo (isset($clientFirstname) ? $clientFirstname : ''); ?>" autofocus required><br>

                    <label for="clientLastname">* Last Name:</label><br>
                    <input type="text" id="clientLastname" name="clientLastname" value="<?php echo (isset($clientLastname) ? $clientLastname : ''); ?>" required><br>

                    <label for="clientEmail">* Email:</label><br>
                    <input type="email" id="clientEmail" name="clientEmail" value="<?php echo (isset($clientEmail) ? $clientEmail : ''); ?>" required><br>


                    <label for="clientPassword">* Password:</label><br>
                    <span class="muted">There must be 8 characters, any of which may be numbers, any may be non-alphanumeric characters, they may be in any order and can include any number of capital and lower case letters.</span><br>
                    <input type="password" id="clientPassword" name="clientPassword" value="" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>

                    <label for="c_clientPassword">* Confirm Password:</label><br>
                    <input type="password" id="c_clientPassword" name="c_clientPassword" value="" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>

                    <input type="submit" value="Register">
                    <br><br>
                    <span class="muted red">* = Field required</span>
                </form>
                <br><br>
                <a class="a-register" href="/phpmotors/accounts/?action=login">Go back to Login</a>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
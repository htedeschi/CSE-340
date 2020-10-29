<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
    <link rel="stylesheet" media="screen" href="../assets/css/login.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Login</h1>
            <main>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

                <form action="#" method="post">
                    <label for="clientEmail">Email:</label><br>
                    <input type="email" id="clientEmail" name="clientEmail" value="" autofocus required><br>
                    <label for="clientPassword">Password:</label><br>
                    <input type="password" id="clientPassword" name="clientPassword" value="" required><br><br>
                    <input type="submit" value="Login">
                </form>
                <br>
                <a class="a-register" href="/phpmotors/accounts/?action=register">Register here</a>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
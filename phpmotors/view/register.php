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
            <h1>Login</h1>
            <main>
                <form action="#" method="post">
                    <label for="clientFirstname">* First Name:</label><br>
                    <input type="text" id="clientFirstname" name="clientFirstname" value="" autofocus><br>
                    <label for="clientLastname">* Last Name:</label><br>
                    <input type="text" id="clientLastname" name="clientLastname" value=""><br>
                    <label for="clientEmail">* Email:</label><br>
                    <input type="email" id="clientEmail" name="clientEmail" value=""><br> 
                    <label for="clientPassword">* Password:</label><br>
                    <input type="password" id="clientPassword" name="clientPassword" value=""><br>
                    <label for="c_clientPassword">* Confirm Password:</label><br>
                    <input type="password" id="c_clientPassword" name="c_clientPassword" value=""><br><br>
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
<?php
if (!isset($_SESSION) || !$_SESSION['loggedin']) {
    header('location: /phpmotors/');
    exit;
}

// var_dump($_SESSION);
// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Personal Info | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
    <link rel="stylesheet" media="screen" href="../assets/css/login.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Update Account Information</h1>
            <main>
                <?php
                if (isset($messageUpdAcc)) {
                    echo $messageUpdAcc;
                }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2>Update Account Info</h2>
                    <!-- action name for updating acc info -->
                    <input type="hidden" name="action" value="updateAccountPost">
                    <input type="hidden" name="cliId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
                    
                    <label for="clientFirstname">First Name:</label><br>
                    <input type="text" id="clientFirstname" name="clientFirstname" value="<?php echo (isset($_SESSION['clientData']['clientFirstname']) ? $_SESSION['clientData']['clientFirstname'] : ''); ?>" required><br>
                    
                    <label for="clientLastname">Last Name:</label><br>
                    <input type="text" id="clientLastname" name="clientLastname" value="<?php echo (isset($_SESSION['clientData']['clientLastname']) ? $_SESSION['clientData']['clientLastname'] : ''); ?>" required><br>
                    
                    <label for="clientEmail">Email:</label><br>
                    <input type="email" id="clientEmail" name="clientEmail" value="<?php echo (isset($_SESSION['clientData']['clientEmail']) ? $_SESSION['clientData']['clientEmail'] : ''); ?>" required><br><br>
                    
                    <input type="submit" value="Update Info">
                </form>
                
                <br>
                
                <?php
                if (isset($messageUpdPwd)) {
                    echo $messageUpdPwd;
                }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2>Update Password</h2>
                    <!-- action name for updating password -->
                    <input type="hidden" name="action" value="updatePasswrd">
                    <input type="hidden" name="cliId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
                    
                    <label for="clientPassword">Password:</label><br>
                    <input type="password" id="clientPassword" name="clientPassword" value="" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>

                    <p class="muted">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</p>
                    <p class="red">* note your original password will be changed.</p>

                    <input type="submit" value="Update Password">
                </form>

            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
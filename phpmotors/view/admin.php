<?php
if (!$_SESSION['loggedin']) {
    header('Location: /phpmotors/');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <main>
                <h1><?php echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname']; ?></h1>
                <ul>
                    <li>Client ID: <?php echo $_SESSION['clientData']['clientId']; ?></li>
                    <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                    <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                    <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
                    <li>Level: <?php echo $_SESSION['clientData']['clientLevel']; ?></li>
                </ul>

                <?php
                if (intval($_SESSION['clientData']['clientLevel']) > 1)
                    echo "<p><a href='/phpmotors/vehicles/'>Vehicle Management</a></p>";
                ?>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
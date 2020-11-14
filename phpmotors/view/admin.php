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
                <p><?php echo ($_SESSION['loggedin'] ? 'You are logged in.' : ''); ?></p>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                ?>
                <ul>
                    <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                    <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                    <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
                </ul>

                <h2>Account Management</h2>
                <p>Use this link to update account information</p>
                <p><a href='/phpmotors/accounts/?action=update'>Update account information</a></p>

                <?php
                if (intval($_SESSION['clientData']['clientLevel']) > 1) {
                    echo "<h2>Inventory Management</h2>";
                    echo "<p>Use this link to manage the inventory</p>";
                    echo "<p><a href='/phpmotors/vehicles/'>Vehicle Management</a></p>";
                }
                ?>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
<?php unset($_SESSION['message']); ?>
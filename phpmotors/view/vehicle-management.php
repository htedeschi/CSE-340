<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
    <link rel="stylesheet" media="screen" href="../assets/css/vehicle-management.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Vehicle Management</h1>
            <main>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <a href="/phpmotors/vehicles/?action=addClassification">Add Classification</a>
                <br>
                <a href="/phpmotors/vehicles/?action=addVehicle">Add Vehicle</a>


                <?php
                if (isset($classificationListSelect)) {
                    echo '<h2>Vehicles By Classification</h2>';
                    echo '<p>Choose a classification to see those vehicles</p>';
                    echo $classificationListSelect;
                }
                ?>

                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>

                <table id="inventoryDisplay"></table>

            </main>
        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>

    <script src="../assets/js/inventory.js"></script>

</body>

</html>
<?php unset($_SESSION['message']); ?>
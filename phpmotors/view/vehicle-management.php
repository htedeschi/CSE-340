<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Vehicle Management</h1>
            <main>
                <a href="/phpmotors/vehicles/?action=addClassification">Add Classification</a>
                <br>
                <a href="/phpmotors/vehicles/?action=addVehicle">Add Vehicle</a>
            </main>
        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
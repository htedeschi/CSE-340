<?php
if (!$vehicle || !isset($vehicle) || count($vehicle) <= 0) {
    header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found", true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($vehicle && isset($vehicle) && count($vehicle) > 0 ? "$vehicle[invMake] $vehicle[invModel] | " : ""); ?>PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
    <link rel="stylesheet" media="screen" href="../assets/css/vehicle-detail.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <main>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <div class="contaner">
                    <?php echo (isset($vehicleHtml) ? $vehicleHtml : ""); ?>
                </div>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
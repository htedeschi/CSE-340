<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Delete $invMake $invModel";
        }
        ?> | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
    <link rel="stylesheet" media="screen" href="../assets/css/add-class.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                } elseif (isset($invMake) && isset($invModel)) {
                    echo "Delete$invMake $invModel";
                } ?></h1>
            <main>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <!-- action name for registering -->
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="<?php echo (isset($invInfo['invId']) ? $invInfo['invId'] : '') ?>">

                    <label for="invMake">Make:</label><br>
                    <input type="text" id="invMake" name="invMake" value="<?php echo (isset($data['invMake']) && !empty($data['invMake'])) ? $data['invMake'] : (isset($invInfo['invMake']) ? $invInfo['invMake'] : '') ?>" readonly><br>

                    <label for="invModel">Model:</label><br>
                    <input type="text" id="invModel" name="invModel" value="<?php echo (isset($data['invModel']) && !empty($data['invModel'])) ? $data['invModel'] : (isset($invInfo['invModel']) ? $invInfo['invModel'] : '') ?>" readonly><br>

                    <label for="invDescription">Description:</label><br>
                    <textarea cols="66" rows="4" name="invDescription" id="invDescription" readonly><?php echo (isset($data['invDescription']) && !empty($data['invDescription'])) ? $data['invDescription'] : (isset($invInfo['invDescription']) ? $invInfo['invDescription'] : '') ?></textarea><br>                    
                    <br><br>

                    <p class="red">Confirm Vehicle Deletion. The delete is permanent.</p>

                    <input class="red" type="submit" value="Delete Vehicle">
                    <br><br>
                </form>
                <br><br>
                <a class="a-register" href="/phpmotors/vehicles/">Go back to management</a>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
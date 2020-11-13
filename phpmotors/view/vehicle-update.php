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
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify $invMake $invModel";
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
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                } elseif (isset($invMake) && isset($invModel)) {
                    echo "Modify$invMake $invModel";
                } ?></h1>
            <main>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <!-- action name for registering -->
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="<?php echo (isset($invInfo['invId']) ? $invInfo['invId'] : (isset($invId) ? $invId : '')) ?>">

                    <label for="classificationId">Classification</label><br>
                    <select id="classificationId" name="classificationId" autofocus required>
                        <option value="" disabled <?php echo (!isset($data['classificationId']) || empty($data['classificationId']) || !isset($invInfo['classificationId']) || empty($invInfo['classificationId'])) ? 'selected' : '' ?>>SELECT A CLASSIFICATION</option>
                        <?php
                        foreach ($classificationList as $key => $value) {
                            echo '<option value="' . $key . '"' . (isset($data['classificationId']) && !empty($data['classificationId']) && $data['classificationId'] ==  $key ? 'selected' : (isset($invInfo['classificationId']) && $key == $invInfo['classificationId'] ? 'selected' : '')) . '>' . $value . '</option>';
                        }
                        ?>
                    </select>
                    <br>
                    <label for="invMake">* Make:</label><br>
                    <input type="text" id="invMake" name="invMake" value="<?php echo (isset($data['invMake']) && !empty($data['invMake'])) ? $data['invMake'] : (isset($invInfo['invMake']) ? $invInfo['invMake'] : '') ?>" required><br>

                    <label for="invModel">* Model:</label><br>
                    <input type="text" id="invModel" name="invModel" value="<?php echo (isset($data['invModel']) && !empty($data['invModel'])) ? $data['invModel'] : (isset($invInfo['invModel']) ? $invInfo['invModel'] : '') ?>" required><br>

                    <label for="invDescription">* Description:</label><br>
                    <textarea cols="66" rows="4" name="invDescription" id="invDescription" required><?php echo (isset($data['invDescription']) && !empty($data['invDescription'])) ? $data['invDescription'] : (isset($invInfo['invDescription']) ? $invInfo['invDescription'] : '') ?></textarea><br>

                    <label for="invImage">Image Path:</label><br>
                    <input type="text" id="invImage" name="invImage" value="/images/no-image.png"><br>

                    <label for="invThumbnail">Thumbnail Path:</label><br>
                    <input type="text" id="invThumbnail" name="invThumbnail" value="/images/no-image.png"><br>

                    <label for="invPrice">* Price:</label><br>
                    <input type="number" min="0" step="0.01" id="invPrice" name="invPrice" value="<?php echo (isset($data['invPrice']) && !empty($data['invPrice'])) ? $data['invPrice'] : (isset($invInfo['invPrice']) ? $invInfo['invPrice'] : '') ?>" required><br>

                    <label for="invStock">* Number in Stock:</label><br>
                    <input type="number" min="0" id="invStock" name="invStock" value="<?php echo (isset($data['invStock']) && !empty($data['invStock'])) ? $data['invStock'] : (isset($invInfo['invStock']) ? $invInfo['invStock'] : '') ?>" required><br>

                    <label for="invColor">* Color:</label><br>
                    <input type="text" id="invColor" name="invColor" value="<?php echo (isset($data['invColor']) && !empty($data['invColor'])) ? $data['invColor'] : (isset($invInfo['invColor']) ? $invInfo['invColor'] : '') ?>" required><br>
                    <br><br>
                    <input type="submit" value="Update Vehicle">
                    <br><br>
                    <span class="muted red">* = Field required</span>
                </form>
                <br><br>
                <a class="a-register" href="/phpmotors/vehicles/">Go back to management</a>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
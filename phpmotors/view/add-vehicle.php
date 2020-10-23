<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
    <link rel="stylesheet" media="screen" href="../assets/css/add-class.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Add Vehicle</h1>
            <main>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="classificationId">Classification</label><br>
                    <select id="classificationId" name="classificationId">
                        <option value="" disabled selected>SELECT A CLASSIFICATION</option>
                        <?php
                        foreach($classificationList as $key => $value){
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        ?>                        
                    </select>
                    <br>
                    <label for="invMake">* Make:</label><br>
                    <input type="text" id="invMake" name="invMake" value="" autofocus><br>
                    <label for="invModel">* Model:</label><br>
                    <input type="text" id="invModel" name="invModel" value=""><br>
                    <label for="invDescription">* Description:</label><br>
                    <textarea cols="66" rows="4" name ="invDescription" id="invDescription" ></textarea><br>
                    <label for="invImage">Image Path:</label><br>
                    <input type="text" id="invImage" name="invImage" value="/images/no-image.png"><br>
                    <label for="invThumbnail">Thumbnail Path:</label><br>
                    <input type="text" id="invThumbnail" name="invThumbnail" value="/images/no-image.png"><br>
                    <label for="invPrice">* Price:</label><br>
                    <input type="number" min="0" id="invPrice" name="invPrice" value=""><br>
                    <label for="invStock">* Number in Stock:</label><br>
                    <input type="number" min="0" id="invStock" name="invStock" value=""><br>
                    <label for="invColor">* Color:</label><br>
                    <input type="text" id="invColor" name="invColor" value=""><br>
                    <br>
                    <?php echo (isset($_GET['message']) ? $_GET['message'] : ''); ?>
                    <br><br>
                    <input type="submit" value="Add Vehicle">
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
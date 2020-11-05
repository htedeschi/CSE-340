<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Classification | PHP Motors</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
    <link rel="stylesheet" media="screen" href="../assets/css/add-class.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Add Classification</h1>
            <main>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <!-- action name for registering -->
                    <input type="hidden" name="action" value="addClassificationPost">

                    <label for="classificationName">* Classification:</label><br>
                    <input type="text" id="classificationName" name="classificationName" value="<?php echo (isset($classificationName) && !empty($classificationName)) ? $classificationName : '' ?>" autofocus  required><br>
                    <br><br>
                    <input type="submit" value="Add Classification">
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
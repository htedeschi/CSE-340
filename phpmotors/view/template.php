<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors</title>

    <link rel="stylesheet" media="screen" href="./assets/css/template.css">
</head>

<body>
    <div class="container">
        <div class="top">
            <div id="div-logo">
                <img src="./assets/images/site/logo.png" alt="PHP Motors Logo" />
            </div>
            <div id="div-my-account">
                <a href="#">My Account</a>
            </div>
        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Content Title Here</h1>
            <main>

            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
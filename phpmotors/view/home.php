<?php $currentPage = "home"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors <?php echo ($currentPage ? " - " . strtoupper($currentPage) : "") ?></title>

    <link rel="stylesheet" media="screen" href="./assets/css/template.css">
    <link rel="stylesheet" media="screen" href="./assets/css/home.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <main>
                <h1>Welcome to PHP Motors!</h1>
                <article>
                    <div class="div-vehicle-description">
                        <div class="div-vehicle-details">
                            <h2 class="h2-vehicle-name">DMC Delorean</h2>
                            <ul class="ul-vehicle-items">
                                <li>3 Cup holders</li>
                                <li>Superman doors</li>
                                <li>Fuzzy dice</li>
                            </ul>
                            <a class="a-cta-btn" href="#">Own Today</a>
                        </div>

                        <img class="img-vehicle" src="./assets/images/delorean.jpg" alt="DMC Delorean" />
                    </div>
                    <div class="div-vehicle-extra">
                        <div class="div-vehicle-upgrades">
                            <h3>DMC Delorean Upgrades</h3>
                            <div class="div-upgrades-buttons">
                                <div class="div-upgrade-btn">
                                    <img src="./assets/images/upgrades/flux-cap.png" alt="Icon for flux capacitor">
                                    <a href="#">Flux Capacitor</a>
                                </div>
                                <div class="div-upgrade-btn">
                                    <img src="./assets/images/upgrades/flame.jpg" alt="Icon for flame">
                                    <a href="#">Flame Decals</a>
                                </div>
                                <div class="div-upgrade-btn">
                                    <img src="./assets/images/upgrades/bumper_sticker.jpg" alt="Icon for bumper sticker">
                                    <a href="#">Bumper Stickers</a>
                                </div>
                                <div class="div-upgrade-btn">
                                    <img src="./assets/images/upgrades/hub-cap.jpg" alt="Icon for hub cap">
                                    <a href="#">Hub caps</a>
                                </div>
                            </div>
                        </div>
                        <div class="div-vehicle-reviews">
                            <h3>DMC Delorean Reviews</h3>
                            <ul>
                                <li>"So fast it's almost like traveling in time." (4/5)</li>
                                <li>"Coolest ride in the road." (4/5)</li>
                                <li>"I'm feeling Marty McFly!" (5/5)</li>
                                <li>"The most futuristic rid of our day" (4.5/5)</li>
                                <li>"80's livin and I love it!" (5/5)</li>
                            </ul>
                        </div>
                    </div>
                </article>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
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
                <div class="reviews">
                    <hr>
                    <h2>Reviews</h2>
                    <!-- Add new Review -->
                    <?php
                    echo '<p class="red">';
                    echo (isset($_SESSION['message']) ? $_SESSION['message'] : '');
                    echo '</p>';
                    ?>
                    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-add.php' ?>

                    <!-- Get all reviews for this car -->
                    <?php
                    $reviews = getReviewsByInvId($vehicle['invId']);
                    foreach ($reviews as $key => $review) {
                    ?>
                        <div class="review">
                            <p class="head"><?php echo $review['screenName']; ?><small> wrote on </small><?php echo date("F j, Y",strtotime($review['reviewDate'])); ?></p>
                            <p class="review-body"><?php echo $review['reviewText']; ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </main>
        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
<?php unset($_SESSION['message']); ?>
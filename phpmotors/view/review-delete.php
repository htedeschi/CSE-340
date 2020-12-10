<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors | Delete Review</title>

    <link rel="stylesheet" media="screen" href="../assets/css/template.css">
</head>

<body>
    <div class="container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/nav.php' ?>
        <div class="content">
            <h1>Edit Review for <?php echo $review['invMake'] . ' ' . $review['invModel'] ?></h1>
            <main>
                <form action="" method="post">
                    <input type="hidden" name="action" value="delete-post">
                    <input type="hidden" name="reviewId" value="<?php echo $review['reviewId']; ?>">

                    <br>
                    <label for="reviewText">Review Text:</label><br>
                    <textarea name="reviewText" id="reviewText" cols="50" rows="10" disabled><?php echo $review['reviewText']; ?></textarea>
                    <br>
                    <p class="red">Deleting a review cannot be undone, are you sure you want to delete the review?</p>
                    <input type="submit" value="Delete Review">

                </form>
            </main>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/includes/footer.php' ?>
    </div>
</body>

</html>
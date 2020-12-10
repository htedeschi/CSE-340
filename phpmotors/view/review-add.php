<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo '<p>You must <a href="/phpmotors/accounts/?action=login">login</a> to write a review</p>';
    exit;
}

$screenName = strtoupper(substr($_SESSION['clientData']['clientFirstname'], 0, 1)) . ucfirst($_SESSION['clientData']['clientLastname']);

// var_dump($vehicle);
?>
<h3>Review the <?php echo $vehicle['invMake'] . " " . $vehicle['invModel']; ?></h3>
<form action="/phpmotors/reviews/" method="post">
    <input type="hidden" name="action" value="new">
    <input type="hidden" name="invId" value="<?php echo $vehicle['invId']; ?>">

    <label for="screenName">Screen Name:</label><br>
    <input type="text" id="screenName" value="<?php echo $screenName; ?>" disabled />
    <br>
    <label for="reviewText">Review:</label><br>
    <textarea name="reviewText" id="reviewText" cols="50" rows="10" required></textarea>
    <br>
    <input type="submit" value="Submit Review">
</form>
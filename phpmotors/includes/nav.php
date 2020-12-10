<?php
// Check if the firstname cookie exists, get its value
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_COOKIE['firstname'])) {
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }
}
?>
<div class="top">
    <div id="div-logo">
        <img src="/phpmotors/assets/images/site/logo.png" alt="PHP Motors Logo" />
    </div>
    <div id="div-my-account">
        <?php if (isset($cookieFirstname)) {
            echo "<span>Welcome <a href='/phpmotors/accounts/'>$cookieFirstname</a></span>";
        } ?>

        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
            echo '<a href="/phpmotors/accounts/?action=logout">Logout</a>';
        } else {
            echo '<a href="/phpmotors/accounts/?action=login">My Account</a>';
        }
        ?>


    </div>
</div>
<nav>
    <?php echo $navList; ?>
</nav>
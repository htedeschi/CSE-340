<?php
$activePage = null;
if (isset($currentPage) && !empty($currentPage)) {
    $activePage = $currentPage;
}
?>
<nav>
    <a href="#" class="nav-item <?php echo ($activePage && $activePage == "home" ? "active" : ""); ?> ">Home</a>
    <a href="#" class="nav-item">Classic</a>
    <a href="#" class="nav-item">Sports</a>
    <a href="#" class="nav-item">SUV</a>
    <a href="#" class="nav-item">Trucks</a>
    <a href="#" class="nav-item">Used</a>
</nav>
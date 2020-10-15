<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = "<a href='/phpmotors/index.php' class='nav-item' title='View the PHP Motors home page'>Home</a>";
foreach ($classifications as $classification) {
    $navList .= "<a class='nav-item' href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a>";
}
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';
        break;

    case 'register':
        include '../view/register.php';
    break;
    
    default:
    include '../view/login.php';
    
        break;
}

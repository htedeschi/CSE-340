<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Vehicles Model for use as needed
require_once '../model/vehicles.php';

$action = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && !is_null($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && !is_null($_POST) && count($_POST) > 0) {
    $args = array(
        'classificationName'   => FILTER_SANITIZE_STRING,
        'invMake'   => FILTER_SANITIZE_STRING,
        'invModel'  => FILTER_SANITIZE_STRING,
        'invDescription'  => FILTER_SANITIZE_STRING,
        'invPrice'  => FILTER_SANITIZE_NUMBER_FLOAT,
        'invStock'  => FILTER_SANITIZE_STRING,
        'invColor'  => FILTER_SANITIZE_STRING,
        'classificationId'  => FILTER_SANITIZE_NUMBER_INT
    );

    $sanitizedData = filter_var_array($_POST, $args);

    if (isset($_POST['isClassification']) && $_POST['isClassification'] === 'true') {
        $result = insertClassification($sanitizedData['classificationName']);
        $action = ($result['success'] ? '' : 'addClassification');
    } else {
        $result = insertVehicle($sanitizedData);
        $action = 'addVehicle';
    }

    if (!$result['success'] || (isset($result['message']) && $result['message'] != "")) {
        $message = $result['message'];
        header("Location: /phpmotors/vehicles/?action=$action&message=$message");
        exit();
    }
}


// Build a navigation bar using the $classifications array
$classifications = getClassifications();
$navList = "<a href='/phpmotors/index.php' class='nav-item' title='View the PHP Motors home page'>Home</a>";
foreach ($classifications as $classification) {
    $navList .= "<a class='nav-item' href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a>";
}

$classificationList = getClassificationsList();

switch ($action) {
    case 'addClassification':
        include "../view/add-classification.php";
        break;

    case 'addVehicle':
        include "../view/add-vehicle.php";
        break;

    default:
        include '../view/vehicle-management.php';

        break;
}

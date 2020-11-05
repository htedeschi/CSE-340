<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Vehicles Model for use as needed
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


// Build a navigation bar using the $classifications array
$buildNavigation = getClassifications();
$navList = buildNavigation($buildNavigation);

$classificationList = getClassificationsList();

switch ($action) {
    case 'addClassification':
        include "../view/add-classification.php";
    break;
    
    case 'addVehicle':
        include "../view/add-vehicle.php";
    break;
    
    case 'addClassificationPost':
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

        $classificationName = checkClassificationName($classificationName);

        // Check for missing data
        if (empty($classificationName)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include "../view/add-classification.php";
            exit;
        }
        
        // Send the data to the model
        $regOutcome = insertClassification($classificationName);
        
        // Check and report the result
        if ($regOutcome === 1) {
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p>Sorry but the adding of a new classification failed. Please try again.\nErr: $regOutcome</p>";
            include "../view/add-classification.php";
            exit;
        }

        break;
    case 'addVehiclePost':
        // sanitize all the data in post
        $data = sanitizeVehicle($_POST);

        // check if valid inputs
        if (!checkVehicle($data)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include "../view/add-vehicle.php";
            exit;
        }

        // Send the data to the model
        $regOutcome = insertVehicle($data);

        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p>The " . $data['invMake'] . " " . $data['invModel'] . " was added successfully</p>";
            unset($data);
            include "../view/add-vehicle.php";
            exit;
        } else {
            $message = "<p>Sorry but adding the " . $data['invMake'] . " " . $data['invModel'] . " failed. Please try again.\nErr: $regOutcome</p>";
            include "../view/add-vehicle.php";
            exit;
        }
        break;
    default:
        include '../view/vehicle-management.php';

        break;
}

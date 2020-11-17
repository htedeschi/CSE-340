<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Vehicles Model for use as needed
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';


// Create or access a Session
session_start();


// // Check if user can see these pages, if not, send them back
// if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || intval($_SESSION['clientData']['clientLevel']) <= 1) {
//     header('Location: /phpmotors/');
//     exit;
// }

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
            $message = "<p class='green'>The " . $data['invMake'] . " " . $data['invModel'] . " was added successfully</p>";
            unset($data);
            include "../view/add-vehicle.php";
            exit;
        } else {
            $message = "<p>Sorry but adding the " . $data['invMake'] . " " . $data['invModel'] . " failed. Please try again.\nErr: $regOutcome</p>";
            include "../view/add-vehicle.php";
            exit;
        }
        break;

        /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);

        if (!$invInfo || count($invInfo) < 1) {
            $message = '<p>Sorry, no vehicle information could be found.</p>';
        }
        include '../view/vehicle-update.php';
        exit;
        break;

    case 'updateVehicle':
        // sanitize all the data in post
        $data = sanitizeVehicle($_POST);

        // check if valid inputs
        if (!checkVehicle($data)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include "../view/add-vehicle.php";
            exit;
        }

        // Send the data to the model
        $updateResult = updateVehicle($data);

        // Check and report the result
        if ($updateResult === 1) {
            $message = "<p class='green'>The " . $data['invMake'] . " " . $data['invModel'] . " was updated successfully</p>";
            unset($data);
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Sorry but updated the " . $data['invMake'] . " " . $data['invModel'] . " failed. Please try again.\nErr: $updateResult</p>";
            include "../view/vehicle-update.php";
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (!$invInfo || count($invInfo) < 1) {
            $message = '<p>Sorry, no vehicle information could be found.</p>';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    case 'deleteVehicle':
        // sanitize all the data in post
        $data = sanitizeVehicle($_POST);

        // Send the data to the model
        $deleteResult = deleteVehicle($data);

        // Check and report the result
        if ($deleteResult === 1) {
            $message = "<p class='green'>The " . $data['invMake'] . " " . $data['invModel'] . " was deleted successfully</p>";
            unset($data);
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Sorry but deleting the " . $data['invMake'] . " " . $data['invModel'] . " failed. Please try again.\nErr: $deleteResult</p>";
            unset($data);
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles) || empty($vehicles)) {
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }

        include '../view/classification.php';
        break;
    case 'detail':
        $invId = intval(filter_input(INPUT_GET, 'carId', FILTER_VALIDATE_INT));
        $vehicle = array();
        $vehicle = getInvItemInfo($invId);

        // var_dump($vehicle);
        // exit;

        if (!$vehicle || !count($vehicle) || empty($vehicle)) {
            $message = "<p class='notice'>Sorry, the vehicle you are looking for could not be found.</p>";
        } else {
            $vehicleHtml = buildVehicleDetail($vehicle);
        }

        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationListSelect = buildClassificationList($classificationList);
        include '../view/vehicle-management.php';

        break;
}

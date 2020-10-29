<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Vehicles Model for use as needed
require_once '../model/vehicles-model.php';


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && !is_null($_POST) && count($_POST) > 0) {
//     $args = array(
//         'classificationName'   => FILTER_SANITIZE_STRING,
//         'invMake'   => FILTER_SANITIZE_STRING,
//         'invModel'  => FILTER_SANITIZE_STRING,
//         'invDescription'  => FILTER_SANITIZE_STRING,
//         'invPrice'  => FILTER_SANITIZE_NUMBER_FLOAT,
//         'invStock'  => FILTER_SANITIZE_STRING,
//         'invColor'  => FILTER_SANITIZE_STRING,
//         'classificationId'  => FILTER_SANITIZE_NUMBER_INT
//     );

//     $sanitizedData = filter_var_array($_POST, $args);

//     if (isset($_POST['isClassification']) && $_POST['isClassification'] === 'true') {
//         $result = insertClassification($sanitizedData['classificationName']);
//         $action = ($result['success'] ? '' : 'addClassification');
//     } else {
//         $result = insertVehicle($sanitizedData);
//         $action = 'addVehicle';
//     }

//     if (!$result['success'] || (isset($result['message']) && $result['message'] != "")) {
//         $message = $result['message'];
//         header("Location: /phpmotors/vehicles/?action=$action&message=$message");
//         exit();
//     }
// }


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
    
    case 'addClassificationPost':
        $classificationName = filter_input(INPUT_POST, 'classificationName');

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
        $args = array(
            'classificationName'   => FILTER_SANITIZE_STRING,
            'invMake'   => FILTER_SANITIZE_STRING,
            'invModel'  => FILTER_SANITIZE_STRING,
            'invDescription'  => FILTER_SANITIZE_STRING,
            'invImage'  => FILTER_SANITIZE_STRING,
            'invThumbnail'  => FILTER_SANITIZE_STRING,
            'invPrice'  => FILTER_SANITIZE_NUMBER_FLOAT,
            'invStock'  => FILTER_SANITIZE_STRING,
            'invColor'  => FILTER_SANITIZE_STRING,
            'classificationId'  => FILTER_SANITIZE_NUMBER_INT
        );

        $data = filter_var_array($_POST, $args);

        if (
            is_null($data) || !isset($data) ||
            !isset($data['invMake']) || is_null($data['invMake']) || $data['invMake'] == '' ||
            !isset($data['invModel']) || is_null($data['invModel']) || $data['invModel'] == '' ||
            !isset($data['invDescription']) || is_null($data['invDescription']) || $data['invDescription'] == '' ||
            !isset($data['invPrice']) || is_null($data['invPrice']) || $data['invPrice'] == '' ||
            !isset($data['invStock']) || is_null($data['invStock']) || $data['invStock'] == '' ||
            !isset($data['invColor']) || is_null($data['invColor']) || $data['invColor'] == '' ||
            !isset($data['classificationId']) || is_null($data['classificationId']) || $data['classificationId'] == ''
        ) {
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

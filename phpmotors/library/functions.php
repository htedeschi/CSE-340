<?php

// Build a navigation bar using the $carclassifications array
function buildNavigation($carclassifications)
{
    // Creates navList variable and adds the Home page link
    $navList = "<a href='/phpmotors/' class='nav-item' title='View the PHP Motors home page'>Home</a>";

    // for every item in the carclassifications, create a link and add it to navList var
    foreach ($carclassifications as $classification) {
        $navList .= "<a class='nav-item' href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a>";
    }

    // returns the string for the navbar built based on the $carclassifications array
    return $navList;
}

function checkEmail($clientEmail)
{
    return filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
}

function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

function checkClassificationName($classificationName)
{
    return filter_var($classificationName, FILTER_SANITIZE_STRING);
}

function sanitizeVehicle($data)
{
    $args = array(
        'classificationName'   => FILTER_SANITIZE_STRING,
        'invId'   => FILTER_SANITIZE_NUMBER_INT,
        'invMake'   => FILTER_SANITIZE_STRING,
        'invModel'  => FILTER_SANITIZE_STRING,
        'invDescription'  => FILTER_SANITIZE_STRING,
        'invImage'  => FILTER_SANITIZE_STRING,
        'invThumbnail'  => FILTER_SANITIZE_STRING,
        'invPrice'  => [FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION],
        'invStock'  => FILTER_SANITIZE_STRING,
        'invColor'  => FILTER_SANITIZE_STRING,
        'classificationId'  => FILTER_SANITIZE_NUMBER_INT
    );

    return filter_var_array($data, $args);
}

function checkVehicle($data)
{
    return !is_null($data) && isset($data) &&
        isset($data['invMake']) && !is_null($data['invMake']) && $data['invMake'] != '' &&
        isset($data['invModel']) && !is_null($data['invModel']) && $data['invModel'] != '' &&
        isset($data['invDescription']) && !is_null($data['invDescription']) && $data['invDescription'] != '' &&
        isset($data['invPrice']) && !is_null($data['invPrice']) && $data['invPrice'] != '' &&
        isset($data['invStock']) && !is_null($data['invStock']) && $data['invStock'] != '' &&
        isset($data['invColor']) && !is_null($data['invColor']) && $data['invColor'] != '' &&
        isset($data['classificationId']) && !is_null($data['classificationId']) && $data['classificationId'] != '';
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $k => $v) {
        $classificationList .= "<option value='$k'>$v</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

# builds a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<img class='car-thumbnail' src='/phpmotors$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$vehicle[invPrice]</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

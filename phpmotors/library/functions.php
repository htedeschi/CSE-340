<?php

// Build a navigation bar using the $carclassifications array
function buildNavigation($carclassifications)
{
    // Creates navList variable and adds the Home page link
    $navList = "<a href='/phpmotors/index.php' class='nav-item' title='View the PHP Motors home page'>Home</a>";

    // for every item in the carclassifications, create a link and add it to navList var
    foreach ($carclassifications as $classification) {
        $navList .= "<a class='nav-item' href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a>";
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

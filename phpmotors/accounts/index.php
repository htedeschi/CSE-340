<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Accounts model for use as needed
require_once '../model/accounts-model.php';

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

    case 'registerPost':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');
        $c_clientPassword = filter_input(INPUT_POST, 'c_clientPassword');


        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/register.php';
            exit;
        }

        // Check if different passwords in confirmation
        if ($clientPassword !== $c_clientPassword) {
            $message = '<p>Password confimation does not match the password typed.</p>';
            include '../view/register.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/register.php';
            exit;
        }
        break;

    default:
        include '../view/login.php';

        break;
}

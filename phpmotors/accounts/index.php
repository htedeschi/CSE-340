<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Accounts model for use as needed
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';


$buildNavigation = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNavigation($buildNavigation);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';
        break;

    case 'loginPost':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        // Check if email is valid
        $clientEmail = checkEmail($clientEmail);

        // Check if password is valid
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientEmail) || empty($clientPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
        }

        if (!$checkPassword) {
            $message = '<p>Password does not match the requirements, try again.</p>';
            include '../view/login.php';
            exit;
        }

        // Check if info matches DB to say Logged In!
        $message = '<p>Loggged in!</p>';
        include '../view/login.php';
        break;

    case 'register':
        include '../view/register.php';
        break;

    case 'registerPost':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $c_clientPassword = filter_input(INPUT_POST, 'c_clientPassword', FILTER_SANITIZE_STRING);

        // Check if email is valid
        $clientEmail = checkEmail($clientEmail);

        // Check if password is valid
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/register.php';
            exit;
        }

        // Check if email is already registered
        if (checkExistingEmail($clientEmail)) {
            $message = '<p>That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        if (!$checkPassword) {
            $message = '<p>Password does not match the requirements, try again.</p>';
            include '../view/register.php';
            exit;
        }

        // Check if different passwords in confirmation
        if ($clientPassword !== $c_clientPassword) {
            $message = '<p>Password confimation does not match the password typed.</p>';
            include '../view/register.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

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

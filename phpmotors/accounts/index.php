<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Accounts model for use as needed
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';


// Create or access a Session
session_start();

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
            $message = '<p>Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

        if (!$checkPassword) {
            $message = '<p>Password does not match the requirements, try again.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        // "delete" cookie
        setcookie("firstname", null, time() - 3600, "/");
        unset($_COOKIE['firstname']);
        // set the firstname cookie
        // setcookie("firstname", $_SESSION['clientData']['clientFirstname'], strtotime("+ 1 year"), "/");

        // Send them to the admin view
        // include '../view/admin.php';
        header('Location: /phpmotors/accounts');
        exit;
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
            setcookie("firstname", $clientFirstname, strtotime("+ 1 year"), "/");

            // $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            // include '../view/login.php';
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/register.php';
            exit;
        }
        break;

    case 'logout':
        setcookie("firstname", $_SESSION['clientData']['clientFirstname'], strtotime("+ 1 hour"), "/");
        session_destroy();
        header('Location: /phpmotors/');
        exit;
        break;

    case 'update':
        include '../view/client-update.php';
        break;
    case 'updateAccountPost':
        $clientId = intval(filter_input(INPUT_POST, 'cliId', FILTER_SANITIZE_NUMBER_INT));
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);

        if ($clientEmail !== $_SESSION['clientData']['clientEmail']) {
            if (checkExistingEmail($clientEmail)) {
                $messageUpdAcc = '<p>That email address already exists. Use a different email.</p>';
                include '../view/client-update.php';
                exit;
            }
        }

        $updateResult = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail);

        if ($updateResult > 0) {
            $message = "<p class='green'>The user account was updated successfully</p>";
            $_SESSION['message'] = $message;
            // Query the client data based on the email address
            $clientData = getClientById($clientId);

            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;

            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='red'>Sorry but updating the user account has failed. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        }

        break;
    case 'updatePasswrd':
        $clientId = intval(filter_input(INPUT_POST, 'cliId', FILTER_SANITIZE_NUMBER_INT));
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        // Check if password is valid
        $checkPassword = checkPassword($clientPassword);

        if (!$checkPassword) {
            $messageUpdPwd = '<p class="red">Password does not match the requirements, try again.</p>';
            include '../view/client-update.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $updateResult = updateClientPassword($clientId, $hashedPassword);

        if ($updateResult > 0) {
            $message = "<p class='green'>The user password was updated successfully</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='red'>Sorry but updating the user password has failed. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        }

        break;
    default:
        include '../view/admin.php';
        break;
}

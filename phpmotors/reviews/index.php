<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Reviews model for use as needed
require_once '../model/reviews-model.php';
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
    case 'get-by-inv':

    case 'new':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $data = array(
            'invId' => $invId,
            'reviewText' => filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING),
            'clientId' => $_SESSION['clientData']['clientId'],
        );

        if (!$data['reviewText'] || empty($data['reviewText']) || $data['reviewText'] == "") {
            $_SESSION['message'] = "The review was NOT added, the field was empty.";
            header("Location: /phpmotors/vehicles/?action=detail&carId=" . $invId);
            exit;
        }

        $result = insert($data);

        if ($result > 0) {
            $_SESSION['message'] = "Thanks for the review, it is displayed below.";
        } else {
            $_SESSION['message'] = "An error occurred, please try again, or contact the administrator of this site.";
        }

        header("Location: /phpmotors/vehicles/?action=detail&carId=" . $invId);
        exit;
        break;

    case 'edit':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $review = getById($reviewId);
        include '../view/review-edit.php';
        break;

    case 'edit-post':
        $data = array(
            'reviewId' => filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT),
            'reviewText' => filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING),
            'clientId' => $_SESSION['clientData']['clientId'],
        );

        if (!$data['reviewText'] || empty($data['reviewText']) || $data['reviewText'] == "") {
            $_SESSION['message'] = "The review was NOT updated, the field was empty.";
            header("Location: /phpmotors/accounts");
            exit;
        }

        $result = update($data);

        if ($result > 0) {
            $_SESSION['message'] = "The review was updated successfully.";
        }

        header("Location: /phpmotors/accounts");
        exit;
        break;

    case 'delete':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $review = getById($reviewId);
        include '../view/review-delete.php';
        break;
        break;

    case 'delete-post':
        #code
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $review = getById($reviewId);
        $result = delete($reviewId);

        if ($result > 0) {
            $_SESSION['message'] = "The review for the " . $review['invMake'] . " " . $review['invModel'] . " was successfully deleted.";
        } else {
            $_SESSION['message'] = "An error occurred, please try again, or contact the administrator of this site.";
        }

        header("Location: /phpmotors/accounts");
        exit;
        break;

    default:
        # code...
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            include("../view/admin.php");
        } else {
            header("Location: /phpmotors/");
        }
        break;
}

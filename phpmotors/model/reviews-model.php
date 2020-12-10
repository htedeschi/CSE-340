<?php

/**
 * Inserts a review into the database, and returns the number of items added
 *
 * @param  array $data Array with reviewText, invId, and clientId
 * @return int Number of items deleted
 */
function insert(array $data): int
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'INSERT INTO `phpmotors`.`reviews` (`reviewText`, `invId`, `clientId`) VALUES (:reviewText, :invId, :clientId);';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $data['reviewText'], PDO::PARAM_STR);
    $stmt->bindValue(':invId', $data['invId'], PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $data['clientId'], PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}

/**
 * Updates a given review in the database, and returns the number of items updated
 *
 * @param  array $data Array with reviewText, reviewId, and clientId
 * @return int Number of items deleted
 */
function update(array $data): int
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'UPDATE `phpmotors`.`reviews` SET `reviewText`=:reviewText WHERE  `reviewId`=:reviewId AND `clientId`=:clientId';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $data['reviewText'], PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $data['reviewId'], PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $data['clientId'], PDO::PARAM_INT);

    // Update the data
    $stmt->execute();

    // Ask how many rows changed as a result of our update
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}

/**
 * Deletes a review from the database, and returns the number of items deleted
 *
 * @param  int $id The review ID
 * @return int Number of items deleted
 */
function delete(int $id): int
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'DELETE FROM `phpmotors`.`reviews` WHERE  `reviewId`=:reviewId;';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $id, PDO::PARAM_INT);

    // Update the data
    $stmt->execute();

    // Ask how many rows changed as a result of our delete
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}

/**
 * Gets a review by its id
 *
 * @param  int $id Review ID
 * @return mixed Array with review information
 */
function getById(int $id)
{
    $db = phpmotorsConnect();

    $sql = 'SELECT r.*, i.invMake, i.invModel
    FROM reviews r
    JOIN inventory i ON i.invId = r.invId
    WHERE reviewId = :reviewId';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewId', $id, PDO::PARAM_INT);

    $stmt->execute();

    $review = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $review;
}

/**
 * Gets all reviews by the inventory id
 *
 * @param  int $id Inventory ID
 * @return array Array with all reviews for a vehicle
 */
function getByInvId(int $id): array
{
    $db = phpmotorsConnect();

    $sql = 'SELECT CONCAT(SUBSTR(C.clientFirstname, 1, 1), c.clientLastname) AS screenName, r.reviewText, r.reviewDate
    FROM reviews r
    JOIN clients c ON r.clientId = c.clientId
    WHERE r.invId = :invId
    ORDER BY r.reviewDate';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':invId', $id, PDO::PARAM_INT);

    $stmt->execute();

    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $reviews;
}


/**
 * Gets all reviews by the client id
 *
 * @param  int $id Client ID
 * @return array Array with all reviews given by a client
 */
function getByClientId(int $id): array
{
    $db = phpmotorsConnect();

    $sql = 'SELECT r.*, i.invMake, i.invModel
    FROM reviews r
    JOIN inventory i ON r.invId = i.invId
    WHERE r.clientId = :clientId
    ORDER BY r.reviewDate';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientId', $id, PDO::PARAM_INT);

    $stmt->execute();

    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $inventory;
}

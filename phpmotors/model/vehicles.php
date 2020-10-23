<?php

function getClassificationsList()
{
    $db = phpmotorsConnect();
    $sql = 'SELECT classificationId, classificationName FROM carclassification ORDER BY classificationName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $classifications = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    $stmt->closeCursor();
    return $classifications;
}

function insertClassification($name)
{
    if (is_null($name) || !isset($name) || $name == '')
        return array('success' => false, 'message' => 'Please provide information for all empty form fields');

    $name = filter_var($name, FILTER_SANITIZE_STRING);

    try {
        $db = phpmotorsConnect();
        $sql = "INSERT INTO `phpmotors`.`carclassification` (`classificationName`) VALUES (:classificationName);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':classificationName', $name);
        $stmt->execute();

        return array('success' => true);
    } catch (PDOException $e) {
        return array('success' => false, 'message' => 'An unexpected error occurred. Please contact the admin. (' . $e->getCode() . ')');
    }
}

function insertVehicle($data)
{
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
        return array('success' => false, 'message' => 'Please provide information for all empty form fields');
    }

    $args = array(
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

    $sanitizedData = filter_var_array($data, $args);

    if (!isset($sanitizedData['invImage']) || is_null($sanitizedData['invImage'])) {
        $sanitizedData['invImage'] = '/images/no-image.png';
    }

    if (!isset($sanitizedData['invThumbnail']) || is_null($sanitizedData['invThumbnail'])) {
        $sanitizedData['invThumbnail'] = '/images/no-image.png';
    }

    try {
        $db = phpmotorsConnect();
        $sql = "INSERT INTO `phpmotors`.`inventory` (`invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`)
                VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':invMake', $sanitizedData['invMake']);
        $stmt->bindParam(':invModel', $sanitizedData['invModel']);
        $stmt->bindParam(':invDescription', $sanitizedData['invDescription']);
        $stmt->bindParam(':invImage', $sanitizedData['invImage']);
        $stmt->bindParam(':invThumbnail', $sanitizedData['invThumbnail']);
        $stmt->bindParam(':invPrice', $sanitizedData['invPrice']);
        $stmt->bindParam(':invStock', $sanitizedData['invStock']);
        $stmt->bindParam(':invColor', $sanitizedData['invColor']);
        $stmt->bindParam(':classificationId', $sanitizedData['classificationId']);

        $stmt->execute();

        return array('success' => true, 'message' => 'Vehicle successfully added!');
    } catch (PDOException $e) {
        return array('success' => false, 'message' => 'An unexpected error occurred. Please contact the admin. (' . $e->getCode() . ')');
    }
}

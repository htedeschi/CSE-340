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

function insertClassification($classificationName)
{
    try {
        $db = phpmotorsConnect();
        $sql = "INSERT INTO `phpmotors`.`carclassification` (`classificationName`) VALUES (:classificationName);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':classificationName', $classificationName);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    } catch (PDOException $e) {
        return $e->getCode() . ":" . $e->getMessage();
    }
}

function insertVehicle($data)
{
    try {
        $db = phpmotorsConnect();
        $sql = "INSERT INTO `phpmotors`.`inventory` (`invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`)
                VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':invMake', $data['invMake']);
        $stmt->bindParam(':invModel', $data['invModel']);
        $stmt->bindParam(':invDescription', $data['invDescription']);
        $stmt->bindParam(':invImage', $data['invImage']);
        $stmt->bindParam(':invThumbnail', $data['invThumbnail']);
        $stmt->bindParam(':invPrice', $data['invPrice']);
        $stmt->bindParam(':invStock', $data['invStock']);
        $stmt->bindParam(':invColor', $data['invColor']);
        $stmt->bindParam(':classificationId', $data['classificationId']);

        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    } catch (PDOException $e) {
        return $e->getCode() . ":" . $e->getMessage();
    }
}

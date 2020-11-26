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

# this function will update a vehicle
function updateVehicle($data)
{
    try {
        $db = phpmotorsConnect();
        $sql = "UPDATE inventory 
                SET invMake = :invMake, 
                    invModel = :invModel, 
                    invDescription = :invDescription, 
                    invImage = :invImage, 
                    invThumbnail = :invThumbnail, 
                    invPrice = :invPrice, 
                    invStock = :invStock, 
                    invColor = :invColor, 
                    classificationId = :classificationId 
                WHERE invId = :invId";
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
        $stmt->bindParam(':invId', $data['invId']);

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

# this function will delete a vehicle
function deleteVehicle($data)
{
    try {
        $db = phpmotorsConnect();
        $sql = "DELETE FROM inventory WHERE invId = :invId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':invId', $data['invId']);

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

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId)
{
    $db = phpmotorsConnect();
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

// Get vehicle information by invId
function getInvItemInfo($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

# gets a vehicle by its classification name
function getVehiclesByClassification($classificationName)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * 
            FROM inventory 
            WHERE classificationId IN (
                SELECT classificationId 
                FROM carclassification 
                WHERE classificationName = :classificationName
                )';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

// Get information for all vehicles
function getVehicles()
{
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

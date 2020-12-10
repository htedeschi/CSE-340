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
        $dv .= "<a href='/phpmotors/vehicles/?action=detail&carId=$vehicle[invId]'><img class='car-thumbnail' onerror=\"this.onerror=null; this.src='/phpmotors/assets/images/no-image.png'\" src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= '<hr>';
        $dv .= "<h2><a href='/phpmotors/vehicles/?action=detail&carId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
        $dv .= "<span>\$$vehicle[invPrice]</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

# builds a display of the thumbnails for the vehicle selected
function buildVehicleThumbnails($thumbnails)
{
    $html = '<div class="thumbnails"><h3>Pictures</h3>';

    foreach ($thumbnails as $key => $value) {
        $html .= '<img src="' . $value['imgPath'] . '" alt="Thumbnail">';
    }

    $html .= '</div>';
    return $html;
}

# builds a display of the details for the vehicle selected
function buildVehicleDetail($vehicle)
{
    return "<div class='pictures'>
                <img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com' onerror=\"this.onerror=null; this.src='/phpmotors/assets/images/no-image.png'\">
            </div>
            <div class='details'>
                <h1>$vehicle[invMake] $vehicle[invModel]</h1>
                <h2>\$" . number_format($vehicle['invPrice']) . "</h2>
                <hr>
                <h2>$vehicle[invMake] $vehicle[invModel] Details</h2>

                <h3>Description</h3>
                <p>$vehicle[invDescription]</p>

                <h3>Color</h3>
                <p>$vehicle[invColor]</p>

                <h3>Qty in Stock</h3>
                <p>$vehicle[invStock]</p>

            </div>";
}

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image)
{
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray)
{
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles)
{
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name)
{
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename)
{
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
{

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    } // ends the swith

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
} // ends resizeImage function

function getReviewsByInvId(int $id): array
{
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';
    return getByInvId($id);
}

function getReviewsByClientId(int $id): array
{
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';
    return getByClientId($id);
}

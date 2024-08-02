<?php
require "../includes/database-connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["pictures"]) && $_FILES["pictures"]["error"] === 0) {
        
        // Begin transaction
        $pdo->beginTransaction();

        // Insert property
        $sql = "INSERT INTO properties (type, address, city, state, zip_code, price, bedrooms, bathrooms, square_feet, description)
                        VALUES (:type, :address, :city, :state, :zip, :price, :bedrooms, :bathrooms, :squareFeet, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":type" => "apartment",
            ":address" => $_POST["address"],
            ":city" => $_POST["city"],
            ":state" => $_POST["state"],
            ":zip" => $_POST["zip"],
            ":price" => $_POST["price"],
            ":bedrooms" => $_POST["bedrooms"],
            ":bathrooms" => $_POST["bathrooms"],
            ":squareFeet" => $_POST["square_feet"],
            ":description" => $_POST["description"],
        ]);

        $propertyId = $pdo->lastInsertId();

        // Define the image path
        $temp = $_FILES['pictures']['tmp_name'];
        $imgName = $_FILES["pictures"]["name"];
        $imagePath = "/assets/apartments/" . $propertyId;
        $imageDir = $_SERVER["DOCUMENT_ROOT"] . $imagePath . '/' . $imgName;
        // working
        if (!is_dir($imagePath)) {
            if (mkdir($_SERVER["DOCUMENT_ROOT"] . $imagePath, 0777, true)) {
            } else {
                throw new Exception("Failed to create directory: " . $imagePath);
            }
        }
        $sql =
            "INSERT INTO images (property_id, image_url) VALUES (:propertyId, :imageUrl)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":propertyId" => $propertyId,
            ":imageUrl" => '/assets/apartments/' . $propertyId . '/' . $imgName,
        ]);

        // Move the uploaded file to the desired directory
        if (
            move_uploaded_file($temp, $imageDir)
        ) {
            // Commit transaction
            $pdo->commit();
        } else {
            // Rollback transaction
            $pdo->rollBack();
        }
    }
}       

?>
<!DOCTYPE html>
<html lang="en">
    <?php include "../includes/head.php"; ?>
    <body>
        <?php include "../includes/header.php"; ?>
        
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <h1>List an apartment for rent</h1>
            <div class="input-wrapper" >
                <label for="price">
                    Price
                </label>
                <input type="text" id="price" name="price" pattern='[0-9]+'>
            </div>
            <div class="input-wrapper" >
                <label for="bedrooms">
                   Bedrooms
                </label>
                <input type="text" id="bedrooms" name="bedrooms" >
            </div>
            <div class="input-wrapper" >
                <label for="bedrooms">
                   Bathrooms
                </label>
                <input type="text" id="bathrooms" name="bathrooms" >
            </div>
            <div class="input-wrapper" >
                <label for="squarefeet">
                   Square Feet
                </label>
                <input type="text" id="squarefeet" name="square_feet" >
            </div>
            <div class="input-wrapper" >
                <label for="address">
                    Address
                </label>
                <input type="text" id="address" name="address">
            </div>
            <div class="input-wrapper" >
                <label for="city">
                    City
                </label>
                <input type="text" id="city" name="city">
            </div>
            <div class="input-wrapper" >
                <label for="state">
                    State
                </label>
                <input type="text" id="state" name="state">
            </div>
            <div class="input-wrapper" >
                <label for="zip">
                    Zip
                </label>
                <input type="text" id="zip" name="zip">
            </div>
            <div class="input-wrapper">
                <label for="pictures">
                    Upload photos
                </label>
                <input type="file" id="pictures" name="pictures" accept="image/*">
            </div>
            <div class="input-wrapper" >
                <label for="description">
                    Description
                </label>
                <textarea type="text" id="description" name="description"></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    </body>
</html>

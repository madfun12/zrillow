<?php
require "../includes/database-connection.php";
    $homeId = $_GET['id'];
    $sent = false;
    try{
        // Prepare the SQL query with the named parameter :type
        $sql = "SELECT p.id, p.type, p.address, p.city, p.state, p.zip_code, p.price, p.bedrooms, p.bathrooms, p.square_feet, p.year_built, p.description, i.image_url
        FROM properties p
        LEFT JOIN images i ON p.id = i.property_id
        WHERE p.id = :id";
        $stmt = $pdo->prepare($sql);

        // Execute the query with the parameter array
        $stmt->execute([":id" => $homeId]);

        // Fetch the result set
        $property = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sent = true;
    $address = $_POST["address"];
    $price = $_POST["price"];
    $bedrooms = $_POST["bedrooms"];
    $bathrooms = $_POST["bathrooms"];
    $squareFeet = $_POST["square_feet"];
    $yearBuilt = $_POST["year_built"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];


    
        
    try{// Begin transaction
    $pdo->beginTransaction();

    $sql = "UPDATE properties
            SET address = :address, price = :price, bedrooms = :bedrooms, bathrooms = :bathrooms, square_feet = :square_feet, year_built = :year_built, city = :city, state = :state, zip_code = :zip_code, description = :description
            WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    
    // Execute the statement with the new values
    $stmt->execute([
        ":address" => $_POST["address"],
        ":price" => $_POST["price"],
        ":bedrooms" => $_POST["bedrooms"],
        ":bathrooms" => $_POST["bathrooms"],
        ":square_feet" => $_POST["square_feet"],
        ":year_built" => $_POST["year_built"],
        ":city" => $_POST["city"],
        ":state" => $_POST["state"],
        ":zip_code" => $_POST["zip"],
        ":description" => $_POST["description"],
        ":id" => $_GET["id"]
    ]);

    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), $e->getCode());
    }

    $propertyId = $_GET["id"];

    if (isset($_FILES["pictures"]) && $_FILES["pictures"]["error"] === 0) {
        // Define the image path
        $temp = $_FILES['pictures']['tmp_name'];
        $imgName = $_FILES["pictures"]["name"];
        $imagePath = "/assets/homes/" . $propertyId;
        $imageDir = $_SERVER["DOCUMENT_ROOT"] . $imagePath . '/' . $imgName;

        $sql =
            "UPDATE images SET image_url = :image_url WHERE property_id = :property_id;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":image_url" => '/assets/homes/' . $propertyId . '/' . $imgName,
            ":property_id" => $propertyId,
        ]);

        // Move the uploaded file to the desired directory
        if (
            move_uploaded_file($temp, $imageDir)
        ) {
            // Commit transaction
            $pdo->commit();
            header("Refresh:0");
        } else {
            // Rollback transaction
            $pdo->rollBack();
        }
    }else{
       $pdo->commit(); 
       header("Refresh:0");
    }
}       

?>
<!DOCTYPE html>
<html lang="en">
    <?php include "../includes/head.php"; ?>
    <body>
        <?php include "../includes/header.php"; ?>
        
        <form action="update.php/home?id=<?= $homeId ?>" method="POST" enctype="multipart/form-data">
            <h1>List a home for sale</h1>
            <div class="input-wrapper" >
                <label for="price">
                    Price
                </label>
                <input type="text" id="price" name="price" value="<?= $property['price'] ?>">
            </div>
            <div class="input-wrapper" >
                <label for="bedrooms">
                   Bedrooms
                </label>
                <input type="text" id="bedrooms" name="bedrooms" value="<?= $property['bedrooms'] ?>">
            </div>
            <div class="input-wrapper" >
                <label for="bedrooms">
                   Bathrooms
                </label>
                <input type="text" id="bathrooms" name="bathrooms" value="<?= $property['bathrooms'] ?>">
            </div>
            <div class="input-wrapper" >
                <label for="squarefeet">
                   Square Feet
                </label>
                <input type="text" id="squarefeet" name="square_feet" value="<?= $property['square_feet'] ?>">
            </div>
            <div class="input-wrapper" >
                <label for="year-built">
                   Year Built
                </label>
                <input type="text" id="year-built" name="year_built" value="<?= $property['year_built'] ?>">
            </div>
            <div class="input-wrapper" >
                <label for="address">
                    Address
                </label>
                <input type="text" id="address" name="address" value="<?= $property['address'] ?>">
            </div>
            <div class="input-wrapper" >
                <label for="city">
                    City
                </label>
                <input type="text" id="city" name="city" value="<?= $property['city'] ?>">
            </div>
            <div class="input-wrapper" >
                <label for="state">
                    State
                </label>
                <input type="text" id="state" name="state" value="<?= $property['state'] ?>">
            </div>
            <div class="input-wrapper" >
                <label for="zip">
                    Zip
                </label>
                <input type="text" id="zip" name="zip" value="<?= $property['zip_code'] ?>">
            </div>
            <div class="input-wrapper">
                <label for="pictures">
                    Upload photos
                </label>
                <input type="file" id="pictures" name="pictures" accept="image/*" >
            </div>
            <div class="input-wrapper" >
                <label for="description">
                    Description
                </label>
                <textarea type="text" id="description" name="description" ><?= $property['description'] ?></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    </body>
</html>

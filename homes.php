<?php
require "./includes/database-connection.php";

    try{
        // Prepare the SQL query with the named parameter :type
    $sql = "SELECT p.id, p.type, p.address, p.city, p.state, p.zip_code, p.price, p.bedrooms, p.bathrooms, p.square_feet, p.year_built, i.image_url
    FROM properties p
    LEFT JOIN images i ON p.id = i.property_id
    WHERE p.type = :type";
    $stmt = $pdo->prepare($sql);

    // Execute the query with the parameter array
    $stmt->execute([":type" => "home"]);

    // Fetch the result set
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "./includes/head.php"; ?>
    <body>
    <?php include "./includes/header.php"; ?>
    <div class="properties">
    <?php foreach($properties as $property) { ?>
        <a href="/homes/home.php?id=<?= $property['id']; ?>">
            <div class="property">
                <img src="<?= $property['image_url']?>" />
                <div class="info">
                    <h4>$<?= $property['price'] ?></h4>
                    <p><?= $property['address'] ?> <?= $property['city'] ?>, <?= $property['state'] ?></p>
                    <p><?= $property['bedrooms'] ?> beds | <?=$property['bathrooms'] ?> baths | <?= $property['square_feet'] ?> sqft</p>
                </div>
            </div>
        </a>
    <?php } ?>
    </div>
    </body>
</html>

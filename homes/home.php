<?php
    require "../includes/database-connection.php";
    $homeId = $_GET['id'];
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
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House</title>
</head>
<body>
    <?php include "../includes/head.php"; ?>
    <body>
        <?php include "../includes/header.php"; ?>
        <div class="property-wrapper">
            <img src="<?= $property['image_url'] ?>" alt="Image of <?= $property['address'] ?>" />
            <div class="info-section">
                <h4 class="address"><?= $property['address'] ?></h4>
                <p class="price">$<?= $property['price'] ?></p>
                <p class="beds-bath"><?= $property['bedrooms'] ?> beds | <?= $property['bathrooms'] ?> baths | <?= $property['square_feet'] ?> sqft</p>
                <p class="description"><?= $property['description'] ?></p>
            </div>
            
        </div>
        <a style="display: block; text-align: center; margin: auto;" href="/homes/update.php?id=<?= $homeId ?>">Update this home</a>
        <a style="display: block; text-align: center; margin: auto;" href="/homes/delete.php?id=<?= $homeId ?>">Delete this home</a>
    </body>
</body>
</html>
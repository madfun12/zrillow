<?php
require "../includes/database-connection.php";
    $homeId = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete image    
    try{
        $pdo->beginTransaction();

        $sql = "DELETE FROM images WHERE property_id = :id";

        
        $stmt = $pdo->prepare($sql);
        
        // Execute the statement with the new values
        $stmt->execute([
            ":id" => $_GET["id"]
        ]);

        $pdo->commit(); 

    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), $e->getCode());
    }

    // Delete property   
    try{
        $pdo->beginTransaction();

        $sql = "DELETE FROM properties WHERE id = :id";

        
        $stmt = $pdo->prepare($sql);
        
        // Execute the statement with the new values
        $stmt->execute([
            ":id" => $_GET["id"]
        ]);

        $pdo->commit(); 
        header("Refresh:0; url=/homes.php");
    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), $e->getCode());
    }

    
    
}       

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php include "../includes/head.php"; ?>
    <body>
    <?php include "../includes/header.php"; ?>
    <form action="/homes/delete.php?id=<?= $homeId ?>" method="POST">
        <label for="delete">Are you sure?</label>
        <button class="warning" id="delete" type="submit">Delete this home</button>
    </form>
</body>
</html>



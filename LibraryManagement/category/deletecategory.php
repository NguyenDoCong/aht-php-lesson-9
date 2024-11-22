<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include '../layout/header.php';
    include '../database/database.php';

    $database = new Database();
    $conn = $database->getConnection();

    $category_number = isset($_GET['id']) ? $_GET['id'] : '';

    if (isset($_GET['action'])) {
        $query = "DELETE FROM `category` WHERE `category_number` = :category_number";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':category_number', $category_number);

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit();
        }
    }

    $query = "SELECT category_name FROM category WHERE category_number = :category_number";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category_number', $category_number);

    $stmt->execute();

    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
    <div>
        <h2>Delete Category</h2>
        <p>Do you want to delete category "<?php echo htmlspecialchars($category["category_name"]); ?>"?</p>

        <div>
            <form action="" method="get" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($category_number); ?>">
                <input type="submit" name="action" value="Delete">
            </form>

            <a href="../index.php" style="margin-left: 10px;">Cancel</a>
        </div>
    </div>

    <?php

    ?>
</body>
<?php
include '../layout/footer.php';
$conn = null; ?>

</html>
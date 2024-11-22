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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['category_name'])) {
            $newCatName = trim($_POST['category_name']);
            $query = "UPDATE category SET category_name = :category_name WHERE category_number = :category_number";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':category_name', $newCatName);
            $stmt->bindParam(':category_number', $category_number);

            $stmt->execute();
        }
    }

    $query = "SELECT category_name FROM category WHERE category_number = :category_number";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category_number', $category_number);

    $stmt->execute();

    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
    <div>
        <h2>Edit Category</h2>
        <table>
            <tbody>
                <form action="" method="post">
                    <tr>
                        <td>
                            <label for="category_name">
                                Category Name:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="category_name"
                                name="category_name"
                                value="<?php echo $category["category_name"]; ?>">

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Update">
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>

    <?php

    ?>
</body>
<?php
include '../layout/footer.php';

$conn = null; ?>

</html>
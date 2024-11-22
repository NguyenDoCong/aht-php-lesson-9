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
            $query = "INSERT INTO `category`(`category_number`, `category_name`) VALUES (NULL,:category_name)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':category_name', $newCatName);

            if ($stmt->execute()) {
                header("Location: ../index.php");
                exit();
            }
        }
    }

    ?>
    <div>
        <h2>Add New Category</h2>
        <table>
            <tbody>
                <form action="" method="post">
                    <tr>
                        <td>
                            <label for="category_code">
                                Code:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="category_code"
                                name="category_code">

                        </td>
                    </tr>
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
                                name="category_name">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Add">
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
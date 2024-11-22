<?php
include 'database/database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
        $category_number = $_GET['id'];
        $query = "DELETE FROM `category` WHERE `category_number` = :category_number";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':category_number', $category_number);

        $stmt->execute();
    }
}

$query = "SELECT * FROM category";
$stmt = $conn->prepare($query);

$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table>
    <thead>
        <tr>
            <th>
                Code
            </th>
            <th>
                Category Name
            </th>
            <th>

            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($categories) > 0) {
            foreach ($categories as $category) {
        ?>
                <tr>
                    <td>
                        <?php
                        echo "C0" . $category["category_number"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $category["category_name"];
                        ?>
                    </td>
                    <td>
                        <a href="category/editcategory.php?id=<?php echo $category['category_number']; ?>">Update</a>
                        <span>|</span>
                        <a href="category/deletecategory.php?id=<?php echo $category['category_number']; ?>">Delete</a>
                        <!-- <form action="" method="get" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $category['category_number']; ?>">
                            <input type="hidden" name="action" value="confirm">
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this category?');">
                        </form> -->

                    </td>
                </tr>
        <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </tbody>
    <table>
        <?php

        $conn = null;

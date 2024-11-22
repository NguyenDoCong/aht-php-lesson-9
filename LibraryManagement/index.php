<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <div class="menu">
            <?php
            include 'layout/header.php';
            ?>
        </div>
        <div>
            <h2>Categories List</h2>
            <div>
                <?php
                include 'category/displaycategory.php';
                ?>
            </div>
            <a href="category/addcategory.php">
                Add new category
            </a>
        </div>
    </div>
</body>

</html>
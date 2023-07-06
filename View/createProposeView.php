<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="">
    <label for="itemName">Nazwa przedmiotu:</label>
    <input type="text" id="itemName" name="itemName"><br>

    <label for="price">Cena:</label>
    <input type="number" step="0.01" id="price" name="price"><br>

    <label for="link">Link:</label>
    <input type="text" id="link" name="link"><br>

    <label for="category">Kategoria:</label>
    <select id="category" name="category">
        <?php
            $categories = [
                0 => 'Kategoria 1',
                1 => 'Kategoria 2',
                2 => 'Kategoria 3',
                3 => 'Kategoria 4'
            ];

            foreach ($categories as $categoryId => $categoryName) {
                echo "<option value='$categoryId'>$categoryName</option>";
            }
        ?>
    </select><br>

    <button type="submit" name="submit">Akceptuj</button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $itemName = $_POST['itemName'];
        $price = $_POST['price'];
        $link = $_POST['link'];
        $categoryId = $_POST['category'];
    }
?>
</body>
</html>

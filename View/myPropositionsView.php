<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if ($propositionsList) {
        foreach ($row as $proposition) {
            if (isset($itemName, $price, $link, $categoryName)) {
                $itemName = $proposition['itemName'];
                $price = $proposition['price'];
                $link = $proposition['link'];
                $categoryName = $proposition['categoryName'];
                ?>
                <table>
                    <tr>
                        <th>Nazwa przedmiotu</th>
                        <th>Cena</th>
                        <th>Link</th>
                        <th>Kategoria</th>
                    </tr>
                    <tr>
                        <td><?php echo $itemName ?></td>
                        <td><?php echo $price ?></td>
                        <td><?php echo $link ?></td>
                        <td><?php echo $categoryName ?></td>
                    </tr>
                </table>
            <?php
            }
        }
    } else {
        echo "Brak propozycji do wyświetlenia.";
    }
    ?>
</body>
</html>

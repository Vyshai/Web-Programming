<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h3>Beauty Cosmetics</h3>

<?php
$products = array(
    array("name" => "Lipstick", "price" => 299.00, "stock" => 12),
    array("name" => "Foundation", "price" => 499.50, "stock" => 6),
    array("name" => "Mascara", "price" => 350.00, "stock" => 18),
    array("name" => "Blush On", "price" => 220.00, "stock" => 9),
    array("name" => "Eyeliner", "price" => 150.00, "stock" => 20),
    array("name" => "Face Powder", "price" => 180.00, "stock" => 5)
);
?>

<table class="custom-table">
    <tr>
        <th>No.</th>
        <th>Product Name</th>
        <th>Price (₱)</th>
        <th>Stock</th>
    </tr>

    <?php
    $no = 1;
    foreach ($products as $p) {
        $rowClass = ($p["stock"] < 10) ? "low-stock" : "";
        echo "<tr class='$rowClass'>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $p["name"] . "</td>";
        echo "<td>" . number_format($p["price"], 2) . "</td>";
        echo "<td>" . $p["stock"] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>

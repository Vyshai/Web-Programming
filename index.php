<html>
    <body>
        <h1>Hello, from Palmer Vincent B. Ong!</h1>

        <h3>Step #3: My Very First PHP Program</h3>
        <?php
        $x = 15;
        $y = 3;

        $sum = $x + $y;
        $difference = $x - $y;
        $product = $x * $y;
        $quotient = $x / $y;

        echo "The sum is $sum. <br>";
        echo "The difference is $difference. <br>";
        echo "The product is $product. <br>";
        echo "The quotient is $quotient. <br><br>";

        if ($x % $y == 0) {
            echo "$y is a factor of $x.";
        } else {
            echo "$y is not a factor of $x.";
        }
        ?>

        <h3>Step #7: Multiples of 3 or 5</h3>
        <?php
        echo "Multiples of 3 or 5 from 1 to 100: <br>";

        for ($i = 1; $i <= 100; $i++) {
            if ($i % 3 == 0 || $i % 5 == 0) {
                echo "$i <br>";
            }
        }
        ?>

        <h3>Step #8.1: Indexed Array Example</h3>
        <?php
        $products = array("Product A", "Product B", "Product C");
        var_dump($products); 
        ?>

        <h3>Step #8.2: Display the First Array Item</h3>
        <?php
        echo $products[0]; 
        ?>

        <h3>Step #8.3: Change the Value of the Second Item</h3>
        <?php
        $products[1] = "Product D";
        var_dump($products);
        ?>

        <h3>Step #8.4: Display All Array Items with foreach</h3>
        <?php
        foreach($products as $p) {
            echo "$p <br>";
        }
        ?>

        <h3>Step #8.5: Associative Array Example</h3>
        <?php
        $productInfo = array("name"=>"Product A", "price"=>10.50, "stock"=>12);
        echo "Product Name: " . $productInfo["name"] . "<br>";
        echo "Price: " . $productInfo["price"] . "<br>";
        echo "Stock: " . $productInfo["stock"] . "<br>";
        ?>

        <h3>Step #8.6: Multiple Products in a Table</h3>
        <?php
        $productsTable = array(
            array("name"=>"Product A", "price"=>10.50, "stock"=>12),
            array("name"=>"Product B", "price"=>5.60, "stock"=>7),
            array("name"=>"Product C", "price"=>7.00, "stock"=>5)
        );

        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Product Name</th><th>Price</th><th>Stock</th></tr>";

        foreach($productsTable as $p) {
            echo "<tr>";
            echo "<td>" . $p["name"] . "</td>";
            echo "<td>" . $p["price"] . "</td>";
            echo "<td>" . $p["stock"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        ?>

        <h3>Step #8.7–8.8: Two-Dimensional Array with foreach</h3>
        <?php
        $products = array(
            array("name"=>"Product A", "price"=>10.50, "stock"=>12),
            array("name"=>"Product B", "price"=>5.60, "stock"=>7),
            array("name"=>"Product C", "price"=>7.00, "stock"=>5)
        );

        foreach($products as $p){
            echo $p["name"] . " is " . $p["price"] . " pesos <br>";
        }
        ?>
    </body>
</html>

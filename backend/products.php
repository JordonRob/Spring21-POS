<!DOCTYPE html>
<html lang="en">    
<head>
<meta charset="UTF-8">    
<title>Add Record Form</title>
</head>

<body>
<form action="products_insert.php" method="post">

    <p>
        <label for="PIDC">PIDC:</label>
        <input type="int" name="PIDC" id="PIDC">    
    </p>

    <p>
        <label for="Name">Name:</label>
        <input type="text" name="Name" id="Name">    
    </p>

    <p>    
        <label for="Price">Price:</label>
        <input type="double" name="Price" id="Price">    
    </p>

    <p>    
        <label for="Quantity">Quantity:</label>
        <input type="int" name="Quantity" id="Quantity">    
    </p>

    <input type="submit" value="Submit">
</form>
</body>
</html>
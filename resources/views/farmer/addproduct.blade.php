<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="submit_products.php" method="POST">
    <label for="productName">Product Name:</label>
    <input type="text" id="productName" name="productName" required>
    <br>
    <label for="productDescription">Product Description:</label>
    <textarea id="productDescription" name="productDescription" required></textarea>
    <br>
    <label for="productPrice">Product Price:</label>
    <input type="number" id="productPrice" name="productPrice" required>
    <br>
    <button>Add Product</button>
</form>


</body>
</html>

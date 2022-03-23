<?php
require('app/Customer.php');
require('app/Product.php');
require('app/ShoppingCart.php');
require('app/FileUtility.php');

$products_data = FileUtility::openCSV('products.csv');

$products = Product::convertArrayToProducts($products_data);

$customer = new Customer('John Doe', 'john@mail.com');

$shoppingCart = new ShoppingCart($customer);
$shoppingCartItems = $shoppingCart->getAllItems();
?>
<html>
<head>
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container height-100 d-flex justify-content-center align-items-center">
    <div class="card text-center">
    <div class="py-4 p-2">
        <img src="logo.png" class="rounded" width="100">
    </div>
        <h1>Welcome <?php echo $customer->getName() ?>!</h1>
        <h2>Shopping Cart</h2>
        <h4>
            <a href="products-list.php" class="btn btn-primary">Shop More Products</a>
        </h4>

        <?php if (count($shoppingCartItems) > 0): ?>

            <table>
            <thead>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </thead>
            <tbody>

            <?php foreach ($shoppingCartItems as $item): ?>

                <tr>
                    <td><?php echo $item['product']->getName(); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['subtotal']; ?></td>
                </tr>

            <?php endforeach; ?>

                <tr>
                    <td colspan="4">
                        <?php echo $shoppingCart->getItemsTotal(); ?>
                    </td>
                </tr>

            </tbody>
            </table>
    </div>
</div>
<?php endif; ?>

</body>
</html>

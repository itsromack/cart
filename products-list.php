<?php
require('app/Customer.php');
require('app/Product.php');
require('app/FileUtility.php');

$products_data = FileUtility::openCSV('products.csv');

$products = Product::convertArrayToProducts($products_data);

$customer = new Customer('John Doe', 'john@mail.com');
?>
<html>
<head>
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">
	<div  id="list" class="card">
		<div class="text-center">
			<h1>Welcome <?php echo $customer->getName() ?>!</h1>
			<h2>Products</h2>
			<h4>
			    <a href="shopping-cart.php">Shopping Cart</a>
			</h4>
		</div>
		<div class="table-responsive">
			<table class="table table-borderless table-shopping-cart">
				<thead class="text-muted">
					<tr class="small text-uppercase">
						<th scope="col">Product</th>
						<th scope="col">Quantity</th>
						<th scope="col">Price</th>
					</tr>
				</thead>
				<form action="add-to-cart.php" method="POST">
					<tbody>
						<?php foreach ($products as $product): ?>
						<tr>
							<td>
								<figure class="itemside align-items-center">
									<div class="aside">
										<img src="<?php echo $product->getImage(); ?>" class="img-sm">
									</div>	
									<figcaption class="info">
										<a href="#" class="title text-dark" data-abc="true"><?php echo $product->getName(); ?></a>
										<p class="text-muted small"><?php echo $product->getDescription(); ?></p>
									</figcaption>
								</figure>
							</td>
							<td>
								<input type="number" name="quantity" class="input-price form-control" value="0" />
							</td>
							<td>
								<div class="price-wrap">
									<var class="price">Php <?php echo $product->getPrice(); ?></var>
								</div>
							</td>
							<td>
								<button type="submit" class="btn btn-success">
						            ADD TO CART
						        </button>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</form>
			</table>
		</div>
	</div>
</div>
</body>
</html>

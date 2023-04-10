<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Php Test</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<header>
		<nav class="navbar fixed-top navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Admin</a>
			</div>
		</nav>
	</header>
	<div class="clearfix">...</div>
	<div class="container thump-section">
		<div class="row row-cols-1 row-cols-md-4 g-4">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Products</h5>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><a href="javascript:void(0)" class="add-product">Add Item</a></li>
							<li class="list-group-item"><a href="javascript:void(0)" class="list-product">List Item</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Product Category</h5>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Add Category</li>
							<li class="list-group-item"><a href="javascript:void(0)" class="list-category">List Category</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<!-- <img src="..." class="card-img-top" alt="..."> -->
					<div class="card-body">
						<h5 class="card-title">Customer</h5>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Add Customer</li>
							<li class="list-group-item"><a href="javascript:void(0)" class="list-customer">List Customer</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Sale</h5>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><a href="javascript:void(0)" class="add-sales">Add Sales</a></li>
							<li class="list-group-item"><a href="javascript:void(0)" class="list-sale">List Sales</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">...</div>
	<div class="container">
		<p>
			<a class="btn btn-dark cus-nosale" >
				Customers with No sale
			</a>
			<a class="btn btn-dark all-sale" >
				All Sales
			</a>
			<a class="btn btn-dark item-sale" >
				Item Sale
			</a>
			<a class="btn btn-dark cus-salecount" >
				Customers by sale count
			</a>
		</p>
		<div class="collapse" id="collapseExample">
			<div class="col"><div class="card"><div class="card-body"><h5 class="card-title collapsetitle"></h5><div class="cws"></div></div></div></div>
		</div>
	</div>
	<div class="clearfix">...</div>
	<div class="container list-view">
	</div>
	<footer>
		<nav class="navbar fixed-bottom navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">xyz.com</a>
			</div>
		</nav>
	</footer>
	<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" id="AddProductForm">
				<div class="modal-body">
					
						<div class="mb-3">
							<label for="productName" class="form-label">Product Name</label>
							<input type="text" class="form-control" id="productName" name="productName" aria-describedby="emailHelp" required>
						</div>
						<div class="mb-3">
							<label for="catList" class="form-label">Product Category</label>
							<select class="form-select" aria-label="Default select example" id="catList" name="catList" required>
							</select>
						</div>
						<div class="mb-3">
							<label for="productPrice" class="form-label">Product Price</label>
							<input type="number" class="form-control" id="productPrice"  name="productPrice" aria-describedby="emailHelp" required>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary save-product" >Save</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="addSaleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Sales</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" id="AddSaleForm">
				<div class="modal-body">
					
						<div class="mb-3">
							<label for="invoiceNumber" class="form-label">Invoice Number</label>
							<input type="text" class="form-control" id="invoiceNumber" name="invoiceNumber" readonly aria-describedby="emailHelp" required>
						</div>
						<div class="mb-3">
							<label for="productList" class="form-label">Product</label>
							<select class="form-select" aria-label="Default select example" id="productList" name="productList" required>
							</select>
						</div>
						<div class="mb-3">
							<label for="salePrice" class="form-label">Price</label>
							<input type="number" class="form-control" id="salePrice"  name="salePrice" aria-describedby="emailHelp" readonly>
							<input type="hidden" name="saleName" id="saleName">
						</div>
						<div class="mb-3">
							<label for="productPrice" class="form-label">Quantity</label>
							<input type="number" class="form-control" id="productQuantity"  name="productQuantity" aria-describedby="emailHelp" required>
						</div>
						<div class="mb-3">
							<label for="customerList" class="form-label">Customer</label>
							<select class="form-select" aria-label="Default select example" id="customerList" name="customerList" required>
							</select>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary save-sale" >Save</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<script type="text/javascript" src="main.js"></script>
</body>
</html>
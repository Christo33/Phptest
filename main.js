$(document).ready(function() {
			$(".add-product").click(function(){
				$('#catList').html('<option selected>Select Category</option>');
				$.get("http://localhost/phptest/api/api.php/categories", function(data, status){
					var obj = jQuery.parseJSON(data);
					$.each( obj, function( key, value ) {
						$('#catList').append('<option value="'+value.id+'">'+value.name+'</option>');
					});
					return false;
				});
				var addproductModal = new bootstrap.Modal(document.getElementById('addProductModal'), {
					keyboard: false
				});
				addproductModal.toggle();
			});
			$("form#AddProductForm").submit(function(e){
				e.preventDefault();
				$.ajax({
					url: 'http://localhost/phptest/api/api.php/products',			
					type: "POST",
					data:JSON.stringify({"name":$("#productName").val(),"category_id":$("#catList").val(),"price":$("#productPrice").val()}),
					dataType: "json",
					contentType: 'application/json',
					processData: false,
					success: function(data){
						if (Number.isInteger(data)) {
							alert('Added successfully');
						}else{
							alert('Failed');
						}
						$('#AddProductForm').trigger("reset");
						$("#addProductModal").modal('hide');
												
					}
				});
			});

			$(".add-sales").click(function(){
				$.get("http://localhost/phptest/api/api.php/generateinvoice", function(data, status){
					var obj = jQuery.parseJSON(data);
					$("#invoiceNumber").val(obj);
				});
				$.get("http://localhost/phptest/api/api.php/products", function(data, status){
					var obj = jQuery.parseJSON(data);
					$.each( obj, function( key, value ) {
						$('#productList').append('<option value="'+value.id+'" data-id="'+value.price+'">'+value.name+'</option>');
					});
					return false;
				});
				$.get("http://localhost/phptest/api/api.php/customers", function(data, status){
					var obj = jQuery.parseJSON(data);
					$.each( obj, function( key, value ) {
						$('#customerList').append('<option value="'+value.id+'">'+value.name+'</option>');
					});
					return false;
				});
				$('#productList').html('<option selected>Select Product</option>');
				$('#customerList').html('<option selected>Select Customer</option>');
				
				var addSaleModal = new bootstrap.Modal(document.getElementById('addSaleModal'), {
					keyboard: false
				});
				addSaleModal.toggle();
			});
			$("form#AddSaleForm").submit(function(e){
				e.preventDefault();
				$.ajax({
					url: 'http://localhost/phptest/api/api.php/sale',			
					type: "POST",
					data:JSON.stringify({"invoice_number":$("#invoiceNumber").val(),"item":$("#saleName").val(),"product_id":$("#productList").val(),"quantity":$("#productQuantity").val(),"price":$("#salePrice").val(),"customer_id":$("#customerList").val()}),
					dataType: "json",
					contentType: 'application/json',
					processData: false,
					success: function(data){
						if (Number.isInteger(data)) {
							alert('Added successfully');
						}else{
							alert('Failed');
						}
						$('#AddSaleForm').trigger("reset");
						$("#addSaleModal").modal('hide');
												
					}
				});
			});

			$('#productList').on('change', function() {
				var iid = $(this).find(":selected").val();
				$.get("http://localhost/phptest/api/api.php/products/"+iid, function(data, status){
					var obj = jQuery.parseJSON(data);
					$("#salePrice").val(obj.price);
					$("#saleName").val(obj.name);
				});
			});

			$(".cus-nosale").click(function(){
				// $('.collapse').collapse('hide');|
				
				$('.collapsetitle').html('Customers Without sales');
				$('.cws').html('');
				let ra ='';
				$.get("http://localhost/phptest/api/api.php/nosalewithcustomers", function(data, status){
					 ra += '<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Name</th><th scope="col">Email</th></tr></thead><tbody>';
					var obj = jQuery.parseJSON(data);
					var i=1;
					$.each( obj, function( key, value ) {
						ra += '<tr><th scope="row">'+i+'</th><td>'+value.name+'</td><td>'+value.email+'</td></tr>';
						i++;
					});
					$('.cws').append(ra+'</tbody></table>');
				});
				

				// $('#collapseExample').html('');
				$('#collapseExample').collapse('show');
			});
			$(".all-sale").click(function(){
				// $('.collapse').collapse('hide');
				$('.collapsetitle').html('Sales With name and email of the customer');
				$('.cws').html('');
				let ra ='';
				$.get("http://localhost/phptest/api/api.php/saledetails", function(data, status){
					ra += '<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Invoice number</th><th scope="col">Product name</th><th scope="col">Quantity</th><th scope="col">Name</th><th scope="col">Email</th></tr></thead><tbody>';
					var obj = jQuery.parseJSON(data);
					var i=1;
					$.each( obj, function( key, value ) {
						ra += '<tr><th scope="row">'+i+'</th><td>'+value.invoice_number+'</td><td>'+value.product_name+'</td><td>'+value.quantity+'</td><td>'+value.customer_name+'</td><td>'+value.email+'</td></tr>';
						i++;
					});
					$('.cws').append(ra +'</tbody></table>');
				});
				$('#collapseExample').collapse('show');
			});
			$(".item-sale").click(function(){
				// $('.collapse').collapse('hide');
				$('.collapsetitle').html('Each item sale');
				$('.cws').html('');
				let ra ='';
				$.get("http://localhost/phptest/api/api.php/itempurchased", function(data, status){
					ra += '<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Name</th><th scope="col">Count</th></tr></thead><tbody>';
					var obj = jQuery.parseJSON(data);
					var i=1;
					$.each( obj, function( key, value ) {
						ra += '<tr><th scope="row">'+i+'</th><td>'+value.name+'</td><td>'+value.count+'</td></tr>';
						i++;
					});
					$('.cws').append(ra +'</tbody></table>');
				});
				$('#collapseExample').collapse('show');
			});
			$(".cus-salecount").click(function(){
				// $('.collapse').collapse('hide');

				$('.collapsetitle').html('Customers with count of sales');
				$('.cws').html('');
				let ra ='';
				$.get("http://localhost/phptest/api/api.php/customersales", function(data, status){
					ra +='<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Name</th><th scope="col">Count</th></tr></thead><tbody>';
					var obj = jQuery.parseJSON(data);
					var i=1;
					$.each( obj, function( key, value ) {
						ra +='<tr><th scope="row">'+i+'</th><td>'+value.name+'</td><td>'+value.count+'</td></tr>';
						i++;
					});
					$('.cws').append(ra +'</tbody></table>');
				});
				
				$('#collapseExample').collapse('show');
			});
			$(".list-product").click(function(){
				$('.list-view').html('');
				let ra ='';
				$.get("http://localhost/phptest/api/api.php/products", function(data, status){
					ra +='<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Name</th><th scope="col">price</th></tr></thead><tbody>';
					var obj = jQuery.parseJSON(data);
					var i=1;
					$.each( obj, function( key, value ) {
						ra +='<tr><th scope="row">'+i+'</th><td>'+value.name+'</td><td>'+value.price+'</td></tr>';
						i++;
					});
					$('.list-view').append(ra +'</tbody></table>');
				});
			});
			$(".list-category").click(function(){
				$('.list-view').html('');
				let ra ='';
				$.get("http://localhost/phptest/api/api.php/categories", function(data, status){
					ra +='<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Name</th></tr></thead><tbody>';
					var obj = jQuery.parseJSON(data);
					var i=1;
					$.each( obj, function( key, value ) {
						ra +='<tr><th scope="row">'+i+'</th><td>'+value.name+'</td></tr>';
						i++;
					});
					$('.list-view').append(ra +'</tbody></table>');
				});
			});
			$(".list-customer").click(function(){
				$('.list-view').html('');
				let ra ='';
				$.get("http://localhost/phptest/api/api.php/customers", function(data, status){
					ra +='<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Name</th><th scope="col">Dob</th><th scope="col">Email</th></tr></thead><tbody>';
					var obj = jQuery.parseJSON(data);
					var i=1;
					$.each( obj, function( key, value ) {
						ra +='<tr><th scope="row">'+i+'</th><td>'+value.name+'</td><td>'+value.dob+'</td><td>'+value.email+'</td></tr>';
						i++;
					});
					$('.list-view').append(ra +'</tbody></table>');
				});
			});
			$(".list-sale").click(function(){
				$('.list-view').html('');
				let ra ='';
				$.get("http://localhost/phptest/api/api.php/sale", function(data, status){
					ra +='<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Invoice Number</th><th scope="col">Item</th><th scope="col">Qty</th><th scope="col">price</th></tr></thead><tbody>';
					var obj = jQuery.parseJSON(data);
					var i=1;
					$.each( obj, function( key, value ) {
						ra +='<tr><th scope="row">'+i+'</th><td>'+value.invoice_number+'</td><td>'+value.item+'</td><td>'+value.quantity+'</td><td>'+value.price+'</td></tr>';
						i++;
					});
					$('.list-view').append(ra +'</tbody></table>');
				});
			});

			
		});
<?php
require_once 'config.php';
// Function to get all customers who don't have any sales
/**
 * 
 */
function getCustomersWithNoSales()
{
    global $conn;
    $sql = "SELECT customers.name, customers.email FROM customers LEFT JOIN sales ON customers.id = sales.customer_id WHERE sales.id IS NULL";
    $result = mysqli_query($conn, $sql);
    $customers = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
    return $customers;
}

// Function to get all sales with name and email of the customer
function getSalesWithCustomerInfo()
{
    global $conn;
    $sql = "SELECT sales.invoice_number, products.name AS product_name, sales.quantity, customers.name AS customer_name, customers.email FROM sales JOIN products ON sales.product_id = products.id JOIN customers ON sales.customer_id = customers.id";
    $result = mysqli_query($conn, $sql);
    $sales = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row;
    }
    return $sales;
}

// Function to get the count of each product sold
function getProductSalesCount()
{
    global $conn;
    $sql = "SELECT products.name, COUNT(*) AS count FROM sales JOIN products ON sales.product_id = products.id GROUP BY products.name";
    $result = mysqli_query($conn, $sql);
    $product_sales_count = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $product_sales_count[] = $row;
    }
    return $product_sales_count;
}

// Function to get all customers with count of sales
function getCustomersWithSalesCount()
{
    global $conn;
    $sql = "SELECT customers.name, COUNT(*) AS count FROM sales JOIN customers ON sales.customer_id = customers.id GROUP BY customers.name";
    $result = mysqli_query($conn, $sql);
    $customers = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
    return $customers;
}
// Function to generate new Invoice number
function getNextInvoice()
{
    global $conn;
    $sql = "SELECT MAX(id) AS last_invoice_number FROM sales";
    $result = mysqli_query($conn, $sql);
    $resdata = mysqli_fetch_assoc($result);
    $next_invoice_number = 'INV-'.sprintf("%03d", intval($resdata['last_invoice_number']) + 1);
    return $next_invoice_number;
}
// Function to create a new sale
function createSale($data)
{
    global $conn;
    $invoice_number = mysqli_real_escape_string($conn, $data['invoice_number']);
    $item = mysqli_real_escape_string($conn, $data['item']);
    $product_id = mysqli_real_escape_string($conn, $data['product_id']);
    $quantity = mysqli_real_escape_string($conn, $data['quantity']);
    $price   = mysqli_real_escape_string($conn, $data['price']);
    $customer_id   = mysqli_real_escape_string($conn, $data['customer_id']);
    $sql = "INSERT INTO sales (invoice_number, item, product_id, quantity, price, customer_id) VALUES ('$invoice_number', '$item', '$product_id', '$quantity', '$price', '$customer_id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return mysqli_insert_id($conn);
    } else {
        return false;
    }
}
// Function to get all sales
function getSales()
{
    global $conn;
    $sql = "SELECT * FROM sales";
    $result = mysqli_query($conn, $sql);
    $sales = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row;
    }
    return $sales;
}

// Function to get a specific sale by id
function getSale($id)
{
    global $conn;
    $sql = "SELECT * FROM sales WHERE id = " . mysqli_real_escape_string($conn, $id);
    $result = mysqli_query($conn, $sql);
    $sale = mysqli_fetch_assoc($result);
    return $sale;
}
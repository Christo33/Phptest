<?php

require_once 'config.php';

// Read all products
function getProducts()
{
    global $conn;

    $sql = 'SELECT * FROM products';
    $result = mysqli_query($conn, $sql);

    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}

// Read one product by ID
function getProduct($id)
{
    global $conn;

    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    $product = mysqli_fetch_assoc($result);

    return $product;
}

// Create a new product
function createProduct($data)
{
    global $conn;

    $name = mysqli_real_escape_string($conn, $data['name']);
    $category_id = mysqli_real_escape_string($conn, $data['category_id']);
    $price = mysqli_real_escape_string($conn, $data['price']);

    $sql = "INSERT INTO products (name, category_id, price) VALUES ('$name', '$category_id', '$price')";
    mysqli_query($conn, $sql);

    return mysqli_insert_id($conn);
}

// Update an existing product by ID
function updateProduct($id, $data)
{
    global $conn;

    $name = mysqli_real_escape_string($conn, $data['name']);
    $category_id = mysqli_real_escape_string($conn, $data['category_id']);
    $price = mysqli_real_escape_string($conn, $data['price']);

    $sql = "UPDATE products SET name = '$name', category_id = '$category_id', price = '$price' WHERE id = '$id'";
    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn) > 0;
}

// Delete a product by ID
function deleteProduct($id)
{
    global $conn;

    $sql = "DELETE FROM products WHERE id = '$id'";
    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn) > 0;
}
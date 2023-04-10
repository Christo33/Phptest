<?php

require_once 'config.php';

// Read all categories
function getCategories()
{
    global $conn;

    $sql = 'SELECT * FROM categories';
    $result = mysqli_query($conn, $sql);

    $categories = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }

    return $categories;
}

// Read one category by ID
function getCategory($id)
{
    global $conn;

    $sql = "SELECT * FROM categories WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    $category = mysqli_fetch_assoc($result);

    return $category;
}

// Create a new category
function createCategory($data)
{
    global $conn;

    $name = mysqli_real_escape_string($conn, $data['name']);

    $sql = "INSERT INTO categories (name) VALUES ('$name')";
    mysqli_query($conn, $sql);

    return mysqli_insert_id($conn);
}

// Update an existing category by ID
function updateCategory($id, $data)
{
    global $conn;

    $name = mysqli_real_escape_string($conn, $data['name']);

    $sql = "UPDATE categories SET name = '$name' WHERE id = '$id'";
    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn) > 0;
}

// Delete a category by ID
function deleteCategory($id)
{
    global $conn;

    $sql = "DELETE FROM categories WHERE id = '$id'";
    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn) > 0;
}
<?php

require_once 'config.php';

// Function to get all customers
function getCustomers()
{
    global $conn;
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn, $sql);
    $customers = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
    return $customers;
}

// Function to get a specific customer by id
function getCustomer($id)
{
    global $conn;
    $sql = "SELECT * FROM customers WHERE id = " . mysqli_real_escape_string($conn, $id);
    $result = mysqli_query($conn, $sql);
    $customer = mysqli_fetch_assoc($result);
    return $customer;
}

// Function to create a new customer
function createCustomer($data)
{
    global $conn;
    $name = mysqli_real_escape_string($conn, $data['name']);
    $dob = mysqli_real_escape_string($conn, $data['dob']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $sql = "INSERT INTO customers (name, dob, email) VALUES ('$name', '$dob', '$email')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return mysqli_insert_id($conn);
    } else {
        return false;
    }
}

// Function to update an existing customer
function updateCustomer($id, $data)
{
    global $conn;
    $name = mysqli_real_escape_string($conn, $data['name']);
    $dob = mysqli_real_escape_string($conn, $data['dob']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $sql = "UPDATE customers SET name = '$name', dob = '$dob', email = '$email' WHERE id = " . mysqli_real_escape_string($conn, $id);
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Function to delete an existing customer
function deleteCustomer($id)
{
    global $conn;
    $sql = "DELETE FROM customers WHERE id = " . mysqli_real_escape_string($conn, $id);
    $result = mysqli_query($conn, $sql);
    return $result;
}
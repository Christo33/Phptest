<?php 
require_once 'products.php';
require_once 'categories.php';
require_once 'customers.php';
require_once 'sales.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
switch ($request[0]) {
    case 'products':
        if ($method === 'GET') {
            if (isset($request[1])) {
                $product = getProduct($request[1]);
                echo json_encode($product);
            } else {
                $products = getProducts();
                echo json_encode($products);
            }
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $product_id = createProduct($data);
            echo $product_id;
        } elseif ($method === 'PUT' && isset($request[1])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = updateProduct($request[1], $data);
            echo $result ? 'Product updated successfully.' : 'Product update failed.';
        } elseif ($method === 'DELETE' && isset($request[1])) {
            $result = deleteProduct($request[1]);
            echo $result ? 'Product deleted successfully.' : 'Product delete failed.';
        }
        break;
    case 'categories':
        if ($method === 'GET') {
            if (isset($request[1])) {
                $category = getCategory($request[1]);
                echo json_encode($category);
            } else {
                $categories = getCategories();
                echo json_encode($categories);
            }
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $category_id = createCategory($data);
            echo $category_id;
        } elseif ($method === 'PUT' && isset($request[1])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = updateCategory($request[1], $data);
            echo $result ? 'Category updated successfully.' : 'Category update failed.';
        } elseif ($method === 'DELETE' && isset($request[1])) {
            $result = deleteCategory($request[1]);
            echo $result ? 'Category deleted successfully.' : 'Category delete failed.';
        }
        break;
    case 'customers':
        if ($method === 'GET') {
            if (isset($request[1])) {
                $customer = getCustomer($request[1]);
                echo json_encode($customer);
            } else {
                $customers = getCustomers();
                echo json_encode($customers);
            }
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $customer_id = createCustomer($data);
            echo $customer_id;
        } elseif ($method === 'PUT' && isset($request[1])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = updateCustomer($request[1], $data);
            echo $result ? 'Customer updated successfully.' : 'Customer update failed.';
        } elseif ($method === 'DELETE' && isset($request[1])) {
            $result = deleteCustomer($request[1]);
            echo $result ? 'Customer deleted successfully.' : 'Customer delete failed.';
        }
        break;
    case 'sale':
        if ($method === 'GET') {
            if (isset($request[1])) {
                $sale = getSale($request[1]);
                echo json_encode($sale);
            } else {
                $sales = getSales();
                echo json_encode($sales);
            }
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $sale_id = createSale($data);
            echo $sale_id;
        }
        break;
    case 'nosalewithcustomers':
        if ($method === 'GET') {
          $customers_no_sales = getCustomersWithNoSales();
          echo json_encode($customers_no_sales);
      }
      break;
    case 'saledetails':
      if ($method === 'GET') {
          $sales_customers = getSalesWithCustomerInfo();
          echo json_encode($sales_customers);
      }
      break;
    case 'itempurchased':
      if ($method === 'GET') {
          $items_purchased = getProductSalesCount();
          echo json_encode($items_purchased);
      }
      break;
    case 'customersales':
      if ($method === 'GET') {
          $customers_sales = getCustomersWithSalesCount();
          echo json_encode($customers_sales);
      }
      break;
    case 'generateinvoice':
      if ($method === 'GET') {
          $nextinvoice_number = getNextInvoice();
          echo json_encode($nextinvoice_number);
      }
      break;
    default:
      http_response_code(404);
      echo json_encode(array('message' => 'Endpoint not found'));
      break;
}
?>




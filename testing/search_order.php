<?php
header("Access-Control-Allow-Origin: *");

// Function to search for an order by ID
function searchOrderById($id) {
    $file_path = 'orders/' . $id . '.txt';
    if (file_exists($file_path)) {
        $order_details = file_get_contents($file_path);
        return explode(", ", $order_details); // Returns an array of order details
    } else {
        return false; // Order not found
    }
}

// Function to verify if the provided name matches the name associated with the ID
function verifyName($orderDetails, $name) {
    if ($orderDetails[0] === $name) {
        return true;
    } else {
        return false;
    }
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $order_details = searchOrderById($id);

    if ($order_details !== false) {
        $name_matched = verifyName($order_details, $name);
        if ($name_matched) {
            echo json_encode(array('success' => true, 'order_details' => $order_details));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Name does not match the order associated with this ID.'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Order not found.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}

?>

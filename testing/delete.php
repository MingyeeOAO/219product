<?php


// Function to delete an order by ID
function deleteOrder($id, $name) {
    $file_path = "orders/{$id}.txt";
    
    // Check if order file exists
    if (!file_exists($file_path)) {
        return json_encode(array('success' => false, 'message' => 'Order not found.'));
    }

    // Get order details
    $order_details = file_get_contents($file_path);
    $order_info = explode(", ", $order_details);

    // Verify if name matches
    if ($order_info[0] !== $name) {
        return json_encode(array('success' => false, 'message' => 'Name does not match the order associated with this ID.'));
    }

    // Delete the order file
    if (unlink($file_path)) {
        return json_encode(array('success' => true, 'message' => 'Order deleted successfully.'));
    } else {
        return json_encode(array('success' => false, 'message' => 'Failed to delete order.'));
    }
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];

    echo deleteOrder($id, $name);
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}

?>

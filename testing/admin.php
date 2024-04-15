<?php
header("Access-Control-Allow-Origin: *");

function searchOrderById($id) {
    $file_path = 'orders/' . $id . '.txt';
    if (file_exists($file_path)) {
        $order_details = file_get_contents($file_path);
        return explode(", ", $order_details); // Returns an array of order details
    } else {
        return false; // Order not found
    }
}

// $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// echo $actual_link;

if(isset($_GET['code']) && isset($_GET['username']) && isset($_GET['password'])) {

echo '<button class="waves-effect waves-light btn" onclick=\'location.href="admin.html?username=' . $_GET['username'] . '&password=' . $_GET['password'] . '";\'> General Order </button>';
    
echo '<link rel="stylesheet" href="style/materialize.min.css">';

echo '<script src="style/materialize.min.js"></script>';

    echo $_GET['code'];
    $pswd = $_GET['password'];
    $account = $_GET['username'];

    if (hash('md5', $pswd . "*&*^") == '4ca922f522829dd23b3394de2d95ca23' and $account == 'adad') {
        // Function to search for an order by ID

            $id = $_GET['code'];

            $order_details = searchOrderById($id);

            if ($order_details !== false) {
                echo '<table>';
                echo '<tr><th>Order ID</th><th>Name</th><th>Phone</th><th>Time</th><th>吐司</th><th>可樂</th><th>多多綠</th><th>冬瓜檸</th><th>雪碧</th><th>銅鑼燒</th><th>布雷</th><th>A套餐</th><th>B套餐</th><th>C套餐</th><th>價格</th></tr>';
                // echo json_encode(array('success' => true, 'order_details' => $order_details));
                echo '<tr><th> Result </th>';
                // print_r($order_details);
                for($i = 0;$i < sizeof($order_details);$i = $i + 1) {
                    echo '<th>' . $order_details[$i] . '</th>';
                }
                echo '</tr></table>';
            } else {
                echo json_encode(array('success' => false, 'message' => 'Order not found.'));
            }
            // echo '2';
    } else {
        die('password is wrong.');
    }
    // echo '1';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $account= $_POST['account'];
    $pswd = $_POST['pswd'];

    if (hash('md5', $pswd . "*&*^") == '4ca922f522829dd23b3394de2d95ca23' and $account == 'adad') {
        $sort_by = isset($_POST['sort_by']) ? $_POST['sort_by'] : 'id';
        $all_orders = getAllOrders($sort_by);
        // Output the sorting form
        /*        
        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        echo '<label for="sort_by">Sort By:</label>';
        echo '<select name="sort_by" id="sort_by">';
        echo '<option value="id">Order ID</option>';
        echo '<option value="time">時間</option>';
        echo '</select>';
        echo '<input type="submit" value="Sort">';
        echo '</form>';*/
        echo '<table border="1">';
        echo '<tr><th>Order ID</th><th>Name</th><th>Phone</th><th>Time</th><th>吐司</th><th>可樂</th><th>多多綠</th><th>冬瓜檸</th><th>雪碧</th><th>銅鑼燒</th><th>布雷</th><th>A套餐</th><th>B套餐</th><th>C套餐</th><th>價格</th></tr>';
        foreach ($all_orders as $order) {
            echo '<tr>';
            echo '<td>' . $order['id'] . '</td>';
            echo '<td>' . $order['name'] . '</td>';
            echo '<td>' . $order['phone'] . '</td>';
            echo '<td>' . $order['time'] . '</td>';
            echo '<td>' . $order['total_sandwitch'] . '</td>';
            echo '<td>' . $order['total_cola'] . '</td>';
            echo '<td>' . $order['total_green'] . '</td>';
            echo '<td>' . $order['total_lemon'] . '</td>';
            echo '<td>' . $order['total_sp'] . '</td>';
            echo '<td>' . $order['total_tls'] . '</td>';
            echo '<td>' . $order['total_bul'] . '</td>';
            echo '<td>' . $order['sa'] . '</td>';
            echo '<td>' . $order['sb'] . '</td>';
            echo '<td>' . $order['sc'] . '</td>';
            echo '<td>' . $order['money'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    else{
        echo 'wrong account or password';
    }
}


// Function to read all order files and extract order details
function getAllOrders($sort_by) {
    $orders = array();

    // Get all order files
    $order_files = glob("orders/*.txt");

    // Loop through each order file
    foreach ($order_files as $file) {
        $order_details = file_get_contents($file);
        $order_info = explode(", ", $order_details);

        // Extract order details
        $order_id = basename($file, '.txt');
        $name = $order_info[0];
        $phone = $order_info[1];
        $time = $order_info[2];
        $total_sandwitch = $order_info[3];
        $total_cola = $order_info[4];
        $total_green = $order_info[5];
        $total_lemon = $order_info[6];
        $total_sp = $order_info[7];
        $total_tls = $order_info[8];
        $total_bul = $order_info[9];
        $sa = $order_info[10];
        $sb = $order_info[11];
        $sc = $order_info[12];
        $money = $order_info[13];

        // Add order details to array
        $orders[] = array(
            'id' => $order_id,
            'name' => $name,
            'phone' => $phone,
            'time' => $time,
            'total_sandwitch' => $total_sandwitch,
            'total_cola' => $total_cola,
            'total_green' => $total_green,
            'total_lemon' => $total_lemon,
            'total_sp' => $total_sp,
            'total_tls' => $total_tls,
            'total_bul' => $total_bul,
            'sa' => $sa,
            'sb' => $sb,
            'sc' => $sc,
            'money' => $money
        );
    }
    
    usort($orders, function($a, $b) use ($sort_by) {
        return strcmp($a[$sort_by], $b[$sort_by]);
    });

    return $orders;
}

?>

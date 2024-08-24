<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Decode the JSON-encoded cart items received from the client side and store them in an array
    $cart_items = json_decode($_POST['cart_items'], true);
    $payment_method = $_POST['payment_method'];
    $total_price = $_POST['total_price'];
    $user_id = $_SESSION['user_id'] ?? null;

    // Fetch user's discount
    $discount = 0;
    // If the user is logged in, fetch their discount from the database
    if ($user_id) {
        $stmt = mysqli_prepare($conn, "SELECT discount FROM users WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $discount);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Calculate the discounted price by applying discount to the total price
    $discounted_price = $total_price * (1 - $discount / 100);

    mysqli_begin_transaction($conn);

    try {
        // Insert the main order into the orders table with user ID, discounted price, payment method, and current date/time.
        $stmt = mysqli_prepare($conn, "INSERT INTO orders (user_id, total_price, payment_method, order_date) VALUES (?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "ids", $user_id, $discounted_price, $payment_method);
        mysqli_stmt_execute($stmt);
        $order_id = mysqli_insert_id($conn);

        // Prepare the statement for inserting items into the order_items table.
        $stmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, menu_item_id, quantity, item_price) VALUES (?, ?, ?, ?)");
        foreach ($cart_items as $item) {
            mysqli_stmt_bind_param($stmt, "iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
            mysqli_stmt_execute($stmt);
        }

        // Commit the transaction to save the changes to the database.
        mysqli_commit($conn);
        echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => 'Error placing order: ' . $e->getMessage()]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
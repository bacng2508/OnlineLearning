<?php

function createOrder($userId, $itemsInCart) {
    // $orderCode = strtoupper(substr(uniqid(), 0, 5));
    $orderCode = "OD".rand(1, 99999);
    // Create new Order
    $sqlCreateOrder = "INSERT INTO orders(user_id, order_code) VALUES($userId, '$orderCode')";
    $orderId = pdo_lastInsertId($sqlCreateOrder);

    $totalMoney = 0;
    // Add items to Order
    foreach($itemsInCart as $item) {
        $sqlAddOrderItems = "INSERT INTO order_details(course_id, order_id) VALUES(".$item['course_id'].", $orderId)";
        pdo_execute($sqlAddOrderItems);
        $totalMoney+=$item['course_price'];
    }

    // Caculate 
    $sql = "UPDATE orders SET total_money='$totalMoney' WHERE id=$orderId";
    pdo_execute($sql);
    

    $result = [
        "orderId" => $orderId,
        "totalMoney" => $totalMoney
    ];
    return $result;
}

function getOrderCode($orderId) {
    $sql = "SELECT * FROM orders WHERE id=$orderId";
    return pdo_query_one($sql)['order_code'];
}

function getOrder($orderId) {
    $sql = "SELECT * FROM orders WHERE id=$orderId";
    return pdo_query_one($sql);
}

function getOrderItems($orderId) {
    $sql = "SELECT * FROM order_details WHERE order_id=$orderId";
    return pdo_query($sql);
}

function getItemOrderInDetail($orderId) {
    $sql = "SELECT courses.* FROM order_details JOIN courses ON order_details.course_id=courses.course_id WHERE order_details.order_id=$orderId";
    return pdo_query($sql);
}

function updateOrderStatus($orderId, $orderStatus) {
    $sql = "UPDATE orders SET order_status=$orderStatus WHERE id=$orderId";
    return pdo_execute($sql);
}

function getRevenueByMonth($month, $year) {
    $sql = "select sum(`total_money`) from `orders` where year(`created_at`) = $year and month(`created_at`) = $month and order_status=1" ;
    return pdo_query_value($sql);
}


// function createNewOrder($userId) {
//     $sqlCreateOrder = "INSERT INTO orders(user_id) VALUES($userId)";
//     return pdo_lastInsertId($sqlCreateOrder);
// }

// function addItemsToOrder($orderId, $itemsInCart) {
//     $totalMoney = 0;
//     foreach($itemsInCart as $item) {
//         $sqlAddOrderItems = "INSERT INTO order_details(course_id, order_id) VALUES(".$item['course_id'].", $orderId)";
//         pdo_execute($sqlAddOrderItems);
//         $totalMoney+=$item['course_price'];
//     }

//     // Caculate 
//     $sql = "UPDATE orders SET total_money='$totalMoney' WHERE id=$orderId";
//     pdo_execute($sql);


// }


function getAllOrder() {
    $sql = "SELECT * FROM orders JOIN users ON orders.user_id=users.user_id ORDER BY orders.created_at DESC";
    return pdo_query($sql);
}

// function getOrder($orderId) {
//     $sql = "SELECT * FROM orders WHERE order_id=$orderId";
//     return pdo_query_one($sql);
// }

// function changeOrderStatus($orderStatus, $orderId) {
//     $sql = "UPDATE orders SET order_status='$orderStatus' WHERE order_id=$orderId";
//     return pdo_checkStatusSql($sql);
// }

// function checkUserCourseAvailable($userId, $courseId) {
//     $sql = "SELECT * FROM user_courses WHERE user_id=$userId AND course_id=$courseId";
//     return pdo_query_one($sql);
// }

// function activeCourse($userId, $courseId) {
//     $sql = "INSERT INTO user_courses(user_id, course_id) VALUES('$userId', '$courseId')";
//     return pdo_checkStatusSql($sql);
// }

// function removeCourseUser($userId, $courseId) {
//     $sql = "DELETE FROM user_courses WHERE user_id=$userId AND course_id=$courseId";
//     return pdo_checkStatusSql($sql);
// }

?>
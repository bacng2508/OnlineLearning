<?php

function totalUser(){
    $sql = "SELECT COUNT(*) FROM users WHERE roles = 3";
    return pdo_query_value($sql);
}

function totalCourse(){
    $sql = "SELECT COUNT(*) FROM courses";
    return pdo_query_value($sql);
}

function totalOrder(){
    $sql = "SELECT COUNT(*) FROM orders";
    return pdo_query_value($sql);
}

function totalRevenue(){
    $sql = "SELECT SUM(total_money) FROM orders WHERE order_status = 1;";
    return pdo_query_value($sql);
}

function recentOrders() {
    $sql = "SELECT * FROM orders JOIN users ON orders.user_id=users.user_id ORDER BY orders.created_at DESC LIMIT 5 ";
    return pdo_query($sql);
}

function recentCustomers() {
    $sql = "SELECT * FROM users WHERE roles=3 ORDER BY users.created_at DESC LIMIT 5";
    return pdo_query($sql);
}

// //get all Course
function allCourse(){
    $sql = "SELECT COUNT(*) AS courses FROM `courses` ";
    return pdo_query_one($sql);
}

//khoá học chờ xác nhận
function orderAwaiting(){
    $sql = "SELECT COUNT(*) AS awating FROM `orders` WHERE order_status = 2";
    return pdo_query_one($sql);
}

//số danh mục khóa học
function countCategoty(){
    $sql = "SELECT COUNT(*) AS countCategoty FROM `category` ";
    return pdo_query_one($sql);
}

//
function loadDoanhThu(){
    $dateStart = date("Y");
    $dateEnd = date("Y-m-d H:i:s");
    $sql = "SELECT o.order_id, u.user_name, c.course_name, o.order_date, c.course_price
            FROM `orders` as o 
            JOIN users as u ON o.user_id = u.user_id
            JOIN courses as c on c.course_id = o.course_id
            WHERE order_status = 1
            AND order_date BETWEEN '$dateStart' AND '$dateEnd'
            ORDER BY order_date DESC;
    ";
    return pdo_query($sql);
}
?>
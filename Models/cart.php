<?php

//show_Category

function getUserCart($userId) {
    $sql = "SELECT * FROM carts WHERE user_id=$userId";
    return pdo_query($sql);
}

function getCartItems($userId) {
    // $sql = "SELECT carts.user_id, products.* FROM carts JOIN products ON carts.product_id=products.product_id WHERE carts.user_id=$userId";
    $sql = "SELECT cour.* FROM carts AS ca JOIN courses AS cour ON ca.course_id=cour.course_id WHERE ca.user_id=$userId";
    return pdo_query($sql);
}

function checkCourseInCart($courseId, $userId) {
    $sql = "SELECT * FROM carts WHERE course_id=$courseId AND user_id=$userId";
    return pdo_query_one($sql);
}

function addToCart($courseId, $userId) {
    $sql = "INSERT INTO carts(course_id, user_id) VALUES($courseId, $userId)";
    return pdo_checkStatusSql($sql);
}

function clearCart($userId) {
    $sql = "DELETE FROM carts WHERE user_id=$userId";
    return pdo_execute($sql);
}

?>
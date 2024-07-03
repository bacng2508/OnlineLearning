<?php

function checkLoginAdmin($loginName, $password) {
    $sql = "SELECT * FROM users WHERE user_loginName='$loginName' AND user_password='$password' AND (roles=1 OR roles=2)";
    return pdo_query_one($sql);
}

function getAdminInfo($adminId) {
    $sql = "SELECT * FROM users WHERE user_id=$adminId";
    return pdo_query_one($sql);
}

function updateAdminInfo($adminId, $userName) {
    $sql = "UPDATE users SET user_name='$userName' WHERE user_id=$adminId";
    return pdo_checkStatusSql($sql);
}

function checkAdminPassword($adminId, $password) {
    $sql = "SELECT * FROM users WHERE user_id='$adminId' AND user_password='$password'";
    return pdo_query_one($sql);
}

function changeAdminPassword($adminId, $newPassword) {
    $sql = "UPDATE users SET user_password='$newPassword' WHERE user_id=$adminId";
    return pdo_checkStatusSql($sql);
}

function changeAvatar($adminId, $newAvatar) {
    $sql = "UPDATE users SET user_avatar='$newAvatar' WHERE user_id=$adminId";
    return pdo_checkStatusSql($sql);
}

function checkEmailAvailable($email) {
    $sql = "SELECT * FROM users WHERE user_email='$email'";
    return pdo_query_one($sql);
}


?>
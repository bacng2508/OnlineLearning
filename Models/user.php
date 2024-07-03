<?php

function getAllUser() {
    $sql = "SELECT * FROM users ORDER BY roles ASC";
    return pdo_query($sql);
}

function deleteUser($userId) {
    $sql = "DELETE FROM users WHERE user_id=$userId";
    return pdo_checkStatusSql($sql);
}

function getUser($userId) {
    $sql = "SELECT * FROM users WHERE user_id=$userId";
    return pdo_query_one($sql);
}

function checkLoginName($loginName) {
    $sql = "SELECT * FROM users WHERE user_loginName='$loginName'";
    return pdo_query_one($sql);
}

function checkEmail($userEmail) {
    $sql = "SELECT * FROM users WHERE user_email='$userEmail'";
    return pdo_query_one($sql);
}

function insertUser($loginName, $user_name, $userPassword, $userAvatar, $userEmail, $userRole) {
    if ($userRole == 3) {
        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    } else {
        $userPassword = sha1($userPassword);
    }
    $sql = "INSERT INTO users(user_loginName, user_name, user_password, user_avatar, user_email, roles) VALUES('$loginName', '$user_name', '$userPassword', '$userAvatar', '$userEmail', '$userRole')";
    return pdo_checkStatusSql($sql);
}

function editUser($userName, $userAvatar, $userId) {
    if ($userAvatar != "") {
        $sql = "UPDATE users SET user_name='$userName', user_avatar='$userAvatar' WHERE user_id='$userId'";
    } else {
        $sql = "UPDATE users SET user_name='$userName' WHERE user_id='$userId'";
    }
    return pdo_checkStatusSql($sql);
}

function changeUserStatus($userStatus, $userId) {
    $sql = "UPDATE users SET user_status=$userStatus WHERE user_id=$userId";
    return pdo_checkStatusSql($sql);
}



?>
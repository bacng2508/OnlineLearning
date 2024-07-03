<?php 
function checkAccountExist($email) {
    $sql = "SELECT * FROM users WHERE user_email='$email'";
    return pdo_query_one($sql);
}

function insertClient($loginName, $username, $email, $password, $role=3) {
    $sql = "insert into users(user_loginName, user_name, user_email, user_password, roles) values('$loginName', '$username', '$email', '$password', '$role')";
    return pdo_checkStatusSql($sql);
}

function checkLoginNameExist($loginName) {
    $sql = "SELECT * FROM users WHERE user_loginName='$loginName'";
    return pdo_query_one($sql);
}

function checkLoginName($loginName) {
    $sql = "SELECT * FROM users WHERE user_loginName='$loginName' and roles=3";
    return pdo_query_one($sql);
}

function checkIdLogin($userId) {
    $sql = "SELECT * FROM users WHERE user_id=$userId";
    return pdo_query_one($sql);
}

function editProfile($username, $userId) {
    $sql = "UPDATE users SET user_name='$username' WHERE user_id=$userId";
    return pdo_checkStatusSql($sql);
}

function checkClientEmailExist($email) {
    $sql = "SELECT * FROM users WHERE user_email='$email' and roles=3";
    return pdo_query_one($sql);
}

function resetPassword($passwordHashed, $userEmail) {
    $sql = "UPDATE users SET user_password='$passwordHashed' WHERE user_email='$userEmail'";
    return pdo_checkStatusSql($sql);
}

function orderList($userId) {
    $sql = "SELECT * FROM orders WHERE user_id=$userId";
    return pdo_query($sql);
}

function changeClientPassword($newHashedPassword, $userId) {
    $sql = "UPDATE users SET user_password='$newHashedPassword' WHERE user_id='$userId'";
    return pdo_checkStatusSql($sql);;
}

function changeClientAvatar($newAvatar, $userId) {
    $sql = "UPDATE users SET user_avatar='$newAvatar' WHERE user_id=$userId";
    return pdo_checkStatusSql($sql);
}

function getOrderdList($userId) {
    $sql = "SELECT * FROM orders WHERE user_id=$userId AND order_status=1";
    return pdo_query($sql);
}

function addCourseToClient($userId, $courseList) {
    foreach($courseList as $course) {
        $sqlAddOrderItems = "INSERT INTO user_courses(user_id, course_id) VALUES($userId, ".$course['course_id'].")";
        pdo_execute($sqlAddOrderItems);
    }
}

function checkMyCourse($userId, $courseId) {
    $sql = "SELECT * FROM user_courses WHERE user_id=$userId AND course_id=$courseId";
    return pdo_query_one($sql);
}

function getMyCourses($clientId) {
    // $sql = "SELECT * FROM user_courses JOIN courses ON user_courses.course_id=courses.course_id WHERE user_id=$clientId";
    $sql = "SELECT courses.* FROM user_courses JOIN courses ON user_courses.course_id=courses.course_id WHERE user_id=$clientId";
    return pdo_query($sql);
}

?>


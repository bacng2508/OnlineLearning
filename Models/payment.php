<?php

function savePayment($paymentInfor) {
    $vnp_TmnCode = $paymentInfor['vnp_TmnCode'];
    $vnp_Amount = $paymentInfor['vnp_Amount'];
    $vnp_BankCode = $paymentInfor['vnp_BankCode'];
    $vnp_PayDate = $paymentInfor['vnp_PayDate'];
    $vnp_OrderInfo = $paymentInfor['vnp_OrderInfo'];
    $vnp_TransactionNo = $paymentInfor['vnp_TransactionNo'];
    $vnp_ResponseCode = $paymentInfor['vnp_ResponseCode'];
    $vnp_TransactionStatus = $paymentInfor['vnp_TransactionStatus'];
    $vnp_TxnRef = $paymentInfor['vnp_TxnRef'];
    
    $sql = "INSERT INTO vnpay_infor(vnp_TmnCode, vnp_Amount, vnp_BankCode, vnp_PayDate, vnp_OrderInfo, vnp_TransactionNo, vnp_ResponseCode, vnp_TransactionStatus, vnp_TxnRef) 
    VALUES('$vnp_TmnCode', '$vnp_Amount', '$vnp_BankCode', '$vnp_PayDate', '$vnp_OrderInfo', '$vnp_TransactionNo', '$vnp_ResponseCode', '$vnp_TransactionStatus', '$vnp_TxnRef')";
    pdo_execute($sql);

    return $vnp_TxnRef;
}

// //trạng thái thanh toán
// function order($order_id, $user_id, $course_id, $order_date, $order_status){
//     $sql = "INSERT INTO orders(order_id, user_id, course_id, order_date, order_status) 
//             VALUES($order_id, $user_id, $course_id, '$order_date', $order_status)";
//     pdo_execute($sql);
// }

// //lịch sử thanh toán
// function historyPayment($user_id){
//     $sql = "SELECT courses.course_name, order_id, order_date, courses.course_price, order_status 
//             FROM `orders` JOIN `courses` on orders.course_id = courses.course_id
//             WHERE user_id = $user_id ORDER BY `order_date` DESC";
//     return pdo_query($sql);
// }
?>
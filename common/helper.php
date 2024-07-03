<?php

function format_currency($n=0, $currency='đ') {
    $n = (string)$n;
    $n = strrev($n);
    $res = '';
    for ($i = 0; $i < strlen($n); $i++) {
        if ($i%3===0 && $i!=0) {
            $res.=',';
        }
        $res.=$n[$i];
    }
    $res=strrev($res)." $currency";
    return $res;
}

function format_timestamp($timeStamp) {
    return date('H:i:s d-m-Y', strtotime($timeStamp));
}

function randomPassword() {
    $passwordCharacters = "abcdefghiklmnopqrstuvwxyzABCDEFGHIKLMNOPQRSTUVWXYZ0123456789.@#";
    $newPassword = substr(md5(rand(0, 999999)), 0, 5);
    return $newPassword;
}

function createPayment($orderId, $orderCode, $totalMoney) {
    $vnp_TmnCode = "8JFJ26RJ"; //Mã định danh merchant kết nối (Terminal Id)
    // $vnp_HashSecret = "MJAZJTFLNEANKHZPFQGOPRANTBQOKRLU"; //Secret key old
    $vnp_HashSecret = "XD9HAJM2G4423IPDKJ7YCULBGX5AZIR2"; //Secret key new
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://polyuni.edu.vn/index.php?act=payment-result";
    $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
    $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
    //Config input format

    //Expire
    $startTime = date("YmdHis");
    $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

    $vnp_TxnRef = $orderId; //Mã giao dịch thanh toán tham chiếu của merchant
    $vnp_Amount = $totalMoney; // Số tiền thanh toán
    $vnp_Locale = "vn"; //Ngôn ngữ chuyển hướng thanh toán
    $vnp_BankCode = "VNBANK"; //Mã phương thức thanh toán
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount* 100,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => "Thanh toan đơn hàng: ".$orderCode,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate"=>$expire,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    header('Location: ' . $vnp_Url);
};

function checkClientPermission() {
    if (!isset($_SESSION['clientLogin'])) {
        header('Location: /');
    }
}

function checkAdminPermission() {
    if (!isset($_SESSION['admin'])) {
        header("Location: ?act=login");
    }
}
?>
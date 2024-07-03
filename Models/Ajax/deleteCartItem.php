<?php 

    include_once "../connect.php";

    if (isset($_POST['courseId']) && isset($_POST['clientId'])) {
        $courseId = $_POST['courseId'];
        $clientId = $_POST['clientId'];

        // $sqlCheckCourseInCart = "SELECT * FROM carts WHERE user_id=$clientId AND course_id=$courseId";
        $sqlDeleteCartItem = "DELETE FROM carts WHERE user_id=$clientId AND course_id=$courseId";
        if (pdo_checkStatusSql($sqlDeleteCartItem)) {
            $sqlGetCartItems = "SELECT cour.* FROM carts AS ca JOIN courses AS cour ON ca.course_id=cour.course_id WHERE ca.user_id=$clientId";
            // $sqlGetCart = "SELECT * FROM carts WHERE user_id=$clientId";
            $cartItems = pdo_query($sqlGetCartItems);
            $quantityInCart = sizeof($cartItems);
            $totalMoney = 0;

            foreach ($cartItems as $item) {
                if ($item['course_price_sale'] != 0) {
                    $totalMoney+=$item['course_price_sale'];
                } else {
                    $totalMoney+=$item['course_price'];
                }
            }
            
            $result = [
                'quantityInCart' => $quantityInCart,
                'totalMoney' => $totalMoney
            ];
            

            echo json_encode($result);
            // echo sizeof($cartList);
            // if (sizeof($cartList) > 0) {
            // } else {
            //     echo 0;
            // }
            
        } else {
            echo false;
        }
        
    }

?>
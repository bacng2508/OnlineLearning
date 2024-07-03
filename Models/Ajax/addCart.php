<?php 

    include_once "../connect.php";

    if (isset($_POST['courseId']) && isset($_POST['clientId'])) {
        $courseId = $_POST['courseId'];
        $clientId = $_POST['clientId'];

        $sqlCheckCourseInCart = "SELECT * FROM carts WHERE user_id=$clientId AND course_id=$courseId";
        if (!pdo_query_one($sqlCheckCourseInCart)) {
            $sqlUpdateCart = "INSERT INTO carts(user_id, course_id) values ($clientId, $courseId)";
            if (pdo_checkStatusSql($sqlUpdateCart)) {

                // $coursePrice = pdo_query_value("SELECT course_price FROM courses WHERE course_id=$productId");

                // $sqlUpdateTotalMoney = "UPDATE carts SET cart_total_money=cart_total_money+$coursePrice WHERE cart_id=$cartId";
                // pdo_execute($sqlUpdateTotalMoney);

                // $sqlCaculateTotalMoney = "SELECT SUM(course_price) FROM cart_detail JOIN courses on cart_detail.course_id=course.course_id WHERE cart_id=$cartId";
                // $totalMoney = pdo_query($sqlCaculateTotalMoney);

                // $sqlUpdateTotalMoney = "UPDATE carts SET cart_total_money=$totalMoney WHERE cart_id=$cartId";
                // pdo_execute($sql);

                // $sqlCountQuantityInCart = "SELECT COUNT(*) FROM cart_detail WHERE cart_id=$cartId";
                $sqlCountQuantityInCart = "SELECT * FROM carts WHERE user_id=$clientId";
                $result = pdo_query($sqlCountQuantityInCart);

                $quantityInCart = sizeof($result);
                
                echo $quantityInCart;

            } else {
                echo false;
            }
        }
    }

?>
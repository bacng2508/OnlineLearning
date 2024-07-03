<?php
    include_once "../connect.php";

    if (isset($_POST['rating_data'])) {
        $courseId = $_POST['course_id'];
        $clientId = $_POST['user_id'];
        $clientRating = $_POST['rating_data'];
        $clientReview = $_POST['user_review'];
        $reviewDate = date("Y-m-d H:i:s");

        $sql = "INSERT INTO reviews(user_id, course_id, review_rate, review_content, review_date)
        VALUES('$clientId', '$courseId', '$clientRating', '$clientReview', '$reviewDate')";

        pdo_execute($sql);

        echo "Đánh giá của bạn đã được ghi nhận!";
    }

    if (isset($_POST['action']) && isset($_POST['courseId'])) {
        $courseId = $_POST['courseId'];
        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = array();

        $sql = "SELECT reviews.*, users.user_name, users.user_avatar FROM reviews JOIN users ON reviews.user_id=users.user_id WHERE reviews.course_id=$courseId ORDER BY reviews.review_id DESC";
        $result = pdo_query($sql);

        foreach($result as $row) {
            $review_content[] = array(
                'course_id'         =>  $row["course_id"],
                'user_id'		    =>	$row["user_id"],
                'user_name'         =>  $row["user_name"],
                'user_avatar'       =>  ($row["user_avatar"]) ? $row["user_avatar"] : "avatar_default.png",
                'user_review'	    =>	$row["review_content"],
                'rating'		    =>	$row["review_rate"],
                'datetime'		    =>	date("Y-m-d H:i:s")
            );

            if($row["review_rate"] == '5')
            {
                $five_star_review++;
            }

            if($row["review_rate"] == '4')
            {
                $four_star_review++;
            }

            if($row["review_rate"] == '3')
            {
                $three_star_review++;
            }

            if($row["review_rate"] == '2')
            {
                $two_star_review++;
            }

            if($row["review_rate"] == '1')
            {
                $one_star_review++;
            }

            $total_review++;

            $total_user_rating = $total_user_rating + $row["review_rate"];
        }

        $average_rating = $total_user_rating / $total_review;

        $output = array(
            'average_rating'	=>	number_format($average_rating, 1),
            'total_review'		=>	$total_review,
            'five_star_review'	=>	$five_star_review,
            'four_star_review'	=>	$four_star_review,
            'three_star_review'	=>	$three_star_review,
            'two_star_review'	=>	$two_star_review,
            'one_star_review'	=>	$one_star_review,
            'review_data'		=>	$review_content
        );

        echo json_encode($output);
    }

?>
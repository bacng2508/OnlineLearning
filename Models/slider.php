<?php

function getAllSlider() {
    $sql = "SELECT * FROM sliders";
    return pdo_query($sql);
}

function getHomeSlider() {
    $sql = "SELECT * FROM sliders WHERE slider_status=1 ORDER BY slider_order ASC";
    return pdo_query($sql);
}

function deleteSlider($sliderId) {
    $sql = "DELETE FROM sliders WHERE slider_id=$sliderId";
    return pdo_checkStatusSql($sql);
}

function getSlider($sliderId) {
    $sql = "SELECT * FROM sliders WHERE slider_id=$sliderId";
    return pdo_query_one($sql);
}

function changeSliderStatus($sliderId, $sliderStatus) {
    $sql = "UPDATE sliders SET slider_status=$sliderStatus WHERE slider_id=$sliderId";
    return pdo_checkStatusSql($sql);
}

function getSliderOrderAvailable($sliderOrder) {
    $sql = "SELECT * FROM sliders WHERE slider_order='$sliderOrder'";
    return pdo_query_one($sql);
}

function insertSlider($sliderOrder, $sliderImg) {
    $sql = "INSERT INTO sliders(slider_order, slider_img) VALUES('$sliderOrder', '$sliderImg')";
    return pdo_checkStatusSql($sql);
}

function editSlider($sliderOrder, $sliderImg, $sliderId) {
    if ($sliderImg != "") {
        $sql = "UPDATE sliders SET slider_order='$sliderOrder', slider_img='$sliderImg' WHERE slider_id='$sliderId'";
    } else {
        $sql = "UPDATE sliders SET slider_order='$sliderOrder' WHERE slider_id='$sliderId'";
    }
    return pdo_checkStatusSql($sql);
}

// function editLesson($lessonOrder, $lessonName, $lessonPath, $lesson_id) {
//     if ($lessonPath != "") {
//         $sql = "UPDATE course_lessons SET lesson_order='$lessonOrder', lesson_name='$lessonName', lesson_path='$lessonPath' WHERE lesson_id='$lesson_id'";
//     } else {
//         $sql = "UPDATE course_lessons SET lesson_order='$lessonOrder', lesson_name='$lessonName' WHERE lesson_id='$lesson_id'";
//     }
//     return pdo_checkStatusSql($sql);
// }






?>
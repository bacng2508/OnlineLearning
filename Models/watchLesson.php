<?php
//
function getNameCourse($idCourse){
    $sql = "SELECT course_name FROM `courses` WHERE course_id = $idCourse AND course_status = 1";
    return pdo_query_one($sql);
}

// 
function getChapterCourse($idCourse){
    $sql = "SELECT chapter_name, chapter_id FROM `course_chapters`
            WHERE course_id = $idCourse AND chapter_status = 1";
    return pdo_query($sql);
}

//
function getLessonCourse($idCourse){
    $sql = "SELECT lesson_name, lesson_path, cl.chapter_id FROM `course_lessons` AS cl
            JOIN course_chapters AS cc ON cc.chapter_id = cl.chapter_id
            WHERE course_id = $idCourse AND lesson_status = 1";
    return pdo_query($sql);
}
?>
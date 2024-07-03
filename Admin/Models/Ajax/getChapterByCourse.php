<?php

include_once "../../../Models/connect.php";

    if (isset($_POST['courseId'])) {
        $courseId = $_POST['courseId'];

        $query = "SELECT * FROM course_chapters WHERE course_id='$courseId'";

        $result = pdo_query($query);

        $listChapterHTML = "<option selected value='0'>Chọn chương học</option>";
        if (count($result) > 0) {
            foreach ($result as $chapter) {
                // $listCourseSearch.=('
                //     <a href="index.php?act=course-detail&courseId='.$item['course_id'].'" class="list-group-item list-group-item-action" aria-current="true">'.$item['course_name'].'</a>');
                $listChapterHTML.=('<option value="'.$chapter['chapter_id'].'">'.$chapter['chapter_name'].'</option>');
            }                    
        }
        echo $listChapterHTML;
        // echo $result;
        
    }
?>

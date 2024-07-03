<?php
    include_once "../connect.php";

    if (isset($_POST['input'])) {
        $input = $_POST['input'];

        $query = "SELECT * FROM courses WHERE course_name LIKE '%$input%' LIMIT 0,8";

        $result = pdo_query($query);

        $listCourseSearch = "";
        if (sizeof($result) > 0) {
            foreach ($result as $item) {
                $listCourseSearch.=('
                    <a href="index.php?act=course-detail&id='.$item['course_id'].'" class="list-group-item list-group-item-action" aria-current="true">'.$item['course_name'].'</a>
                ');
            }                    
        }
        echo $listCourseSearch;
        
    }

?>
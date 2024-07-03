<?php
if (isset($_POST['search']) && isset($_POST['category_id'])) {
    
    $search = $_POST['search'];
    $category_id = $_POST['category_id'];

    $connect = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    $sql = "SELECT * FROM courses WHERE course_name LIKE '%".$search."%'" . " AND category_id = $category_id AND course_status = 1";
    $stsm = $connect->query($sql);

    $output = "";
    if($stsm->rowCount() > 0)
        while($row = $stsm->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $output .= "<a href='index.php?act=course&course_id=$course_id' class='list-group-item list-group-item-action'>$course_name</li>";
        }

    echo $output;
}
?>
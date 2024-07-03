<?php
if (isset($_POST['course_id']) && $_POST['user_id']) {
    
    $course_id = $_POST['course_id'];
    $user_id = $_POST['user_id'];

    $connect = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    $sql = "DELETE FROM carts
        WHERE user_id = $user_id AND course_id = $course_id";

    $stsm = $connect->query($sql);

    $sql = "SELECT * FROM carts 
            JOIN `courses` on carts.course_id = courses.course_id
            WHERE user_id = $user_id";
    $stsm = $connect->query($sql);

    $output = "";
    if($stsm->rowCount() > 0)
        while($row = $stsm->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $img = "./Public/images/imgCourse/".$course_image;
            $course_price = number_format($course_price, 0, ',', '.');
            $output .= "
            <tr>
                <th scope='row'><input class='form-check-input' type='radio' name='nameCourse' value='$course_price' onclick='getValue(this.value, $course_id)'></th>
                <td>
                    <div class='card d-flex flex-wrap '>
                        <img src='$img' alt='error' width='120px' height='68px'>
                            <div class='mt-2'>
                                <h6 class='card-title fs-lg'>$course_name</h6>
                            </div>
                    </div>
                </td>
                <td class='fw-bold h6'>$course_price đ</td>
                <td><button value='$course_id' onclick='removeCourse(this.value)' type='button' class='btn btn-outline-danger'>Xóa</button></td>
            </tr>";
        }

    echo $output;
}
?>
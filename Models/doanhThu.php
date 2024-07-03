<?php
// if (isset($_POST['dateEnd']) && isset($_POST['dateStart'])) {
    
//     $dateEnd = $_POST['dateEnd'];
//     $dateStart = $_POST['dateStart'];

//     $connect = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
//     $sql = "SELECT o.order_id, u.user_name, c.course_name, o.order_date, c.course_price
//             FROM `orders` as o 
//             JOIN users as u ON o.user_id = u.user_id
//             JOIN courses as c on c.course_id = o.course_id
//             WHERE order_status = 1
//             AND order_date BETWEEN '$dateStart' AND '$dateEnd'
//             ORDER BY order_date DESC";
//     $stsm = $connect->query($sql);

//     $output = "";
//     $i = 0;
//     if($stsm->rowCount() > 0)
//         while($row = $stsm->fetch(PDO::FETCH_ASSOC)){
//             extract($row);
//             ++$i;
//             $output .= "
//             <tr>
//                 <td>{$i}</td>
//                 <td>#$order_id</td>
//                 <td>$user_name</td>
//                 <td>$course_name</td>
//                 <td>$order_date</td>
//                 <td>$course_price đ</td>
//             </tr>
//             ";
            
//         }

//     echo $output;
// }
?>
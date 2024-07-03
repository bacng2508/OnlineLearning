<?php
if (isset($_POST['exportExcel'])) {

    $connect = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    $dateStart = date("Y");
    $dateEnd = date("Y-m-d H:i:s");
    $sql = "SELECT o.order_id, u.user_name, c.course_name, o.order_date, c.course_price
            FROM `orders` as o 
            JOIN users as u ON o.user_id = u.user_id
            JOIN courses as c on c.course_id = o.course_id
            WHERE order_status = 1
            AND order_date BETWEEN '$dateStart' AND '$dateEnd'
            ORDER BY order_date DESC";
    $stsm = $connect->query($sql);

    $output = "";
    $i = 0;

    if($stsm->rowCount() > 0){
        $output .= '
            <table class="table" border="1">
                <tr>    
                    <th>STT</th>
                    <th>ID đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Tên khóa học</th>
                    <th>Ngày mua</th>
                    <th>Giá</th>
                </tr>
                    ';

        while($row = $stsm->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            ++$i;
            $output .= "
            <tr>
                <td>{$i}</td>
                <td>#$order_id</td>
                <td>$user_name</td>
                <td>$course_name</td>
                <td>$order_date</td>
                <td>$course_price đ</td>
            </tr>
            ";
        }
        $output .= "</table>";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=download.xls");
        echo $output;
    }
}
?>
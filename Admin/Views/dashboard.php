<main class="app-content">
    <div class="row">
      <div class="col-md-12">
        <div class="app-title">
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><b>Bảng điều khiển</b></a></li>
          </ul>
          <div id="clock"><span class="date"> Thứ Bảy, 01/06/2024 - 15 giờ 33 phút 24 giây</span></div>
        </div>
      </div>
    </div>
    <div class="row">
      <!--Left-->
      <div class="col-md-12 col-lg-6">
        <div class="row">
       <!-- col-6 -->
       <div class="col-md-6">
        <div class="widget-small primary coloured-icon"><i class="icon bx bxs-user-account fa-3x"></i>
          <div class="info">
            <h4>Tổng khách hàng</h4>
            <p><b><?=$totalUser?> khách hàng</b></p>
            <p class="info-tong">Tổng số khách hàng được quản lý.</p>
          </div>
        </div>
      </div>
       <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small info coloured-icon"><i class="icon bx bxs-data fa-3x"></i>
              <div class="info">
                <h4>Tổng khóa học</h4>
                <p><b><?=$totalCourse?> khóa học</b></p>
                <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
              </div>
            </div>
          </div>
           <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small warning coloured-icon">
              <i class="icon bx bxs-shopping-bags fa-3x"></i>
              
              <div class="info">
                <h4>Tổng đơn hàng</h4>
                <p><b><?=$totalOrder?> đơn hàng</b></p>
                <p class="info-tong">Tổng số hóa đơn bán hàng.</p>
              </div>
            </div>
          </div>
           <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small danger coloured-icon">
              <!-- <i class="icon bx bxs-error-alt fa-3x"></i> -->
              <i class='icon bx bx-money fa-3x'></i>
              <div class="info">
                <h4>Tổng doanh thu</h4>
                <p><b><?=number_format($totalRevenue)?> đ</b></p>
                <p class="info-tong">Tổng doanh thu bán hàng.</p>
              </div>
            </div>
          </div>
           <!-- col-12 -->
           <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Đơn hàng mới</h3>
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">ID đơn hàng</th>
                      <th class="text-center">Tên khách hàng</th>
                      <th class="text-center">Tổng tiền</th>
                      <th class="text-center">Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($recentOrders as $key => $order) { ?>
                      <tr>
                        <td class="text-center"><?=$order['order_code']?></td>
                        <td class="text-center"><?=$order['user_name']?></td>
                        <td class="text-center"><?=format_currency($order['total_money'])?></td>
                        <td class="text-center">
                          <?php switch ($order['order_status']) {
                            case '0':
                              echo '<span class="badge bg-warning">Chờ xử lý</span>';
                              break;
                            case '1':
                              echo '<span class="badge bg-success">Đã hoàn thành</span>';
                              break;
                            case '2':
                              echo '<span class="badge bg-danger">Đã hủy</span>';
                              break;
                            case '3':
                              echo '<span class="badge bg-info">Đang vận chuyển</span>';
                              break;
                            default:
                              break;
                          } ?>
                        </td>
                      </tr>
                    <?php } ?>
                    <!-- <tr>
                      <td>AL3947</td>
                      <td>Phạm Thị Ngọc</td>
                      <td>
                        19.770.000 đ
                      </td>
                      <td><span class="badge bg-info">Chờ xử lý</span></td>
                    </tr>
                    <tr>
                      <td>ER3835</td>
                      <td>Nguyễn Thị Mỹ Yến</td>
                      <td>
                        16.770.000 đ	
                      </td>
                      <td><span class="badge bg-warning">Đang vận chuyển</span></td>
                    </tr>
                    <tr>
                      <td>MD0837</td>
                      <td>Triệu Thanh Phú</td>
                      <td>
                        9.400.000 đ	
                      </td>
                      <td><span class="badge bg-success">Đã hoàn thành</span></td>
                    </tr>
                    <tr>
                      <td>MT9835</td>
                      <td>Đặng Hoàng Phúc	</td>
                      <td>
                        40.650.000 đ	
                      </td>
                      <td><span class="badge bg-danger">Đã hủy	</span></td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
              <!-- / div trống-->
            </div>
           </div>
            <!-- / col-12 -->
             <!-- col-12 -->
            <div class="col-md-12">
                <div class="tile">
                  <h3 class="tile-title">Khách hàng mới</h3>
                <div>
                  <table class="table table-hover">
                    <thead>
                      <tr >
                        <th class="text-center">Tên khách hàng</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">SDT</th>
                        <th class="text-center">Ngày tạo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($recentCustomers as $key => $customer) { ?>
                        <tr>
                          <td class="text-center"><?=$customer['user_name']?></td>
                          <td class="text-center"><?=$customer['user_email']?></td>
                          <td class="text-center"><?=$customer['user_phone']?></td>
                          <td class="text-center"><span class="tag tag-success"><?=date( "d/m/Y", strtotime($customer['created_at']))?></span></td>
                        </tr>
                      <?php } ?>
                      
                      <!-- <tr>
                        <td>#219</td>
                        <td>Bánh tráng trộn</td>
                        <td>30/4/1975</td>
                        <td><span class="tag tag-warning">0912376352</span></td>
                      </tr>
                      <tr>
                        <td>#627</td>
                        <td>Cút rang bơ</td>
                        <td>12/3/1999</td>
                        <td><span class="tag tag-primary">01287326654</span></td>
                      </tr>
                      <tr>
                        <td>#175</td>
                        <td>Hủ tiếu nam vang</td>
                        <td>4/12/20000</td>
                        <td><span class="tag tag-danger">0912376763</span></td>
                      </tr> -->
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
             <!-- / col-12 -->
        </div>
      </div>
      <!--END left-->
      <!--Right-->
      <div class="col-md-12 col-lg-6">
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <!-- <h3 class="tile-title">Biểu đồ đơn hàng trong tháng</h3> -->
              <h3 class="tile-title">Biểu đồ khóa học theo danh mục</h3>
              <div class="embed-responsive embed-responsive-16by9 text-center" >
                  <canvas class="embed-responsive-item text-center" id="courseChart" width="900" height="404" style="width: 900px; height: 404px;"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Biểu đồ doanh thu</h3>
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="revenueChart" width="718" height="404" style="width: 718px; height: 404px;"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!--END right-->
    </div>
  </main>

  <script>
    const courseChart = document.getElementById('courseChart');
    console.log(123);
    new Chart(courseChart, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($categoryNames);?>,
                datasets: [{
                    label: 'Khóa học theo danh mục',
                    data: <?php echo json_encode($countCourseByCategory);?>,
                    backgroundColor: [
                        '#ef476f',
                        '#ffd166',
                        '#06d6a0',
                        '#118ab2',
                        '#073b4c',
                    ],
                    hoverOffset: 4
                }]
            },
            // options: {
            //   plugins: {
            //       legend: {
            //           display: true,
            //           position: 'right',
            //           labels: {
            //             fontColor: 'rgb(255, 99, 132)'
            //           }
            //       }
            //     } 
            // }
          });

    
    
    
    const revenueChart = document.getElementById('revenueChart');
    new Chart(revenueChart, {
            type: 'bar',
            data: {
                labels: [
                    'Tháng 1',
                    'Tháng 2',
                    'Tháng 3',
                    'Tháng 4',
                    'Tháng 5',
                    'Tháng 6',
                    'Tháng 7',
                    'Tháng 8',
                    'Tháng 9',
                    'Tháng 10',
                    'Tháng 11',
                    'Tháng 12',
                ],
                datasets: [{
                    label: 'Thống kê doanh thu',
                    data: <?php echo json_encode($revenueByMonth);?>,
                    fill: false,
                    borderColor: '#00559f',
                    tension: 0.1,
                    pointBackgroundColor: '#ccc',
                    fill: true,
                    backgroundColor: '#00559f',
                    tension: 0.4,
                    pointRadius: 0,
                    hoverPointRadius: 0
                }],
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 100000000,
                        ticks: {
                            stepSize: 10000000
                        }
                    },
                    x: {
                        beginAtZero: true,
                        grid: {
                          display: false,
                        }
                    }
                }
            }
        });


  </script>
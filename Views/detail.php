        <!-- Course detail -->
        <div class="container-fluid w-1400 my-4" id="course-detail">
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <img class="w-100" src="Public/images/imgCourse/<?= $courseDetail['course_image'] ?>"
                            alt="" />
                    </div>

                    <div class="row my-3">
                        <?php 
                            if ($isMyCourse) {
                                ?>
                        <div class="col-sm pe-sm-2 mb-2">
                            <a class="btn btn-primary btn-lg w-100 rounded-0 border-black border-2 bg__main-color fw-bold"
                                href="index.php?act=learn-course&courseId=<?= $courseDetail['course_id'] ?>">Học
                                ngay</a>
                        </div>
                        <?php 

                            } else {
                                ?>
                        <div class="col-sm pe-sm-2 mb-2">
                            <a class="btn btn-primary btn-lg w-100 rounded-0 border-black border-2 bg__main-color fw-bold"
                                id="buyCourseBtn"
                                href="index.php?act=buy-course&courseId=<?= $courseDetail['course_id'] ?>">Mua ngay</a>
                        </div>
                        <div class="col-sm ps-sm-2">
                            <button class="btn btn-primary btn-lg w-100 rounded-0 border-black border-2 bg-light text-dark fw-bold" id="addCartBtn">Thêm vào giỏ hàng</button>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1 class="fw-bolder pt-lg-3"><?= $courseDetail['course_name'] ?></h1>
                    <p class=" fw-bold fs-3 ps-2">
                        <?php if ($courseDetail["course_price_sale"] != 0) { ?>
                            <span class="me-2 text-danger" ><?= format_currency($courseDetail["course_price_sale"]) ?></span>
                            <span class="text-decoration-line-through fs-5 fw-light "><?= format_currency($courseDetail["course_price"]) ?></span>
                        <?php } else { ?>
                            <span class="text-danger"><?= format_currency($courseDetail["course_price"]) ?></span>
                        <?php } ?>
                    </p>
                    <div>
                        <h5 class="fw-bold mb-3">Khóa học này bao gồm:</h5>
                        <div class="row ps-3">
                            <div class="col-sm mb-3">
                                <?php
                                    $contentList = explode(";", $courseDetail['course_content']);
                                    foreach ($contentList as $content) : 
                                ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa-solid fa-check pe-2 align-content-between"></i>
                                        <span class=""><?=$content?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Course detail -->

        <!-- Course require -->
        <div class="container-fluid w-1400 my-4" id="course-desc">
            <h3 class="mb-3">Yêu cầu</h3>
            <div class="px-3">
                <?php
                    $requireList = explode(";", $courseDetail['course_require']);
                    foreach ($requireList as $require) : 
                ?>
                <div class="d-flex align-items-center mb-2">
                    <i class="fa-regular fa-clipboard pe-2 align-content-between"></i>
                    <span class=""><?=$require?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Course require -->


        <!-- Course desc -->
        <div class="container-fluid w-1400 my-4" id="course-desc">
            <h3 class="mb-3">Mô tả</h3>
            <p class="fs-5 text-justify px-3">
                <?= $courseDetail['course_desc'] ?>
            </p>
        </div>
        <!-- Course desc -->

        <!-- Review & Rating System -->
        <div class="container-fluid w-1400 my-5">
            <h3 class="mt-5 mb-3">Đánh giá khóa học</h3>
            <div class="card">
                <div class="card-header">Tổng quan đánh giá</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <h1 class="text-warning mb-4 mt-1">
                                <b><span id="average_rating">0.0</span> / 5</b>
                            </h1>
                            <div class="mb-3">
                                <i class="fas fa-star star-light me-1 main_star"></i>
                                <i class="fas fa-star star-light me-1 main_star"></i>
                                <i class="fas fa-star star-light me-1 main_star"></i>
                                <i class="fas fa-star star-light me-1 main_star"></i>
                                <i class="fas fa-star star-light me-1 main_star"></i>
                            </div>
                            <h3><span id="total_review">0</span> Đánh giá</h3>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center my-2 ">
                                <div class="progress-label-left">
                                    <b>5</b> <i class="fas fa-star text-warning"></i>
                                </div>
                                <div class="progress w-75 mx-2 " >
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="five_star_progress">
                                    </div>
                                </div>
                                <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            </div>
                            <div class="d-flex align-items-center my-2">
                                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                                <div class="progress w-75 mx-2">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                </div>
                                <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            </div>
                            <div class="d-flex align-items-center my-2">
                                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                                <div class="progress w-75 mx-2">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                </div>
                                <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            </div>
                            <div class="d-flex align-items-center my-2 ">
                                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                                <div class="progress w-75 mx-2">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                </div>
                                <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            </div>
                            <div class="d-flex align-items-center my-2">
                                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                                <div class="progress w-75 mx-2">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                </div>
                                <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            </div>

                        </div>

                        <?php 
                            if ($isMyCourse) {
                                ?>
                                <div class="col-sm-4 text-center">
                                    <h3 class="mt-4 mb-3">Viết đánh giá khóa học</h3>
                                    <button type="button" name="add_review" id="add_review"
                                        class="btn btn-primary rounded-1 btn-warning fw-medium text-light ">Đánh giá</button>
                                </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- <hr class="container"> -->
            <div class="mt-4" id="review_content">
            </div>
        </div>

        <div id="review_modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Viết đánh giá của bạn</h5>
                        <button type="button" class="close" data-dissmiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light submit_star me-1" id="submit_star_1"
                                data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star me-1" id="submit_star_2"
                                data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star me-1" id="submit_star_3"
                                data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star me-1" id="submit_star_4"
                                data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star me-1" id="submit_star_5"
                                data-rating="5"></i>
                        </h4>
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control" placeholder="Viết đánh giá ở đây"></textarea>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-warning text-white fw-medium rounded-1" id="save_review">Gửi đánh giá</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Relative courses -->
        <div class="container-fluid w-1400 my-4 mt-3" id="relative-course">
            <h3 class="mb-3">Khóa học tương tự</h3>
            <!-- Row 1 -->
            <div class="row mb-xl-4">
                <?php foreach ($relativeCourses as $course): ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <a href="index.php?act=course-detail&id=<?= $course['course_id'] ?>">
                            <img src="Public/images/imgCourse/<?= $course['course_image'] ?>" class="card-img-top"
                                alt="..." />
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= $course['course_name'] ?></h5>
                            <p class="card-text"><?= format_currency($course['course_price']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
        <!-- Relative courses -->

        <script type="text/javascript">
            $(document).ready(function() {
                $("#addCartBtn").click(function() {
                    <?php if (isset($_SESSION['clientLogin'])) { ?>
                        $.ajax({
                            url: "Models/Ajax/AddCart.php",
                            method: "POST",
                            data: {
                                courseId: <?= $_GET['id'] ?>,
                                clientId: <?= $_SESSION['clientLogin']['id'] ?>,

                            },
                            success: function(data) {
                                if (data) {
                                    $("#quantityIncart").text(data);
                                    $("#quantityIncart_mobile").text(data);
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Đã thêm khóa học vào giỏ hàng",
                                        showConfirmButton: false,
                                        timer: 1200
                                    });
                                } else {
                                    // alert('Khóa học đã ở trong giỏ hàng!');

                                    Swal.fire({
                                        position: "center",
                                        icon: "warning",
                                        title: "Khóa học đã ở trong giỏ hàng",
                                        showConfirmButton: false,
                                        timer: 1200
                                    });
                                }
                            }
                        });
                    <?php } else { ?>
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Bạn phải đăng nhập để thêm khóa học vào giỏ hàng",
                            showConfirmButton: false,
                            showCloseButton: true,
                        });
                    <?php } ?>
                });


                const buyCourseBtn = document.querySelector('#buyCourseBtn');
                buyCourseBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    let urlToReDirect = e.currentTarget.getAttribute('href');
                    <?php if (isset($_SESSION['clientLogin'])) { 
                            if (!$isMyCourse) { ?>
                        window.location.href = urlToReDirect;
                    <?php } else { ?>
                        window.location.href = "index.php?act=my-cart";
                    <?php } ?>
                        
                    <?php } else { ?>
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Bạn phải đăng nhập để mua khóa học",
                            showConfirmButton: false,
                            showCloseButton: true,
                        });
                    <?php } ?>
                });
            });

            window.addEventListener('DOMContentLoaded', load_rating_data);
            
            function load_rating_data() {
                $.ajax({
                    url: "Models/Ajax/submit_rating.php",
                    method: "POST",
                    data: {
                        action: 'load_data',
                        courseId: '<?=$_GET['id']?>'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#average_rating').text(data.average_rating);
                        $('#total_review').text(data.total_review);

                        var count_star = 0;

                        $('.main_star').each(function() {
                            count_star++;
                            if (Math.ceil(data.average_rating) >= count_star) {
                                $(this).addClass('text-warning');
                                $(this).addClass('star-light');
                            }
                        });

                        $('#total_five_star_review').text(data.five_star_review);

                        $('#total_four_star_review').text(data.four_star_review);

                        $('#total_three_star_review').text(data.three_star_review);

                        $('#total_two_star_review').text(data.two_star_review);

                        $('#total_one_star_review').text(data.one_star_review);

                        $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 +
                            '%');

                        $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 +
                            '%');

                        $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 +
                            '%');

                        $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 +
                            '%');

                        $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 +
                            '%');

                        if (data.review_data.length > 0) {
                            var html = '';

                            for (var count = 0; count < data.review_data.length; count++) {
                                // console.log(data.review_data[count]);
                                html += '<div class="row mb-4">';

                                // html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name+'</h3></div></div>';

                                html += `<div class="overflow-hidden rounded-1 d-flex justify-content-center align-items-start" style="width: 70px;">
                                        <img src="public/images/Avatar/${data.review_data[count].user_avatar}" width="90px;" alt="">
                                    </div>`

                                // html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name+'</h3></div></div>';

                                html += '<div class="col-sm-11">';

                                html += '<div class="card">';

                                html += '<div class="card-header"><b>' + data.review_data[count].user_name +
                                    '</b></div>';

                                html += '<div class="card-body">';

                                for (var star = 1; star <= 5; star++) {
                                    var class_name = '';

                                    if (data.review_data[count].rating >= star) {
                                        class_name = 'text-warning';
                                    } else {
                                        class_name = 'star-light';
                                    }

                                    html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                                }

                                html += '<br />';

                                html += data.review_data[count].user_review;

                                html += '</div>';

                                html += '<div class="card-footer text-right">On ' + data.review_data[count]
                                    .datetime + '</div>';

                                html += '</div>';

                                html += '</div>';

                                html += '</div>';
                            }

                            $('#review_content').html(html);
                        }
                    }
                });
            }

            window.addEventListener('DOMContentLoaded', load_rating_data);

            $(document).ready(function() {
                var rating_data = 0;
                $('#add_review').click(function() {
                    $('#review_modal').modal('show');
                });

                $(document).on('mouseenter', '.submit_star', function() {
                    var rating = $(this).data('rating');

                    reset_background();

                    for (let count = 1; count <= rating; count++) {
                        $('#submit_star_' + count).addClass('text-warning');
                    }
                });

                function reset_background() {
                    for (var count = 1; count <= 5; count++) {
                        $('#submit_star_' + count).addClass('star-light');

                        $('#submit_star_' + count).removeClass('text-warning');
                    }
                }

                $(document).on('mouseleave', '.submit_star', function() {
                    reset_background();

                    for (var count = 1; count <= rating_data; count++) {

                        $('#submit_star_' + count).removeClass('star-light');

                        $('#submit_star_' + count).addClass('text-warning');
                    }
                });

                $(document).on('click', '.submit_star', function() {
                    rating_data = $(this).data('rating');
                });

                $('#save_review').click(function() {
                    var user_id;
                    <?php 
                        if (isset($_SESSION['clientLogin']['id'])) {
                            ?>
                                user_id = '<?=$_SESSION['clientLogin']['id']?>';
                            <?php
                        }
                    ?>
  
                    var user_review = $('#user_review').val();

                    if (user_review == '') {
                        alert("Please Fill Both Field");
                        return false;
                    } else {
                        $.ajax({
                            url: "Models/Ajax/submit_rating.php",
                            method: "POST",
                            data: {
                                course_id: <?= $_GET['id'] ?>,
                                user_id: user_id,
                                rating_data: rating_data,
                                user_review: user_review
                            },
                            success: function(data) {
                                $('#review_modal').modal('hide');

                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: `${data}`,
                                    showConfirmButton: false,
                                    showCloseButton: true,
                                });

                                load_rating_data();
                            }
                        })
                    }
                });       
            });
        </script>
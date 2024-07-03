<div class="container-fluid w-1400 my-4" id="relative-course" style="min-height: 600px;">
    <h2 class="mb-4">Kết quả tìm kiếm: "<?=$searchKey?>"</h2>
    <div class="row">
            <?php
                if (count($searchResult) > 0) {
                    foreach ($searchResult as $course) {
                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <a href="<?php echo "?act=course-detail&courseId=".$course['course_id']?>">
                                        <img src="Public/images/imgCourse/<?=$course['course_image']?>" class="card-img-top" alt="..." />
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$course['course_name']?></h5>
                                        <p class="card-text"><?=format_currency($course['course_price'], 'đ')?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                } else {
                    ?>
                        <p class="fs-4 text-center">Không tìm thấy kết quả nào</p>
                    <?php
                }
            ?>
    </div>
</div>
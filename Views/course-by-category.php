<div class="container-fluid w-1400 my-4" id="relative-course" style="min-height: 600px;">
    <h3 class="mb-3">Danh mục: <?=$categoryName?></h3>
    <!-- Row 1 -->
    <div class="row mb-xl-4">
            <?php 
                foreach ($courseByCategory as $course) {
                    ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <a href="<?php echo "?act=course-detail&id=".$course['course_id']?>">
                                    <img src="Public/images/imgCourse/<?=$course['course_image']?>" class="card-img-top" alt="..." />
                                </a>
                                
                                <div class="card-body">
                                    <h5 class="card-title"><?=$course['course_name']?></h5>
                                    <p class="card-text ">
                                        <?php if ($course["course_price_sale"] != 0) { ?>
                                            <span class="me-2 fs-5 text-danger fw-medium" ><?= format_currency($course["course_price_sale"]) ?></span>
                                            <span class="text-decoration-line-through fw-light "><?= format_currency($course["course_price"]) ?></span>
                                        <?php } else { ?>
                                            <span class=""><?= format_currency($course["course_price"]) ?></span>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
    </div>
</div>
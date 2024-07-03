<!-- Slider -->
<div class="container-fluid w-1400 mt-1">
    <div class="row">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                    for ($x = 0; $x < sizeof($all_slider); $x++) {
                        ?>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$x?>" aria-label="Slide <?=$x+1?>" <?php if ($x === 0) echo 'class="active" aria-current="true"'?> ></button>
                        <?php
                    }
                    
                ?>                
            </div>
            <div class="carousel-inner rounded-3">
                <?php
                    foreach ($all_slider as $slider) {
                        ?>
                            <div class="carousel-item active">
                                <img src="./Public/images/sliders/<?=$slider['slider_img']?>" class="d-block w-100" alt="..."/>
                            </div>
                        <?php
                    }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<!-- Slider -->

<!-- Course -->
<main class="container-fluid w-1400 mt-5" id="main">
    <div class="course row my-4">
        <h3 class="mb-3">Khóa học giảm giá</h3>

        <?php foreach ($saleCourseList as $course) :?>
            <div class="col-xl-3 col-12 col-sm-6">
                <div class="card">
                    <a href="index.php?act=course-detail&id=<?=$course['course_id']?>">
                        <img src="./Public/images/imgCourse/<?=$course['course_image']?>" class="card-img-top" alt="" />
                    </a>
                    <div class="card-body px-2 pt-3">
                        <h5 class="card-title"><?=$course["course_name"]?></h5>
                        <p class="card-text ">
                            <?php if ($course["course_price_sale"] != 0) { ?>
                                <span class="me-2 fs-5 text-danger fw-medium" ><?= format_currency($course["course_price_sale"]) ?></span>
                                <span class="text-decoration-line-through fw-light "><?= format_currency($course["course_price"]) ?></span>
                            <?php } else { ?>
                                <span class=""><?= format_currency($course["course_price"]) ?></span>
                            <?php } ?>
                        </p>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="course row my-4">
        <h3 class="mb-3">Khóa học nổi bật</h3>

        <?php foreach ($featureCourseList as $course) :?>
            <div class="col-xl-3 col-12 col-sm-6">
                <div class="card">
                    <a href="index.php?act=course-detail&id=<?=$course['course_id']?>">
                        <img src="./Public/images/imgCourse/<?=$course['course_image']?>" class="card-img-top" alt="" />
                    </a>
                    <div class="card-body px-2 pt-3">
                        <h5 class="card-title"><?=$course["course_name"]?></h5>
                        <p class="card-text ">
                            <?php if ($course["course_price_sale"] != 0) { ?>
                                <span class="me-2 fs-5 text-danger fw-medium" ><?= format_currency($course["course_price_sale"]) ?></span>
                                <span class="text-decoration-line-through fw-light "><?= format_currency($course["course_price"]) ?></span>
                            <?php } else { ?>
                                <span class=""><?= format_currency($course["course_price"]) ?></span>
                            <?php } ?>
                        </p>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<!-- Course -->


<div class="container-fluid w-1400 my-4" id="relative-course" style="min-height: 600px;">
    <h3 class="mb-3">Khóa học của tôi</h3>
    <!-- Row 1 -->
    <div class="row mb-xl-4">
        <?php foreach($myCourses as $course) : ?>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <a href="index.php?act=learn-course&courseId=<?=$course['course_id']?>">
                        <img src="Public/images/imgCourse/<?=$course['course_image']?>" class="card-img-top " alt="..." />
                    </a>
                    <div class="card-body p-2">
                        <h5 class="card-title"><?=$course['course_name']?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
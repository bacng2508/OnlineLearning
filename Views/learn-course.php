<div class="container my-4 " style="min-height: 600px;">
    <h2 class="mb-3"><?=$course['course_name']?></h2>
    <!-- Row 1 -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 p-0 m-0">

                <video class="w-100 h-100 p-0 m-0 " id="player" playsinline controls data-poster="public/images/imgCourse/<?=$course['course_image']?>">
                    <source src="public/video/<?=$lessonPath?>" type="video/mp4" id="sourcePlay"/>
                    <!-- Captions are optional -->
                    <!-- <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default /> -->
                </video>
            </div>
            <div class="col-lg-4 mt-2 mt-lg-0 px-0 overflow-y-scroll border border-secondary-subtle" style="max-height: 486px;" id="lesson-list">
                <?php foreach($chapterInCourse as $chapter) : ?>
                
                <?php 
                    $lessonInChapter = getLessonListByOrder($chapter['chapter_id']);
                ?>
                
                <button class="btn btn-primary w-100 rounded-0 text-start bg-body-secondary text-dark border-0 " 
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?=$chapter['chapter_id']?>" 
                    aria-expanded="<?= ($chapter['chapter_id']==$playChapterId) ? true : false ?>" aria-controls="collapseExample<?=$chapter['chapter_id']?>"
                >
                    <h5 class="mb-1"><?=$chapter['chapter_name']?></h5>
                    <span><?=sizeof($lessonInChapter)?> Bài học</span>
                </button>
                <div class="collapse <?= ($chapter['chapter_id']==$playChapterId) ? 'show' : false ?>" id="collapseExample<?=$chapter['chapter_id']?>">
                    <ul class="list-group rounded-0 ">
                        <?php foreach($lessonInChapter as $lesson) : ?>
                            <li class="list-group-item border-0 <?= ($lesson['lesson_id']==$playLessonId) ? 'active-lesson' : false ?>" >
                                <a href="index.php?act=learn-course&courseId=<?=$_GET['courseId']?>&chapterId=<?=$chapter['chapter_id']?>&lessonId=<?=$lesson['lesson_id']?>" class="text-decoration-none text-dark playLink" data-play="<?=$lesson['lesson_path']?>">
                                    <h6 class="fw-normal"><?=$lesson['lesson_name']?></h6>
                                    <p class="px-2 my-0 fw-normal">
                                        <i class="fa-solid fa-tv me-1 fa-sm"></i>
                                        6 Phút
                                    </p>
                                </a>
                            </li>
                            <hr class="my-0">
                    <?php endforeach; ?>
                    </ul>
                </div>
                <hr class="my-0">

                <?php endforeach; ?>

                <hr class="my-0">
            </div>        
        </div>
    </div>    
</div>

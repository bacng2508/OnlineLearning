<?php 
    ob_start();
?>
<?php
session_start();

date_default_timezone_set('Asia/Ho_Chi_Minh');
include "../common/helper.php";
include "../Models/connect.php";
include "../Models/course.php";
include "../Models/account.php";
include "../common/sendEmail.php";
include "../Models/payment.php";
include "../Models/user.php";
include "../Models/order.php";
include "../Models/category.php";
include "../Models/review.php";
include "../Models/slider.php";
include "../Models/admin.php";
include "../Models/dashboard.php";

if (isset($_GET['act']) && $_GET['act'] != '') {
    $act = $_GET['act'];

    if ($act != 'login' && $act != 'signin' && $act != 'forgotPassword') {
        include "Views/layouts/header.php";
        include "Views/layouts/navbar.php";
        include "Views/layouts/sidebar.php";   
    }
}

if (isset($_GET['act']) && $_GET['act'] != '') {
    $act = $_GET['act'];
    switch ($act) {
        case'dashboard':
            checkAdminPermission();
            $totalUser = totalUser();
            $totalCourse = totalCourse();
            $totalOrder = totalOrder();
            $totalRevenue = totalRevenue();
            $recentOrders = recentOrders();
            $recentCustomers = recentCustomers();

            $categories = allCategories();
            $categoryNames = [];
            $countCourseByCategory = [];
            foreach ($categories as $key => $category) {
                array_push($categoryNames, $category['category_name']);
                array_push($countCourseByCategory, count(getCourseByCategory($category['category_id'])));
            }

            $revenueByMonth = [];
            for ($i = 0; $i < 12; $i++) { 
                array_push($revenueByMonth, getRevenueByMonth($i+1, date("Y")) ?? 0);
            }
            include './Views/dashboard.php';
            break;
        case 'listCourses':
            checkAdminPermission();
            $listCourses = all_course2();
            include "Views/course/list-course.php";
            break;
        case 'add-course':
            checkAdminPermission();
            if (isset($_POST['insertCourseBtn'])) {
                if ($_POST['course_name'] == "" || $_POST['course_price'] == "" || $_POST['course_desc'] == "" || $_POST['course_content'] == "" || $_POST['course_require'] == "") {
                    $_SESSION['notice__insertCourse']['state'] = "alert-danger";
                    $_SESSION['notice__insertCourse']['msg'] = "Bạn phải điền đầy đủ thông tin khóa học";
                } else {
                    if ($_POST['category_id'] != 0) {
                        $courseName = $_POST['course_name'];
                        $coursePrice = $_POST['course_price'];
                        if ($_POST['course_price_sale']) {
                            $coursePriceSale = $_POST['course_price_sale'];
                        } else {
                            $coursePriceSale = $_POST['course_price_sale'] = 0;
                        }

                        $courseContent = $_POST['course_content'];
                        $courseRequire = $_POST['course_require'];
                        $courseDesc = $_POST['course_desc'];
                        $category_id = $_POST['category_id'];
                        if ($_FILES['course_image']['name'] != "") {
                            $courseImage= $_FILES['course_image']['name'];
                            $tmp_courseImage=$_FILES['course_image']['tmp_name'];
                            $size_ccourseImage=$_FILES['course_image']['size'];
                            $type_courseImage=$_FILES['course_image']['type'];
                            
                            $sqlCheckCourseAvailable = "SELECT * FROM courses WHERE course_name='$courseName'";
                            if (pdo_query($sqlCheckCourseAvailable)) {
                                $_SESSION['notice__insertCourse']['state'] = "alert-danger";
                                $_SESSION['notice__insertCourse']['msg'] = "Khóa học đã tồn tại";
                            } else {
                                if (insertCourse($courseName, $coursePrice, $coursePriceSale, $courseImage, $courseContent, $courseRequire, $courseDesc, $category_id) && move_uploaded_file($tmp_courseImage, "../Public/images/imgCourse/".$courseImage)) {
                                    $_SESSION['notice__insertCourse']['state'] = "alert-success";
                                    $_SESSION['notice__insertCourse']['msg'] = "Thêm khóa học thành công";
                                    unset($_POST); 
                                } else {
                                    $_SESSION['notice__insertCourse']['state'] = "alert-danger";
                                    $_SESSION['notice__insertCourse']['msg'] = "Có lỗi xảy ra, xin thử lại sau";
                                }
                            }
                        } else {
                            $_SESSION['notice__insertCourse']['state'] = "alert-danger";
                            $_SESSION['notice__insertCourse']['msg'] = "Bạn phải lựa chọn hình ảnh đại diện cho khóa học";
                        }
                    } else {
                        $_SESSION['notice__insertCourse']['state'] = "alert-danger";
                        $_SESSION['notice__insertCourse']['msg'] = "Bạn phải lựa chọn danh mục khóa học";
                    }
                }
            }
            $listCategory = getAllCategories();
            include "Views/course/add-course.php";
            break;
        case 'hideCourse':
            checkAdminPermission();
            if (isset($_GET['courseId'])) {
                $courseId = $_GET['courseId'];
                $courseName = getCourseName($courseId);
                if (changeCourseStatus($courseId, 0)) {
                    $_SESSION['notice__courseAction']['state'] = "alert-success";
                    $_SESSION['notice__courseAction']['msg'] = "Khóa học '$courseName' đã được ẩn";
                } else {
                    $_SESSION['notice__courseAction']['state'] = "alert-danger";
                    $_SESSION['notice__courseAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listCourses");
            break;
        case 'showCourse':
            checkAdminPermission();
            if (isset($_GET['courseId'])) {
                $courseId = $_GET['courseId'];
                $courseName = getCourseName($courseId);
                if (changeCourseStatus($courseId, 1)) {
                    $_SESSION['notice__courseAction']['state'] = "alert-success";
                    $_SESSION['notice__courseAction']['msg'] = "Khóa học '$courseName' đã được hiển thị";
                } else {
                    $_SESSION['notice__courseAction']['state'] = "alert-danger";
                    $_SESSION['notice__courseAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listCourses");
            break;
        case 'deleteCourse':
            checkAdminPermission();
            if (isset($_GET['courseId'])) {
                $courseId = $_GET['courseId'];
                $courseName = getCourseName($courseId);
                if (deleteCourse($courseId)) {
                    $_SESSION['notice__courseAction']['state'] = "alert-success";
                    $_SESSION['notice__courseAction']['msg'] = "Khóa học '$courseName' đã được xóa";
                } else {
                    $_SESSION['notice__courseAction']['state'] = "alert-danger";
                    $_SESSION['notice__courseAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                }
            }
            header("Location: index.php?act=listCourses");
            break;
        case 'deleteManyCourse':
            checkAdminPermission();
            if (isset($_POST['checkbox'])) {
                $deleteList = [];
                $deleteList = $_POST['checkbox'];
                foreach ($deleteList as $deleteItem) {
                    deleteCourse($deleteItem);
                }
            }
            header("Location: index.php?act=listCourses");
            break;
        case 'editCourse':
            checkAdminPermission();
            $courseId;
            if (isset($_GET['courseId'])) {
                $courseId = $_GET['courseId'];
            }
            $listCategory = getAllCategories();
            $courseToEdit = getCourse($courseId);

            $courseImage;
            if (isset($_POST['editCourseBtn'])) {
                if ($_POST['course_name'] == "" || $_POST['course_price'] == "" || $_POST['course_desc'] == "" || $_POST['course_content'] == "" || $_POST['course_require'] == "") {
                    $_SESSION['notice__editCourse']['state'] = "alert-danger";
                    $_SESSION['notice__editCourse']['msg'] = "Bạn phải điền đầy đủ thông tin khóa học";
                } else {
                    if (getCourseNameAvailable($_POST['course_name']) && $courseToEdit['course_name'] != $_POST['course_name']) {
                        $_SESSION['notice__editCourse']['state'] = "alert-danger";
                        $_SESSION['notice__editCourse']['msg'] = "Khóa học đã tồn tại";
                    } else {
                        if ($_POST['category_id'] != 0) {
                            $courseId = $_POST['course_id'];
                            $courseName = $_POST['course_name'];
                            $coursePrice = $_POST['course_price'];
                            $courseContent = $_POST['course_content'];
                            $courseRequire = $_POST['course_require'];
                            
                            if ($_POST['course_price_sale']) {
                                $coursePriceSale = $_POST['course_price_sale'];
                            } else {
                                $coursePriceSale = $_POST['course_price_sale'] = 0;
                            }
                            $courseDesc = $_POST['course_desc'];
                            $category_id = $_POST['category_id'];

                            
                            $courseImage= $_FILES['course_image']['name'];
                            $tmp_courseImage=$_FILES['course_image']['tmp_name'];
                            $size_ccourseImage=$_FILES['course_image']['size'];
                            $type_courseImage=$_FILES['course_image']['type'];
                            
                            if ($courseImage != "") {
                                if (editCourse($courseId ,$courseName, $coursePrice, $coursePriceSale, $courseImage, $courseContent, $courseRequire, $courseDesc, $category_id) && move_uploaded_file($tmp_courseImage, "../Public/images/imgCourse/$courseImage")) {
                                    $_SESSION['notice__editCourse']['state'] = "alert-success";
                                    $_SESSION['notice__editCourse']['msg'] = "Cập nhật khóa học thành công";
                                    unset($_POST); 
                                } else {
                                    $_SESSION['notice__editCourse']['state'] = "alert-danger";
                                    $_SESSION['notice__editCourse']['msg'] = "Có lỗi xảy ra, xin thử lại sau";
                                }
                            } else {
                                if (editCourse($courseId ,$courseName, $coursePrice, $coursePriceSale, $courseImage, $courseContent, $courseRequire, $courseDesc, $category_id)) {
                                    $_SESSION['notice__editCourse']['state'] = "alert-success";
                                    $_SESSION['notice__editCourse']['msg'] = "Cập nhật khóa học thành công";
                                    unset($_POST); 
                                } else {
                                    $_SESSION['notice__editCourse']['state'] = "alert-danger";
                                    $_SESSION['notice__editCourse']['msg'] = "Có lỗi xảy ra, xin thử lại sau";
                                }
                            }
                        } else {
                            $_SESSION['notice__editCourse']['state'] = "balert-danger";
                            $_SESSION['notice__editCourse']['msg'] = "Bạn phải lựa chọn danh mục khóa học";
                        }
                    }
                }
            }

            $listCategory = getAllCategories();
            $courseToEdit = getCourse($courseId);
            include "Views/course/edit-course.php";
            break;
        case 'listChapters':
            checkAdminPermission();
            $listChapters = getAllChapters();
            include "Views/chapter/list-chapter.php";
            break;
        case 'addChapter':
            checkAdminPermission();
            if (isset($_POST['insertChapterBtn'])) {
                if ($_POST['chapter_order'] == "" || $_POST['chapter_name'] == "" || $_POST['chapter_desc'] == "" || $_POST['course_id'] == 0) {
                    $_SESSION['notice__insertChapter']['state'] = "alert-danger";
                    $_SESSION['notice__insertChapter']['msg'] = "Bạn phải điền đầy đủ thông tin chương học";
                } else {
                    if (getChapterOrderAvailable($_POST['chapter_order'], $_POST['course_id'])) {
                        $_SESSION['notice__insertChapter']['state'] = "alert-danger";
                        $_SESSION['notice__insertChapter']['msg'] = "Thứ tự chương học đã tồn tại";
                    } else {
                        if (getChapterNameAvailable($_POST['chapter_name'], $_POST['course_id'])) {
                            $_SESSION['notice__insertChapter']['state'] = "alert-danger";
                            $_SESSION['notice__insertChapter']['msg'] = "Chương học đã tồn tại trong khóa học";
                        } else {
                            $chapterOrder = $_POST['chapter_order'];
                            $chapterName = $_POST['chapter_name'];
                            $chaperDesc = $_POST['chapter_desc'];
                            $courseId = $_POST['course_id'];
                            if (insertChapter($chapterOrder, $chapterName, $chaperDesc, $courseId)) {
                                $_SESSION['notice__insertChapter']['state'] = "alert-success";
                                $_SESSION['notice__insertChapter']['msg'] = "Thêm chương học thành công";
                                unset($_POST);
                            } else {
                                $_SESSION['notice__insertChapter']['state'] = "alert-danger";
                                $_SESSION['notice__insertChapter']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                            }
                        }
                    }
                }
            }
            $listChapters = getAllChapters();
            $listCourses = all_course2();
            include "Views/chapter/add-chapter.php";
            break;
        case 'editChapter';
            checkAdminPermission();
            $chapterId;
            if (isset($_GET['chapterId'])) {
                $chapterId = $_GET['chapterId'];
            }
            $listCourses = all_course2();
            $chapterToEdit = getChapter($chapterId);
            if (isset($_POST['editChapterBtn'])) {
                if ($_POST['chapter_order'] == "" || $_POST['chapter_name'] == "" || $_POST['chapter_desc'] == "" || $_POST['course_id'] == 0) {
                    $_SESSION['notice__editChapter']['state'] = "alert-danger";
                    $_SESSION['notice__editChapter']['msg'] = "Bạn phải điền đầy đủ thông tin chương học";
                } else {
                    if (getChapterOrderAvailable($_POST['chapter_order'], $_POST['course_id']) && $_POST['chapter_order'] != $chapterToEdit['chapter_order']) {
                        $_SESSION['notice__editChapter']['state'] = "alert-danger";
                        $_SESSION['notice__editChapter']['msg'] = "Thứ tự chương học đã tồn tại";
                    } else {
                        if (getChapterNameAvailable($_POST['chapter_name'], $_POST['course_id']) && $_POST['chapter_name'] != $chapterToEdit['chapter_name']) {
                            $_SESSION['notice__editChapter']['state'] = "alert-danger";
                            $_SESSION['notice__editChapter']['msg'] = "Chương học đã tồn tại trong khóa học";
                        } else {
                            $chapterId = $_GET['chapterId'];
                            $chapterOrder = $_POST['chapter_order'];
                            $chapterName = $_POST['chapter_name'];
                            $chaperDesc = $_POST['chapter_desc'];
                            $courseId = $_POST['course_id'];
                            
                            editChapter($chapterId, $chapterOrder, $chapterName, $chaperDesc, $courseId);
                            unset($_POST);
                            $_SESSION['notice__editChapter']['state'] = "alert-success";
                            $_SESSION['notice__editChapter']['msg'] = "Cập nhật chương học thành công";
                        }
                    }
                }
            }
            $chapterToEdit = getChapter($chapterId);
            include "Views/chapter/edit-chapter.php";
            break;
        case 'deleteChapter':
            checkAdminPermission();
            if (isset($_GET['chapterId'])) {
                $chapterId = $_GET['chapterId'];
                $chapterName = getChapter($chapterId)['chapter_name'];
                if (deleteChapter($chapterId)) {
                    $_SESSION['notice__chapterAction']['state'] = "alert-success";
                    $_SESSION['notice__chapterAction']['msg'] = "Chương học '$chapterName' đã được xóa";
                } else {
                    $_SESSION['notice__chapterAction']['state'] = "alert-danger";
                    $_SESSION['notice__chapterAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                }
            }
            header("Location: index.php?act=listChapters");
            break;
        case 'deleteManyChapter':
            checkAdminPermission();
            if (isset($_POST['checkbox'])) {
                    $deleteList = [];
                    $deleteList = $_POST['checkbox'];
                    foreach ($deleteList as $deleteItem) {
                        deleteChapter($deleteItem);
                    }
            }
            header("Location: index.php?act=listChapters");
            break;
        case 'hideChapter':
            checkAdminPermission();
            if (isset($_GET['chapterId'])) {
                $chapterId = $_GET['chapterId'];
                $chapterName = getChapter($chapterId)['chapter_name'];
                if (changeChapterStatus($chapterId, 0)) {
                    $_SESSION['notice__chapterAction']['state'] = "alert-success";
                    $_SESSION['notice__chapterAction']['msg'] = "Chương học '$chapterName' đã được ẩn";
                } else {
                    $_SESSION['notice__chapterAction']['state'] = "alert-danger";
                    $_SESSION['notice__chapterAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listChapters");
            break;
        case 'showChapter':
            checkAdminPermission();
            if (isset($_GET['chapterId'])) {
                $chapterId = $_GET['chapterId'];
                $chapterName = getChapter($chapterId)['chapter_name'];
                if (changeChapterStatus($chapterId, 1)) {
                    $_SESSION['notice__chapterAction']['state'] = "alert-success";
                    $_SESSION['notice__chapterAction']['msg'] = "Chương học '$chapterName' đã được hiển thị";
                } else {
                    $_SESSION['notice__chapterAction']['state'] = "alert-danger";
                    $_SESSION['notice__chapterAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listChapters");
            break;
        case 'listLessons':
            checkAdminPermission();
            $listCourses = all_course2();
            include "Views/lesson/list-lesson.php";
            break;
        case 'deleteLesson':
            checkAdminPermission();
            if (isset($_GET['lessonId'])) {
                $lessonId = $_GET['lessonId'];
                $lessonName = getLesson($lessonId)['lesson_name'];
                if (deleteLesson($lessonId)) {
                    $_SESSION['notice__lessonAction']['state'] = "alert-success";
                    $_SESSION['notice__lessonAction']['msg'] = "Bài học '$lessonName' đã được xóa";
                } else {
                    $_SESSION['notice__lessonAction']['state'] = "alert-danger";
                    $_SESSION['notice__lessonAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                }
            }
            header("Location: index.php?act=listLessons");
            break;
        case 'deleteManyLesson':
            checkAdminPermission();
            if (isset($_POST['checkbox'])) {
                    $deleteList = [];
                    $deleteList = $_POST['checkbox'];
                    foreach ($deleteList as $deleteItem) {
                        deleteLesson($deleteItem);
                    }
            }
            header("Location: index.php?act=listLessons");
            break;
        case 'hideLesson':
            checkAdminPermission();
            if (isset($_GET['lessonId'])) {
                $lessonId = $_GET['lessonId'];
                $lessonName = getLesson($lessonId)['lesson_name'];
                if (changeLessonStatus($lessonId, 0)) {
                    $_SESSION['notice__lessonAction']['state'] = "alert-success";
                    $_SESSION['notice__lessonAction']['msg'] = "Bài học '$lessonName' đã được ẩn";
                } else {
                    $_SESSION['notice__lessonAction']['state'] = "alert-danger";
                    $_SESSION['notice__lessonAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listLessons");
            break;
        case 'showLesson':
            checkAdminPermission();
            if (isset($_GET['lessonId'])) {
                $lessonId = $_GET['lessonId'];
                $lessonName = getLesson($lessonId)['lesson_name'];
                if (changeLessonStatus($lessonId, 1)) {
                    $_SESSION['notice__lessonAction']['state'] = "alert-success";
                    $_SESSION['notice__lessonAction']['msg'] = "Bài học '$lessonName' đã hiển thị";
                } else {
                    $_SESSION['notice__lessonAction']['state'] = "alert-danger";
                    $_SESSION['notice__lessonAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listLessons");
            break;
        case 'addLesson':
            checkAdminPermission();
            $listCourse = all_course2();
            if (isset($_POST['insertLessonBtn'])) {
                if ($_POST['course_id'] == 0 || $_POST['chapter_id'] == 0 || $_POST['lesson_order'] == "" || $_POST['lesson_name'] == "") {
                    $_SESSION['notice__insertLesson']['state'] = "alert-danger";
                    $_SESSION['notice__insertLesson']['msg'] = "Bạn phải điền đầy đủ thông tin bài học";
                } else {
                    if (getLessonOrderAvailable($_POST['lesson_order'], $_POST['chapter_id'])) {
                        $_SESSION['notice__insertLesson']['state'] = "alert-danger";
                        $_SESSION['notice__insertLesson']['msg'] = "Thứ tự bài học đã tồn tại";
                    } else {
                        $lessonOrder = $_POST['lesson_order'];
                        $lessonName = $_POST['lesson_name'];
                        $chapterId = $_POST['chapter_id'];

                        if ($_FILES['lesson_video']['name'] != "") {
                            $lessonPath= $_FILES['lesson_video']['name'];
                            $tmp_lessonVideo=$_FILES['lesson_video']['tmp_name'];

                            if (getLessonNameAvailable($lessonName, $chapterId)) {
                                $_SESSION['notice__insertLesson']['state'] = "alert-danger";
                                $_SESSION['notice__insertLesson']['msg'] = "Bài học đã tồn tại";
                            } else {
                                if (insertLesson($lessonOrder, $lessonName, $lessonPath, $chapterId) && move_uploaded_file($tmp_lessonVideo, "../Public/video/".$lessonPath)) {
                                    $_SESSION['notice__insertLesson']['state'] = "alert-success";
                                    $_SESSION['notice__insertLesson']['msg'] = "Thêm bài học thành công";
                                    unset($_POST); 
                                } else {
                                    $_SESSION['notice__insertLesson']['state'] = "alert-danger";
                                    $_SESSION['notice__insertLesson']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                                }
                            }
                        } else {
                            $_SESSION['notice__insertLesson']['state'] = "alert-danger";
                            $_SESSION['notice__insertLesson']['msg'] = "Bạn phải upload video bài học";
                        }   
                    }
                }
            }            
            include "Views/lesson/add-lesson.php";
            break;
        case 'editLesson':
            checkAdminPermission();
            $lesson;
            $chapterId;
            if (isset($_GET['lessonId'])) {
                $lesson = getLesson($_GET['lessonId']);
                $chapterId = $lesson['chapter_id'];
            }

            if (isset($_POST['editLessonBtn'])) {
                if ($_POST['lesson_order'] == "" || $_POST['lesson_name'] == "") {
                    $_SESSION['notice__editLesson']['state'] = "alert-danger";
                    $_SESSION['notice__editLesson']['msg'] = "Bạn phải điền đầy đủ thông tin bài học";
                } else {
                    if (getLessonOrderAvailable($_POST['lesson_order'], $chapterId) && $_POST['lesson_order'] != $lesson['lesson_order']) {
                        $_SESSION['notice__editLesson']['state'] = "alert-danger";
                        $_SESSION['notice__editLesson']['msg'] = "Thứ tự bài học đã tồn tại";
                    } else {
                        if (getLessonNameAvailable($_POST['lesson_name'], $chapterId) && $_POST['lesson_name'] != $lesson['lesson_name']) {
                            $_SESSION['notice__editLesson']['state'] = "alert-danger";
                            $_SESSION['notice__editLesson']['msg'] = "Bài học đã tồn tại";
                        } else {
                            $lessonId = $lesson['lesson_id'];
                            $lessonOrder = $_POST['lesson_order'];
                            $lessonName = $_POST['lesson_name'];
                            $lessonPath= $_FILES['lesson_video']['name'];
                            $tmp_lessonVideo=$_FILES['lesson_video']['tmp_name'];

                            if ($lessonPath != "") {
                                if (editLesson($lessonOrder, $lessonName, $lessonPath, $lessonId) && move_uploaded_file($tmp_lessonVideo, "../Public/video/".$lessonPath)) {
                                    $_SESSION['notice__editLesson']['state'] = "alert-success";
                                    $_SESSION['notice__editLesson']['msg'] = "Cập nhật bài học thành công";
                                    unset($_POST); 
                                } else {
                                    $_SESSION['notice__editLesson']['state'] = "alert-danger";
                                    $_SESSION['notice__editLesson']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                                }
                            } else {
                                if (editLesson($lessonOrder, $lessonName, $lessonPath, $lessonId)) {
                                    $_SESSION['notice__editLesson']['state'] = "alert-success";
                                    $_SESSION['notice__editLesson']['msg'] = "Cập nhật bài học thành công";
                                    unset($_POST); 
                                } else {
                                    $_SESSION['notice__editLesson']['state'] = "alert-danger";
                                    $_SESSION['notice__editLesson']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                                }
                            }
                        }
                    }
                }
            }
            $lesson = getLesson($_GET['lessonId']);
            $chapterId = $lesson['chapter_id'];
            include 'Views/lesson/edit-lesson.php';
            break;
        case 'userList':
            checkAdminPermission();
            $allUser = getAllUser();
            include 'Views/user/list-user.php';
            break;
        case 'deleteUser':
            checkAdminPermission();
            if (isset($_GET['userId'])) {
                $userId = $_GET['userId'];
                $userName = getUser($userId)['user_name'];
                if (deleteUser($userId)) {
                    $_SESSION['notice__userAction']['state'] = "alert-success";
                    $_SESSION['notice__userAction']['msg'] = "Xóa người dùng '$userName' thành công";
                } else {
                    $_SESSION['notice__userAction']['state'] = "alert-danger";
                    $_SESSION['notice__userAction']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                }
            }
            header('Location: index.php?act=userList');
            break;
        case 'addUser':
            checkAdminPermission();
            $checkSuccess;
            if (isset($_POST['insertUserBtn'])) {
                if ($_POST['user_role'] == 0 || $_POST['loginName'] == "" || $_POST['user_password'] =="" || $_POST['user_name'] == "" || $_POST['user_email'] == "") {
                    $_SESSION['notice__insertUser']['state'] = "alert-danger";
                    $_SESSION['notice__insertUser']['msg'] = "Bạn phải điền đầy đủ thông tin";
                } else {
                    if (checkLoginName($_POST['loginName'])) {
                        $_SESSION['notice__insertUser']['state'] = "alert-danger";
                        $_SESSION['notice__insertUser']['msg'] = "Tên đăng nhập đã tồn tại";
                    } else {
                        if (strlen($_POST['user_password']) <= 8) {
                            $_SESSION['notice__insertUser']['state'] = "alert-danger";
                            $_SESSION['notice__insertUser']['msg'] = "Mật khẩu phải lớn hơn 8 ký tự";
                        } else {
                            if ($_POST['user_repassword'] != $_POST['user_password']) {
                                $_SESSION['notice__insertUser']['state'] = "alert-danger";
                                $_SESSION['notice__insertUser']['msg'] = "Mật khẩu nhập lại không khớp";
                            } else {
                                if (checkEmail($_POST['user_email'])) {
                                    $_SESSION['notice__insertUser']['state'] = "alert-danger";
                                    $_SESSION['notice__insertUser']['msg'] = "Email đã tồn tại";
                                } else {
                                    $userRole = $_POST['user_role'];
                                    $loginName = $_POST['loginName'];
                                    $userPassword = $_POST['user_password'];
                                    $userAvatar = $_FILES['user_avatar']['name'];
                                    $tmp_userAvatar = $_FILES['user_avatar']['tmp_name'];
                                    $userName = $_POST['user_name'];
                                    $userEmail = $_POST['user_email'];

                                    if ($userAvatar != "") {
                                        if (insertUser($loginName, $userName, $userPassword, $userAvatar, $userEmail, $userRole) && move_uploaded_file($tmp_userAvatar, "../Public/images/Avatar/".$userAvatar)) {
                                            $_SESSION['notice__insertUser']['state'] = "alert-success";
                                            $_SESSION['notice__insertUser']['msg'] = "Thêm tài khoản thành công";
                                            unset($_POST);
                                        } else {
                                            $_SESSION['notice__insertUser']['state'] = "alert-danger";
                                            $_SESSION['notice__insertUser']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                                        }
                                    } else {
                                        if (insertUser($loginName, $userName, $userPassword, 'avatar_default.png', $userEmail, $userRole)) {
                                            $_SESSION['notice__insertUser']['state'] = "alert-success";
                                            $_SESSION['notice__insertUser']['msg'] = "Thêm tài khoản thành công";
                                            unset($_POST);
                                        } else {
                                            $_SESSION['notice__insertUser']['state'] = "alert-danger";
                                            $_SESSION['notice__insertUser']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            include "Views/user/add-user.php";
            break;
        case 'editUser':
            checkAdminPermission();
            $userToEdit;
            if (isset($_GET['userId'])) {
                $userToEdit = getUser($_GET['userId']);
            }

            if (isset($_POST['editUserBtn'])) {
                if ($_POST['user_name'] == "") {
                    $_SESSION['notice__editUser']['state'] = "alert-danger";
                    $_SESSION['notice__editUser']['msg'] = "Tên người dùng không được bỏ trống";
                } else {
                    $userId = $userToEdit['user_id'];
                    $userName = $_POST['user_name'];
                    $userAvatar = $_FILES['user_avatar']['name'];
                    $tmp_userAvatar = $_FILES['user_avatar']['tmp_name'];

                    if ($userAvatar != "") {
                        if (editUser($userName, $userAvatar, $userId) && move_uploaded_file($tmp_userAvatar, "../Public/images/Avatar/".$userAvatar)) {
                            $_SESSION['notice__editUser']['state'] = "alert-success";
                            $_SESSION['notice__editUser']['msg'] = "Cập nhật thông tin tài khoản thành công";
                            unset($_POST);
                        } else {
                            $_SESSION['notice__editUser']['state'] = "alert-danger";
                            $_SESSION['notice__editUser']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                        }
                    } else {
                        if (editUser($userName, $userAvatar, $userId)) {
                            $_SESSION['notice__editUser']['state'] = "alert-success";
                            $_SESSION['notice__editUser']['msg'] = "Cập nhật thông tin tài khoản thành công";
                            unset($_POST);
                        } else {
                            $_SESSION['notice__editUser']['state'] = "alert-danger";
                            $_SESSION['notice__editUser']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                        }
                    }
                }
            }
            $userToEdit = getUser($_GET['userId']);
            include "Views/user/edit-user.php";
            break;
        case 'changeUserStatus';
            checkAdminPermission();
            $userId;
            $userStatus;
            $userName;
            if (isset($_GET['userId'])) {
                $userId = $_GET['userId'];
                $userStatus = $_POST['user_status'];
                $userName = getUser($userId)['user_name'];
            }

            if (changeUserStatus($userStatus, $userId)) {
                $_SESSION['notice__userAction']['state'] = "alert-success";
                $_SESSION['notice__userAction']['msg'] = "Cập nhật trạng thái người dùng '$userName' thành công";
            } else {
                $_SESSION['notice__userAction']['state'] = "alert-danger";
                $_SESSION['notice__userAction']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
            }
            unset($_POST);
            header('Location: index.php?act=userList');
            break;
        case 'listOrder':
            checkAdminPermission();
            $listOrder = getAllOrder();
            include "Views/order/list-order.php"; 
            break;
        case 'orderDetail':
            checkAdminPermission();
            if (isset($_GET['orderId'])) {
                $orderInfor = getOrder($_GET['orderId']);
                $orderItems = getItemOrderInDetail($_GET['orderId']);
                $orderTotalMoney = 0;
                foreach($orderItems as $item) {
                    if ($item['course_price_sale'] != 0) {
                        $orderTotalMoney+=$item['course_price_sale'];
                    } else {
                        $orderTotalMoney+=$item['course_price'];
                    }
                }
            }
            include "Views/order/order-detail.php"; 
            break;
        case 'listCategory':
            checkAdminPermission();
            $listCategory = getAllCategories();
            include "Views/category/list-category.php";
            break;
        case 'addCategory':
            checkAdminPermission();
            if (isset($_POST['insertCategoryBtn'])) {
                $categoryName = $_POST['category_name'];

                if ($categoryName == "") {
                    $_SESSION['notice__insertCategory']['state'] = "alert-danger";
                    $_SESSION['notice__insertCategory']['msg'] = "Không được để trống tên danh mục";
                } else {
                    if (checkCategoryNameAvailable($categoryName)) {
                        $_SESSION['notice__insertCategory']['state'] = "alert-danger";
                        $_SESSION['notice__insertCategory']['msg'] = "Tên danh mục đã tồn tại";
                    } else {
                        if (insertCategory($categoryName)) {
                            $_SESSION['notice__insertCategory']['state'] = "alert-success";
                            $_SESSION['notice__insertCategory']['msg'] = "Thêm danh mục thành công";
                            unset($_POST);
                        } else {
                            $_SESSION['notice__insertCategory']['state'] = "alert-danger";
                            $_SESSION['notice__insertCategory']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                        }
                    }
                }
            }
            include "Views/category/add-category.php";
            break;
        case 'editCategory':
            checkAdminPermission();
            $category;
            $categoryId;
            if (isset($_GET['categoryId'])) {
                $categoryId = $_GET['categoryId'];
                $category = getCategory($categoryId);
            }

            if (isset($_POST['editCategoryBtn'])) {
                $categoryName = $_POST['category_name'];
                if ($categoryName == "") {
                    $_SESSION['notice__editCategory']['state'] = "alert-danger";
                    $_SESSION['notice__editCategory']['msg'] = "Không được để trống tên danh mục";
                } else {
                    if (checkCategoryNameAvailable($categoryName) && $category['category_name'] != $categoryName) {
                        $_SESSION['notice__editCategory']['state'] = "alert-danger";
                        $_SESSION['notice__editCategory']['msg'] = "Tên danh mục đã tồn tại";
                    } else {
                        if (editCategory($categoryName, $categoryId)) {
                            $_SESSION['notice__editCategory']['state'] = "alert-success";
                            $_SESSION['notice__editCategory']['msg'] = "Cập nhật danh mục thành công";
                        } else {
                            $_SESSION['notice__editCategory']['state'] = "alert-danger";
                            $_SESSION['notice__editCategory']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                        }
                    }
                }
            }
            $category = getCategory($categoryId);
            include "Views/category/edit-category.php";
            break;
        case 'deleteCategory':
            checkAdminPermission();
            if (isset($_GET['categoryId'])) {
                $categoryId = $_GET['categoryId'];
                $categoryname = getCategory($categoryId)['category_name'];
                if (deleteCategory($categoryId)) {
                    $_SESSION['notice__categoryAction']['state'] = "alert-success";
                    $_SESSION['notice__categoryAction']['msg'] = "Xóa danh mục '$categoryname' thành công";
                } else {
                    $_SESSION['notice__categoryAction']['state'] = "alert-danger";
                    $_SESSION['notice__categoryAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                }

            }
            header("Location: index.php?act=listCategory");
            break;
        case 'deleteManyCategory':
            checkAdminPermission();
            if (isset($_POST['checkbox'])) {
                $deleteList = [];
                $deleteList = $_POST['checkbox'];
                foreach ($deleteList as $deleteItem) {
                    deleteCategory($deleteItem);
                }
            }
            header("Location: index.php?act=listCategory");
        break;
        case 'hideCategory':
            checkAdminPermission();
            if (isset($_GET['categoryId'])) {
                $categoryId = $_GET['categoryId'];
                $categoryname = getCategory($categoryId)['category_name'];
                if (changeCategoryStatus($categoryId, 0)) {
                    $_SESSION['notice__categoryAction']['state'] = "alert-success";
                    $_SESSION['notice__categoryAction']['msg'] = "Danh mục '$categoryname' đã được ẩn";
                } else {
                    $_SESSION['notice__categoryAction']['state'] = "alert-danger";
                    $_SESSION['notice__categoryAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listCategory");
            break;
        case 'showCategory':
            checkAdminPermission();
            if (isset($_GET['categoryId'])) {
                $categoryId = $_GET['categoryId'];
                $categoryname = getCategory($categoryId)['category_name'];
                if (changeCategoryStatus($categoryId, 1)) {
                    $_SESSION['notice__categoryAction']['state'] = "alert-success";
                    $_SESSION['notice__categoryAction']['msg'] = "Danh mục '$categoryname' đã được hiển thị";
                } else {
                    $_SESSION['notice__categoryAction']['state'] = "alert-danger";
                    $_SESSION['notice__categoryAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listCategory");
            break;
        case 'listReview':
            checkAdminPermission();
            $listReview = getAllReview();
            include "./Views/review/list-review.php";
            break;
        case 'deleteReview':
            checkAdminPermission();
            if (isset($_GET['reviewId'])) {
                $reviewId = $_GET['reviewId'];
                if (deleteReview($reviewId)) {
                    $_SESSION['notice__reviewAction']['state'] = "alert-success";
                    $_SESSION['notice__reviewAction']['msg'] = "Bình luận đã được xóa thành công";
                } else {
                    $_SESSION['notice__reviewAction']['state'] = "alert-danger";
                    $_SESSION['notice__reviewAction']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                }
            }
            header("Location: index.php?act=listReview");
            break;
        case 'deleteManyReview':
            checkAdminPermission();
            if (isset($_POST['checkbox'])) {
                $deleteList = [];
                $deleteList = $_POST['checkbox'];
                foreach ($deleteList as $deleteItem) {
                    deleteReview($deleteItem);
                }
            }
            header("Location: index.php?act=listReview");
            break;
        case 'listSlider':
            checkAdminPermission();
            $listSlider = getAllSlider();
            include "Views/slider/list-slider.php";
            break;
        case 'addSlider';
            checkAdminPermission();
            if (isset($_POST['insertSliderBtn'])) {
                $sliderOrder = $_POST['slider_order'];
                $sliderImg = $_FILES['slider_img']['name'];
                $tmp_sliderImg = $_FILES['slider_img']['tmp_name'];
                if ($sliderOrder == "" || $sliderImg == "") {
                    $_SESSION['notice__insertSlider']['state'] = "alert-danger";
                    $_SESSION['notice__insertSlider']['msg'] = "Bạn phải điền đầy đủ thông tin";
                } else {
                    if (getSliderOrderAvailable($sliderOrder)) {
                        $_SESSION['notice__insertSlider']['state'] = "alert-danger";
                        $_SESSION['notice__insertSlider']['msg'] = "Thứ tự slider đã tồn tại";
                    } else {
                        if (insertSlider($sliderOrder, $sliderImg) && move_uploaded_file($tmp_sliderImg, "../Public/images/sliders/".$sliderImg)) {
                            $_SESSION['notice__insertSlider']['state'] = "alert-success";
                            $_SESSION['notice__insertSlider']['msg'] = "Thêm thành công slider";
                            unset($_POST);
                        } else {
                            $_SESSION['notice__insertSlider']['state'] = "alert-danger";
                            $_SESSION['notice__insertSlider']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                        }
                    }
                }
            }
            include "Views/slider/add-slider.php";
            break;
        case 'editSlider':
            checkAdminPermission();
            $sliderId;
            $sliderToEdit;
            if (isset($_GET['sliderId'])) {
                $sliderId = $_GET['sliderId'];
                $sliderToEdit = getSlider($sliderId);
            }

            if (isset($_POST['editSliderBtn'])) {
                $sliderOrder = $_POST['slider_order'];
                $sliderImg = $_FILES['slider_img']['name'];
                $tmp_sliderImg = $_FILES['slider_img']['tmp_name'];

                if ($sliderOrder == "") {
                    $_SESSION['notice__editSlider']['state'] = "alert-danger";
                    $_SESSION['notice__editSlider']['msg'] = "Bạn phải điền đầy đủ thông tin";
                } else {
                    if (getSliderOrderAvailable($sliderOrder) && $sliderOrder != $sliderToEdit['slider_order']) {
                        $_SESSION['notice__editSlider']['state'] = "alert-danger";
                        $_SESSION['notice__editSlider']['msg'] = "Thứ tự slider đã tồn tại";
                    } else {
                        if ($sliderImg != "") {
                            if (editSlider($sliderOrder, $sliderImg, $sliderId) && move_uploaded_file($tmp_sliderImg, "../Public/images/sliders/".$sliderImg)) {
                                $_SESSION['notice__editSlider']['state'] = "alert-success";
                                $_SESSION['notice__editSlider']['msg'] = "Cập nhật thành công slider";
                                unset($_POST);
                            } else {
                                $_SESSION['notice__editSlider']['state'] = "alert-danger";
                                $_SESSION['notice__editSlider']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                            }
                        } else {
                            if (editSlider($sliderOrder, $sliderImg, $sliderId)) {
                                $_SESSION['notice__editSlider']['state'] = "alert-success";
                                $_SESSION['notice__editSlider']['msg'] = "Cập nhật thành công slider";
                                unset($_POST);
                            } else {
                                $_SESSION['notice__editSlider']['state'] = "alert-danger";
                                $_SESSION['notice__editSlider']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                            }
                        }
                        
                    }
                }
            }

            $sliderToEdit = getSlider($sliderId);
            include "Views/slider/edit-slider.php";
            break;
        case 'deleteSlider':
            checkAdminPermission();
            if (isset($_GET['sliderId'])) {
                $sliderId = $_GET['sliderId'];
                if (deleteSlider($sliderId)) {
                    $_SESSION['notice__sliderAction']['state'] = "alert-success";
                    $_SESSION['notice__sliderAction']['msg'] = "Slider đã được xóa thành công";
                } else {
                    $_SESSION['notice__sliderAction']['state'] = "alert-danger";
                    $_SESSION['notice__sliderAction']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                }
            }
            header("Location: index.php?act=listSlider");
            break;
        case 'deleteManySlider':
            checkAdminPermission();
            if (isset($_POST['checkbox'])) {
                $deleteList = [];
                $deleteList = $_POST['checkbox'];
                foreach ($deleteList as $deleteItem) {
                    deleteSlider($deleteItem);
                }
            }
            header("Location: index.php?act=listSlider");
            break;
        case 'hideSlider';
            checkAdminPermission();
            if (isset($_GET['sliderId'])) {
                $sliderId = $_GET['sliderId'];
                if (changeSliderStatus($sliderId, 0)) {
                    $_SESSION['notice__sliderAction']['state'] = "alert-success";
                    $_SESSION['notice__sliderAction']['msg'] = "Slider đã được ẩn";
                } else {
                    $_SESSION['notice__sliderAction']['state'] = "alert-danger";
                    $_SESSION['notice__sliderAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listSlider");
            break;
        case 'showSlider';
            checkAdminPermission();
            if (isset($_GET['sliderId'])) {
                $sliderId = $_GET['sliderId'];
                if (changeSliderStatus($sliderId, 1)) {
                    $_SESSION['notice__sliderAction']['state'] = "alert-success";
                    $_SESSION['notice__sliderAction']['msg'] = "Slider đã được hiển thị";
                } else {
                    $_SESSION['notice__sliderAction']['state'] = "alert-danger";
                    $_SESSION['notice__sliderAction']['msg'] = "Đã xảy ra lỗi, vui lòng thử lại sau";
                } 
            }
            header("Location: index.php?act=listSlider");
            break;
        case 'signin':
            if (isset($_POST['signinBtn'])) {
                $username = $_POST['username'];
                $password = sha1($_POST['password']);
                $adminInfo = checkLoginAdmin($username, $password);
                if (is_array($adminInfo)) {
                    if ($adminInfo['user_status'] == 1) {
                        $_SESSION['admin']['role'] = $adminInfo['roles'];
                        $_SESSION['admin']['id'] = $adminInfo['user_id'];
                        $_SESSION['admin']['user_name'] = $adminInfo['user_name'];
                        $_SESSION['admin']['user_avatar'] = $adminInfo['user_avatar'];
                        header('location:index.php?act=dashboard');
                    } else {
                        $messLogin = 'Tài khoản đã bị khóa';
                        include "./Views/auth/login.php";
                    }
                } else {
                    $messLogin = 'Tài khoản hoặc mật khẩu không chính xác!';
                    include "./Views/auth/login.php";
                }
            }
            break;
        case 'forgotPassword':
            if (isset($_POST['forgotPasswordBtn'])) {
                $email = $_POST['email'];
                $checkAdminEmail = checkEmailAvailable($email);

                if ($checkAdminEmail) {
                    if ($checkAdminEmail['roles'] == 3) {
                        $_SESSION['notice__adminForgotPassword']['state'] = "alert-danger";
                        $_SESSION['notice__adminForgotPassword']['msg'] = "Email không có quyền";
                    } else {
                        if (sendMail($email)) {
                            $_SESSION['notice__adminForgotPassword']['state'] = "alert-success";
                            $_SESSION['notice__adminForgotPassword']['msg'] = "Đã gửi mật khẩu mới tới email";
                        } else {
                            $_SESSION['notice__adminForgotPassword']['state'] = "alert-danger";
                            $_SESSION['notice__adminForgotPassword']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                        }
                    }
                } else {
                    $_SESSION['notice__adminForgotPassword']['state'] = "alert-danger";
                    $_SESSION['notice__adminForgotPassword']['msg'] = "Email không tồn tại";
                }

            }
            include "./Views/auth/forgot-password.php";
            break;
        case 'editProfileAdmin';
            checkAdminPermission();
            if (isset($_POST['btnEditProfile'])) {
                $userName = $_POST['userName'];
                if ($userName == "") {
                    $_SESSION['notice__adminProfile']['state'] = "alert-danger";
                    $_SESSION['notice__adminProfile']['msg'] = "Không được để trống tên quản trị viên";
                } else {
                    if (updateAdminInfo($_SESSION['admin']['id'], $userName)) {
                        $_SESSION['notice__adminProfile']['state'] = "alert-success";
                        $_SESSION['notice__adminProfile']['msg'] = "Cập nhật thành công";
                        $_SESSION['admin']['user_name'] = $userName;
                    } else {
                        $_SESSION['notice__adminProfile']['state'] = "alert-danger";
                        $_SESSION['notice__adminProfile']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                    }
                }
            }

            if (isset($_POST['btnChangeAdminAvatar'])) {
                $adminAvatar = $_FILES['adminAvatar']['name'];
                $tmp_adminAvatar=$_FILES['adminAvatar']['tmp_name'];

                if ($adminAvatar == "") {
                    $_SESSION['notice__adminProfile']['state'] = "alert-danger";
                    $_SESSION['notice__adminProfile']['msg'] = "Bạn chưa upload ảnh";
                } else {
                    if (changeAvatar($_SESSION['admin']['id'], $adminAvatar) && move_uploaded_file($tmp_adminAvatar, "../Public/images/Avatar/".$adminAvatar)) {
                        $_SESSION['admin']['user_avatar'] = $adminAvatar;
                        $_SESSION['notice__adminProfile']['state'] = "alert-success";
                        $_SESSION['notice__adminProfile']['msg'] = "Cập nhật ảnh đại diện thành công";
                    } else {
                        $_SESSION['notice__adminProfile']['state'] = "alert-danger";
                        $_SESSION['notice__adminProfile']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                    }
                }
            }
            include "./Views/auth/edit-profile.php";
            break;
        case 'changePasswordAdmin';
            checkAdminPermission();
            if (isset($_POST['changeAdminPasswordBtn'])) {
                $oldPassword = $_POST['oldPassword'];
                $newPassword = $_POST['newPassword'];
                $confirmNewPassword = $_POST['confirmNewPassword'];
                if ($oldPassword == "" || $newPassword == "" || $confirmNewPassword == "") {
                    $_SESSION['notice__adminChangePassword']['state'] = "alert-danger";
                    $_SESSION['notice__adminChangePassword']['msg'] = "Bạn phải điền đầy đủ thông tin";
                } else {
                    if (checkAdminPassword($_SESSION['admin']['id'], sha1($oldPassword))) {
                        if ($newPassword == $confirmNewPassword) {
                            if (changeAdminPassword($_SESSION['admin']['id'], sha1($newPassword))) {
                                $_SESSION['notice__adminChangePassword']['state'] = "alert-success";
                                $_SESSION['notice__adminChangePassword']['msg'] = "Thay đổi mật khẩu thành công";
                            } else {
                                $_SESSION['notice__adminChangePassword']['state'] = "alert-danger";
                                $_SESSION['notice__adminChangePassword']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau";
                            }
                        } else {
                            $_SESSION['notice__adminChangePassword']['state'] = "alert-danger";
                            $_SESSION['notice__adminChangePassword']['msg'] = "Mật khẩu nhập lại không khớp";
                        }
                    } else {
                        $_SESSION['notice__adminChangePassword']['state'] = "alert-danger";
                        $_SESSION['notice__adminChangePassword']['msg'] = "Mật khẩu cũ không chính xác";
                    }
                }
                
            }
            include "./Views/auth/change-password.php";
            break;
        case 'logout':
            session_destroy();
            header('location:index.php');
            break;
        default:
            include "./Views/auth/login.php";
            break;
    }
} else {
    include "./Views/auth/login.php";
}

if (isset($_GET['act']) && $_GET['act'] != '') {
    $act = $_GET['act'];
    if ($act != 'login' && $act != 'signin' && $act != 'forgotPassword') {
        include "Views/layouts/footer.php";
    }
}

ob_end_flush(); 
?>




<?php
ob_start(); 

session_start();

date_default_timezone_set('Asia/Ho_Chi_Minh');

include "common/helper.php";
include "./Models/connect.php";
include "./Models/course.php";
include "./Models/account.php";
include "./Models/payment.php";
include "./Models/slider.php";
include "./Models/category.php";
include "./Models/client.php";
include "./Models/cart.php";
include "./Models/order.php";
include "common/sendEmail.php";
include "vnpay_php/config.php";


$featureCourseList = featureCourses();
$saleCourseList = saleCourses();
$all_slider = getHomeSlider();
$showCategories = show_Category();

include "Views/layouts/htmlHeader.php";
include "Views/layouts/header.php";

if (isset($_GET['act']) && $_GET['act'] != '') {
    $act = $_GET['act'];

    switch ($act) {
        case 'course-detail':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $courseId = $_GET['id'];
                $courseDetail = getCourse($courseId);
                if (isset($_SESSION['clientLogin'])) {
                    $isMyCourse = checkMyCourse($_SESSION['clientLogin']['id'], intval($courseId));
                } else {
                    $isMyCourse = false;
                }
                $relativeCourses = getRelativeCourses($courseId, $courseDetail['category_id']);
                include "Views/detail.php";
            } else {
                echo "ID không tồn tại";
            }
            break;
        case 'course-by-category':
            if (isset($_GET['categoryId'])) {
                $categoryId = $_GET['categoryId'];
                if ($categoryId == 0) {
                    $categoryName = "Tất cả khóa học";
                    $courseByCategory = allCourses();

                } else {
                    $category = getCategory($categoryId);
                    $categoryName = $category['category_name'];
                    $courseByCategory = getCourseByCategory($categoryId);
                }
            }
            include "Views/course-by-category.php";
            break;
        case 'search-course':
            if (isset($_POST['search-keys'])) {
                $searchKey = $_POST['search-keys'];
                $searchResult =  searchCourse($_POST['search-keys']);
            }
            include "Views/search-course.php";
            break;
        case 'sign-up':
            if (isset($_POST['signUpBtn'])) {
                if ($_POST['loginName'] == "" || $_POST['username'] == "" || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['passwordConfirm'] == "") {
                    $_SESSION['notice__signUp']['state'] = "danger";
                    $_SESSION['notice__signUp']['msg'] = "Bạn phải điền đầy đủ thông tin";
                } else {
                    $loginName = $_POST['loginName'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['passwordConfirm'];
                    if (!checkLoginNameExist($loginName)) {
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $_SESSION['notice__signUp']['state'] = "danger";
                            $_SESSION['notice__signUp']['msg'] = "Email không hợp lệ";
                        } else {
                            if (!checkClientEmailExist($email)) {
                                if (strlen($password) < 8) {
                                    $_SESSION['notice__signUp']['state'] = "danger";
                                    $_SESSION['notice__signUp']['msg'] = "Mật khẩu tối thiểu là 8 ký tự";
                                } else {
                                    if ($password != $confirmPassword) {
                                        $_SESSION['notice__signUp']['state'] = "danger";
                                        $_SESSION['notice__signUp']['msg'] = "Mật khẩu nhập lại không khớp";
                                    } else {
                                        if (insertClient($loginName, $username, $email, password_hash($_POST['password'], PASSWORD_DEFAULT))) {
                                            unset($_POST);
                                            $_SESSION['notice__signUp']['state'] = "success";
                                            $_SESSION['notice__signUp']['msg'] = "Đăng ký tài khoản thành công";
                                        } else {
                                            $_SESSION['notice__signUp']['state'] = "danger";
                                            $_SESSION['notice__signUp']['msg'] = "Đã có lỗi xảy ra!";
                                        }
                                    }
                                }
                            } else {
                                $_SESSION['notice__signUp']['state'] = "danger";
                                $_SESSION['notice__signUp']['msg'] = "Email đã tồn tại!";
                            }
                        }
                    } else {
                        $_SESSION['notice__signUp']['state'] = "danger";
                        $_SESSION['notice__signUp']['msg'] = "Tên đăng nhập đã tồn tại!";
                    }
                }
            }
            include "Views/auth/signup.php";
            break;
        case 'login':
            if (isset($_POST['loginBtn'])) {
                if ($_POST['loginName'] == "" || $_POST['password'] == "") {
                    $_SESSION['notice__login']['state'] = "danger";
                    $_SESSION['notice__login']['msg'] = "Bạn phải nhập đầy đủ thông tin đăng nhập";
                } else {
                    $loginName = $_POST['loginName'];
                    $password = $_POST['password'];
                    $userInfo = checkLoginName($loginName);
                    if ($userInfo) {
                        if (password_verify($password, $userInfo['user_password'])) {
                            $_SESSION['clientLogin']['id'] = $userInfo['user_id'];
                            $_SESSION['clientLogin']['username'] = $userInfo['user_name'];
                            $_SESSION['clientLogin']['email'] = $userInfo['user_email'];
                            $_SESSION['clientLogin']['avatar'] = $userInfo['user_avatar'];
                            header("Location: index.php?act=home");
                        } else {
                            $_SESSION['notice__login']['state'] = "danger";
                            $_SESSION['notice__login']['msg'] = "Mật khẩu không chính xác";
                        }
                    } else {
                        $_SESSION['notice__login']['state'] = "danger";
                        $_SESSION['notice__login']['msg'] = "Tài khoản không tồn tại";
                    }
                }
            }
            include "Views/auth/login.php";
            break;
        case 'logout':
            unset($_SESSION['clientLogin']);
            header("Location: index.php?act=home");
            break;
        case 'forgot-password':
            if (isset($_POST['sendToEmailBtn'])) {
                $email = $_POST['email'];
                if ($email == "") {
                    $_SESSION['notice__forgotPassword']['state'] = "danger";
                    $_SESSION['notice__forgotPassword']['msg'] = "Bạn phải nhập Email!";
                } else {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['notice__forgotPassword']['state'] = "danger";
                        $_SESSION['notice__forgotPassword']['msg'] = "Email không hợp lệ";
                    } else {
                        if (checkClientEmailExist($email)) {
                            $newPassword = '0123456789';
                            if (sendMail($email, 'Yêu cầu cấp lại mật khẩu', $newPassword) && resetPassword(password_hash($newPassword, PASSWORD_DEFAULT), $email)) {
                                $_SESSION['notice__forgotPassword']['state'] = "success";
                                $_SESSION['notice__forgotPassword']['msg'] = "Mật khẩu đã được đặt lại, vui lòng kiểm tra email!";
                            } else {
                                $_SESSION['notice__forgotPassword']['state'] = "danger";
                                $_SESSION['notice__forgotPassword']['msg'] = "Đã có lỗi xảy ra!";
                            }
                        } else {
                            $_SESSION['notice__forgotPassword']['state'] = "danger";
                            $_SESSION['notice__forgotPassword']['msg'] = "Email không tồn tại trong hệ thống!";
                        }
                    }
                }
            }
            include "Views/auth/forgotPassword.php";
            break;
        case 'profile-infor':
                checkClientPermission();
                if (isset($_POST['editProfileBtn'])) {
                    $username = $_POST['username'];
                    if ($username == "") {
                        $_SESSION['notice__editProfile']['state'] = "danger";
                        $_SESSION['notice__editProfile']['msg'] = "Không được bỏ trống tên";
                    } else {
                        if (editProfile($username, $_SESSION['clientLogin']['id'])) {
                            $_SESSION['notice__editProfile']['state'] = "success";
                            $_SESSION['notice__editProfile']['msg'] = "Cập nhập thông tin thành công";
                        } else {
                            $_SESSION['notice__editProfile']['state'] = "danger";
                            $_SESSION['notice__editProfile']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại";
                        }
                    }
                }

                if (isset($_FILES['avatarUploadedFile']['name'])) {
                    $avatar = $_FILES['avatarUploadedFile']['name'];
                    $tmp_avatar=$_FILES['avatarUploadedFile']['tmp_name'];
                    $size_avatar=$_FILES['avatarUploadedFile']['size'];
                    $type_avatar=$_FILES['avatarUploadedFile']['type'];

                    $allowed_filetypes = array('image/jpeg','image/jpg', 'image/png',);

                    if (move_uploaded_file($tmp_avatar, "Public/images/Avatar/".$avatar) && changeClientAvatar($avatar, $_SESSION['clientLogin']['id'])) {
                        $_SESSION['notice__editProfile']['state'] = "success";
                        $_SESSION['notice__editProfile']['msg'] = "Cập nhập ảnh đại diện thành công";
                    } else {
                        $_SESSION['notice__editProfile']['state'] = "danger";
                        $_SESSION['notice__editProfile']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại";
                    }
                }
                $userInfo = checkIdLogin($_SESSION['clientLogin']['id']);
                include "Views/profile/infor.php";
                break;
        case 'profile-changePassword':
            checkClientPermission();
            $userInfo = checkIdLogin($_SESSION['clientLogin']['id']);
            if (isset($_POST['changePasswordBtn'])) {
                if ($_POST['oldPassword'] == "" || $_POST['newPassword'] == "") {
                    $_SESSION['notice__changePassword']['state'] = "danger";
                    $_SESSION['notice__changePassword']['msg'] = "Phải nhập đầy đủ thông tin";
                } else {
                    if (password_verify($_POST['oldPassword'], $userInfo['user_password'])) {
                        if (strlen($_POST['newPassword']) < 8) {
                            $_SESSION['notice__changePassword']['state'] = "danger";
                            $_SESSION['notice__changePassword']['msg'] = "Độ dài mật khẩu tối thiểu 8 ký tự";
                        } else {
                            if ($_POST['newPassword'] != $_POST['confirmNewPassword']) {
                                $_SESSION['notice__changePassword']['state'] = "danger";
                                $_SESSION['notice__changePassword']['msg'] = "Mật khẩu nhập lại không khớp";
                            } else {
                                $newPassword = $_POST['newPassword'];
                                if (changeClientPassword(password_hash($newPassword, PASSWORD_DEFAULT), $userInfo['user_id'])) {
                                    $_SESSION['notice__changePassword']['state'] = "success";
                                    $_SESSION['notice__changePassword']['msg'] = "Đổi mật khẩu thành công";
                                } else {
                                    $_SESSION['notice__changePassword']['state'] = "danger";
                                    $_SESSION['notice__changePassword']['msg'] = "Đã có lỗi xảy ra, vui lòng thử lại sau!";
                                }
                            }
                        }
                    } else {
                        $_SESSION['notice__changePassword']['state'] = "danger";
                        $_SESSION['notice__changePassword']['msg'] = "Mật khẩu cũ không chính xác";
                    }
                }
                
            }
            include "Views/profile/change-password.php";
            break;
        case 'profile-paymentHistory':
            checkClientPermission();
            $userInfo = checkIdLogin($_SESSION['clientLogin']['id']);
            $orderList = getOrderdList($_SESSION['clientLogin']['id']);
            include "Views/profile/payment-history.php";
            break;
        case 'profile-orderDetail':
            checkClientPermission();
            $userInfo = checkIdLogin($_SESSION['clientLogin']['id']);
            $orderCode = getOrderCode($_GET['orderId']);
            $orderItems = getItemOrderInDetail($_GET['orderId']);
            include "Views/profile/order-detail.php";
            break;
        case 'my-course':
            checkClientPermission();
            $myCourses = getMyCourses($_SESSION['clientLogin']['id']);
            include "Views/my-course.php";
            break;
        case 'learn-course':
            checkClientPermission();
            if (isset($_GET['courseId'])) {
                $courseId = $_GET['courseId'];
                $course = getCourse($courseId);
                $chapterInCourse = getChapterInCourse($courseId);
                if (sizeof($chapterInCourse) != 0) {
                    if (isset($_GET['chapterId'])) {
                        $playChapterId = $_GET['chapterId'];
                    } else {
                        $playChapterId = $chapterInCourse[0]['chapter_id'];
                    }

                    $firstLesson = getLessonListByOrder($playChapterId)[0];
                    
                    if (isset($_GET['lessonId'])) {
                        $playLessonId = $_GET['lessonId'];
                    } else {
                        $playLessonId = $firstLesson['lesson_id'];
                    }
    
                    $lessonPath = getLesson($playLessonId)['lesson_path'];
                    include "Views/learn-course.php";
                } else {
                    include "Views/error-course.php";
                }
            } else {
                echo "Khóa học không tồn tại";
            }
            break;
        case 'buy-course':
            checkClientPermission();
            $courseId = $_GET['courseId'];
            if (!checkCourseInCart($courseId, $_SESSION['clientLogin']['id'])) {
                addToCart($courseId, $_SESSION['clientLogin']['id']);
            }
            header('Location: index.php?act=my-cart');
            break;
        case 'my-cart':
            checkClientPermission();
            $itemsInCart = getCartItems($_SESSION['clientLogin']['id']);
            $quantityInCart = sizeof($itemsInCart);
            $totalMoney = 0;
            if ($quantityInCart > 0) {
                foreach ($itemsInCart as $item) {
                    if ($item['course_price_sale'] != 0) {
                        $totalMoney+=$item['course_price_sale'];
                    } else {
                        $totalMoney+=$item['course_price'];
                    }
                }
            }
            include "Views/my-cart.php";
            break;
        case 'order-confirm':
            checkClientPermission();
            $itemsInCart = getCartItems($_SESSION['clientLogin']['id']);
            include "Views/order-confirm.php";
            break;
        case 'payment':
            checkClientPermission();
            if ($_POST['payment_method'] == "vnpay") {
                // Lấy ra danh sách các item trong giỏ hàng
                $itemsInCart = getCartItems($_SESSION['clientLogin']['id']);
    
                // // Tạo mới đơn hàng và thêm mới các items vào đơn hàng
                $result = createOrder($_SESSION['clientLogin']['id'], $itemsInCart);

                $orderId = $result["orderId"];
                $orderCode = getOrderCode($orderId);
                $totalMoney = $result["totalMoney"];
                createPayment($orderId, $orderCode, $totalMoney);
            }
            break;
        case 'payment-result':
            checkClientPermission();
            $orderId = savePayment($_GET);
            $paymentNotification = '';
            if ($_GET['vnp_TransactionStatus'] == 00) {
                $orderItems = getOrderItems($orderId);
                updateOrderStatus($orderId, 1);
                addCourseToClient($_SESSION['clientLogin']['id'], $orderItems);
                clearCart($_SESSION['clientLogin']['id']);
                $paymentNotification = 'Giao dịch thành công';
            } else if ($_GET['vnp_TransactionStatus'] == 11) {
                $paymentNotification = 'Hết hạn thời gian thanh toán, giao dịch không thành công';
                updateOrderStatus($orderId, 0);
            } else if ($_GET['vnp_TransactionStatus'] == 24) {
                $paymentNotification = 'Hủy giao dịch thành công';
                updateOrderStatus($orderId, 3);
            } else {
                $paymentNotification = 'Lỗi không xác định, giao dịch không thành công';
                updateOrderStatus($orderId, 0);
            }
            $paymentNotification = 'Giao dịch thành công';
            include "./Views/payment-result.php";
            break;
        default:
            include "./Views/home.php";
            break;
    }
} else {
    include "./Views/home.php";
}

include "Views/layouts/footer.php";
include "Views/layouts/htmlFooter.php";

ob_end_flush(); 
?>
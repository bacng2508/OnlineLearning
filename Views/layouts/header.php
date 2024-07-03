<!-- Header -->
        <header class="d-flex justify-content-between align-items-center flex-wrap px-2 d-none d-md-flex" id="header">
            <div class="logo d-flex align-content-center flex-wrap">
                <a href="index.php">
                    <img src="./favicon.png" alt="error" width="38px" height="38px" class="ms-3" />
                </a>
                <h4 class="logoHeading">PolyUni</h4>

            </div>
            <div class="d-flex flex-row align-items-center">
                <div class="dropdown bg-light position-relative bg-white d-flex">
                    <button class="dropdown-toggle p-1 fw-bold text-secondary me-2 bg-white border-0" style="font-size: 14px" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bars me-2"></i>
                        Danh mục
                    </button>
                    <ul class="dropdown-menu p-0 mt-2 rounded-1">
                        <li><a class="dropdown-item" href="index.php?act=course-by-category&categoryId=0">Tất cả khóa học</a></li>
                        <?php 
                            foreach ($showCategories as $category) {
                                ?>
                                    <li><a class="dropdown-item" href="index.php?act=course-by-category&categoryId=<?=$category['category_id']?>"><?=$category['category_name']?></a></li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
                <form action="index.php?act=search-course" method="POST">
                    <div class="input-group position-relative">
                        <i class="fa-solid fa-magnifying-glass fa-sm text-secondary position-absolute top-50 translate-middle" style="left: 20px; z-index: 100"></i>
                        <input type="text" class="form-control rounded-4" name="search-keys" style="width: 350px; font-size: 14px; padding-left: 38px" id="searchCourseInput" placeholder="Tìm kiếm khóa học..." />
                        
                        <div class="list-group position-absolute rounded-3 w-100 " style="top: 100%;" id="searchresult">
                            
                        </div>
                        
                    </div>
                </form>
            </div>
             <?php 
                if (!isset($_SESSION['clientLogin'])) {
                    ?>
                        <div class="login d-flex flex-wrap align-content-center">
                            <a href="#" id="cartNotLogin">
                                <i class="fa-solid fa-cart-shopping fa-lg p-2 me-1 position-relative pointer">
                                    <span class="position-absolute bg-danger text-white fw-bold rounded-2" style="font-size: 10px; padding: 8px 6px; top: -15px; left: 22px">
                                        0
                                    </span>
                                </i>
                            </a>
                            <i class="fa-regular fa-circle-user fa-lg p-2 ms-1 pointer" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu dropdown-menu-end mt-2 me-2 rounded-1 py-0">
                                <li>
                                    <a href="index.php?act=login" class="dropdown-item rounded-top-2">Đăng nhập</a>
                                </li>
                                <li>
                                    <a href="index.php?act=sign-up" class="dropdown-item rounded-bottom-2">Đăng ký</a>
                                </li>
                            </ul>
                        </div>
                    <?php
                } else {
                    ?>
                    <div class="login d-flex flex-wrap align-content-center">
                        <a href="index.php?act=my-cart">
                            <i class="fa-solid fa-cart-shopping fa-lg p-2 me-1 position-relative pointer">
                            <span class="position-absolute bg-danger text-white fw-bold rounded-2" id="quantityIncart" style="font-size: 10px; padding: 8px 6px; top: -15px; left: 22px;">
                                <?php
                                    if (isset($_GET['act']) && $_GET['act'] == 'payment-result') {
                                        echo 0;
                                    } else {
                                        $totalInCart = getUserCart($_SESSION['clientLogin']['id']);
                                        echo isset($totalInCart) ? sizeof($totalInCart) : "0";
                                    }
                                    
                                ?>
                            </span>
                            </i>
                        </a>
                        <i class="fa-regular fa-circle-user fa-lg p-2 ms-1 pointer" data-bs-toggle="dropdown" aria-expanded="false"></i>
                        <!-- Dropdown box -->
                        <div class="dropdown-menu p-0 rounded-0 mt-2 me-2">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="d-flex bg-body-secondary p-3">
                                        <div class="d-flex align-items-center">
                                            <img 
                                                class="rounded-circle" 
                                                src="Public/images/Avatar/<?= isset($_SESSION['clientLogin']['avatar']) ? $_SESSION['clientLogin']['avatar'] : "avatar_default.png" ?>" 
                                                width="40px" 
                                                alt="" 
                                            />
                                        </div>
                                        <div class="ps-3">
                                            <h5 class="mb-1">
                                                <?php 
                                                    if (isset($_SESSION['clientLogin']['username'])) {
                                                        echo $_SESSION['clientLogin']['username'];
                                                    } else {
                                                        echo "Default User" ;
                                                    }
                                                ?> 
                                            </h5>
                                            <p class="mb-0" style="font-size: 14px">
                                                <?php
                                                    if (isset($_SESSION['clientLogin']['email'])) {
                                                        echo $_SESSION['clientLogin']['email'];
                                                    } else {
                                                        echo "Default email" ;
                                                    } 
                                                ?> 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <a href="index.php?act=my-course" class="list-group-item list-group-item-action rounded-0 border-0 p-2" aria-current="true">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-video"></i>
                                            </div>
                                            <span>Khóa học của tôi</span>
                                        </a>
                                        <a href="index.php?act=profile-infor" class="list-group-item list-group-item-action border-0 p-2">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </div>
                                            <span>Chỉnh sửa hồ sơ</span>
                                        </a>
                                        <a href="index.php?act=profile-changePassword" class="list-group-item list-group-item-action border-0 p-2">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-key"></i>
                                            </div>
                                            <span>Đổi mật khẩu</span>
                                        </a>
                                        <a href="index.php?act=profile-paymentHistory" class="list-group-item list-group-item-action rounded-0 border-0 p-2">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-clock-rotate-left"></i>
                                            </div>
                                            <span>Lịch sử thanh toán</span>
                                        </a>
                                        <a href="index.php?act=logout" class="list-group-item list-group-item-action rounded-0 border-0 p-2">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            </div>
                                            <span>Đăng xuất</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            
            ?>
        </header>
        <!-- Header -->
                
        <!-- Header mobile -->
        <header class="navbar navbar-expand-lg d-block d-md-none">
            <div class="container-fluid p-0 pt-1">
                <div class="logo d-flex align-content-center flex-wrap">
                    <a href="index.php">
                        <img src="./favicon.png" alt="error" width="38px" height="38px" class="ms-3" />
                    </a>
                    <h4 class="logoHeading">PolyUni</h4>
                </div>

                <button
                    class="navbar-toggler me-3"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse bg-white px-3 pt-2 pb-2 mt-2 border vw-100 rounded-bottom-3 border-top-0" id="navbarSupportedContent">
                    <form action="index.php?act=search-course" method="POST" class="d-flex position-relative" role="search">
                        <input class="form-control me-2" type="search" name="search-keys" placeholder="Tìm kiếm khóa học..." aria-label="Search" id="searchCourseInput_mobile"/>
                        <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>

                        <div class="list-group position-absolute w-100 z-3 overflow-hidden border-top-0 mt-1" style="top: 100%;" id="searchresult_mobile" >

                        </div>
                    </form>

                    <?php if (!isset($_SESSION['clientLogin'])) { ?>
                        <ul class="list-group list-group-flush mt-2">
                            <li class="list-group-item p-2 border-0">
                                <a href="#" class="text-decoration-none text-secondary">Giỏ hàng <span class="bg-danger py-1 px-2 fw-bold text-white rounded-2 ms-1">0</span></a>
                            </li>
                            <li class="list-group-item p-2 border-0">
                                <a href="index.php?act=login" class="text-decoration-none text-secondary">Đăng nhập</a>
                            </li>
                            <li class="list-group-item p-2">
                                <a href="index.php?act=sign-up" class="text-decoration-none text-secondary">Đăng ký</a>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <ul class="list-group list-group-flush mt-2">
                            <div>
                                <button class="btn btn-secondary w-100 text-start bg-white text-secondary border-0 px-0" type="button" data-bs-toggle="collapse" data-bs-target="#categories" aria-expanded="false" aria-controls="#categories">
                                    <div class="d-flex justify-content-between ">
                                        <div class="d-flex align-items-center ">
                                            <div class="d-flex justify-content-center  text-end me-3 " style="width: 23px">
                                                <i class="fa-solid fa-list"></i>
                                            </div>
                                            <span>
                                                Danh mục
                                            </span>
                                        </div>
                                        <i class="fa-solid fa-caret-down pe-2"></i>
                                    </div>
                                </button>
                            </div>

                            <div class="collapse" id="categories">
                                <hr class="my-1">
                                <ul class="w-100 py-0 overflow-hidden rounded-1 list-unstyled ">
                                     <?php 
                                        foreach ($showCategories as $category) {
                                            ?>
                                                <li class="">
                                                    <a class="dropdown-item ps-0 py-2 text-secondary " href="index.php?act=course-by-category&categoryId=<?=$category['category_id']?>">
                                                        <span class="ps-3"><?=$category['category_name']?></span>
                                                    </a>
                                                </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>

                            <div>
                                <button class="btn btn-secondary w-100 text-start bg-white text-secondary border-0 px-0" type="button" data-bs-toggle="collapse" data-bs-target="#userinfo" aria-expanded="false" aria-controls="#userinfo">
                                    <div class="d-flex justify-content-between ">
                                        <div class="d-flex align-items-center ">
                                            <div class="d-flex justify-content-center  text-end me-3 " style="width: 23px">
                                                <img 
                                                    src="Public/images/Avatar/<?= isset($_SESSION['clientLogin']['avatar']) ? $_SESSION['clientLogin']['avatar'] : "avatar_default.png" ?>" 
                                                    class="rounded-circle " 
                                                    width="25px;" 
                                                    alt=""
                                                >
                                            </div>
                                            <span>
                                                <?php 
                                                    if (isset($_SESSION['clientLogin']['username'])) {
                                                        echo $_SESSION['clientLogin']['username'];
                                                    } else {
                                                        echo "Default User" ;
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                        <i class="fa-solid fa-caret-down pe-2"></i>
                                    </div>
                                </button>
                            </div>

                            <div class="collapse" id="userinfo">
                                <hr class="my-1">
                                <ul class="w-100 py-0 overflow-hidden rounded-1 list-unstyled ">
                                    <li class="">
                                        <a class="dropdown-item ps-0 py-2 text-secondary " href="index.php?act=my-course">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-video"></i>
                                            </div>
                                            <span>Khóa học của tôi</span>
                                        </a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item ps-0 py-2 text-secondary" href="index.php?act=profile-infor">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </div>
                                            <span>Chỉnh sửa hồ sơ</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item ps-0 py-2 text-secondary" href="index.php?act=profile-changePassword">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-key"></i>
                                            </div>
                                            <span>Đổi mật khẩu</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item ps-0 py-2 text-secondary" href="index.php?act=profile-paymentHistory">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-clock-rotate-left"></i>
                                            </div>
                                            <span>Lịch sử thanh toán</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item ps-0 py-2 text-secondary" href="index.php?act=logout">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            </div>
                                            <span>Đăng xuất</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <li class="list-group-item p-2 ps-0 border-0">
                                <a href="index.php?act=my-cart" class="text-decoration-none text-secondary">
                                    <div class="d-inline-block text-start me-2 " style="width: 25px">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                    Giỏ hàng <span class="bg-danger py-1 px-2 fw-bold text-white rounded-2 ms-1" id="quantityInCart_mobile">
                                        <?php
                                            if (isset($_GET['act']) && $_GET['act'] == 'payment-result') {
                                                echo 0;
                                            } else {
                                                $totalInCart = getUserCart($_SESSION['clientLogin']['id']);
                                                echo isset($totalInCart) ? sizeof($totalInCart) : "0";
                                            }
                                        ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </header>
        <!-- Header mobile -->

        <script type="text/javascript">
            const cartNotLogin = document.querySelector('#cartNotLogin');
            
            if (cartNotLogin) {
                cartNotLogin.addEventListener('click', (e) => {
                e.preventDefault();
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: "Bạn phải đăng nhập để sử dụng giỏ hàng",
                        showConfirmButton: false,
                        showCloseButton: true,
                    });
                });
            }


            $("#searchCourseInput").keyup(function() {
                $("#searchresult").html('');
                $("#searchresult_mobile").html('');
                var input = $(this).val();
                if (input != "") {
                    $.ajax({
                        url: "Models/Ajax/liveSearch.php",
                        method: "POST",
                        data: {input:input},
                        success: function(data) {
                            $("#searchresult").html(data);
                            $("#searchresult").css("display", "block");

                            $("#searchresult_mobile").html(data);
                            $("#searchresult_mobile").css("display", "block");
                        }
                    });
                } else {
                    $("#searchresult").css("display", "none");
                    $("#searchresult_mobile").css("display", "none");
                }
            });

            $("#searchCourseInput_mobile").keyup(function() {
                $("#searchresult_mobile").html('');
                var input = $(this).val();
                if (input != "") {
                    $.ajax({
                        url: "Models/Ajax/liveSearch.php",
                        method: "POST",
                        data: {input:input},
                        success: function(data) {
                            $("#searchresult_mobile").html(data);
                            $("#searchresult_mobile").css("display", "block");
                        }
                    });
                } else {
                    $("#searchresult").css("display", "none");
                    $("#searchresult_mobile").css("display", "none");
                }
            });
        </script>
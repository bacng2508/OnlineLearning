  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../Public/images/Avatar/<?php
      if (isset($_SESSION['admin']['user_avatar'])) {
        echo $_SESSION['admin']['user_avatar'];
      } else {
        echo "avatar_default.png";
      }
    ?>
    " width="50px"
        alt="User Image">
      <div>
        <p class="app-sidebar__user-name fs-2"><b><?=$_SESSION['admin']['user_name']?></b></p>
        <p class="app-sidebar__user-designation mt-2">
          <?php
            if ($_SESSION['admin']['role'] == 1) {
              echo "SuperAdmin";
            } else {
              echo "Admin";
            }
          ?>
        </p>
      </div>
    </div>

    <hr>

    <ul class="app-menu">
      <!-- Bang dieu khien -->
      <!-- <li><a class="app-menu__item
        <?php
          switch ($_GET['act']) {
            case 'dashboard':
              echo 'active';
              break;
            default:
              break;
          }
        ?>
      " href="index.php?act=dashboard"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Bảng điều khiển</span></a></li> -->

      <!-- Dashboard -->
      <li><a class="app-menu__item
        <?php
          switch ($_GET['act']) {
            case 'dashboard':
              echo 'active';
              break;
            default:
              break;
          }
        ?>
      " href="index.php?act=dashboard"><i class="app-menu__icon fa-solid fa-chart-pie"></i><span
            class="app-menu__label">Dashboard</span></a></li>

      <!-- Quan ly danh muc -->
      <li><a class="app-menu__item
        <?php
          switch ($_GET['act']) {
            case 'listCategory':
              echo 'active';
              break;
            default:
              break;
          }
        ?>
      " href="index.php?act=listCategory"><i class=" app-menu__icon fa-solid fa-list fa-lg"></i><span
            class="app-menu__label">Quản lý danh mục</span></a></li>
      
      <li><a class="app-menu__item 
        <?php
          switch ($_GET['act']) {
            case 'listCourses':
            case 'add-course':
            case 'editCourse':
            case 'listChapters':
            case 'addChapter':
            case 'editChapter':
            case 'listLessons':
            case 'addLessonToCourse':
            case 'addLesson':
            case 'editLesson':
              echo 'active';
              break;
            default:
              break;
          }
        ?>
      " href="index.php?act=listCourses"><i
            class='app-menu__icon fa-solid fa-film fa-lg'></i><span class="app-menu__label">Quản lý khóa học</span></a>
      <div class="ml-5">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?act=listChapters">Quản lý chương học</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?act=listLessons">Quản lý bài học</a>
            </li>
          </ul>
        </div>
      </li>

      <li><a class="app-menu__item 
        <?php
          switch ($_GET['act']) {
            case 'userList':
            case 'addUser':
              echo 'active';
              break;
            default:
              break;
          }
        ?>
      " href="index.php?act=userList"><i class='app-menu__icon bx bx-id-card'></i> <span
            class="app-menu__label">Quản lý người dùng</span></a>
      </li>
            
      <li><a class="app-menu__item
          <?php
          switch ($_GET['act']) {
              case 'listOrder':
                echo 'active';
                break;
              default:
                break;
            }
          ?>
      " href="index.php?act=listOrder"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Quản lý đơn hàng</span></a></li>

      <li><a class="app-menu__item
            <?php
              switch ($_GET['act']) {
                  case 'listReview':
                    echo 'active';
                    break;
                  default:
                    break;
                }
            ?>
      " href="index.php?act=listReview"><i class='app-menu__icon fa-regular fa-comment fa-lg'></i><span
            class="app-menu__label">Đánh giá khóa học
          </span></a></li>
      <li><a class="app-menu__item 
            <?php
              switch ($_GET['act']) {
                  case 'listSlider':
                  case 'addSlider':
                    echo 'active';
                    break;
                  default:
                    break;
                }
            ?>
      " href="index.php?act=listSlider"><i class='app-menu__icon fa-regular fa-images fa-lg'></i>
          <span class="app-menu__label">Quản lý Slider</span></a></li>

      <!-- Bao cao so thu -->
      <!-- <li><a class="app-menu__item  
            <?php
            switch ($_GET['act']) {
                case 'baoCao':
                  echo 'active';
                  break;
                default:
                  break;
              }
            ?>
      " href="index.php?act=baoCao"><i
            class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Báo cáo số thu</span></a>
      </li> -->
      
    </ul>

  </aside>
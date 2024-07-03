<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>Danh sách người dùng</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>

    <div class="row">
      <div class="col-md-12">
        
        <div class="tile">
            <?php
                if (isset($_SESSION['notice__userAction'])) {
                    $state = $_SESSION['notice__userAction']['state'];
                    $msg = $_SESSION['notice__userAction']['msg'];
                    echo 
                        '
                            <div class="'.$state.' rounded-2  text-center p-2 mb-1 w-100 mb-2" role="alert">
                                '.$msg.'
                            </div>
                        ';
                    unset($_SESSION['notice__userAction']);
                }
            ?>
            <div class="d-flex justify-content-end align-items-center mb-2 ">
                <a href="index.php?act=addUser" class="btn btn-primary"><i class="fa-solid fa-plus me-2" ></i>Thêm người dùng</a>
            </div>
          <div class="tile-body">

            <table class="table table-hover table-bordered js-copytextarea align-middle" cellpadding="0" cellspacing="0" border="0"
              id="sampleTable">
              <thead>
                <tr>
                  <th class="text-center" >STT</th>
                  <th class="text-center" >Họ và tên</th>
                  <th class="text-center" >Username</th>
                  <th class="text-center" >Avatar</th>
                  <th class="text-center" >Email</th>
                  <th class="text-center" >Vai trò</th>
                  <th class="text-center" >Trạng thái</th>
                  <th class="text-center" >Tính năng</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    foreach ($allUser as $key => $user) {
                        ?>
                            <tr>
                                <td class="text-center"><?=$key+1?></td>
                                <td class="text-center"><?=$user['user_name']?></td>
                                <td class="text-center"><?=$user['user_loginName']?></td>
                                <td class="text-center">
                                    <img class="img-card-person" src="../Public/images/Avatar/<?=$user['user_avatar']?>" alt="">
                                </td>
                                <td class="text-center"><?=$user['user_email']?></td>
                                <td class="text-center">
                                    <?php
                                        switch ($user['roles']) {
                                            case 1:
                                                echo 'SuperAdmin';
                                                break;
                                            case 2:
                                                echo 'Admin';
                                                break;
                                            case 3:
                                                echo 'Customer';
                                                break;
                                            default:
                                                echo 'Không xác định';
                                                break;
                                        }
                                    ?>
                                </td>
                                <td class="text-center">
                                  <?php
                                      if ($_SESSION['admin']['role'] == 2) {
                                        if ($user['roles'] == 3) {
                                            ?>
                                              <form action="index.php?act=changeUserStatus&userId=<?=$user['user_id']?>" method="post">
                                                <select class="form-select changeUserStatus" aria-label="Default select example" name="user_status">
                                                  <option value="0" <?=($user['user_status']==0)?"selected":FALSE;?> >Khóa</option> 
                                                  <option value="1" <?=($user['user_status']==1)?"selected":FALSE;?> >Đang hoạt động</option> 
                                                </select>
                                              </form>
                                            <?php
                                          }
                                      } else {
                                        if ($user['roles'] != 1) {
                                          ?>
                                            <form action="index.php?act=changeUserStatus&userId=<?=$user['user_id']?>" method="post">
                                                  <select class="form-select changeUserStatus" aria-label="Default select example" name="user_status">
                                                    <option value="0" <?=($user['user_status']==0)?"selected":FALSE;?> >Khóa</option> 
                                                    <option value="1" <?=($user['user_status']==1)?"selected":FALSE;?> >Đang hoạt động</option> 
                                                  </select>
                                            </form>
                                          <?php
                                        }
                                      }
                                  ?>
                                  
                                </td>
                                <td class="text-center">
                                  
                                  <?php

                                    if ($_SESSION['admin']['role'] == 2) {
                                      if ($user['roles'] == 3) {
                                          ?>
                                            <a href="index.php?act=editUser&userId=<?=$user['user_id']?>" class="btn btn-primary btn-sm edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                          <?php
                                        }
                                    } else {
                                      if ($user['roles'] != 1) {
                                        ?>
                                          <a href="index.php?act=editUser&userId=<?=$user['user_id']?>" class="btn btn-primary btn-sm edit">
                                              <i class="fas fa-edit"></i>
                                          </a>
                                          <a href="index.php?act=deleteUser&userId=<?=$user['user_id']?>" class="btn btn-primary btn-sm trash deleteItem" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                          </a>
                                          
                                        <?php
                                      }
                                    }
                                  ?>
                                  
                                </td>
                            </tr>
                        <?php
                    }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        </form>
      </div>
    </div>
  </main>
  <script type="text/javascript">
    var deleteItemBtn = document.querySelectorAll('.deleteItem');
    deleteItemBtn.forEach((element) => {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            var urlToReDirect = e.currentTarget.getAttribute('href');
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa không?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Hủy bỏ"
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToReDirect;
                }
            });
        })
    });

    var changeUserStatusList = document.querySelectorAll('.changeUserStatus');
    console.log(changeUserStatusList);
    changeUserStatusList.forEach( (selectBox) => {
      selectBox.addEventListener('change', (item) => {
        selectBox.parentElement.submit();
      });
    });
  </script>
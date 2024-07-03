  <!-- Essential javascripts for application to work-->
  <!-- <script src="../public/js/jquery-3.2.1.min.js"></script> -->
  <script src="public/js/jquery/jquery.min.js"></script>
  <script src="../public/js/popper.min.js"></script>
  <script src="../public/js/bootstrap.min.js"></script>
  <!-- <script src="../public/ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
  <!-- <script src="../public/src/jquery.table2excel.js"></script> -->
  <script src="../public/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="../public/js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- <script src="../https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script> -->
  <!-- Data table plugin-->
  <!-- <script type="text/javascript" src="Public/js/plugins/jquery.dataTables.min.js"></script> -->
  <script type="text/javascript" src="Public/js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
    //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Chủ Nhật";
      weekday[1] = "Thứ Hai";
      weekday[2] = "Thứ Ba";
      weekday[3] = "Thứ Tư";
      weekday[4] = "Thứ Năm";
      weekday[5] = "Thứ Sáu";
      weekday[6] = "Thứ Bảy";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " giờ " + m + " phút " + s + " giây";
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
  </script>
  <script>
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);
    }
    jQuery(function () {
      jQuery("").click(function () {
        swal({
          title: "Cảnh báo",
          text: "Bạn có chắc chắn là muốn xóa sản phẩm này?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
          .then((willDelete) => {
            if (willDelete) {
              swal("Đã xóa thành công.!", {

              });
            }
          });
      });
    });
    oTable = $('#sampleTable').dataTable();
    $('#all').click(function (e) {
      $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
      e.stopImmediatePropagation();
    });
  </script>
</body>
<script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
</html>
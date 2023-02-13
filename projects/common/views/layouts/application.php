<?php 
    //check 
    if (isset($_COOKIE["loggedinHDVN"]) && $_COOKIE["loggedinHDVN"] == true) {
    }
    else {
         // header('Location: /partner/fischer_asia/login.php');
        echo "<script>document.location = '/fiot-hdvn-losses/login.php'</script>";
    }

    require_once "./config/config.php";
    require_once "./config/dbconnection.php";
?>
<!DOCTYPE html>
<html lang="vi" class="notranslate" translate="no">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<meta property="og:image" content="/images/Fischer.png">-->
        <meta property="og:image:type" content="image/png">
        <title>HDVN Co., Ltd</title>
        <link href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/logo.png" ?>"
            rel="icon">
        <!-- Google Font: Source Sans Pro -->
        <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
        <!-- Font Awesome Icons -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/fontawesome-free/css/all.min.css" ?>">
        <!-- overlayScrollbars -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" ?>">
        <!-- flag-icon-css -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/flag-icon-css/css/flag-icon.min.css" ?>">
        <!-- Theme style -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/css/adminlte.min.css" ?>">
        <!-- Sweetalert2 -->
        <link
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" ?>"
            rel="stylesheet">
        <!-- Toastr -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/toastr/toastr.min.css" ?>">
        <!-- link data table  -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-bs4/css/datatables.bootstrap4.min.css" ?>">
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" ?>">
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" ?>">
        <!-- daterange picker -->
        <link rel="stylesheet"
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/daterangepicker/daterangepicker.css" ?>">
        <style type="text/css">
            #one{
            /*color: #000;*/
    		font-weight: bold;
    		animation: blinkingText 1s infinite;
            }
            @keyframes blinkingText{
                0%		{ color: white;}
                25%		{ color: blue;}
                50%		{ color: yellow;}
                75%		{ color: green;}
                100%	{ color: white;}
            }
        </style>
        <!-- jquery -->
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/jquery/jquery.min.js" ?>">
        </script>
        <!-- Bootstrap -->
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/bootstrap/js/bootstrap.bundle.min.js" ?>">
        </script>
        <!-- overlayScrollbars -->
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" ?>">
        </script>
        <!-- ChartJS -->
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/chart.js/Chart.min.js" ?>">
        </script>
        <!-- select 2 -->
        <link
            href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/select2/css/select2.min.css" ?>"
            rel="stylesheet" />
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/select2/js/select2.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/sweetalert2/sweetalert2.min.js" ?>">
        </script>
        <!-- DataTables  & Plugins -->
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables/jquery.dataTables.min.js" ?> ">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-responsive/js/dataTables.responsive.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-buttons/js/dataTables.buttons.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/jszip/jszip.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/pdfmake/pdfmake.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/pdfmake/vfs_fonts.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-buttons/js/buttons.html5.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-buttons/js/buttons.print.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/datatables-buttons/js/buttons.colVis.min.js" ?>">
        </script>
        <!-- AdminLTE App -->
        <script src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/js/adminlte.js" ?>">
        </script>

        <!-- Toastr -->
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/toastr/toastr.min.js" ?>">
        </script>
        <!-- jQuery Mapael -->
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/jquery-mousewheel/jquery.mousewheel.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/raphael/raphael.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/jquery-mapael/jquery.mapael.min.js" ?>">
        </script>
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/jquery-mapael/maps/usa_states.min.js" ?>">
        </script>

        <!-- ChartJS -->
        <script
            src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/chart.js/Chart.min.js" ?>">
        </script>
        <script type="text/javascript">
        function startTime() {
            // Lấy Object ngày hiện tại
            var today = new Date();

            // Giờ, phút, giây hiện tại
            // var datetime = today.getDate()+ '/' + (today.getMonth()+1)+ '/' +today.getFullYear();
            // datetime = checkTime(today.getDate())+ ' ' + checkTime(today.getMonth()+1)+ ' ' +today.getFullYear();

            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();

            var current_month = (today.getMonth() + 1);
            var month_name = '';
            switch (current_month) {
                case 1:
                    month_name = "JAN";
                    break;
                case 2:
                    month_name = "FEB";
                    break;
                case 3:
                    month_name = "MAR";
                    break;
                case 4:
                    month_name = "APR";
                    break;
                case 5:
                    month_name = "MAY";
                    break;
                case 6:
                    month_name = "JUN";
                    break;
                case 7:
                    month_name = "JUL";
                    break;
                case 8:
                    month_name = "AUG";
                    break;
                case 9:
                    month_name = "SEP";
                    break;
                case 10:
                    month_name = "OCT";
                    break;
                case 11:
                    month_name = "NOV";
                    break;
                case 12:
                    month_name = "DEC";
                    break;
            }

            // Chuyển đổi sang dạng 01, 02, 03
            h = checkTime(h);
            m = checkTime(m);
            s = checkTime(s);
            datetime = checkTime(today.getDate()) + ' ' + month_name + ' ' + today.getFullYear();
            // datetime_show = checkTime(today.getDate()) + ' ' + checkTime(current_month) + ' ' + today.getFullYear();
            // Ghi ra trình duyệt

            document.getElementById('timer').innerHTML = datetime + " " + h + ":" + m + ":" + s;

            // Dùng hàm setTimeout để thiết lập gọi lại 0.5 giây / lần
            var t = setTimeout(function() {
                startTime();
            }, 500);
            // console.log(datetime + " " + h + ":" + m + ":" + s);
            // console.log("here");
        }

        // Hàm này có tác dụng chuyển những số bé hơn 10 thành dạng 01, 02, 03, ...
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
        </script>

    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse"
        onload="startTime()">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-light navbar-light">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li> -->
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>" class="nav-link">Trang chủ</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- //select lang  -->
                
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-cogs"></i>
                            <!-- <span class="badge badge-warning navbar-badge">15</span> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">Setting</span>
                            <!-- manager account -->
                            <!-- <div class="dropdown-divider"></div>
                            <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/master" ?>"
                                class="dropdown-item <?php if ($_COOKIE['role'] != 0) {echo 'd-none';} ?>">
                                <i class="fas fa-users-cog "></i> Account Management
                                <span class="float-right text-muted text-sm"></span>
                            </a> -->
                            <!-- change password -->
                            <!-- <div class="dropdown-divider"></div>
                            <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/profile" ?>" class="dropdown-item">
                                <i class="fas fa-key mr-2"></i> Profile
                                <span class="float-right text-muted text-sm"></span>
                            </a> -->
                            <!-- logout -->
                            <div class="dropdown-divider"></div>
                            <form id="logout" method="post"
                                action="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/logout.php" ?>" name="logout">
                                <a class="dropdown-item logouthere" onclick="logout.submit()" style="cursor:pointer;">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    <span class="float-right text-muted text-sm"></span>
                                    <input id="logoutHDVN" name="logoutHDVN" value="logoutHDVN" hidden>
                                    <span name="" id="">Logout</span>
                                </a>
                            </form>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>" class="brand-link">
                    <img src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/logo.png" ?>"
                        alt="Fischer Asia Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">HAMADEN VIETNAM</span>
                </a>
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/avatar.png" ?>"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a class="d-block"><?php echo $_COOKIE['full_name']; ?></a>
                            <a class="d-block"><?php echo $_COOKIE['username']; ?></a>
                            <a class="d-block"><?php echo $_COOKIE['role_name']; ?></a>
                            <!-- <a class="d-block"><?php echo $_COOKIE['department']; ?></a> -->
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>"
                                    class="nav-link <?php if ($active_page_sub == "index") echo "active" ?>">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Trang Chủ
                                    </p>
                                </a>
                            </li>

                            <li
                                class="nav-item has-treeview <?php if ($active_page_sub == "t001" || $active_page_sub == "t002" || $active_page_sub == "t003") echo "menu-open" ?>">
                                <a href="#"
                                    class="nav-link <?php if ($active_page_sub == "t001" || $active_page_sub == "t002" || $active_page_sub == "t003") echo "active" ?>">
                                    <i class="nav-icon fas fa-cog text-warning"></i>
                                    <p>
                                        Bảo Trì
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/maintenance/index_bt" ?>"
                                            class="nav-link <?php if ($active_page_sub == "index_bt") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Thay thế định kì</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/maintenance/history_interval/index_history" ?>"
                                            class="nav-link <?php if ($active_page_sub == "index_history") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Lịch sử thay thế</p>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "..." ?>"
                                            class="nav-link <?php if ($active_page_sub == "t003") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>3. Turning 3 (T003)</p>
                                        </a>
                                    </li> -->
                                </ul>
                            </li>

                            <li
                                class="nav-item has-treeview <?php if ($active_page_sub == "t001" || $active_page_sub == "t002" || $active_page_sub == "t003") echo "menu-open" ?>">
                                <a href="#"
                                    class="nav-link <?php if ($active_page_sub == "t001" || $active_page_sub == "t002" || $active_page_sub == "t003") echo "active" ?>">
                                    <i class="nav-icon fas fa-chart-line text-success"></i>
                                    <p>
                                        Sản Xuất
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/production/speed/indexSpeed" ?>"
                                            class="nav-link <?php if ($active_page_sub == "indexSpeed") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Tốc độ</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/production/shortDt/indexShortDt" ?>"
                                            class="nav-link <?php if ($active_page_sub == "indexShortDt") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Dừng ngắn</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/production/longDt/indexLongDt" ?>"
                                            class="nav-link <?php if ($active_page_sub == "indexLongDt") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Dừng dài</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/production/preparing/indexPreparing" ?>"
                                            class="nav-link <?php if ($active_page_sub == "indexPreparing") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Chuẩn bị</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/production/changing/indexChanging" ?>"
                                            class="nav-link <?php if ($active_page_sub == "indexChanging") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Thay đổi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/production/outputNG/indexOutputNG" ?>"
                                            class="nav-link <?php if ($active_page_sub == "indexOutputNG") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Tỉ lệ lỗi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/production/oee/indexOee" ?>"
                                            class="nav-link <?php if ($active_page_sub == "indexOee") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>OEE</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/production/email/indexEmail" ?>"
                                            class="nav-link <?php if ($active_page_sub == "indexEmail") echo "active" ?>">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Quản lí Email</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/history/" ?>"
                                    class="nav-link <?php if ($active_page_sub == "history") echo "active" ?>">
                                    <i class="nav-icon fas fa-history text-warning"></i>
                                    <p>
                                        History
                                    </p>
                                </a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users text-info"></i>
                                    <p>
                                        Admin
                                    </p>
                                </a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/tutorial/" ?>"
                                    class="nav-link <?php if ($active_page_sub == "tutorial") echo "active" ?>">
                                    <i class="nav-icon fas fa-book text-secondary"></i>
                                    <p>
                                        Tutorial
                                    </p>
                                </a>
                            </li> -->

                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <?php echo $content; ?>
            </div>
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
            <footer class="main-footer">
                <img src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/dist/img/logo.png" ?>"
                    alt="Fischer Asia Logo" width=25px>
                <strong>Hamaden Vietnam Co., Ltd</strong>
                <div class="float-right d-none d-sm-inline-block" id="timer" style="color: #869099; font-weight:bold;">
                </div>
            </footer>
        </div>

    </body>
    <script
        src="<?php echo dirname($_SERVER['SCRIPT_NAME']) . "/projects/common/public/plugins/chart.js/Chart.min.js" ?>">
    </script>
    <!-- <script src="/fiot-hdvn-losses/node_modules/highcharts/highcharts.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/accessibility.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/exporting.js"></script>
    <script src="/fiot-hdvn-losses/node_modules/highcharts/modules/export-data.js"></script> -->


</html>
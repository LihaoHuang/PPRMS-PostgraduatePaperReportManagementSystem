<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>論文管理系統 | 首頁</title>

    <!-- Bootstrap -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">

    <?php
      session_start();
      if (isset($_SESSION["username"])) {

      }else{
        print '<script>window.location.replace("login.php");</script>';
      }

      if (isset($_SESSION['message'])) {
        echo '<script>alert(\''.$_SESSION['message'].'\');</script>';
        unset($_SESSION['message']);
      }
    ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- side navigation -->
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>論文管理系統</span></a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>功能選單</h3>
                  <ul class="nav side-menu">
                      <li><a><i class="fa fa-home"></i> 論文 <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                              <li><a href="paper_manage.php">論文管理</a></li>
                              <?php
                              if ($_SESSION['authority'] == 1) {
                                  echo "<li><a href='favorite.php'>我的最愛*</a></li>";
                                  echo "<li><a href='verify.php'>論文審核*</a></li>";
                              }
                              ?>
                          </ul>
                      </li>
                      <?php
                      if ($_SESSION['authority'] == 1) {
                          echo "<li><a><i class='fa fa-edit'></i> 使用者* <span class='fa fa-chevron-down'></span></a>";
                          echo    "<ul class='nav child_menu''>";
                          echo        "<li><a href='user_manage.php'>使用者維護*</a></li>";
                          echo    "</ul>";
                          echo "</li>";
                      }
                      ?>
                  </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
        <!-- /side navigation -->

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION["name"] ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                      <li><a href="javascript:;"> 登入身分 : <?php echo $_SESSION["authority"]==1?'管理員':'一般使用者' ?></a></li>
                      <li><a href="javascript:;"> 學校 : <?php echo $_SESSION["school"] ?></a></li>
                      <li><a href="javascript:;"> 科系 : <?php echo $_SESSION["department"] ?></a></li>
                      <li><a href="javascript:;"> 信箱 : <?php echo $_SESSION["email"] ?></a></li>
                    <li><a href="php/logout.php"><i class="fa fa-sign-out pull-right"></i> 登出</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <div style="height: 80vh;" class="col-md-12 col-sm-12 col-xs-12 bg-white">
              <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                <div style="margin-top: 20vh;font-size: 40px;">研究生論文報告管理系統</div>
              </div>
            </div>
            
          </div>
          <br />
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            研究生論文報告管理系統 BY 黃立豪 葉晴尹 簡伯翰 邱詳晴</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="js/custom.min.js"></script>
  </body>
</html>

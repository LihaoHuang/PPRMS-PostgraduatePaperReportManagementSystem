<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>論文管理系統 | 模板</title>

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
                      <li><a href="favorite.php">我的最愛*</a></li>
                      <li><a href="verify.php">論文審核*</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> 使用者* <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="user_manage.php">使用者維護*</a></li>
                    </ul>
                  </li>
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
                    <li><a href="javascript:;"> 個人資料</a></li>
                    <li><a href="php/logout.php"><i class="fa fa-sign-out pull-right"></i> 登出</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <style>
        .form-control-inline {
           width: auto;
           float:left;
           margin-right: 5px;
        }  
        </style>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
              <div class="x_title">
                <h3>論文 <small>論文新增</small></h3>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <p>
                   <form class="form-horizontal" method="post" action="php/paper_create.php" enctype="multipart/form-data">
                      <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $_SESSION["user_id"] ?>">
                      <div class="form-group">
                           <label class="col-sm-2 control-label" for="paper_name">論文名稱</label>
                           <div class="col-sm-3"><input type="text" class="form-control" name="paper_name" id="paper_name" required></div>
                           <label class="col-sm-2 control-label" for="source">出處</label>
                            <div class="col-sm-3"><input type="text" class="form-control" name="source" id="source" required></div>
                      </div>
  
                      <div class="form-group">
                           <label class="col-sm-2 control-label" for="publish" >發表年份</label>
                           <div class="col-sm-3"><input type="number" class="form-control" name="publish" id="publish" required></div>
                           <label class="col-sm-2 control-label" for="seminar_loc">研討會地點</label>
                           <div class="col-sm-3"><input type="text" class="form-control" name="seminar_loc" id="seminar_loc" required></div>
                      </div>

                      
                      <div class="form-group">
                           <label class="col-sm-2 control-label" for="seminar_time">研討會日期</label>
                           <div class="col-sm-3"><input class="form-control" type="date" placeholder="2014-09-18" name="seminar_time" id="seminar_time"></div>
                           <label class="col-sm-2 control-label" for="page">起訖頁數</label>
                           <div class="col-sm-3"><input type="number" class="form-control" name="page" id="page" required></div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="vol">期刊 Vol</label>
                          <div class="col-sm-3"><input type="number" class="form-control" name="vol" id="vol" required></div>
                          <label class="col-sm-2 control-label" for="no">期刊 No.</label>
                          <div class="col-sm-3"><input type="number" class="form-control" name="no" id="no" required></div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="file">論文原始檔</label>
                          <div class="col-sm-10"><input type="file" name="file" id="file" required></div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="keyword1">論文關鍵字1</label>
                          <div class="col-sm-3"><input style="display:inline;" type="text" class="form-control form-control-inline" name="keyword1" id="keyword1"></div>
                          <label class="col-sm-2 control-label" for="keyword2">論文關鍵字2</label>
                          <div class="col-sm-3"><input style="display:inline;" type="text" class="form-control form-control-inline" name="keyword2" id="keyword2"></div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="keyword3">論文關鍵字3</label>
                          <div class="col-sm-3"><input style="display:inline;" type="text" class="form-control form-control-inline" name="keyword3" id="keyword3"></div>
                          <label class="col-sm-2 control-label" for="keyword4">論文關鍵字4</label>
                          <div class="col-sm-3"><input style="display:inline;" type="text" class="form-control form-control-inline" name="keyword4" id="keyword4"></div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="keyword5">論文關鍵字5</label>
                          <div class="col-sm-3"><input style="display:inline;" type="text" class="form-control form-control-inline" name="keyword5" id="keyword5"></div>
                      </div>
                      
                      <div class="form-group">
                           <label class="col-sm-2 control-label" for="teacher">指導老師</label>
                           <div class="col-sm-3"><input type="text" class="form-control" name="teacher" id="teacher" required></div>
                           <label class="col-sm-2 control-label" for="report_time">報告日期</label>
                           <div class="col-sm-3"><input type="date" class="form-control" name="report_time" id="report_time" required></div>
                      </div>
                      
                      <div class="form-group">
                          <div class="col-sm-offset-5 col-sm-5"><button type="submit" class="btn btn-primary">送出表單</button></div>
                      </div>
                   </form>
                </p>
              </div>
            </div>
            <div class="clearfix"></div>
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

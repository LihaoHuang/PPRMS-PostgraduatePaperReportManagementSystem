<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>論文管理系統 | 論文管理</title>

    <!-- Bootstrap -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
    <!-- Datatables Style -->
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

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

  <body class="nav-md" onload="paper_load(<?php echo $_SESSION["user_id"] ?>)">
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
            <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
                <div class="row x_title">
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <h3>論文管理</h3>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <form style="margin-top:10px;" class="form-horizontal" method="post" action="php/xx.php">
                            <select id="search" style="display: inline;font-size:15px;">
                                <option value="paper_name">報告者姓名</option>
                                <option value="keyword">關鍵字</option>
                                <option value="report_time">報告日期</option>
                                <option value="journal">期刊名稱</option>
                                <option value="publish">發表年份</option>
                            </select>
                            <input type="text" id="keyword" placeholder="請輸入欲搜尋的關鍵字">
                            <input type="submit" value="搜尋" class="btn btn-default">
                        </form>
                    </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
               
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
                <div class="col-md-11 col-sm-11 col-xs-11"></div>
                <div class="col-md-1 col-sm-1 col-xs-1" style="margin-top:10px;">
                    <a class="btn btn-success" href="paper_manage_create.php" title="新增" data-tooltip="tooltip"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <p>
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>論文名稱</th>
                                <th>出處</th>
                                <th>發表年份</th>
                                <th>期刊</th>
                                <th>報告者名稱</th>
                                <th>審核結果</th>
                                <th style="width: 20vw;">功能</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
    <!-- Selfdefined Scripts -->
    <script src="js/paper.js"></script>
    <!-- Datatables Scripts -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

  </body>
</html>

<!-- View Modal -->
<div class="modal fade bs-example-modal-lg" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div align="center" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">詳細資料</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="php/paper_create.php" enctype="multipart/form-data">
          <div class="form-group">
               <label class="col-sm-2 control-label" for="paper_name">論文名稱：</label>
               <div class="col-sm-3" id="model_paper_name"></div>
               <label class="col-sm-2 control-label" for="source">出處：</label>
                <div class="col-sm-3" id="model_source"></div>
          </div>

          <div class="form-group">
               <label class="col-sm-2 control-label" for="publish" >發表年份：</label>
               <div class="col-sm-3" id="model_publish"></div>
               <label class="col-sm-2 control-label" for="seminar_loc">研討會地點：</label>
               <div class="col-sm-3" id="model_seminar_loc"></div>
          </div>

          
          <div class="form-group">
               <label class="col-sm-2 control-label" for="seminar_time">研討會日期：</label>
               <div class="col-sm-3" id="model_seminar_time"></div>
               <label class="col-sm-2 control-label" for="page">起訖頁數：</label>
               <div class="col-sm-3" id="model_page"></div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="journal">期刊名稱：</label>
              <div class="col-sm-3" id="model_journal"></div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="vol">期刊 Vol：</label>
              <div class="col-sm-3" id="model_vol"></div>
              <label class="col-sm-2 control-label" for="no">期刊 No.：</label>
              <div class="col-sm-3" id="model_no"></div>
          </div>
          
          <div class="form-group">
              <label class="col-sm-2 control-label" for="keyword1">論文關鍵字1：</label>
              <div class="col-sm-3" id="model_keyword1"></div>
              <label class="col-sm-2 control-label" for="keyword2">論文關鍵字2：</label>
              <div class="col-sm-3" id="model_keyword2"></div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="keyword3">論文關鍵字3：</label>
              <div class="col-sm-3" id="model_keyword3"></div>
              <label class="col-sm-2 control-label" for="keyword4">論文關鍵字4：</label>
              <div class="col-sm-3" id="model_keyword4"></div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="keyword5">論文關鍵字5：</label>
              <div class="col-sm-3" id="model_keyword5"></div>
              <label class="col-sm-2 control-label" for="filename">檔案：</label>
              <div class="col-sm-3" id="model_filename"></div>
          </div>
          
          <div class="form-group">
               <label class="col-sm-2 control-label" for="teacher">指導老師：</label>
               <div class="col-sm-3" id="model_teacher"></div>
               <label class="col-sm-2 control-label" for="report_time">報告日期：</label>
               <div class="col-sm-3" id="model_report_time"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade bs-example-modal-lg" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div align="center" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">編輯</h4>
      </div>
      <form class="form-horizontal" method="post" action="php/paper_store.php">
      <div class="modal-body">
          <div class="form-group">
               <input type="hidden" class="form-control" name="paper_id" id="paper_id" value="">
               <label class="col-sm-2 control-label" for="paper_name">論文名稱：</label>
               <div class="col-sm-3" id="paper_name"></div>
               <label class="col-sm-2 control-label" for="source">出處：</label>
                <div class="col-sm-3" id="source"></div>
          </div>

          <div class="form-group">
               <label class="col-sm-2 control-label" for="publish" >發表年份：</label>
               <div class="col-sm-3" id="publish"></div>
               <label class="col-sm-2 control-label" for="seminar_loc">研討會地點：</label>
               <div class="col-sm-3" id="seminar_loc"></div>
          </div>

          
          <div class="form-group">
               <label class="col-sm-2 control-label" for="seminar_time">研討會日期：</label>
               <div class="col-sm-3" id="seminar_time"></div>
               <label class="col-sm-2 control-label" for="page">起訖頁數：</label>
               <div class="col-sm-3" id="page"></div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="journal">期刊名稱：</label>
              <div class="col-sm-3" id="journal"></div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="vol">期刊 Vol：</label>
              <div class="col-sm-3" id="vol"></div>
              <label class="col-sm-2 control-label" for="no">期刊 No.：</label>
              <div class="col-sm-3" id="no"></div>
          </div>
          
          <div class="form-group">
              <label class="col-sm-2 control-label" for="keyword1">論文關鍵字1：</label>
              <div class="col-sm-3" id="keyword1"></div>
              <label class="col-sm-2 control-label" for="keyword2">論文關鍵字2：</label>
              <div class="col-sm-3" id="keyword2"></div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="keyword3">論文關鍵字3：</label>
              <div class="col-sm-3" id="keyword3"></div>
              <label class="col-sm-2 control-label" for="keyword4">論文關鍵字4：</label>
              <div class="col-sm-3" id="keyword4"></div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="keyword5">論文關鍵字5：</label>
              <div class="col-sm-3" id="keyword5"></div>
          </div>
          
          <div class="form-group">
               <label class="col-sm-2 control-label" for="teacher">指導老師：</label>
               <div class="col-sm-3" id="teacher"></div>
               <label class="col-sm-2 control-label" for="report_time">報告日期：</label>
               <div class="col-sm-3" id="report_time"></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">送出表單</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- FileUpload Modal -->
<div class="modal fade bs-example-modal-lg" id="fileupload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div align="center" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">檔案上傳</h4>
            </div>
            <form class="form-horizontal" method="post" action="php/paper_fileupload.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="FileUpload_paper_id" id="FileUpload_paper_id">
                        <label class="col-sm-2 control-label" for="file">論文原始檔</label>
                        <div class="col-sm-10"><input type="file" name="file" id="file" required></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">送出表單</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                </div>
            </form>
        </div>
    </div>
</div>
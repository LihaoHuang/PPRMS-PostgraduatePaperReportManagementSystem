<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>論文管理系統 | 我的最愛</title>

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

        <!-- page content -->
        <div class="right_col" role="main">
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
                <div class="row x_title">
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <h3>我的最愛</h3>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <form style="margin-top:10px;">
                            <lable for="keyword">關鍵字：</lable>
                            <input type="text" id="keyword">
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <p>
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>論文名稱</th>
                                <th>出處</th>
                                <th>發表年份</th>
                                <th>期刊</th>
                                <th>報告者名稱</th>
                                <th>功能</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>
                                    <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> 查看</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>
                                    <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> 查看</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>
                                    <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> 查看</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>
                                    <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> 查看</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>
                                    <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> 查看</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>
                                    <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> 查看</button>
                                </td>
                            </tr>
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
        <!-- Datatables Scripts -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "searching": false,
            } );
        } );
    </script>
  </body>
</html>

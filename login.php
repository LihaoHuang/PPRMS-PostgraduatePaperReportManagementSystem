<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>論文管理系統 | 登入</title>

    <!-- Bootstrap -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">

    <script src="js/login.js"></script>
    <?php
      session_start();
      if (isset($_SESSION['message'])) {
        echo '<script>alert(\''.$_SESSION['message'].'\');</script>';
        unset($_SESSION['message']);
      }
    ?>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div align="center" style="margin-top: 100px;">
          <h1><i class="fa fa-paw"></i> 研究生論文管理系統</h1>
      </div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="php/login.php" method="post">
              <h1>登入</h1>
              <div>
                <input type="text" class="form-control" placeholder="帳號" name="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="密碼" name="password" required="" />
              </div>
              <div>
                <input type="submit" value="登入" class="btn btn-default submit" style="margin-left: 42%;">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">沒有帳號密碼?
                  <a href="#signup" class="to_register" type="submit"> 申請帳號 </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="php/register.php" method="post">
              <h1>申請帳號</h1>
              <div>
                <input type="text" class="form-control" placeholder="帳號" name="username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" name="email" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="中文姓名" name="name" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="學校姓名" name="school" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="科系" name="department" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="密碼" name="password" required="" />
              </div>
              <div>
                <input type="submit" value="送出申請" class="btn btn-default submit" style="margin-left: 42%;">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">已經有帳號密碼?
                  <a href="#signin" class="to_register"> 登入 </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

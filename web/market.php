<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="BUAA database course work">

  <meta name="author" content="TongyuYue">

  <title>易物校园二手物品交换平台</title>

  <!-- Mobile Specific Meta
        ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />

  <!-- CSS
        ================================================== -->
  <!-- Fontawesome Icon font -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- Owl Carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css">
  <!-- Grid Component css -->
  <link rel="stylesheet" href="css/component.css">
  <!-- Slit Slider css -->
  <link rel="stylesheet" href="css/slit-slider.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/main.css">
  <!-- Media Queries -->
  <link rel="stylesheet" href="css/media-queries.css">

  <!--
        Google Font
        =========================== -->

  <!-- Oswald / Title Font -->
  <link href='http://fonts.useso.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
  <!-- Ubuntu / Body Font -->
  <link href='http://fonts.useso.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>

  

</head>

<body id="body">
  <!--
        Start Preloader
        ==================================== -->
  <div id="loading-mask">
    <div class="loading-img">
      <img alt="Yiwu Preloader" src="img/preloader.gif" />
    </div>
  </div>
  <!--
        End Preloader
        ==================================== -->

  <!--
        Welcome Slider
        ==================================== -->

  <!--/#home section-->

  <!-- 
        Fixed Navigation
        ==================================== -->
  <header id="navigation" class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <!-- responsive nav button -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- /responsive nav button -->

        <!-- logo -->
        <a class="navbar-brand" href="index.html">
          <h1 id="logo">
            <img src="img/logo-yiwu.png" />
          </h1>
        </a>
        <!-- /logo -->
      </div>

      <!-- main nav -->
      <nav class="collapse navbar-collapse navbar-right" role="Navigation">
        <ul id="nav" class="nav navbar-nav">
          <li><a href="index">首页</a></li>
          <li><a href="market">市场</a></li>
          <li><a id="inmsg" href="message">消息</a></li>
          <li><a id="outlg" href='#' data-toggle="modal" data-target="#login">登录</a></li>
          <li><a id="outrg" href="register">注册</a></li>
          <li><a id="inname" href="user"></a></li>          
        </ul>
      </nav>
      <!-- /main nav -->

    </div>
  </header>
  <!--
        End Fixed Navigation
        ==================================== -->

  <div class="copyrights">Collect from <a href="https://github.com/mycraftmw/db-course">GitHub</a></div>

  <!-- 登录模态框（Modal） -->
  <div id="login" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <a class="close" data-dismiss="modal">×</a>
          <h3 class="black">登录</h3>
        </div>
        <div class="modal-body">
          <p>
            <label class="black">用户名：</label>
            <input id="lusername" type="text" name="username" placeholder="username" style='color:black;'/>
          </p>
          <p>
            <label class="black">密&emsp;码：</label>
            <input id="luserpw" type="password" name="password" placeholder="password" style='color:black;'/>
          </p>
        </div>
        <div class="modal-footer">
          <a href='#' class="btn btn-success black" onclick="login()">登录</a>
          <a href='#' class="btn black " data-dismiss="modal">关闭</a>
        </div>
      </div>
    </div>
  </div>

   <!--消息模态框（Modal） -->
  <div id="msgmsg" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <a class="close" data-dismiss="modal">×</a>
          <h3 class="black">联系物主</h3>
        </div>
        <div class="modal-body">
          <p>
            <label class="black">消息：</label>
            <input id="msgs" style='width:480px;' type="text" name="username" placeholder="消息" style='color:black;'/><br>
            <!--<input id="applycha" type="checkbox" name="app"><label for='applycha' style='color:black;'>同时发送交易请求</label> -->
          </p>
        </div>
        <div class="modal-footer">
          <a href='#' id='sendbtn' class="btn btn-success black" onclick="sendmsg(admin);">发送</a>
          <a href='#' class="btn black " data-dismiss="modal">关闭</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Portfolio Section
        =========================================== -->

  <section id="showcase">
    <div class="container">
      <div class="row wow fadeInDown" data-wow-duration="500ms">
        <div class="col-lg-12">

          <!-- section title -->
          <div class="title text-center">
            <h2>热门<span class="color">物品</span></h2>
            <div class="border"></div>
          </div>
          <!-- /section title -->

          <!-- portfolio item filtering -->
          <div class="portfolio-filter clearfix">
            <input id="searchbar" class="col-xs-6 col-xs-offset-3 black" type="text" name="searchtext" placeholder="搜一下">
            <a href="javascript:search()">&emsp;&emsp;&emsp;搜索</a>
            <br>
            <br>
            <ul class="text-center">
              <li><a href="javascript:void(0)" class="filter" data-filter="all">全部</a></li>
              <li><a href="javascript:void(0)" class="filter" data-filter=".tag_meng">萌</a></li>
              <li><a href="javascript:void(0)" class="filter" data-filter=".tag_shishang">时尚</a></li>
              <li><a href="javascript:void(0)" class="filter" data-filter=".tag_gexing">个性</a></li>
              <li><a href="javascript:void(0)" class="filter" data-filter=".tag_shiyong">实用</a></li>
              <li><a href="javascript:void(0)" class="filter" data-filter=".tag_pinpai">品牌</a></li>
            </ul>
          </div>
          <!-- /portfolio item filtering -->

        </div>
        <!-- /end col-lg-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->

    <!-- portfolio items -->
    <div class="portfolio-item-wrapper wow fadeInUp" data-wow-duration="500ms">
      <ul id="og-grid" class="og-grid">

        <!-- single portfolio item -->
        <li id="shaobing" class="mix tag_pinpai">
          <a href="javascript:$('#msgmsg').modal();" style = "display:none;" data-largesrc="img/item/hu.jpg" data-title="闲置收音机" data-description="品牌收音机一台，功能完好，外观无明显损毁。">
            <img src="img/item/hu.jpg" width="100%">
            <div class="hover-mask">
              <h3>闲置收音机</h3>
              <span><i class="fa fa-plus fa-2x"></i></span>
            </div>
          </a>
        </li>

        
      </ul>
      <!-- end og grid -->
    </div>
    <!-- portfolio items wrapper -->

  </section>
  <!-- End section -->

  <footer id="footer" class="bg-one">
    <div class="container">
      <div class="row wow fadeInUp" data-wow-duration="500ms">
        <div class="col-lg-12">

          <!-- Footer Social Links -->
          <div class="social-icon">
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>
          </div>
          <!--/. End Footer Social Links -->

          <!-- copyright -->
          <div class="copyright text-center">
            <a href="index.html">
              <img src="img/logo-yiwu.png" alt="Meghna" />
            </a>
            <br />

            <p>数据库展示<a href="https://github.com/mycraftmw/db-course" target="_blank" title="gayhub">GitHub</a> - Collect from
              <a href="https://github.com/mycraftmw/db-course" title="gayhub" target="_blank">GayHub</a>. Copyright &copy;
              2015. All Rights Reserved.</p>
          </div>
          <!-- /copyright -->

        </div>
        <!-- end col lg 12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </footer>
  <!-- end footer -->

  <!-- Back to Top
        ============================== -->
  <a href="javascript:;" id="scrollUp">
    <i class="fa fa-angle-up fa-2x"></i>
  </a>

  <!-- end Footer Area
        ========================================== -->

  <!-- 
        Essential Scripts
        =====================================-->
<!-- Modernizer Script for old Browsers -->
  <script src="js/modernizr-2.6.2.min.js"></script>
  <!-- Main jQuery -->
  <script src="js/jquery-1.11.0.min.js"></script>
  <!--<script src="js/jquery-1.7.min.js"></script>-->
  <!-- Bootstrap 3.1 -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Slitslider -->
  <script src="js/jquery.slitslider.js"></script>
  <script src="js/jquery.ba-cond.min.js"></script>
  <!-- Parallax -->
  <script src="js/jquery.parallax-1.1.3.js"></script>
  <!-- Owl Carousel -->
  <script src="js/owl.carousel.min.js"></script>
  <!-- Portfolio Filtering -->
  <script src="js/jquery.mixitup.min.js"></script>
  <!-- Custom Scrollbar -->
  <script src="js/jquery.nicescroll.min.js"></script>
  <!-- Jappear js -->
  <script src="js/jquery.appear.js"></script>
  <!-- Pie Chart -->
  <script src="js/easyPieChart.js"></script>
  <!-- jQuery Easing -->
  <script src="js/jquery.easing-1.3.pack.js"></script>
  <!-- tweetie.min -->
  <script src="js/tweetie.min.js"></script>
  <!-- Google Map API -->

  <!-- Highlight menu item -->
  <script src="js/jquery.nav.js"></script>
  <!-- Sticky Nav -->
  <script src="js/jquery.sticky.js"></script>
  <!-- Number Counter Script -->
  <script src="js/jquery.countTo.js"></script>
  <!-- wow.min Script -->
  <script src="js/wow.min.js"></script>
  <!-- For video responsive -->
  <script src="js/jquery.fitvids.js"></script>
  <!-- Grid js -->
  <script src="js/grid.js"></script>
  <!-- Custom js -->
  <script src="js/custom.js"></script>
  <script src="js/myjs.js"></script>
  <script>
    $(function ($){      
      modifybar();
      fillMarket();
    });
  </script>
</body>

</html>
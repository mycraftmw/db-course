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

  <!-- Modernizer Script for old Browsers -->
  <script src="js/modernizr-2.6.2.min.js"></script>




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
        <a class="navbar-brand" href="#">
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
          <li><a id="outlg" data-toggle="modal" data-target="#login" href="javasript:void(0);">登录</a></li>
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
          <a href="#" class="btn btn-success black" onclick="login()">登录</a>
          <a href="#" class="btn black " data-dismiss="modal">关闭</a>
        </div>
      </div>
    </div>
  </div>

  <!--
        Start About Section
        ==================================== -->
  <section id="about" class="bg-one">
    <div class="container">
      <div class="row">

        <!-- section title -->
        <div class="title text-center wow fadeIn" data-wow-duration="1500ms">
          <h2>以物<span class="color">易物</span></h2>
          <div class="border"></div>
        </div>
        <!-- /section title -->

        <!-- About item -->
        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms">
          <div class="wrap-about">
            <div class="icon-box">
              <i class="fa fa-lightbulb-o fa-4x"></i>
            </div>
            <!-- Express About Yourself -->
            <div class="about-content text-center">
              <h3>循环利用</h3>
              <p>生活中有那种食之无用，弃之可惜的鸡肋么！或是那种自己一时兴起热血上头买来的货物，最后发现没什么大用。</p>
              <p>我们交换吧！</p>
            </div>
          </div>
        </div>
        <!-- End About item -->

        <!-- About item -->
        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
          <div class="wrap-about">
            <div class="icon-box">
              <i class="fa fa-exchange fa-4x "></i>
            </div>
            <!-- Express About Yourself -->
            <div class="about-content text-center">
              <h3>双倍享受</h3>
              <p>每人一份快乐，交换一下，就会有两份快乐！想要用最少的付出获得最大的乐趣么！</p>
              <p>我们交换吧！</p>
            </div>
          </div>
        </div>
        <!-- End About item -->

        <!-- About item -->
        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
          <div class="wrap-about kill-margin-bottom">
            <div class="icon-box">
              <i class="fa fa-users fa-4x"></i>
            </div>
            <!-- Express About Yourself -->
            <div class="about-content text-center">
              <h3>扩展社交</h3>
              <p>让乐于交友的你在这个平台上更加如意！每多一次交换，你就收获一份友谊！</p>
              <p>我们交换吧！</p>
            </div>
          </div>
        </div>
        <!-- End About item -->

      </div>
      <!-- End row -->
    </div>
    <!-- End container -->
  </section>
  <!-- End section -->

  <!--
        Start Main Features
        ==================================== -->
  <section id="main-features">
    <div class="container">
      <div class="row">

        <!-- features item -->
        <div id="features">
          <div class="item">

            <div class="features-item">

              <!-- features media -->
              <div class="col-md-6 feature-media media-wrapper wow fadeInUp" data-wow-duration="500ms">
                <img src="img/jiaohuan.png" class="img-responsive" width="70%">
              </div>
              <!-- /features media -->

              <!-- features content -->
              <div class="col-md-6 feature-desc wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                <h3>交换礼物</h3>
                <p>两千年前耶稣诞生时，从遥远的东方来了三位星象学家（东方三博士），他们发现一个奇特的星象，根据时间往回推，可能是哈雷慧星。 于是他们跟着这个奇异星星的引导，来到了伯利恒，因此后来的圣诞树顶部会有星星的装饰。 他们把三个礼物，黄金、乳香、没药（一种中药材），献给了耶稣。
                  后来就慢慢演变成交换礼物了。
                </p>
                <p>两千年前耶稣诞生时，从遥远的东方来了三位星象学家（东方三博士），他们发现一个奇特的星象，根据时间往回推，可能是哈雷慧星。 于是他们跟着这个奇异星星的引导，来到了伯利恒，因此后来的圣诞树顶部会有星星的装饰。 他们把三个礼物，黄金、乳香、没药（一种中药材），献给了耶稣。
                  后来就慢慢演变成交换礼物了。
                </p>
              </div>
              <!-- /features content -->

            </div>
          </div>

          <div class="item">
            <div class="features-item">

              <!-- features media -->
              <div class="col-md-6 feature-media wow fadeInUp" data-wow-duration="500ms">
                <img src="img/happyfriend.jpg" class="img-responsive">
              </div>
              <!-- /features media -->

              <!-- features content -->
              <div class="col-md-6 feature-desc wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                <h3>交换友谊</h3>
                <p>两千年前耶稣诞生时，从遥远的东方来了三位星象学家（东方三博士），他们发现一个奇特的星象，根据时间往回推，可能是哈雷慧星。 于是他们跟着这个奇异星星的引导，来到了伯利恒，因此后来的圣诞树顶部会有星星的装饰。 他们把三个礼物，黄金、乳香、没药（一种中药材），献给了耶稣。
                  后来就慢慢演变成交换礼物了。
                </p>
                <p>两千年前耶稣诞生时，从遥远的东方来了三位星象学家（东方三博士），他们发现一个奇特的星象，根据时间往回推，可能是哈雷慧星。 于是他们跟着这个奇异星星的引导，来到了伯利恒，因此后来的圣诞树顶部会有星星的装饰。 他们把三个礼物，黄金、乳香、没药（一种中药材），献给了耶稣。
                  后来就慢慢演变成交换礼物了。
                </p>
              </div>
              <!-- /features content -->

            </div>
          </div>
        </div>
        <!-- /features item -->

      </div>
      <!-- End row -->
    </div>
    <!-- End container -->
  </section>
  <!-- End section -->

  <!--
        Start Counter Section
        ==================================== -->

  <section id="counter" class="parallax-section">
    <div class="container">
      <div class="row">

        <!-- first count item -->
        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms">
          <div class="counters-item">
            <div>
              <span data-speed="3000" data-to="320">320</span>
            </div>
            <i class="fa fa-users fa-3x"></i>
            <h3>Happy Clients</h3>
          </div>
        </div>
        <!-- end first count item -->

        <!-- second count item -->
        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="200ms">
          <div class="counters-item">
            <div>
              <span data-speed="3000" data-to="565">565</span>
            </div>
            <i class="fa fa-check-square fa-3x"></i>
            <h3>Transaction completed</h3>
          </div>
        </div>
        <!-- end second count item -->

        <!-- third count item -->
        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="400ms">
          <div class="counters-item">
            <div>
              <span data-speed="3000" data-to="95">95</span>
              <span>%</span>
            </div>
            <i class="fa fa-thumbs-up fa-3x"></i>
            <h3>Positive feedback</h3>

          </div>
        </div>
        <!-- end third count item -->

        <!-- fourth count item -->
        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="600ms">
          <div class="counters-item kill-margin-bottom">
            <div>
              <span data-speed="3000" data-to="2500">2500</span>
            </div>
            <i class="fa fa-coffee fa-3x"></i>
            <h3>Cups of Coffee</h3>
          </div>
        </div>
        <!-- end fourth count item -->

      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end section -->

  <!-- end Contact Area
        ========================================== -->

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

  <!-- Main jQuery -->
  <script src="js/jquery-1.11.0.min.js"></script>
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
    });
  </script>
</body>

</html>
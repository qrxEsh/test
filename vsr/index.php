<?php
session_start();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Сайт</title>
  <link rel="shortcut icon" href="assets/img/.png" type="image/x-icon" />


  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <link href="assets/css/flexslider.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="index.css" rel="stylesheet" />

</head>

<body>

  <div class="navbar navbar-inverse navbar-fixed-top " id="menu">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><img class="logo-custom" src="assets/img/logo.jpg" alt="" /></a>
      </div>
      <div class="navbar-collapse collapse move-me">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#home">Главная</a></li>

          <li><a href="#course-sec">О нас</a></li>
          <li><a href="#course-sec1">Каталог</a></li>
          <li><a href="#course-sec2">Как нас найти?</a></li>

        </ul>
      </div>

    </div>
  </div>
<div class ="hzz">
  <div class="home-sec" id="home">
    <div class="overlay">
      <div class="container">
        <div class="row text-center ">

          <div class="col-lg-12  col-md-12 col-sm-12">


            <div class="flexslider set-flexi" id="main-section">
              <ul class="slides move-me">

                <li>
                  <h3>Пожалуйста, войдите или зарегистрируйтесь</h3>
                  <a href="#features-sec" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#ln">
                    Войти
                  </a>
                  <a href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                    Регистрация
                  </a>

                  <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#an">
                    Админ
                  </a>
                </li>

                <li>
                  <h3>Пожалуйста, войдите или зарегистрируйтесь</h3>
                  
                 
                  <a href="#features-sec" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#ln">
                    Войти
                  </a>
                  <a href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                    Регистрация
                  </a>

                  <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#an">
                    Админ
                  </a>
                </li>

                <li>
                  <h3>Пожалуйста, войдите или зарегистрируйтесь</h3>
                  
                  <a href="#features-sec" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#ln">
                    Войти
                  </a>
                  <a href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                    Регистрация
                  </a>
                  <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#an">
                    Админ
                  </a>
                </li>

              </ul>
            </div>




          </div>

        </div>
      </div>
    </div>

  </div>

  <div class="tag-line">
    <div class="container">
      <div class="row  text-center">
<div class = "textppp">
  <h1><strong>Добро пожаловать!</h1></strong>
</div>
        
      </div>
    </div>

  </div>




  <div id="course-sec" class="container set-pad">
    <div class="row text-center">
      <div class="zzzz">
        <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">О нас</h1>
        <p data-scroll-reveal="enter from the bottom after 0.3s">
          Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта 
          Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта Описание сайта 
          <br />ююю
        </p>
      </div>

    </div>


    <div id="course-sec1" class="awdawdaw">

      <h2><strong>Каталог</strong></h2>
      <hr />
      <div>


        <?php
        $conn = mysqli_connect("localhost", "root", "");
        mysqli_select_db($conn, "edgedata");

        $start = 0;
        $limit = 8;

        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $start = ($id - 1) * $limit;
        }

        $query = mysqli_query($conn, "select * from items LIMIT $start, $limit");


        while ($query2 = mysqli_fetch_array($query)) {

          echo "<div class='col-sm-3'><div class='panel panel-default' style='border-color:#000000;'>
            <div class='panel-heading' style='color:white;background-color : #000000;'>
            <center> 
<textarea style='text-align:center;background-color: yellow;' class='form-control' rows='1' disabled>" . $query2['item_name'] . "</textarea>
			</center>
            </div>
            <div class='panel-body'>
           <a class='fancybox-buttons' href='../Admin/item_images/" . $query2['item_image'] . "' data-fancybox-group='button' title='Page " . $id . "- " . $query2['item_name'] . "'>
					
					<img src='../Admin/item_images/" . $query2['item_image'] . "' class='img img-thumbnail'  style='width:350px;height:200px;' />
					</a>
				
					
					<center><h4> Цена: &#8381; " . $query2['item_price'] . " </h4></center>
					<center><h4> Описание: " . $query2['item_qwe'] . " </h4></center>
				
            </div>
          </div>
        </div>";
        }

        echo "<div class='container'>";
        echo "</div>";
        ?>
      </div>
    </div>



  </div>



  <br />

  <div id="course-sec2" class="container">
    <div class="row set-row-pad">
      <div class="aaaa">

        <h2><center><strong>Где нас найти?</strong></h2></center>
        <hr />
        <div">
          <h4>129337, город Москва, Хибинский пр-д, д. 10.</h4>
          <h4>Хибинский пр-д, д. 10.</h4>
          <h4>129337</h4>
          <h4>Телефон: +79998887766</h4>
          <div style="text-align:center">
          <img class = "asda" src = "assets\img\map.jpg">
          </div>
      </div>
      
     


    </div>

  </div>


  </div>
  </div>

  <div class="modal fade" id="su" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
    <div class="modal-dialog modal-sm">
      <div style="color:white;background-color:#008CBA" class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Форма регистрации</h4>
        </div>
        <div class="modal-body">


          <form role="form" method="post" action="register.php">
            <fieldset>

              <div class="form-group">
                <input class="form-control" placeholder="Имя" name="ruser_firstname" type="text" required>
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Фамилия" name="ruser_lastname" type="text" required>
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Адрес" name="ruser_address" type="text" required>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Отчество" name="ruser_mynac" type="text" required>
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Почта" name="ruser_email" type="email" required>
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Пароль" name="ruser_password" type="password" required>
              </div>

            </fieldset>


        </div>
        <div class="modal-footer">

          <button class="btn btn-md btn-warning btn-block" name="register">Зарегистрироваться</button>

          <button type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Закрыть</button>
          </form>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="ln" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
    <div class="modal-dialog modal-sm">
      <div style="color:white;background-color:#008CBA" class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 style="color:white" class="modal-title" id="myModalLabel">Логин клиента</h4>
        </div>
        <div class="modal-body">


          <form role="form" method="post" action="userlogin.php">
            <fieldset>


              <div class="form-group">
                <input class="form-control" placeholder="Почта" name="user_email" type="email" required>
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Пароль" name="user_password" type="password" required>
              </div>

            </fieldset>


        </div>
        <div class="modal-footer">

          <button class="btn btn-md btn-warning btn-block" name="user_login">Войти</button>

          <button type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Закрыть</button>
          </form>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="an" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
    <div class="modal-dialog modal-sm">
      <div style="color:white;background-color:#008CBA" class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 style="color:white" class="modal-title" id="myModalLabel">Учетные данные администратора</h4>
        </div>
        <div class="modal-body">


          <form role="form" method="post" action="adminlogin.php">
            <fieldset>


              <div class="form-group">
                <input class="form-control" placeholder="Имя" name="admin_username" type="text" required>
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Пароль" name="admin_password" type="password" required>
              </div>

            </fieldset>


        </div>
        <div class="modal-footer">

          <button class="btn btn-md btn-warning btn-block" name="admin_login">Войти</button>

          <button type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Закрыть</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  <br />
  <br />
  <br />

  <script src="assets/js/jquery-1.10.2.js"></script>

  <script src="assets/js/bootstrap.js"></script>

  <script src="assets/js/jquery.flexslider.js"></script>

  <script src="assets/js/scrollReveal.js"></script>

  <script src="assets/js/jquery.easing.min.js"></script>

  <script src="assets/js/custom.js"></script>
</body>

</html>
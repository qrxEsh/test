<?php
session_start();

if (!$_SESSION['user_email']) {

  header("Location: ../index.php");
}

?>

<?php
include("config.php");
extract($_SESSION);
$stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
$stmt_edit->execute(array(':user_email' => $user_email));
$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
extract($edit_row);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Сайт</title>
  <link rel="shortcut icon" href="../assets/img/.png" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="css/local.css" />

  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>



</head>

<body>
  <div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Переключение навигации</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Сайт</a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
          <li class="active"><a href="index.php"> &nbsp; Главная</a></li>
          <li><a href="shop.php?id=1"> &nbsp; Купить сейчас</a></li>
          <li><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span> Корзина</a></li>
          <li><a data-toggle="modal" data-target="#setAccount"> &nbsp; <span class='fa fa-gear'></span> Настройки аккаунта</a></li>
          <li><a href="logout.php"> &nbsp; Выйти</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right navbar-user">
          <li class="dropdown user-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_email; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a data-toggle="modal" data-target="#setAccount"><i class="fa fa-gear"></i> Настройки</a></li>
              <li class="divider"></li>
              <li><a href="logout.php"><i class="fa fa-power-off"></i> Выйти</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="alert alert-info">
        <h1>
          <center>Добро пожаловать!</center>
        </h1>
      </div>
      <div style="color:black; background-color: white">
        <h1>
          Здесь вы можете просмотреть список доступных вам товаров(кнопка купить сейчас)
          <br>Также вы можете добавить нужный вам товар в корзину и соответсвенно прсмотреть ее, ну и удалить товар из корзины
          <br>Еще вы можете редактировать информацию своего аккаунта:)
        </h1>
      </div>
    </nav>

  </div>
  <br />

  </div>
  </div>
  </div>
  <div class="modal fade" id="setAccount" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
    <div class="modal-dialog modal-sm">
      <div style="color:white;background-color:#008CBA" class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 style="color:white" class="modal-title" id="myModalLabel">Настройки аккаунта</h2>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" method="post" action="settings.php">
            <fieldset>
              <p>Имя:</p>
              <div class="form-group">
                <input class="form-control" placeholder="Имя" name="user_firstname" type="text" value="<?php echo $user_firstname; ?>" required>
              </div>
              <p>Фамилия:</p>
              <div class="form-group">
                <input class="form-control" placeholder="Фамилия" name="user_lastname" type="text" value="<?php echo $user_lastname; ?>" required>
              </div>
              <p>Логин</p>
              <div class="form-group">
                <input class="form-control" placeholder="Логин" name="user_address" type="text" value="<?php echo $user_address; ?>" required>
              </div>
              <p>Пароль:</p>
              <div class="form-group">
                <input class="form-control" placeholder="Пароль" name="user_password" type="password" value="<?php echo $user_password; ?>" required>
              </div>
              <p>Отчество:</p>
              <div class="form-group">
                <input class="form-control" placeholder="Отчество" name="user_mynac" type="text" value="<?php echo $user_mynac; ?>" required>
              </div>
              <div class="form-group">
                <input class="form-control hide" name="user_id" type="text" value="<?php echo $user_id; ?>" required>
              </div>
            </fieldset>
        </div>
        <div class="modal-footer">
          <button class="btn btn-block btn-success btn-md" name="user_save">Сохранить</button>
          <button type="button" class="btn btn-block btn-danger btn-md" data-dismiss="modal">Закрыть</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#priceinput').keypress(function(event) {
        return isNumber(event, this)
      });
    });

    function isNumber(evt, element) {

      var charCode = (evt.which) ? evt.which : event.keyCode

      if (
        (charCode != 45 || $(element).val().indexOf('-') != -1) &&
        (charCode != 46 || $(element).val().indexOf('.') != -1) &&
        (charCode < 48 || charCode > 57))
        return false;

      return true;
    }
  </script>



</body>

</html>
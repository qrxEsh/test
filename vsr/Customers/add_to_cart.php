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
<?php
include("config.php");
$stmt_edit = $DB_con->prepare("select sum(order_total) as total from orderdetails where user_id=:user_id and order_status='Ordered'");
$stmt_edit->execute(array(':user_id' => $user_id));
$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
extract($edit_row);

?>


<?php

error_reporting(~E_NOTICE);

require_once 'config.php';

if (isset($_GET['cart']) && !empty($_GET['cart'])) {
    $id = $_GET['cart'];
    $stmt_edit = $DB_con->prepare('SELECT * FROM items WHERE item_id =:item_id');
    $stmt_edit->execute(array(':item_id' => $id));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);
} else {
    header("Location: shop.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт</title>
    <link rel="shortcut icon" href="../assets/img.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
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
                    <li><a href="index.php"> &nbsp; <span class='glyphicon glyphicon-home'></span> Главная</a></li>
                    <li class="active"><a href="shop.php?id=1"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span> Купить </a></li>
                    <li><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span>Корзина</a></li>
                    <li><a data-toggle="modal" data-target="#setAccount"> &nbsp; <span class='fa fa-gear'></span> Настройки учетной записи</a></li>
                    <li><a href="logout.php"> &nbsp; <span class='glyphicon glyphicon-off'></span>Выйти</a></li>


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
        </nav>

        <div id="page-wrapper">







            <form role="form" method="post" action="save_order.php">


                <?php
                if (isset($errMSG)) {
                ?>

                <?php
                }
                ?>

                <div class="alert alert-default" style="color:white;background-color:#008CBA">
                    <center>
                        <h3> <span class="glyphicon glyphicon-info-sign"></span> Детали заказа</h3>
                    </center>
                </div>

                <td><input class="form-control" type="hidden" name="order_name" value="<?php echo $item_name; ?>" /></td>
                <td><input class="form-control" type="hidden" name="order_price" value="<?php echo $item_price; ?>" /></td>
                <td><input class="form-control" type="hidden" name="user_id" value="<?php echo $user_id; ?>" /></td>

                <table class="table table-bordered table-responsive">



                    <tr>
                        <td><label class="control-label">Название товара.</label></td>
                        <td><input class="form-control" type="text" name="v1" value="<?php echo $item_name; ?>" disabled /></td>




                    </tr>


                    <tr>
                        <td><label class="control-label">Цена.</label></td>
                        <td><input class="form-control" type="text" name="v2" value="<?php echo $item_price; ?>" disabled /></td>
                    </tr>



                    <tr>
                        <td><label class="control-label">Изображение.</label></td>
                        <td>
                            <p><img class="img img-thumbnail" src="../Admin/item_images/<?php echo $item_image; ?>" style="height:250px;width:350px;" /></p>

                        </td>

                    <tr>
                        <td><label class="control-label">Количество.</label></td>
                        <td><input class="form-control" type="text" placeholder="Количество" name="order_quantity" value="1" onkeypress="return isNumber(event)" onpaste="return false" required />



                        </td>
                    </tr>


                    </tr>

                    <tr>
                        <td colspan="2"><button type="submit" name="order_save" class="btn btn-primary">
                                <span class="glyphicon glyphicon-shopping-cart"></span> OK
                            </button>

                            <a class="btn btn-danger" href="shop.php?id=1"> <span class="glyphicon glyphicon-backward"></span> Закрыть </a>

                        </td>
                    </tr>

                </table>

            </form>





            <br />

            

        </div>
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

                            <p>Адрес:</p>
                            <div class="form-group">

                                <input class="form-control" placeholder="Адрес" name="user_address" type="text" value="<?php echo $user_address; ?>" required>


                            </div>

                            <p>Пароль:</p>
                            <div class="form-group">

                                <input class="form-control" placeholder="Пароль" name="user_password" type="password" value="<?php echo $user_password; ?>" required>


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


</body>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

</html>
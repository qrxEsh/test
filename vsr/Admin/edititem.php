<?php
session_start();

if (!$_SESSION['admin_username']) {

    header("Location: ../index.php");
}

?>
<?php

error_reporting(~E_NOTICE);

require_once 'config.php';

if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $stmt_edit = $DB_con->prepare('SELECT * FROM items WHERE item_id =:item_id');
    $stmt_edit->execute(array(':item_id' => $id));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);
} else {
    header("Location: items.php");
}



if (isset($_POST['btn_save_updates'])) {
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];


    $imgFile = $_FILES['item_image']['name'];
    $tmp_dir = $_FILES['item_image']['tmp_name'];
    $imgSize = $_FILES['item_image']['size'];

    if ($imgFile) {
        $upload_dir = 'item_images/';
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
        $itempic = rand(1000, 1000000) . "." . $imgExt;
        if (in_array($imgExt, $valid_extensions)) {
            if ($imgSize < 5000000) {
                unlink($upload_dir . $edit_row['item_image']);
                move_uploaded_file($tmp_dir, $upload_dir . $itempic);
            } else {
                $errMSG = "Извините, ваш файл слишком большой, он должен быть меньше 5 МБ";
                echo "<script>alert('Извините, ваш файл слишком большой, он должен быть меньше 5 МБ')</script>";
            }
        } else {
            $errMSG = "Извините, разрешены только файлы JPG, JPEG, PNG и GIF.";
            echo "<script>alert('Извините, разрешены только файлы JPG, JPEG, PNG и GIF.')</script>";
        }
    } else {

        $itempic = $edit_row['item_image'];
    }



    if (!isset($errMSG)) {
        $stmt = $DB_con->prepare('UPDATE items
									     SET item_name=:item_name, 
											 item_price=:item_price, 
										     item_image=:item_image 
								       WHERE item_id=:item_id');
        $stmt->bindParam(':item_name', $item_name);
        $stmt->bindParam(':item_price', $item_price);
        $stmt->bindParam(':item_image', $itempic);
        $stmt->bindParam(':item_id', $id);

        if ($stmt->execute()) {
?>
            <script>
                alert('Успешно обновлен ...');
                window.location.href = 'items.php';
            </script>
<?php
        } else {
            $errMSG = "Извините, данные не удалось обновить!";
            echo "<script>alert('Извините, данные не удалось обновить!')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оздоровительный комплекс</title>
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
                <a class="navbar-brand" href="index.php">Админ Панель</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="index.php"> &nbsp; &nbsp; &nbsp; Главная</a></li>
                    <li><a data-toggle="modal" data-target="#uploadModal"> &nbsp; &nbsp; &nbsp; Добавить товар</a></li>
                    <li class="active"><a href="items.php"> &nbsp; &nbsp; &nbsp; Управление товарами</a></li>
                    <li><a href="logout.php"> &nbsp; &nbsp; &nbsp; Выйти</a></li>


                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php extract($_SESSION);
                                                                                                                echo $admin_username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Выйти</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">









            <div class="clearfix"></div>

            <form method="post" enctype="multipart/form-data" class="form-horizontal">


                <?php
                if (isset($errMSG)) {
                ?>

                <?php
                }
                ?>
                <div class="alert alert-info">

                    <center>
                        <h3><strong>Обновить товар</strong> </h3>
                    </center>

                </div>

                <table class="table table-bordered table-responsive">

                    <tr>
                        <td><label class="control-label">Название товара</label></td>
                        <td><input class="form-control" type="text" name="item_name" value="<?php echo $item_name; ?>" required /></td>
                    </tr>

                    <tr>
                        <td><label class="control-label">Цена.</label></td>
                        <td><input id="inputprice" class="form-control" type="text" name="item_price" value="<?php echo $item_price; ?>" required /></td>
                    </tr>


                    <tr>
                        <td><label class="control-label">Изображение.</label></td>
                        <td>
                            <p><img class="img img-thumbnail" src="item_images/<?php echo $item_image; ?>" height="150" width="150" /></p>
                            <input class="input-group" type="file" name="item_image" accept="image/*" />
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-primary">
                                Обновить
                            </button>

                            <a class="btn btn-danger" href="items.php"> Закрыть </a>

                        </td>
                    </tr>

                </table>

            </form>


            <br />

           





        </div>
    </div>




    </div>



    </div>




    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
        <div class="modal-dialog modal-md">
            <div style="color:white;background-color:#008CBA" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 style="color:white" class="modal-title" id="myModalLabel">Загрузить товар</h2>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="post" action="additems.php">
                        <fieldset>
                            <p>Название товара:</p>
                            <div class="form-group">
                                <input class="form-control" placeholder="Название товара" name="item_name" type="text" required>
                            </div>
                            <p>Цена:</p>
                            <div class="form-group">
                                <input id="priceinput" class="form-control" placeholder="Цена" name="item_price" type="text" required>
                            </div>
                            <p>Выберите изображение:</p>
                            <div class="form-group">
                                <input class="form-control" type="file" name="item_image" accept="image/*" required />
                            </div>
                        </fieldset>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-success btn-md" name="item_save">Сохранить</button>

                    <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Закрыть</button>


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
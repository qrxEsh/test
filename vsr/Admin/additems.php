<?php
session_start();

if (!$_SESSION['admin_username']) {

	header("Location: ../index.php");
}

?>

<?php
include("db_conection.php");
if (isset($_POST['item_save'])) {
	$item_name = $_POST['item_name'];
	$item_price = $_POST['item_price'];
	$item_qwe = $_POST['item_qwe'];


	$check_item = "select * from items WHERE item_name='$item_name'";
	$run_query = mysqli_query($dbcon, $check_item);

	if (mysqli_num_rows($run_query) > 0) {
		echo "<script>alert('товар уже существует, пожалуйста, попробуйте другой!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
		exit();
	}

	$imgFile = $_FILES['item_image']['name'];
	$tmp_dir = $_FILES['item_image']['tmp_name'];
	$imgSize = $_FILES['item_image']['size'];

	$upload_dir = 'item_images/';
	$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
	$itempic = rand(1000, 1000000) . "." . $imgExt;




	if (in_array($imgExt, $valid_extensions)) {

		if ($imgSize < 5000000) {
			move_uploaded_file($tmp_dir, $upload_dir . $itempic);
			$saveitem = "insert into items (item_name,item_price,item_image,item_date,item_qwe) VALUE ('$item_name','$item_price','$itempic',CURDATE(),'$item_qwe')";
			mysqli_query($dbcon, $saveitem);
			echo "<script>alert('Данные успешно сохранены!')</script>";
			echo "<script>window.open('items.php','_self')</script>";
		} else {

			echo "<script>alert('Файл слишком большой.')</script>";
			echo "<script>window.open('items.php','_self')</script>";
		}
	} else {

		echo "<script>alert('Извините, только файлы формата JPG, JPEG, PNG и GIF.')</script>";
		echo "<script>window.open('items.php','_self')</script>";
	}
}

?>










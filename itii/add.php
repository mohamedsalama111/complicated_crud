<?php
	ob_start();
	session_start();
	include_once'coonect.php';
if (isset($_POST['submit'])) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$formErrors = array();

			$name 		= filter_var($_POST['name'], FILTER_SANITIZE_STRING);
			$price 		= filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
			move_uploaded_file($_FILES["pic"]["tmp_name"], "images/".$_FILES["pic"]['name']);
			$pic="images/".$_FILES['pic']['name'];

			if (strlen($name) < 4) {

				$formErrors[] = 'Item Title Must Be At Least 4 Characters';

			}

			
			if (empty($price)) {

				$formErrors[] = 'Item Price Cant Be Empty';

			}

			
			if (empty($formErrors)) {
				$stmt = $con->prepare("INSERT INTO 
					tbl_product(name, Price, image)
					VALUES(:zname, :zprice,:zpic)");

				$stmt->execute(array(

					'zname' 	=> $name,
					'zprice' 	=> $price,
					'zpic'		=> $pic,
				));


				if ($stmt) {

					$succesMsg = 'Item Has Been Added';
					
				}

			}

		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link 	rel="stylesheet" 
		  	href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" 
		  	integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" 
		  	crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
			integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
			crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" 
			crossorigin="anonymous"></script>
	<title></title>
	<style>
		body {
			background-color: #cfd8dc;
		}
		.lol {
			text-align: center;
			margin-top: 10%;
		}
		label {
			margin-left: -140px;
		}
		input {

		}
		.btn {
		    display: block;
		    margin: 10px 0;
		    margin-left: 3px;
		    padding: 10px;
		    width: 91%;
		}
	</style>
</head>
<body>
<h1 class="text-center">ADD USER</h1>
				<div class="container">
					<form class="form-horizontal" action="add.php" method="POST" enctype="multipart/form-data">
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">NAME : </label>
							<div class="col-sm-10 col-sm-6">
								<input type="text" 
										name="name" 
										class="form-control"
										required="required"
										placeholder="ENTR ITEM NAME" 
										onfocus="this.placeholder = ''" 
										onblur="this.placeholder='ENTR ITEM NAME'"/>
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">PRICE : </label>
							<div class="col-sm-10 col-sm-6">
								<input type="text" 
										name="price" 
										class="form-control"
										required = "required"
										placeholder="PRICE" 
										onfocus="this.placeholder = ''" 
										onblur="this.placeholder='PRICE'"/>
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">IMAGE :</label>
							<div class="col-sm-10 col-sm-6">
								<input type="file" 
										name="pic" >
							</div>
						</div>
							<div class="form-group form-group-lg">
							<div class="btn">
								<input type="submit" name='submit' value="CONFIRM" class="btn btn-primary btn-sm" />
							</div>
						</div>
						</div>
					</form>
				</div>
			</body>
			</html>
			<?php 
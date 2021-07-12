<?php
require_once("../../include/initialize.php");


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add':
		doInsert();
		break;

	case 'edit':
		doEdit();
		break;

	case 'delete':
		doDelete();
		break;

	case 'photos':
		doupdateimage();
		break;

	case 'banner':
		setBanner();
		break;

	case 'discount':
		setDiscount();
		break;
}


function doInsert()
{
	if (isset($_POST['save'])) {



		$errofile = $_FILES['image']['error'];
		$type = $_FILES['image']['type'];
		$temp = $_FILES['image']['tmp_name'];
		$myfile = $_FILES['image']['name'];
		$location = "uploaded_photos/" . $myfile;


		if ($errofile > 0) {
			message("Aucune image selectionner!", "error");
			redirect("index.php?view=add");
		} else {

			@$file = $_FILES['image']['tmp_name'];
			@$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			@$image_name = addslashes($_FILES['image']['name']);
			@$image_size = getimagesize($_FILES['image']['tmp_name']);

			if ($image_size == FALSE || $type == 'video/wmv') {
				message("C'est pas une image!", "error");
				redirect("index.php?view=add");
			} else {
				//uploading the file
				move_uploaded_file($temp, "uploaded_photos/" . $myfile);

				if ($_POST['PRODESC'] == "" or $_POST['PROPRICE'] == "") {
					$messageStats = false;
					message("Tout les champs sont demander!", "error");
					redirect('index.php?view=add');
				} else {


					$autonumber = new Autonumber();
					$res = $autonumber->set_autonumber('PROID');




					$product = new Product();
					$product->PROID 		= $res->AUTO;
					$product->OWNERNAME 		= $_POST['OWNERNAME'];
					$product->OWNERPHONE 		= $_POST['OWNERPHONE'];
					$product->IMAGES 		= $location;
					$product->PRODESC 		= $_POST['PRODESC'];
					$product->CATEGID	    = $_POST['CATEGORY'];
					$product->PROQTY		= $_POST['PROQTY'];
					$product->ORIGINALPRICE	= $_POST['ORIGINALPRICE'];
					$product->PROPRICE		= $_POST['PROPRICE'];
					$product->PROSTATS		= 'Available';
					$product->create();
					// }



					$promo = new Promo();
					$promo->PROID		= $res->AUTO;
					$promo->PRODISPRICE	= $_POST['PROPRICE'];
					$promo->create();


					$autonumber = new Autonumber();
					$autonumber->auto_update('PROID');



					message("Nouveau produit inserer avec success!", "success");
					redirect("index.php");
				}
			}
		}
	}
}


function doEdit()
{
	if (@$_GET['stats'] == 'NotAvailable') {
		$product = new Product();
		$product->PROSTATS	= 'Available';
		$product->update(@$_GET['id']);
	} elseif (@$_GET['stats'] == 'Available') {
		$product = new Product();
		$product->PROSTATS	= 'NotAvailable';
		$product->update(@$_GET['id']);
	} else {

		if (isset($_GET['front'])) {
			$product = new Product();
			$product->FRONTPAGE	= True;
			$product->update(@$_GET['id']);
		}
	}



	if (isset($_POST['save'])) {

		$product = new Product();
		// $product->PROMODEL 		= $_POST['PROMODEL']; 
		// $product->PRONAME 		= $_POST['PRONAME']; 
		$product->OWNERNAME 		= $_POST['OWNERNAME'];
		$product->OWNERPHONE 		= $_POST['OWNERPHONE'];
		$product->PRODESC 		= $_POST['PRODESC'];
		$product->CATEGID	    = $_POST['CATEGORY'];
		$product->PROQTY		= $_POST['PROQTY'];
		$product->ORIGINALPRICE	= $_POST['ORIGINALPRICE'];
		$product->PROPRICE		= $_POST['PROPRICE'];
		$product->update($_POST['PROID']);


		message("Produit modifier avec success!", "success");
		redirect("index.php");
	}
	redirect("index.php");
}

function doDelete()
{




	if (isset($_POST['selector']) == '') {
		message("Selectionner pour Supprimer!", "error");
		redirect('index.php');
	} else {

		$id = $_POST['selector'];
		$key = count($id);

		for ($i = 0; $i < $key; $i++) {

			$product = new Product();
			$product->delete($id[$i]);


			$stockin = new StockIn();
			$stockin->delete($id[$i]);

			$promo = new Promo();
			$promo->delete($id[$i]);

			message("Produit supprimer!", "info");
			redirect('index.php');
		}
	}
}

function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	$myfile = $_FILES['photo']['name'];
	$location = "uploaded_photos/" . $myfile;


	if ($errofile > 0) {
		message("Aucune image selectionner!", "error");
		redirect("index.php?view=view&id=" . $_POST['proid']);
	} else {

		@$file = $_FILES['photo']['tmp_name'];
		@$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		@$image_name = addslashes($_FILES['photo']['name']);
		@$image_size = getimagesize($_FILES['photo']['tmp_name']);

		if ($image_size == FALSE) {
			message("Le fichier ne pas une image!", "error");
			redirect("index.php?view=view&id=" . $_POST['proid']);
		} else {
			//uploading the file
			move_uploaded_file($temp, "uploaded_photos/" . $myfile);



			$product = new Product();
			$product->IMAGES 			= $location;
			$product->update($_POST['proid']);

			redirect("index.php");
		}
	}
}


function setBanner()
{
	$promo = new Promo();
	$promo->PROBANNER  = 1;
	$promo->update($_POST['PROID']);
}

function setDiscount()
{
	if (isset($_POST['submit'])) {

		$promo = new Promo();
		$promo->PRODISCOUNT  = $_POST['PRODISCOUNT'];
		$promo->PRODISPRICE  = $_POST['PRODISPRICE'];
		$promo->PROBANNER  = 1;
		$promo->update($_POST['PROID']);

		msgBox("Discount has been set.");

		redirect("index.php");
	}
}
function removeDiscount()
{
	if (isset($_POST['submit'])) {

		$promo = new Promo();
		$promo->PRODISCOUNT  = $_POST['PRODISCOUNT'];
		$promo->PRODISPRICE  = $_POST['PRODISPRICE'];
		$promo->PROBANNER  = 1;
		$promo->update($_POST['PROID']);

		msgBox("Discount has been set.");

		redirect("index.php");
	}
}
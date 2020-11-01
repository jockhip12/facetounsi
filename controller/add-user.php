<?php
include '../manager/UserManager.php';
include '../model/user.php';

$db = new PDO('mysql:host=localhost;dbname=facetounsi', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.

$manager = new UserManager($db);



if(isset($_GET["email"])) {
	// récupérer les variable
	$fname   = $_GET['fname'];
	$lname   = $_GET['lname'];
	$email   = $_GET['email'];
	$pwd 	 = $_GET['password'];
	$country = $_GET['country'];
	$region  = $_GET['region'];
	$zipcode = $_GET['zipcode'];
	$address = $_GET['address'];
	$picture = $_GET['picture'];

	// traitement

	$user = new User(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'password' => $pwd, 'country' => $country, 'region' => $region, 'zipcode' => $zipcode, 'address' => $address, 'picture' => $picture ]);

	$manager->add($user);

	// redirection

	header('location: ../pages/signin.php');
}









?>
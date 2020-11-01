<?php
if ($_SERVER['REQUEST_URI'] !== '/register/') {
    header('Location: /register/');
}

include "../core/htpasswd.php";
include "../core/config.php";
include "../core/crypto.php";

if (empty($secret_key)) { // First run initialization
    $randompass = randomPassword();
    $myfile = fopen("./config.php", "w") or die("Unable to write your account !");
    $phpToConfig = "<?php\n\$secret_key=\"".$randompass."\";\n?>";
    fwrite($myfile, $phpToConfig);
    fclose($myfile);
}

$htpasswd = new Htpasswd('../.htpasswd');

if ($_POST["login"] && $_POST["password"] && $_POST["firstname"] && $_POST["lastname"] && $_POST["birthday"] && $_POST["birthplace"] && $_POST["address"] && $_POST["city"] && $_POST["zipcode"]) {
    header('Content-Type: application/json; charset=utf-8');
    if ($htpasswd->userExists($_POST["login"])) {
	echo '{"message": "L\'utilisateur demandé existe déjà", "type": "error"}';
    }else{
	$ts = time();
	$username = $_POST["login"];
	$password = $_POST["password"];
	$userData = new stdClass;
	$userData->firstname 	= $_POST["firstname"];
	$userData->lastname  	= $_POST["lastname"];
	$userData->birthday  	= date("d/m/Y", strtotime($_POST["birthday"]));
	$userData->birthplace  	= $_POST["birthplace"];
	$userData->address  	= $_POST["address"];
	$userData->city  	= $_POST["city"];
	$userData->zipcode  	= $_POST["zipcode"];
	$userData->preference  	= $_POST["preference"];
	$userData->ts  		= $ts;
	writeUserdata($username,$password,$userData);

	$retRead = readUserdata($username,$password);
	if ($retRead) {
	    $htpasswd->addUser($username, $password,Htpasswd::ENCTYPE_SHA1);
	    echo '{"message": "L\'utilisateur créé avec succès", "type": "success"}';
	}else{
	    echo '{"message": "Une érreur est survenue : '.readUserdata($username,$password).'", "type": "error"}';
	}
    }
    exit();
}

function randomPassword() {
    $alphabet = "!#$%()*+,-./:;<=>?@[\]^_`{|}~abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 256; $i++) {
	$n = rand(0, $alphaLength);
	$pass[] = $alphabet[$n];
    }
    return implode($pass);
}

function writeUserdata($username,$password,$data) {
    $myfile = fopen("../userdata/".$username.".dat", "w") or die("Unable to write your account !");
    $enc = encrypt_decrypt("encrypt",$username.'#'.$password,json_encode($data));
    fwrite($myfile, $enc);
    fclose($myfile);
    return 1;
}

function readUserdata($username,$password) {
    $myfile2 = fopen("../userdata/".$username.".dat", "r") or die("Unable to read your account !");
    $dec=fread($myfile2,filesize("../userdata/".$username.".dat"));
    fclose($myfile2);
    $retDecode = encrypt_decrypt("decrypt",$username.'#'.$password,$dec);
    return json_decode($retDecode,true);
}

header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    </head>
    <body>
	<div class="containeri-fluid rounded col-md-3 mx-auto text-center" style="border: 2px solid silver;margin-top:10px;">
	    <h5>Formulaire de création d'utilisateur</h5>
	    <form class="needs-validation" id="registration" action="/register/" method="post" novalidate>
		<div>
		    <label for="login">Login</label>
		    <input type="text" class="form-control" id="login" name="login" placeholder="johndoe59" required>
		    <div class="invalid-feedback">
			Merci d'indiquer votre login
		    </div>
		    <label for="password">Mot de passe</label>
		    <input type="password" class="form-control" id="password" name="password" placeholder="123456" required>
		    <div class="invalid-feedback">
			Merci d'indiquer votre mot de passe
		    </div>
		    <label for="firstname">Nom</label>
		    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Doe" required>
		    <div class="invalid-feedback">
			Merci de spécifier un nom valide
		    </div>
		    <label for="lastname">Prénom</label>
		    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="John" required>
		    <div class="invalid-feedback">
			Merci de spécifier un prénom valide
		    </div>
		    <label for="birthday">Date de naissance</label>
		    <input type="date" class="form-control" id="birthday" name="birthday" placeholder="01/01/1960" required>
		    <div class="invalid-feedback">
			Merci de spécifier une date de naissance valide
		    </div>
		    <label for="birthplace">Lieu de naissance</label>
		    <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Paris" required>
		    <div class="invalid-feedback">
			Merci de spécifier un lieu de naissance valide
		    </div>
		    <label for="address">Adresse</label>
		    <input type="text" class="form-control" id="address" name="address" placeholder="55 Rue du Faubourg Saint-Honoré" required>
		    <div class="invalid-feedback">
			Merci de spécifier une adresse valide
		    </div>
		    <label for="city">Ville</label>
		    <input type="text" class="form-control" id="city" name="city" placeholder="Paris" required>
		    <div class="invalid-feedback">
			Merci de spécifier une ville valide
		    </div>
		    <label for="zipcode">Code postal</label>
		    <input type="number" class="form-control" id="zipcode" name="zipcode" placeholder="75008" required>
		    <div class="invalid-feedback">
			Merci de spécifier un code postal valide
		    </div>
		    <label for="preference">Raison par defaut</label>
		    <select class="form-control" id="preference" name="preference">
			<option value="0" selected>Travail</option>
			<option value="1">Achat</option>
			<option value="2">Sante</option>
			<option value="3">Famille</option>
			<option value="4">Handicap</option>
			<option value="5">Sport/Animaux</option>
			<option value="6">Convocation</option>
			<option value="7">Mission</option>
			<option value="8">Enfants</option>
		    </select>
		</div>
		</br>
		<button class="btn btn-primary" type="submit">Valider</button>
	    </form>
	</br>
	<div class="alert alert-danger" role="alert">Les données stockées sont uniquement exploitables avec le couple nom d'utilisateur, mot de passe et clef aléatoire de ce serveur. En cas de perte, aucune donnée ne pourra être exploitée.</div>
	</div>
<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
	if (form.checkValidity() === false) {
	  event.preventDefault();
	  event.stopPropagation();
	}
	form.classList.add('was-validated');
      }, false);
    });
  }, false);
  $('#registration').on('submit', function(e){
    e.preventDefault();
    $.ajax({
    url: "/register/",
      type: "POST",
      data: $("#registration").serialize(),
      success: function(data){
	if (data.type === "error") {
	  alert(data.message);
	}else if (data.type === "success") {
	  alert(data.message);
	  window.location.href = "/";
	}
      }
    });
  });
})();
</script>
    </body>
</html>

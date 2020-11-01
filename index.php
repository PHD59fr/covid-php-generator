<?php
include "./core/htpasswd.php";
include "./core/config.php";
include "./core/crypto.php";

if (empty($secret_key)) { // First run initialization
    $randompass = randomPassword();
    $myfile = fopen("./config.php", "w") or die("Unable to write your account !");
    $phpToConfig = "<?php\n\$secret_key=\"".$randompass."\";\n?>";
    fwrite($myfile, $phpToConfig);
    fclose($myfile);
}

$username       = $_SERVER['PHP_AUTH_USER'];
$password       = $_SERVER['PHP_AUTH_PW'];
$htpasswd 	= new Htpasswd('.htpasswd');
$user 		= readUserdata($username,$password);

if (!$user) {
    echo '{"message": "Une érreur est survenue : '.readUserdata($username,$password).'", "type": "error"}';
    exit();
}

$firstname      = $user->firstname;
$lastname       = $user->lastname;
$birthday       = $user->birthday;
$birthplace     = $user->birthplace;
$address        = $user->address;
$city           = $user->city;
$zipcode        = $user->zipcode;
$preference	= $user->preference;

if (!$preference) {$preference = 0;}

function readUserdata($username,$password) {
    $myfile = fopen("./userdata/".$username.".dat", "r") or die("Unable to read your account !");
    $dec=fread($myfile,filesize("./userdata/".$username.".dat"));
    fclose($myfile);
    $retDecode = encrypt_decrypt("decrypt",$username.'#'.$password,$dec);
    return json_decode($retDecode);
}
?>
<!DOCTYPE html>
<html lang="fr" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="theme-color" content="#ffffff">
    <meta name="title" content="Générateur d'attestation de déplacement dérogatoire - COVID-19">
    <meta name="description" content="Ce service génère une version numérique de la déclaration de déplacement covid-19 à présenter aux forces de sécurité lors d’un contrôle.">
    <meta name="keywords" content="covid19, covid-19, attestation, déclaration, déplacement, officielle, gouvernement">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="French">
    <meta property="og:title" content="Générateur d'attestation de déplacement dérogatoire  - COVID-19">
    <meta property="og:locale" content="fr_FR">

    <title>Attestation de déplacement dérogatoire</title>

    <link rel="stylesheet" href="/ressources/main.css">
  </head>

  <body>
    <a href="/edit/" title="Editer"><img src="../ressources/parameters.svg" style="position: absolute;top: 0px;right: 0px; width: 32px; height:32px; filter: invert(16%) sepia(40%) saturate(6100%) hue-rotate(232deg) brightness(72%) contrast(129%);"/></a>
    <header role="banner" class="wrapper">
      <div>
	<h1 class="flex flex-wrap">
	  <span class="covid-title"> COVID-19 </span>
	  <span class="covid-subtitle"> Attestation de déplacement dérogatoire </span>
	</h1>
	<p class="text-desc"> En application du décret n°2020-1310 du 29 octobre 2020 prescrivant les mesures générales nécessaires pour faire face à l'épidémie de Covid19 dans le cadre de l'état d'urgence sanitaire </p>
      </div>
    </header>
    <main role="main">
	<p class="alert alert-danger d-none" role="alert" id="alert-facebook"></p>
	<div class="wrapper">
	  <form id="form-profile" accept-charset="UTF-8"><h2 class="titre-2">Remplissez en ligne votre déclaration numérique : </h2>
	    <p class="msg-info">Tous les champs sont obligatoires.</p>

	      <input autocomplete="given-name" autofocus="" class="form-control" id="field-firstname" name="firstname" placeholder="Camille" required="" type="text" value="<?echo $firstname;?>" hidden>
	      <input autocomplete="family-name" class="form-control" id="field-lastname" name="lastname" placeholder="Dupont" required="" type="text" value="<?echo $lastname;?>" hidden>
	      <input maxlength="10" pattern="^([0][1-9]|[1-2][0-9]|30|31)/([0][1-9]|10|11|12)/(19[0-9][0-9]|20[0-1][0-9]|2020)" autocomplete="birthday" class="form-control" id="field-birthday" name="birthday" placeholder="01/01/1970" required="" type="text" value="<?echo $birthday;?>" hidden>
	      <input autocomplete="off" class="form-control" id="field-placeofbirth" name="placeofbirth" placeholder="Paris" required="" type="text" value="<?echo $birthplace;?>" hidden>
	      <input autocomplete="adress-line1" class="form-control" id="field-address" name="address" placeholder="999 avenue de France" required="" type="text" value="<?echo $address;?>" hidden>
	      <input autocomplete="address-level2" class="form-control" id="field-city" name="city" placeholder="Paris" required="" type="text" value="<?echo $city;?>" hidden>
	      <input inputmode="numeric" minlength="4" maxlength="5" min="1000" max="99999" pattern="[0-9]{5}" autocomplete="postal-code" class="form-control" id="field-zipcode" name="zipcode" placeholder="75001" required="" type="number" value="<?echo $zipcode;?>" hidden>
	    <div class="form-group">
	      <label for="field-datesortie" id="field-datesortie-label">Date et heure de sortie</label>

	      <div class="input-group align-items-center">
		<input pattern="^([0][1-9]|[1-2][0-9]|30|31)/([0][1-9]|10|11|12)/(19[0-9][0-9]|20[0-1][0-9]|2020)" autocomplete="" class="form-control" id="field-datesortie" name="datesortie" placeholder="" required="" type="date">
		<input autocomplete="" class="form-control" id="field-heuresortie" name="heuresortie" placeholder="" required="" type="time" value="now">
	      </div>
	    </div>
	  <p class="text-center mt-5"> <button type="button" id="generate-btn" class="btn btn-primary btn-attestation">Générer mon attestation
	    <span><svg class="svg-inline--fa fa-file-pdf fa-w-12 inline-block mr-1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="file-pdf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"></path></svg></span>
	  </button></p>

	    <fieldset id="reason-fieldset" class="fieldset">
	      <legend class="legend titre 3">Choisissez un motif de déplacement</legend>

	      <p class="msg-alert hidden">Veuillez choisir un motif</p>

	      <p>certifie que mon déplacement est lié au motif suivant (cocher la case) autorisé par le décret n°2020-1310 du 29 octobre 2020 prescrivant les
	      mesures générales nécessaires pour faire face à l'épidémie de Covid19 dans le cadre de l'état
	      d'urgence sanitaire:</p>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-travail" name="field-reason" value="travail">
		<label for="checkbox-travail" class="form-checkbox-label">Déplacements entre le domicile et le lieu d’exercice de l’activité professionnelle ou un établissement d’enseignement ou de formation, déplacements professionnels ne pouvant être différés, déplacements pour un concours ou un examen.</label>
	      </div>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-achats" name="field-reason" value="achats">
		<label for="checkbox-achats" class="form-checkbox-label">Déplacements pour effectuer des achats de fournitures nécessaires à l'activité professionnelle, des achats de première nécessité dans des établissements dont les activités demeurent autorisées, le retrait de commande et les livraisons à domicile ;</label>
	      </div>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-sante" name="field-reason" value="sante">
		<label for="checkbox-sante" class="form-checkbox-label">Consultations, examens et soins ne pouvant être assurés à distance et l’achat de médicaments ;</label>
	      </div>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-famille" name="field-reason" value="famille">
		<label for="checkbox-famille" class="form-checkbox-label"> Déplacements pour motif familial impérieux, pour l'assistance aux personnes vulnérables et précaires ou la garde d'enfants ;</label>
	      </div>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-handicap" name="field-reason" value="handicap">
		<label for="checkbox-handicap" class="form-checkbox-label">Déplacement des personnes en situation de handicap et leur accompagnant ;</label>
	      </div>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-sport_animaux" name="field-reason" value="sport_animaux">
		<label for="checkbox-sport_animaux" class="form-checkbox-label">Déplacements brefs, dans la limite d'une heure quotidienne et dans un rayon maximal d'un kilomètre autour du domicile, liés soit à l'activité physique individuelle des personnes, à l'exclusion de toute pratique sportive collective et de toute proximité avec d'autres personnes, soit à la promenade avec les seules personnes regroupées dans un même domicile, soit aux besoins des animaux de compagnie ;</label>
	      </div>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-convocation" name="field-reason" value="convocation">
		<label for="checkbox-convocation" class="form-checkbox-label"> Convocation judiciaire ou administrative et pour se rendre dans un service public ;</label>
	      </div>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-missions" name="field-reason" value="missions">
		<label for="checkbox-missions" class="form-checkbox-label"> Participation à des missions d'intérêt général sur demande de l'autorité administrative ;</label>
	      </div>

	      <div class="form-checkbox align-items-center">
		<input class="form-check-input" type="checkbox" id="checkbox-enfants" name="field-reason" value="enfants">
		<label for="checkbox-enfants" class="form-checkbox-label">Déplacement pour chercher les enfants à l’école et à l’occasion de leurs activités périscolaires ;</label>
	      </div>
	    </fieldset>
	  </form>


	    <div class="bg-primary d-none" id="snackbar"> L'attestation est téléchargée sur votre appareil.</div>
	</div>

	<p class="github"> Le code source de ce service est consultable sur <a href="https://github.com/PHD59fr/covid-php-generator" class="github-link">GitHub</a>. </p>
	<script src="/ressources/main.js"></script>
<script>
var d = new Date(),
  h = d.getHours(),
  m = d.getMinutes();
if(h < 10) h = '0' + h;
if(m < 10) m = '0' + m;
document.getElementById("field-heuresortie").value = h + ':' + m;

const expr = <? echo $preference; ?>;
switch (expr) {
case 1:
  document.getElementById("checkbox-achats").checked = true;
  break;
case 2:
  document.getElementById("checkbox-sante").checked = true;
  break;
case 3:
  document.getElementById("checkbox-famille").checked = true;
  break;
case 4:
  document.getElementById("checkbox-handicap").checked = true;
  break;
case 5:
  document.getElementById("checkbox-sport_animaux").checked = true;
  break;
case 6:
  document.getElementById("checkbox-convocation").checked = true;
  break;
case 7:
  document.getElementById("checkbox-missions").checked = true;
  break;
case 8:
  document.getElementById("checkbox-enfants").checked = true;
  break;
default:
  document.getElementById("checkbox-travail").checked = true;
}
</script>
  </body>
</html>

<?php
header( 'content-type: text/html; charset=utf-8' );

$username 	= $_SERVER['REMOTE_USER'];
$usersJson      = 'users.json';
$usersFile      = file_get_contents($usersJson);
$users 		= json_decode($usersFile,true);

$firstname 	= "";
$lastname 	= "";
$birthday	= "";
$birthplace	= "";
$address	= "";
$city		= "";
$zipcode	= "";

foreach ($users as $user) {
    if ($username === $user['id']){
        $firstname 	= $user['firstname'];
        $lastname 	= $user['lastname'];
        $birthday	= $user['birthday'];
        $birthplace	= $user['birthplace'];
        $address	= $user['address'];
        $city		= $user['city'];
        $zipcode	= $user['zipcode'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="title" content="Générateur d'attestation de déplacement dérogatoire - COVID-19">
    <meta name="language" content="French">
    <meta property="og:title" content="Générateur d'attestation de déplacement dérogatoire - COVID-19">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:description" content="Génère une version numérique de l’attestation déplacement covid-19 à présenter aux forces de sécurité lors d’un contrôle.">
    <title>COVID-19 – Générateur d'attestation de déplacement dérogatoire</title>
    <link rel="stylesheet" href="./ressources/certificate.css">
</head>

<body>
    <header class="wrapper">
        <div>
            <h1 class="flex flex-wrap"> <span class="covid-title"> COVID-19 </span> <span class="covid-subtitle"> Générateur d'attestation de&nbsp;déplacement&nbsp;dérogatoire </span> </h1>
        </div>
    </header>
    <div class="wrapper">
        <form id="form-profile">
            <h2 class="titre-2">Remplissez en ligne votre attestation numérique :</h2>
            <div class="form-group"> <label for="field-datesortie">Date/Heure de sortie</label>
                <div class="input-group align-items-center"> <input type="date" class="form-control" id="field-datesortie" name="datesortie" placeholder="JJ/MM/YYYY" required="" value="1970-01-01"></span><input type="time" class="form-control" id="field-heuresortie" name="heure" required="" value="00:00"></span> </div>
            </div>
            <p class="text-center mt-5"> <button type="submit" class="btn btn-primary btn-attestation"> <span class="btn-text">Générer mon attestation</span></button> </p>
            <div class="form-group" hidden="true"> <label for="field-firstname" id="field-firstname-label">Prénom</label>
                <div class="input-group align-items-center"> <input type="text" class="form-control" id="field-firstname" name="firstname" autocomplete="given-name" aria-labelledby="field-firstname-label" required="" autofocus="" value="<?php echo $firstname?>"> <span class="validity"></span> </div>
                <p class="exemple"></p>
            </div>
            <div class="form-group" hidden="true"> <label for="field-lastname" id="field-lastname-label">Nom</label>
                <div class="input-group align-items-center"> <input type="text" class="form-control" id="field-lastname" name="lastname" autocomplete="family-name" aria-labelledby="field-lastname-label" required="" autofocus="" value="<?php echo $lastname?>"> <span class="validity"></span> </div>
                <p class="exemple"></p>
            </div>
            <div class="form-group" hidden="true"> <label for="field-birthday" id="field-birthday-label">Date de naissance (au format jj/mm/aaaa)</label>
                <div class="input-group align-items-center"> <input type="text" inputmode="numeric" class="form-control" id="field-birthday" name="birthday" aria-labelledby="field-birthday-label" required="" value="<?php echo $birthday?>"> <span class="validity"></span> </div>
                <p class="exemple"></p>
            </div>
            <div class="form-group" hidden="true"> <label for="field-lieunaissance" id="field-lieunaissance-label">Lieu de naissance</label>
                <div class="input-group align-items-center"> <input type="text" class="form-control" id="field-lieunaissance" name="lieunaissance" aria-labelledby="field-lieunaissance-label" required="" value="<?php echo $birthplace?>"> <span class="validity"></span> </div>
                <p class="exemple"></p>
            </div>
            <div class="form-group" hidden="true"> <label for="field-address" id="field-address-label">Adresse</label>
                <div class="input-group align-items-center"> <input type="text" class="form-control" id="field-address" name="address" aria-labelledby="field-address-label" required="" value="<?php echo $address?>"> <span class="validity"></span> </div>
                <p class="exemple"></p>
            </div>
            <div class="form-group" hidden="true"> <label for="field-town" id="field-town-label">Ville</label>
                <div class="input-group align-items-center"> <input type="text" class="form-control" id="field-town" name="town" aria-labelledby="field-town-label" required="" value="<?php echo $city?>"> <span class="validity"></span> </div>
                <p class="exemple"></p>
            </div>
            <div class="form-group" hidden="true"> <label for="field-zipcode" id="field-zipcode-label">Code Postal</label>
                <div class="input-group align-items-center"> <input type="number" class="form-control" id="field-zipcode" name="zipcode" aria-labelledby="field-zipcode-label" required="" value="<?php echo $zipcode?>"> <span class="validity"></span> </div>
                <p class="exemple"></p>
            </div>
            <h3>Choisissez un motif de sortie</h3>
            <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-travail" value="travail"> <label class="form-check-label" for="checkbox-travail">Déplacements vers boulot</label> </div>
            <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-courses" value="courses"> <label class="form-check-label" for="checkbox-courses">Déplacements achats de première nécessité</label> </div>
            <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-sante" value="sante"> <label class="form-check-label" for="checkbox-sante">Consultations Médecin</label> </div>
            <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-famille" value="famille"> <label class="form-check-label" for="checkbox-famille">Déplacements pour famille</label> </div>
            <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-sport" value="sport" checked> <label class="form-check-label" for="checkbox-sport">Déplacements Brefs/ Promenade</label> </div>
            <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-judiciaire" value="judiciaire"> <label class="form-check-label" for="checkbox-judiciaire">Convocation judiciaire ou administrative.</label> </div>
            <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-missions" value="missions"> <label class="form-check-label" for="checkbox-missions">Missions d’intérêt général</label> </div>
            <div class="bg-primary d-none" id="snackbar"> L'attestation est téléchargée sur votre appareil. </div>
        </form>
    </div>
    <script src="./ressources/certificate.js"></script>
</body>

</html>

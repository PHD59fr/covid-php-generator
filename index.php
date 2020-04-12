<?php


$username       = $_SERVER['REMOTE_USER'];
$url            = 'users.json';
$data           = file_get_contents($url);
$users          = json_decode($data,true);


$firstname      = "";
$lastname       = "";
$birthday       = "";
$birthplace     = "";
$address        = "";
$city           = "";
$zipcode        = "";


foreach ($users as $user) {
    if ($username === $user['id']){
        $firstname      = $user['firstname'];
        $lastname       = $user['lastname'];
        $birthday       = $user['birthday'];
        $birthplace     = $user['birthplace'];
        $address        = $user['address'];
        $city           = $user['city'];
        $zipcode        = $user['zipcode'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
      <meta name="theme-color" content="#ffffff">
      <meta name="title" content="Générateur d'attestation de déplacement dérogatoire - COVID-19">
      <meta name="description" content="Ce service génère une version numérique de l’attestation déplacement covid-19 à présenter aux forces de sécurité lors d’un contrôle.">
      <meta name="keywords" content="covid19, covid-19, attestation, déplacement, officielle, gouvernement">
      <meta name="robots" content="index, nofollow">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="language" content="French">
      <meta property="og:title" content="Générateur d'attestation de déplacement dérogatoire - COVID-19">
      <meta property="og:locale" content="fr_FR">
      <meta property="og:description" content="Ce service génère une version numérique de l’attestation déplacement covid-19 à présenter aux forces de sécurité lors d’un contrôle.">
      <style type="text/css">svg:not(:root).svg-inline--fa{overflow:visible}.svg-inline--fa{display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em}.svg-inline--fa.fa-lg{vertical-align:-.225em}.svg-inline--fa.fa-w-1{width:.0625em}.svg-inline--fa.fa-w-2{width:.125em}.svg-inline--fa.fa-w-3{width:.1875em}.svg-inline--fa.fa-w-4{width:.25em}.svg-inline--fa.fa-w-5{width:.3125em}.svg-inline--fa.fa-w-6{width:.375em}.svg-inline--fa.fa-w-7{width:.4375em}.svg-inline--fa.fa-w-8{width:.5em}.svg-inline--fa.fa-w-9{width:.5625em}.svg-inline--fa.fa-w-10{width:.625em}.svg-inline--fa.fa-w-11{width:.6875em}.svg-inline--fa.fa-w-12{width:.75em}.svg-inline--fa.fa-w-13{width:.8125em}.svg-inline--fa.fa-w-14{width:.875em}.svg-inline--fa.fa-w-15{width:.9375em}.svg-inline--fa.fa-w-16{width:1em}.svg-inline--fa.fa-w-17{width:1.0625em}.svg-inline--fa.fa-w-18{width:1.125em}.svg-inline--fa.fa-w-19{width:1.1875em}.svg-inline--fa.fa-w-20{width:1.25em}.svg-inline--fa.fa-pull-left{margin-right:.3em;width:auto}.svg-inline--fa.fa-pull-right{margin-left:.3em;width:auto}.svg-inline--fa.fa-border{height:1.5em}.svg-inline--fa.fa-li{width:2em}.svg-inline--fa.fa-fw{width:1.25em}.fa-layers svg.svg-inline--fa{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.fa-layers{display:inline-block;height:1em;position:relative;text-align:center;vertical-align:-.125em;width:1em}.fa-layers svg.svg-inline--fa{-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter,.fa-layers-text{display:inline-block;position:absolute;text-align:center}.fa-layers-text{left:50%;top:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter{background-color:#ff253a;border-radius:1em;-webkit-box-sizing:border-box;box-sizing:border-box;color:#fff;height:1.5em;line-height:1;max-width:5em;min-width:1.5em;overflow:hidden;padding:.25em;right:0;text-overflow:ellipsis;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-bottom-right{bottom:0;right:0;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom right;transform-origin:bottom right}.fa-layers-bottom-left{bottom:0;left:0;right:auto;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom left;transform-origin:bottom left}.fa-layers-top-right{right:0;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-top-left{left:0;right:auto;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top left;transform-origin:top left}.fa-lg{font-size:1.3333333333em;line-height:.75em;vertical-align:-.0667em}.fa-xs{font-size:.75em}.fa-sm{font-size:.875em}.fa-1x{font-size:1em}.fa-2x{font-size:2em}.fa-3x{font-size:3em}.fa-4x{font-size:4em}.fa-5x{font-size:5em}.fa-6x{font-size:6em}.fa-7x{font-size:7em}.fa-8x{font-size:8em}.fa-9x{font-size:9em}.fa-10x{font-size:10em}.fa-fw{text-align:center;width:1.25em}.fa-ul{list-style-type:none;margin-left:2.5em;padding-left:0}.fa-ul>li{position:relative}.fa-li{left:-2em;position:absolute;text-align:center;width:2em;line-height:inherit}.fa-border{border:solid .08em #eee;border-radius:.1em;padding:.2em .25em .15em}.fa-pull-left{float:left}.fa-pull-right{float:right}.fa.fa-pull-left,.fab.fa-pull-left,.fal.fa-pull-left,.far.fa-pull-left,.fas.fa-pull-left{margin-right:.3em}.fa.fa-pull-right,.fab.fa-pull-right,.fal.fa-pull-right,.far.fa-pull-right,.fas.fa-pull-right{margin-left:.3em}.fa-spin{-webkit-animation:fa-spin 2s infinite linear;animation:fa-spin 2s infinite linear}.fa-pulse{-webkit-animation:fa-spin 1s infinite steps(8);animation:fa-spin 1s infinite steps(8)}@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.fa-rotate-90{-webkit-transform:rotate(90deg);transform:rotate(90deg)}.fa-rotate-180{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.fa-rotate-270{-webkit-transform:rotate(270deg);transform:rotate(270deg)}.fa-flip-horizontal{-webkit-transform:scale(-1,1);transform:scale(-1,1)}.fa-flip-vertical{-webkit-transform:scale(1,-1);transform:scale(1,-1)}.fa-flip-both,.fa-flip-horizontal.fa-flip-vertical{-webkit-transform:scale(-1,-1);transform:scale(-1,-1)}:root .fa-flip-both,:root .fa-flip-horizontal,:root .fa-flip-vertical,:root .fa-rotate-180,:root .fa-rotate-270,:root .fa-rotate-90{-webkit-filter:none;filter:none}.fa-stack{display:inline-block;height:2em;position:relative;width:2.5em}.fa-stack-1x,.fa-stack-2x{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.svg-inline--fa.fa-stack-1x{height:1em;width:1.25em}.svg-inline--fa.fa-stack-2x{height:2em;width:2.5em}.fa-inverse{color:#fff}.sr-only{border:0;clip:rect(0,0,0,0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.sr-only-focusable:active,.sr-only-focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}.svg-inline--fa .fa-primary{fill:var(--fa-primary-color,currentColor);opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa .fa-secondary{fill:var(--fa-secondary-color,currentColor);opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-primary{opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-secondary{opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa mask .fa-primary,.svg-inline--fa mask .fa-secondary{fill:#000}.fad.fa-inverse{color:#fff}</style>
      <meta property="og:site_name" content="Générateur d'attestation de déplacement dérogatoire - COVID-19">
      <title>COVID-19 – Générateur d'attestation de déplacement dérogatoire</title>
      <link rel="stylesheet" href="./ressources/certificate.css">
   </head>
   <body>
      <header role="banner" class="wrapper">
         <div>
            <h1 class="flex flex-wrap"> <span class="covid-title"> COVID-19 </span> <span class="covid-subtitle"> Générateur d'attestation de&nbsp;déplacement&nbsp;dérogatoire </span> </h1>
         </div>
      </header>
      <main role="main">
         <p class="alert alert-danger d-none" role="alert" id="alert-facebook"></p>
         <div class="wrapper">
            <form id="form-profile" accept-charset="UTF-8">
               <h2 class="titre-2">Remplissez en ligne votre attestation numérique :</h2>
               <div class="form-group">
                  <label for="field-datesortie">Date/Heure de sortie</label> 
                  <div class="input-group align-items-center"> <input type="date" class="form-control" id="field-datesortie" name="datesortie" autocomplete="off" placeholder="JJ/MM/YYYY" aria-invalid="true" required=""><input type="time" class="form-control" id="field-heuresortie" name="heure" autocomplete="off" aria-invalid="true" required=""></div>
               </div>
               <p class="text-center mt-5">
                  <button type="button" id="generate-btn" class="btn btn-primary btn-attestation">
                     <span>
                        <svg class="svg-inline--fa fa-file-pdf fa-w-12 inline-block mr-1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="file-pdf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                           <path fill="currentColor" d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"></path>
                        </svg>
                        <!-- <i class="fa fa-file-pdf inline-block mr-1"></i> --> Générer mon attestation
                     </span>
                  </button>
               </p>
               <div class="form-group">
                  <input type="text" class="form-control" id="field-firstname" name="firstname" value="<?echo $firstname?>" hidden="true">
                  <input type="text" class="form-control" id="field-lastname" name="lastname" value="<?echo $lastname?>" hidden="true">
		  <input type="text" class="form-control" id="field-birthday" name="birthday" value="<?echo $birthday?>" hidden="true">
                  <input type="text" class="form-control" id="field-lieunaissance" name="lieunaissance" value="<?echo $birthplace?>" hidden="true">
                  <input type="text" class="form-control" id="field-address" name="address" value="<?echo $address?>" hidden="true">
                  <input type="text" class="form-control" id="field-town" name="town" value="<?echo $city?>" hidden="true">
                  <input type="text" class="form-control" id="field-zipcode" name="zipcode" value="<?echo $zipcode?>" hidden="true">
		</div>
               <fieldset>
                  <legend class="title-3">Choisissez le ou les motif(s) de sortie</legend>
		  <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-travail" value="travail"> <label class="form-check-label" for="checkbox-travail">Déplacements vers boulot</label> </div>
		  <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-courses" value="courses"> <label class="form-check-label" for="checkbox-courses">Déplacements achats de première nécessité</label> </div>
		  <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-sante" value="sante"> <label class="form-check-label" for="checkbox-sante">Consultations Médecin</label> </div>
		  <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-famille" value="famille"> <label class="form-check-label" for="checkbox-famille">Déplacements pour famille</label> </div>
		  <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-sport" value="sport" checked> <label class="form-check-label" for="checkbox-sport">Déplacements Brefs/ Promenade</label> </div>
		  <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-judiciaire" value="judiciaire"> <label class="form-check-label" for="checkbox-judiciaire">Convocation judiciaire ou administrative.</label> </div>
		  <div class="form-check"> <input class="form-check-input" type="checkbox" name="field-reason" id="checkbox-missions" value="missions"> <label class="form-check-label" for="checkbox-missions">Missions d’intérêt général</label> </div>
               </fieldset>
               <div class="bg-primary d-none" id="snackbar"> L'attestation est téléchargée sur votre appareil. </div>
            </form>
         </div>
      </main>
      <script src="./ressources/certificate.js"></script>
   </body>
</html>

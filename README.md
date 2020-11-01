# Générateur de certificat de déplacement COVID-19 multi user (htaccess/Json)

**Ce générateur est quasi identique à celui disponible sur le site du gouvernement à l'exception qu'il est simplifié et multi-utilisateur**

Ce qu'il vous faut :
* un serveur apache (sur serveur ou mutualisé)

##### /!\ Ne pas oublier de changer le répertoire absolu de votre fichier .htpasswd dans votre fichier .htaccess (AuthUserFile /var/www/.htpasswd) /!\

Les données sont chiffrées avec la clef dans le fichier core/config.php (généré automatiquement à l'installation)

Les inscriptions des utilisateurs se font via l'url https://WEBSITE/register/

# Générateur de certificat de déplacement COVID-19 multi user (htaccess/Json)

**Ce générateur est quasi identique à celui disponible sur le site du gouvernement à l'exception qu'il est simplifié et multi-utilisateur**

Ce qu'il vous faut :
* un serveur apache (sur serveur ou mutualisé)

##### /!\ Ne pas oublier de changer le répertoire absolu de votre fichier .htpasswd dans votre fichier .htaccess (AuthUserFile /home/www/.htpasswd) /!\

### User et Pass par défaut (éditable dans l'.htpasswd):
    user: X
    pass: 123456

    user: Y
    pass: 123456


### users.json (id = user dans le htpasswd):
```json
[
    {
        "id":"X",
        "firstname":"X",
        "lastname":"X",
        "birthday":"01/02/1983",
        "birthplace":"Lille",
        "address":"2 Avenue Oscar Lambret",
        "city":"Lille",
        "zipcode":"59000"
    },{
        "id":"Y",
        "firstname":"Y",
        "lastname":"Y",
        "birthday":"02/03/1984",
        "birthplace":"Paris",
        "address":"47-83 Boulevard de l'Hôpital",
        "city":"Paris",
        "zipcode":"75013"
    }
]
```

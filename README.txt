********** CZECH **********

Název projektu:
mvc_jirouseq

Typ projektu:
PHP MVC framework + jednoduchý CMS

CMS:
Přihlášení a registrace uživatelů, administrace uživatelů, vytváření stránek a jejich administrace

Důvod vytvoření:
Učení a procvičování níže vypsaných technologií

Použité technologie:
PHP, MYSQL, HTML, CSS, Javascript, jQUERY, Bootstrap

# MVC:

## adresářová struktura

application
    - admin
        - controller
        - css
        - js
        - model
        - view
    - home
        - controller
        - css
        - js
        - model
        - view
    - interfaces
    - modules
errors
framework
    - configuration
    - database
    - languages
    - library
public
    - css
    - environment
    - images
    - js
vendor
.htaccess
index.php

Instalace a nastavení MVC A CMS:

1. Nakopírujte složky a soubory na internetový server
2. Naimportujte soubor db.sql do vaší MYSQL databáze
3. Upravte soubor framework/configuration/Config.json
    (v případě, že soubory nebyly kopírovány do hlavního kořenového adresáře, je třeba doplnit "url":{"subdirectory": "NAZEV_SLOZKY/"},
    a v souboru public/js/Main.js doplnit url_directory = "/NAZEV_SLOZKY/")
4. Upravte soubor vendor/kcfinder/conf/config.php
    'uploadURL' => "/public/images/image/",
    'uploadDir' => "/var/www/html/vase-domena.com/public/images/image/",
5. Pro složku /public/images/ je třeba upravit oprávnění k zápisu
6. Přihlášení:
    username: admin@admin.ad
    password: 12345678
7. V profilu uživatele změnit email a heslo!!
8. Vymazat soubor db.sql z kořenového adresáře

## Práce s MVC:

Namespaces:

admin controlles: admin\controller
admin models:     admin\model

home controlles: home\controller
home models:     home\model

### Vytvoření kontroleru:

    NewController.php

    <?php

        namespace admin\controller;

        use library\ParentController;

        class NewController extends ParentController{}

### registrace kontroleru a jeho metod v framework/configuration/Routes.json

        "controller": {
            "new": {
                "cs": {
                    "url": "novy",
                    "title": "Nový",
                    "metadescription": "popis",
                    "metakeywords": "klíčová slova"
                },
                "en": {
                    "url": "new",
                    "title": "New",
                    "metadescription": "description",
                    "metakeywords": "keywords"
                },
                "permissions": "permissions"
            }
        }

        "method": {
            "new-method": {
                "cs": {
                    "url": "nova-metoda"
                },
                 "en": {
                    "url": "new-method"
                }
            }
        }

### Vytvoření modelu (nepovinné):

    NewModel.php

    <?php

        namespace admin\model;

        use database\Connection;

        class NewModel{}

### Vytvoření javascript souboru (nepovinné):

    new.js

### Vytvoření css souboru (nepovinné):

    new.css

### kontakt
jirouseq@gmail.com



********** ENGLISH **********

Project name:
mvc_jirouseq

Project type:
PHP MVC framework + simple CMS

CMS:
User login and registration, user administration, page creation and administration

Reason for creation:
Learning and practicing the technologies listed below

Used technologies:
PHP, MYSQL, HTML, CSS, Javascript, jQUERY, Bootstrap

# MVC:

## directory structure

application
    - admin
        - controller
        - css
        - js
        - model
        - view
    - home
        - controller
        - css
        - js
        - model
        - view
    - interfaces
    - modules
errors
framework
    - configuration
    - database
    - languages
    - library
public
    - css
    - environment
    - images
    - js
vendor
.htaccess
index.php

Installation and Configuration of MVC and CMS:

1. Copy the folders and files to the Internet server
2. Import the db.sql file into your MYSQL database
3. Edit the file framework/configuration/Config.json
    (in case the files were not copied to the main root directory, it is necessary to add "url":{"subdirectory": "NAME_FOLDER/"},
    and in the file public/js/Main.js, add url_directory = "/NAME_FOLDER/")
4. Edit the file vendor/kcfinder/conf/config.php
    'uploadURL' => "/public/images/image/",
    'uploadDir' => "/var/www/html/vase-domena.com/public/images/image/",
5. For folder /public/images/ it is necessary to modify the write permissions
6. Login:
    username: admin@admin.ad
    password: 12345678
7. Change email and password in the user profile!!
8. Delete the db.sql file from the root directory

## Work with MVC:

Namespaces:

admin controlles: admin\controller
admin models:     admin\model

home controlles: home\controller
home models:     home\model

### Controller creation:

    NewController.php

    <?php

        namespace admin\controller;

        use library\ParentController;

        class NewController extends ParentController{}

### registration of the controller and its methods in framework/configuration/Routes.json

        "controller": {
            "new": {
                "cs": {
                    "url": "novy",
                    "title": "Nový",
                    "metadescription": "popis",
                    "metakeywords": "klíčová slova"
                },
                "en": {
                    "url": "new",
                    "title": "New",
                    "metadescription": "description",
                    "metakeywords": "keywords"
                },
                "permissions": "permissions"
            }
        }

        "method": {
            "new-method": {
                "cs": {
                    "url": "nova-metoda"
                },
                 "en": {
                    "url": "new-method"
                }
            }
        }

### Model creation (optional):

    NewModel.php

    <?php

        namespace admin\model;

        use database\Connection;

        class NewModel{}

### Creation of a javascript file (optional):

    new.js

### Creation of a css file (optional):

    new.css

### contact
jirouseq@gmail.com








<?php
$sql_requests = array();
$langs = Language::getLanguages(false);

// Indiquez A L'intérieur des parenthèses les champs à créer au moment de l'installation

$sql_requests[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'modulesante`(
                    id_modulesante INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    date_naissance datetime,
                    poids float(10),
                    sexe varchar(255),
                    allergie int(1),
                    enceinte int(1),
                    allaite int(1),
                    medicament_actuel text,
                    commentaires text,
                    customer_id INT(10) UNSIGNED,
                    customer_name varchar(255),
                    customer_email varchar(255)
                )
                ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';

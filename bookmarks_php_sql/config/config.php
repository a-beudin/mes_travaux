<?php

/**
 *
 *  URL de base de l'application
 *
 *  @note : attention au / final
 */

define('SERVEUR_URL', 'https://dev-20902167.users.info.unicaen.fr/TPs/tp3/');

define('BASE_URL', SERVEUR_URL . '');
define('BASE_FILE', '/users/20902167/www-dev/TPs/tp3/');

define('LIB_FILE', BASE_FILE . 'modeles/');

define('PUBLIC_URL', BASE_URL . "public/");
define('ADMIN_URL', BASE_URL . "admin/");


/**
 *
 *  Base de données
 *
 */

define('DB_CONFIG', "config/config_db.php");


/**
 *
 *  Appel des autres fichiers de configuration
 *  et de l'Autoload
 *
 */


require_once(BASE_FILE . 'config/Autoload.php');
require_once(BASE_FILE . DB_CONFIG);







?>

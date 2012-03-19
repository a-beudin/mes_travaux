<?php

/**
 *
 *  URL de base de l'application
 *
 *  @note : attention au / final
 */

define('SERVEUR_URL', 'https://20902167.users.info.unicaen.fr/');

define('BASE_URL', SERVEUR_URL . 'bookmarks_php_sql/');
define('BASE_FILE', '/users/20902167/www-prod/bookmarks_php_sql/');

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

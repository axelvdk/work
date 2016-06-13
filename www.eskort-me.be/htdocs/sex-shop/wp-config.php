<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Le script de création wp-config.php utilise ce fichier lors de l'installation.
 * Vous n'avez pas à utiliser l'interface web, vous pouvez directement
 * renommer ce fichier en "wp-config.php" et remplir les variables à la main.
 * 
 * Ce fichier contient les configurations suivantes :
 * 
 * * réglages MySQL ;
 * * clefs secrètes ;
 * * préfixe de tables de la base de données ;
 * * ABSPATH.
 * 
 * @link https://codex.wordpress.org/Editing_wp-config.php 
 * 
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'eskort_sex_shop');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'eskort');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'eskort-me');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0qK#Te~+WR~MotmYi8|~rt1SZvV9MAWc1-Yqrz-I.IRDf|4MGdi*_hTTM@:qQ0WU');
define('SECURE_AUTH_KEY',  'dcWKr|W44_=*r9oZ!{A`PHy6kG:1gimz(+/0#&;UkKu%2mqzigER&0MKxmT(FCC}');
define('LOGGED_IN_KEY',    '%`@F/;+:EV:qQ~C?Ok/.1|elc|dMInMZG=Mv=M/-wpH^Pj 4MDNL{209$j^qc$.!');
define('NONCE_KEY',        'IslG0)K1%<7vxI6!3sj%-I,xg,576~VM]4e~Y5-drxnR-DZ|f.RIzl|jP}W4o56+');
define('AUTH_SALT',        '^f=.q<.sC1A#+us81(R7uA5}i$&W)*N~+:!]B=ao5Ak#O!f|GI Jzr($qdM2+&di');
define('SECURE_AUTH_SALT', 'zvV^9],868.;JyTc5e*nJ>$uX,h<74zG|^F3ZF(;`R`o.>+G-~)@Vf+JM5V7[2Gn');
define('LOGGED_IN_SALT',   'Zv] %4lMn!R0x^p>]JPlS5+dt6#2syEqp~%+r|2B&!r8ExZB&]vcFx$wZ]Vtu-c+');
define('NONCE_SALT',       'S5~~Mkj1glU ;p$=wHg|[EX|iz|K]Pn.jYTm|aJQyH-//.w@N*ooD Nq~%tt|vq7');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode déboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 * 
 * Pour obtenir plus d'information sur les constantes 
 * qui peuvent être utilisée pour le déboguage, consultez le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
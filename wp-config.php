<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'db_database');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '123456');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Ir%~QU @a=s]Ou7R?|,R8~Mn3tnlI_C%7;s 0 )}yrHqm>#&gvjRlHO|KD%ov(?h');
define('SECURE_AUTH_KEY',  'OG^adT#frMK.p`UJLbq-[#_LxA@!##EU:MLE|L/X}UjeDD-TKeUg<4ax>p&dF|Oz');
define('LOGGED_IN_KEY',    'hCsh4;3uopH?y=!oumR?/U]x-TG&Jeh#%kz^:~]y-e=eLHW*Oxb3s;W& [ rg5:o');
define('NONCE_KEY',        'TY(|NTc4mH[r7=VuIPKrr-iJtUpkF~k+@.o~knJe8n4g!7y/M__fxY|gEjV@yL*C');
define('AUTH_SALT',        'jnA]->,(Fn?Y+tA9.blva[8-e@11i])Df:i:)f]6fa{pjgS]xdq_9T]TkR@-qD4f');
define('SECURE_AUTH_SALT', '^.0j&y:3uqnP$ss6i@%Lt{g`-uC1A7=U]]but<4=.kg%oI0{|Wz12g95d+)fYe`I');
define('LOGGED_IN_SALT',   'pBH3N[*BL=$jK~(6_{8cJST%Ib~X YKm|t^+S2R6yF0?sN+f7&g0dJqzG+|DUw<+');
define('NONCE_SALT',       '`-yD9in^B=^hG!XH`u|OYFqI>deRfoCRTW}fz(Pl59F5`&AN<no&*(Y[~ P~6ZOZ');
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
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
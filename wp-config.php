<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hideout');

/** MySQL database username */
define('DB_USER', 'hideout');

/** MySQL database password */
define('DB_PASSWORD', 'jVQ3urpdseeqFcLj');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'UNAo*6zi/r}1zlCu?Q,-NP6iMYwe$Tf!+OrE`(zz|)D>E{l rBPECG>V@l]~elPR');
define('SECURE_AUTH_KEY',  ':l``4N C<XX!V10X{38H/g7.B0x@:(Q>rlxf.UCg~U2|M;HRcr+COQH+S? -LI]8');
define('LOGGED_IN_KEY',    'X45?wChz~+NLcOQFv?4,*g`J|pBA)% Bp*B|{t;@{Nhu omtg`ZVNR`x]d/i-G;@');
define('NONCE_KEY',        '#b*%i}E ;J]|OQ:5M0f||Rw+c4nK#Y0/t?Nc-|s wXJ~9uy>wTal{-V*S!:w`Rm=');
define('AUTH_SALT',        'Lnt*vyZsWYf A~STOm--piZXd0{r(C{WRA5EE  7!4:l/mN;q?vhhj4?uP|fC/u]');
define('SECURE_AUTH_SALT', 'K1d!k#XoGA@wKKH##k:A|b5or]Bj<L{d7}<X$ti!F=iJ+A& gy|-wwJKJzC3T#X~');
define('LOGGED_IN_SALT',   ' Y)(^2As,Al?q7Z|>qnLlf=|jW,+9ViEEJ.TyRi[@qvszW_5]+^M^uy*QO4*<6pt');
define('NONCE_SALT',       '2_kz=M-&)+S<^G1Jc^]Sy*;1+1DFeSKJ-.4-r;n!Z!3Wh_Yfin901/ ~-6cs,^5C');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

<?php
/*
Plugin Name: Opciones de Seguridad para clientes Artifices
Plugin URI: https://www.artifices.net
Description: Opciones básicas de seguridad: límite de revisiones, no actualizaciones automaticas, no edición de ficheros, no instalación de plugins. 
* Version: 1.0.7
* Author: Jesus Cortes
* Author URI: http://www.artifices.net
License: GPLv2 or later
Text Domain: artifices
GitHub Plugin URI: https://github.com/artifices/Divi-child-theme-para-clientes-de-Artifices
*/

// LIMITAR NUMERO DE REVISIONES EN LA BD

if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 2);
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', false);

// IMPEDIR EDICION TEMAS & PLUGINS
$user_id = 'artifices';
$user = get_userdata( $user_id );
if ( $user === false ) {
    //user id does not exist
} else {
    //user id exists
    define('DISALLOW_FILE_EDIT',true);
}


// IMPEDIR INSTALACION DE PLUGINS

define('DISALLOW_FILE_MODS',true);

// Limitar subidas

 @ini_set( 'upload_max_size' , '5M' );

// PERSONALIZAR LOGO LOGIN

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('<?php echo plugins_url( 'logo-artifices.png', __FILE__ ) ; ?>') !important;
		height:52px;
		width:240px;
		background-size: 240px 52px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
    return 'https://artifices.net';
}
?>

<?php
/*
Plugin Name: Opciones de Seguridad para clientes Artifices
Plugin URI: https://www.artifices.net
Description: Opciones basicas de seguridad: limite de revisiones, no actualizaciones automaticas, no edicion de ficheros, no instalacion de plugins.
* Version: 1.0.10
* Author: Jesus Cortes
* Author URI: http://www.artifices.net
License: GPLv2 or later
Text Domain: artifices
GitHub Plugin URI: https://github.com/artifices/artifices-seguridad-plugin
*/


// Definición de configuraciones

function constants_artifices() {

// Filtro para permitir solo al usuario artifices realizar tareas de mantenimiento.

    $current_user = wp_get_current_user();
    if ( 'artifices' != $current_user->user_login ) {
        define('DISALLOW_FILE_EDIT',true); // IMPEDIR EDICION TEMAS & PLUGINS
        define('DISALLOW_FILE_MODS',true); // IMPEDIR INSTALACION DE PLUGINS 
    } else {
        define('DISALLOW_FILE_EDIT',false); // PERMITIR A ARTIFICES EDICION TEMAS & PLUGINS
        define('DISALLOW_FILE_MODS',false); // PERMITIR A ARTIFICES INSTALACION DE PLUGINS    
    }

    // LIMITAR NUMERO DE REVISIONES EN LA BD

    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 2);
    }
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', false);
    }

    // Limitar subidas

     @ini_set( 'upload_max_size' , '5M' );

}
add_action('init', 'constants_artifices', 102);

// PERSONALIZAR LOGO LOGIN

function my_login_logo_style() { ?>
    <style type="text/css">
        #login h1 a, 
        .login h1 a {
            background-image: url('<?php echo plugins_url( 'logo-artifices.png', __FILE__ ) ; ?>') !important;
            height:52px;
            width:240px;
            background-size: 240px 52px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo_style' );
add_filter('login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
    return 'https://www.artifices.net';
}
?>

<?php
/**
 * @package Opciones de seguridad
 */
/*
Plugin Name: Opciones de Seguridad para clientes Artifices
Plugin URI: https://www.artifices.net
Description: Opciones básicas de seguridad: límite de revisiones, no actualizaciones automaticas, no edición de ficheros, no instalación de plugins. 
* Version: 1.0.0
* Author: Jesus Cortes
* Author URI: http://www.artifices.net
License: GPLv2 or later
Text Domain: artifices
*/

/*
* Función para añadir una página al menú de administrador de wordpress
*/
function artifices_seguridad_plugin_menu(){
    //Añade una página de menú a wordpress
    add_menu_page('Ajustes plugin seguridad Artifices',          //Título de la página
                    'Opciones de seguridad artifices',                       //Título del menú
                    'administrator',                            //Rol que puede acceder
                    'artifices_seguridad-content-settings',       //Id de la página de opciones
                    'artifices_seguridad_content_page_settings',  //Función que pinta la página de configuración del plugin
                    'dashicons-admin-generic');                 //Icono del menú
}
add_action('admin_menu','artifices_seguridad_plugin_menu');

/*
* Función que pinta la página de configuración del plugin
*/
function artifices_seguridad_content_page_settings(){
?>
    <div class="wrap">
        <h2>Configuración plugin Opciones de Seguridad Artifices</h2>
        <form method="POST" action="options.php">
            <?php 
                settings_fields('artifices_seguridad-content-settings-group');
                do_settings_sections( 'artifices_seguridad-content-settings-group' ); 
            ?>
            <label>Variable:&nbsp;</label>
            <input  type="text" 
                    name="artifices_seguridad_value" 
                    id="artifices_seguridad_value" 
                    value="<?php echo get_option('cartifices_seguridad_value'); ?>" />
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}


// LIMITAR NUMERO DE REVISIONES EN LA BD

if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 2);
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', false);

// IMPEDIR EDICION TEMAS & PLUGINS

define('DISALLOW_FILE_EDIT',true);

// IMPEDIR INSTALACION DE PLUGINS

define('DISALLOW_FILE_MODS',true);

// Limitar subidas

// @ini_set( 'upload_max_size' , '5M' );

// PERSONALIZAR LOGO LOGIN

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(https://www.artifices.net/wp-content/uploads/2017/03/logo_web_01.png);
		height:52px;
		width:240px;
		background-size: 240px 52px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

?>
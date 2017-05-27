<?php
/*
Plugin Name: FBIngenieria
Version: 1.0.0
Author: Claudia & Simon Piscitelli
Description: FBIngenieria pages
Text Domain: fbingenieria
*/
if (!defined('ABSPATH')) {
    exit;
}

class FBIngenieria
{
    private $lang;

    public function __construct()
    {
        define('FBINGENIERIA_PATH', plugin_dir_path(__FILE__));
        define('FBINGENIERIA_URL', plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__)));
        $this->init_wp_plugin();
    }

    private function init_wp_plugin()
    {
        load_plugin_textdomain('fbingenieria', false, plugin_basename(dirname(__FILE__)) . '/languages');
        require_once(FBINGENIERIA_PATH.'/src/database/database.php');
        register_activation_hook(__FILE__, 'fbingenieriaDatabase');
        add_action('admin_menu', array($this, 'add_menu_pages'));
        add_shortcode('fbi_landing_page', 'fbi_landing_page_handler');
    }

    public function getLanguage($lang=null)
    {
        $file = @file_get_contents(FBINGENIERIA_URL.'/src/languages/'.$lang.'.json');
        if (!$file) {
            $file = file_get_contents(FBINGENIERIA_URL.'/src/languages/es.json'); //default language
        }
        return json_decode($file);
    }
    
    public function add_menu_pages()
    {
        add_menu_page('FBIngenieria', 'FBIngenieria', 'administrator', 'fbi_settings_menu', 'fbi_settings_add_client_handler');
        add_submenu_page('fbi_settings_menu', 'Manejar Clientes', 'Manejar Clientes', 'administrator', 'fbi_settings_menu', 'fbi_settings_add_client_handler');
        add_submenu_page('fbi_settings_menu', 'Manejar Proyectos', 'Manejar Proyectos', 'administrator', 'fbi_settings_projects', 'fbi_settings_add_project_handler');
    }
}

$GLOBALS['FBIngenieria'] = new FBIngenieria();

function fbi_landing_page_handler($atts)
{
    ob_start();
    include FBINGENIERIA_PATH.'src/landing_page.html';
    return ob_get_clean();
}

function fbi_settings_add_client_handler()
{
    echo "Under construction";
}

function fbi_settings_add_project_handler()
{
    echo "Under construction";
}

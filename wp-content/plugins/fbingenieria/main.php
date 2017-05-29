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
        $this->load_wp_functions();
    }

    private function load_wp_functions()
    {
        load_plugin_textdomain('fbingenieria', false, plugin_basename(dirname(__FILE__)) . '/languages');
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
}

$GLOBALS['FBIngenieria'] = new FBIngenieria();

function fbi_landing_page_handler($atts)
{
    ob_start();
    include FBINGENIERIA_PATH.'src/landing_page.html';
    return ob_get_clean();
}
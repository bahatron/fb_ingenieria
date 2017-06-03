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
    private $clients;
    private $projects;
    private $images;
    
    public function __construct()
    {
        define('FBINGENIERIA_PATH', plugin_dir_path(__FILE__));
        define('FBINGENIERIA_URL', plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__)));
        $this->clients = $GLOBALS['wpdb']->prefix.'fbi_clients';
        $this->projects = $GLOBALS['wpdb']->prefix.'fbi_projects';
        $this->images = $GLOBALS['wpdb']->prefix.'fbi_images';
        $this->init_wp_plugin();
    }

    private function init_wp_plugin()
    {
        require_once(FBINGENIERIA_PATH.'/src/config/database.php');
        load_plugin_textdomain('fbingenieria', false, plugin_basename(dirname(__FILE__)) . '/languages');
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
        add_submenu_page('fbi_settings_menu', 'Imagenes', 'Imagenes de proyecto', 'administrator', 'fbi_settings_images', 'fbi_settings_manage_project_images_handler');
    }

    private function showError($message)
    {
        ?>
		<div class="error notice">
			<p><?php echo $message  ?></p>
		</div>
		<?php

    }

    private function showWarning($message)
    {
        ?>
		<div class="update-nag notice">
			<p><?php echo $message  ?></p>
		</div>
		<?php

    }

    private function showSuccess($message)
    {
        ?>
		<div class="updated notice">
			<p><?php echo $message  ?></p>
		</div>
		<?php

    }

    public function getClientList()
    {
        global $wpdb;
        $sql="SELECT id, name from $this->clients";
        return $wpdb->get_results($sql);
    }

    public function getClientById($id)
    {
        global $wpdb;
        $sql="SELECT * from $this->clients WHERE id = $id";
        return $wpdb->get_row($sql);
    }

    public function getProjectList()
    {
        global $wpdb;
        $sql="SELECT id, name FROM $this->projects WHERE active != 0";
        return $wpdb->get_results($sql);
    }

    public function getProjectById($id)
    {
        global $wpdb;
        $sql="SELECT * FROM $this->projects WHERE id= $id";
        return $wpdb->get_row($sql);
    }
    
    public function getProjectImages($id)
    {
        global $wpdb;
        $sql="SELECT id, name FROM $this->images WHERE project_id = $id";
        return $wpdb->get_results($sql);
    }

    public function getUploadedMedia()
    {
        global $wpdb;
        $table = $wpdb->prefix.'postmeta';
        $sql = "SELECT post_id FROM $table WHERE meta_key = '_wp_attached_file';";
        return $wpdb->get_results($sql);
    }

    public function updateClient($array)
    {
        global $wpdb;
        $id = $array['id'];
        unset($array['id']);
        unset($array['submit']);
        $result = $wpdb->update($this->clients, $array, ['id' => $id]);
        if (!$result) {
            $this->showError('Hubo un error actualizando los datos');
        } else {
            $this->showSuccess('Cliente actualizado satisfactoriamente!');
        }
    }
    
    public function createClient($array)
    {
        global $wpdb;
        unset($array['id']);
        unset($array['submit']);
        $result = $wpdb->insert($this->clients, $array);
        if (!$result) {
            $this->showWarning('Ya existe un cliente con ese nombre');
        } else {
            $this->showSuccess('Cliente registrado satisfactoriamente!');
        }
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
    include FBINGENIERIA_PATH.'src/views/manage_clients.php';
}

function fbi_settings_add_project_handler()
{
    include FBINGENIERIA_PATH.'src/views/manage_projects.php';
}

function fbi_settings_manage_project_images_handler()
{
    include FBINGENIERIA_PATH.'src/views/manage_images.php';
}

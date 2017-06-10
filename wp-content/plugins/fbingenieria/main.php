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
    private $headerImages;
    private $translations;

    public function __construct()
    {
        define('FBINGENIERIA_PATH', plugin_dir_path(__FILE__));
        define('FBINGENIERIA_URL', plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__)));
        $this->clients = $GLOBALS['wpdb']->prefix.'fbi_clients';
        $this->projects = $GLOBALS['wpdb']->prefix.'fbi_projects';
        $this->images = $GLOBALS['wpdb']->prefix.'fbi_images';
        $this->headerImages = $GLOBALS['wpdb']->prefix.'fbi_header_images';
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

    public function setLanguage($lang=null)
    {
        $file = @file_get_contents(FBINGENIERIA_URL.'/src/assets/lang/'.$lang.'.json');
        if (!$file) {
            $file = @file_get_contents(FBINGENIERIA_URL.'/src/assets/lang/es.json'); //default language
        }
        $this->translations = json_decode($file);
    }
    
    public function translate($key, $lang = null)
    {
        if ($lang !== null || !isset($this->translations)) {
            $this->setLanguage($lang);
        }
        return $this->translations->$key ? $this->translations->$key : $key;
    }

    public function add_menu_pages()
    {
        add_menu_page('FBIngenieria', 'FBIngenieria', 'administrator', 'fbi_settings_menu', 'fbi_settings_add_client_handler');
        add_submenu_page('fbi_settings_menu', 'Manejar Clientes', 'Manejar Clientes', 'administrator', 'fbi_settings_menu', 'fbi_settings_add_client_handler');
        add_submenu_page('fbi_settings_menu', 'Manejar Proyectos', 'Manejar Proyectos', 'administrator', 'fbi_settings_projects', 'fbi_settings_add_project_handler');
        add_submenu_page('fbi_settings_menu', 'Imagenes', 'Imagenes de proyecto', 'administrator', 'fbi_settings_images', 'fbi_settings_manage_project_images_handler');
        add_submenu_page('fbi_settings_menu', 'Imagenes', 'Imagenes de cabezera', 'administrator', 'fbi_settings_header_images', 'fbi_settings_manage_header_images_handler');
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

    # client control
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

    public function getActiveClients()
    {
        global $wpdb;
        $sql="SELECT id, name, imageUrl from $this->clients WHERE visible=1";
        return $wpdb->get_results($sql);
    }

    public function getClientProjects($id)
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->projects WHERE client_id=$id";
        return $wpdb->get_results($sql);
    }

    public function updateClient($array)
    {
        global $wpdb;
        $id = $array['id'];
        unset($array['id']);
        unset($array['submit']);
        !isset($array['visible']) ? $array['visible'] = 0 : null;
        $result = $wpdb->update($this->clients, $array, ['id' => $id]);
        if (!$result) {
            $this->showWarning('No se registraron cambios en la base de datos');
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

    # project control
    public function getProjectList()
    {
        global $wpdb;
        $sql="SELECT id, name FROM $this->projects";
        return $wpdb->get_results($sql);
    }

    public function getProjectById($id)
    {
        global $wpdb;
        $sql="SELECT * FROM $this->projects WHERE id= $id";
        return $wpdb->get_row($sql);
    }

    public function updateProject($array)
    {
        global $wpdb;
        $id = $array['id'];
        unset($array['id']);
        unset($array['submit']);
        !isset($array['visible']) ? $array['visible'] = 0 : null;
        ($array['client_id'] === '') ?  $array['client_id'] = null : null;
        $result = $wpdb->update($this->projects, $array, ['id' => $id]);
        if (!$result) {
            $this->showError('Hubo un error actualizando los datos');
        } else {
            $this->showSuccess('Proyecto actualizado satisfactoriamente!');
        }
    }

    public function createProject($array)
    {
        global $wpdb;
        unset($array['id']);
        unset($array['submit']);
        if ($array['client_id'] === '') {
            unset($array['client_id']);
        }
        $result = $wpdb->insert($this->projects, $array);
        if (!$result) {
            $this->showError('Hubo un error en base de datos');
        } else {
            $this->showSuccess('Proyecto registrado satisfactoriamente!');
        }
    }

    # image control
    public function getProjectImages($id)
    {
        global $wpdb;
        $sql="SELECT * FROM $this->images WHERE project_id = $id";
        return $wpdb->get_results($sql);
    }

    public function addMediaToProject($id, $array)
    {
        global $wpdb;
        foreach ($array as $img) {
            $result += $wpdb->insert($this->images, ['post_id' => $img, 'project_id' => $id]);
        }
        if (!$result) {
            $this->showError('Hubo un error registrado en base de datos');
        } else {
            $this->showSuccess('Actualizacion satisfactoria!');
        }
    }

    public function deleteMediaFromProject($id, $array)
    {
        global $wpdb;
        foreach ($array as $img) {
            $result += $wpdb->delete($this->images, ['post_id' => $img, 'project_id' => $id]);
        }
        if (!$result) {
            $this->showError('Hubo un error registrado en base de datos');
        } else {
            $this->showSuccess('Actualizacion satisfactoria!');
        }
    }

    public function addMediaToHeader($array)
    {
        global $wpdb;
        foreach ($array as $img) {
            $result += $wpdb->insert($this->headerImages, ['post_id' => $img]);
        }
        if (!$result) {
            $this->showError('Error registrado en base de datos');
        } else {
            $this->showSuccess('Actualizacion satisfactoria!');
        }
    }

    public function deleteMediaFromHeader($array)
    {
        global $wpdb;
        foreach ($array as $img) {
            $result += $wpdb->delete($this->headerImages, ['post_id' => $img]);
        }
        if (!$result) {
            $this->showError('Error registrado en base de datos');
        } else {
            $this->showSuccess('Actualizacion satisfactoria!');
        }
    }

    public function getUploadedMedia()
    {
        global $wpdb;
        $table = $wpdb->prefix.'postmeta';
        $sql = "SELECT post_id FROM $table WHERE meta_key = '_wp_attached_file';";
        $result = $wpdb->get_results($sql);
        $list = [];
        foreach ($result as $img) {
            $list[] = array('id' => $img->post_id, 'url' => wp_get_attachment_url($img->post_id));
        }
        return $list;
    }
    
    public function getHeaderImages()
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->headerImages";
        return $wpdb->get_results($sql);
    }

    public function getHeaderImagesUrl()
    {
        $array = $this->getHeaderImages();
        foreach ($array as $img) {
            $list[] = wp_get_attachment_url($img->post_id);
        }
        return $list;
    }

    public function sendMail($data)
    {
        global $wpdb;
        $table = $wpdb->prefix.'options';
        $sql = "SELECT option_value FROM $table WHERE option_name = 'mail_from'";
        $to = $wpdb->get_row($sql);
        $message = "$data->name $data->lastname commented: $data->comment. You can get back to $data->name through $data->mail.";
        try {
            $result = wp_mail($to->option_value, 'correo de contacto', $message);
        } catch (phpmailerException  $e) {
            return $e;
        }
        return $result;
    }
}

$GLOBALS['FBIngenieria'] = new FBIngenieria();

function fbi_landing_page_handler($atts)
{
    ob_start();
    include FBINGENIERIA_PATH.'src/views/landing_page.html';
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

function fbi_settings_manage_header_images_handler()
{
    include FBINGENIERIA_PATH.'src/views/manage_header.php';
}

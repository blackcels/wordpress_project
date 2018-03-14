<?php
/*
Plugin Name: GalleryPhoto  
Author: Groupe 13
License: ESGI 3A IW2
Version: 1.0
Description: Gallery de photo
*/

class Gallery{

    public function __construct(){
        include_once plugin_dir_path(__FILE__).'/GalleryPhoto.class.php';
        register_activation_hook(__FILE__, array('Gallery', 'active'));
        register_deactivation_hook(__FILE__, array('Gallery', 'desactive'));
        register_uninstall_hook(__FILE__, array('Gallery', 'uninstall'));
    }

    public static function active(){
       
    }

    public static function desactive(){
       
    }

    public static function uninstall(){
       
    }

}

new Gallery();
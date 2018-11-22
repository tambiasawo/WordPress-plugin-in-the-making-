<?php
/** 
* @Package TambiPlugin
*/


/*
Plugin Name: tambi-plugin
Plugin URI: http://plugintest.webgigg.com/plugins
Description: This is my 2nd attempt onn making a plugin
Version: 1.0.0
Author: Tambi Asawo
Author URI: http://webgigg.com
License: GPLv2 or later
Text Domain: tambi plugin 
*/
defined ('ABSPATH') or die('STOP!');

class myPlugin
{
    public $plugin;
    function __construct() 
    {
        $this->plugin=plugin_basename(__FILE__);
		add_action( 'init', array( $this, 'custom_post_type' ) );
		
	}
	function register() 
	{
	    // we are not calling these funcs directly but we r calling them thru the new class instance created
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ));
		add_action('admin_menu', array($this,'add_admin_pages'));
		add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
		
	}
	
	function settings_link($links)
	{
	    $link1='<a href ="admin.php?page=tambi_plugin">Settings</a>';
	    array_push($links,$link1);
	    return $links;
	}
    
    function add_admin_pages()
    {
        add_menu_page('Addition','Calculator','manage_options','tambi_plugin',array($this,'admin_index'),'dashicons-dismiss',110); //3-user privi.,4-callbackfunc,5-custom icon,6-pos. of link in menu 110-bottom
    }
    
    function admin_index()
    {
        require_once plugin_dir_path(__FILE__).'/templates/admin.php';
    }
    
    function custom_post_type() 
    {
		register_post_type( 'calculate', ['public' => true, 'label' => 'Calculator'] );
	}
	function enqueue()
    {
            wp_enqueue_style('tambipluginhandler', plugins_url('/assets/style.css', __FILE__));  //__FILE__ here means the starting pt to start searching for the added file in the di
             wp_enqueue_script('tambipluginhandler', plugins_url('/assets/myscript.js', __FILE__));
    }
	function activate()
        {
            require_once plugin_dir_path(__FILE__).'/inc/tambiplugin_activate.php';
            tambiplugin_activate::activate();
        }
       
    function deactivate()
        {
            require_once plugin_dir_path(__FILE__).'/inc/tambiplugin_deactivate.php';
            tambiplugin_deactivate::deactivate();
        }

}
if ( class_exists( 'myPlugin' ) ) {
	$classVar = new myPlugin();
	$classVar->register();
}
// activation
register_activation_hook( __FILE__, array( $classVar, 'activate' ) );
// deactivation
register_deactivation_hook( __FILE__, array( $classVar, 'deactivate' ) );

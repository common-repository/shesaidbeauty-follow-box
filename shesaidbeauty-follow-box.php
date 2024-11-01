<?php
/*
Plugin Name: SheSaidBeauty Follow Box
Plugin URI: http://www.shesaidbeauty.com/widget/follow-box
Description: The She Said Beauty Follow Box is a social plugin that enables Beauty Bloggers to attract and gain followers on She Said Beauty, from their own website.
Version: 1.0
Author: She Said Beauty
Author URI: http://www.shesaidbeauty.com
License: GPL2
*/

class SheSaidBeautyFollowBox extends WP_Widget {
      
	/*--------------------------------------------------*/  
    /* Constructor 
    /*--------------------------------------------------*/  
	  
    /** 
     * The widget constructor. Specifies the classname and description, instantiates 
     * the widget, loads localization files, and includes necessary scripts and 
     * styles. 
     */ 
	function SheSaidBeautyFollowBox() {
		
		// Define constnats used throughout the plugin  
		$this->init_plugin_constants(); 
		
		$widget_opts = array (  
            'classname' => PLUGIN_NAME,   
            'description' => __('The She Said Beauty Follow Box is a social plugin that enables Beauty Bloggers to attract and gain followers on She Said Beauty, from their own website.', PLUGIN_LOCALE)  
        ); 
		
		$this->WP_Widget(PLUGIN_SLUG, __(PLUGIN_NAME, PLUGIN_LOCALE), $widget_opts);
	
		// Load JavaScripts and Stylesheets
		$this->register_scripts_and_styles();
		
	}
	
	
	/*--------------------------------------------------*/  
    /* API Functions 
    /*--------------------------------------------------*/  

    /** 
     * Outputs the content of the widget. 
     * 
     * @args            The array of form elements 
     * @instance 
     */  
    function widget($args, $instance) {  
      
        extract($args, EXTR_SKIP);  
          
        echo $before_widget;  
      	
		// TODO: This is where you retrieve the widget values
		$shesaidbeauty_vanityname = empty($instance['shesaidbeauty_vanityname']) ? '' : apply_filters('shesaidbeauty_vanityname', $instance['shesaidbeauty_vanityname']);
		$shesaidbeauty_followbox_width = empty($instance['shesaidbeauty_followbox_width']) ? '' : apply_filters('shesaidbeauty_followbox_width', $instance['shesaidbeauty_followbox_width']);
		
        // Display the widget  
        include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/widget.php');  
          
        echo $after_widget;  
          
    } // end widget
    
    /** 
     * Processes the widget's options to be saved. 
     * 
     * @new_instance    The previous instance of values before the update. 
     * @old_instance    The new instance of values to be generated via the update. 
     */  
    function update($new_instance, $old_instance) {  
          
        $instance = $old_instance;  
		
		$instance['shesaidbeauty_vanityname'] = strip_tags(stripslashes($new_instance['shesaidbeauty_vanityname']));
		$instance['shesaidbeauty_followbox_width'] = strip_tags(stripslashes($new_instance['shesaidbeauty_followbox_width']));
		
		if( strlen( trim($instance['shesaidbeauty_vanityname'], " ") ) == 0 ) {
			$instance['shesaidbeauty_vanityname'] = SSB_VANITY;
		}
		
		if( strlen( trim($instance['shesaidbeauty_followbox_width'], " ") ) == 0 || intval($instance['shesaidbeauty_followbox_width']) < 1 ) {
			$instance['shesaidbeauty_followbox_width'] = SSB_FOLLOWBOX_WIDTH;
		}
			  
        return $instance;
          
    } // end widget 
   
    /** 
     * Generates the administration form for the widget. 
     * 
     * @instance    The array of keys and values for the widget. 
     */  
    function form($instance) {  
      
    	// TODO define default values for your variables  
        $instance = wp_parse_args(  
            (array)$instance,  
            array(  
                'shesaidbeauty_vanityname' => '',
                'shesaidbeauty_followbox_width' => ''
            ) 
        ); 
     
    	$shesaidbeauty_vanityname = strip_tags(stripslashes($new_instance['shesaidbeauty_vanityname']));
    	$shesaidbeauty_followbox_width = strip_tags(stripslashes($new_instance['shesaidbeauty_followbox_width']));
        
		if( strlen( trim($shesaidbeauty_vanityname, " ") ) == 0 ) {
			$shesaidbeauty_vanityname = SSB_VANITY;
		}
		
		if( strlen( trim($shesaidbeauty_followbox_width, " ") ) == 0 || intval($shesaidbeauty_followbox_width) < 1 ) {
			$shesaidbeauty_followbox_width = SSB_FOLLOWBOX_WIDTH;
		}
		
        // Display the admin form 
    	include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/admin.php'); 
         
    } // end form
	
	
    /*--------------------------------------------------*/ 
    /* Private Functions 
    /*--------------------------------------------------*/
	
	private function init_plugin_constants() { 
     
		if(!defined('PLUGIN_LOCALE')) { 
		  define('PLUGIN_LOCALE', 'GB-EN'); 
		} // end if 
		
	    if(!defined('PLUGIN_NAME')) { 
	      define('PLUGIN_NAME', 'SheSaidBeauty Follow Box'); 
	    } // end if 
	     
	    if(!defined('PLUGIN_SLUG')) { 
	      define('PLUGIN_SLUG', 'shesaidbeauty-follow-box'); 
	    } // end if 
	     
	    if(!defined('SSB_VANITY')) { 
	      define('SSB_VANITY', 'shesaidbeauty'); 
	    } // end if 
	     
	    if(!defined('SSB_FOLLOWBOX_WIDTH')) { 
	      define('SSB_FOLLOWBOX_WIDTH', 300); 
	    } // end if 
	
	} // end init_plugin_constants
	
    /** 
     * Registers and enqueues stylesheets for the administration panel and the 
     * public facing site. 
     */ 
    private function register_scripts_and_styles() {
			 
		if(is_admin()) { 
	    	$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/js/admin.js', true); 
	        $this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/admin.css'); 
		} else {  
	    	$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/js/admin.css', true); 
	    	$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/widget.css'); 
	    } // end if/else 
	    
    } // end register_scripts_and_styles 
 
    /** 
     * Helper function for registering and enqueueing scripts and styles. 
     * 
     * @name    The     ID to register with WordPress 
     * @file_path       The path to the actual file 
     * @is_script       Optional argument for if the incoming file_path is a JavaScript source file. 
     */ 
    private function load_file($name, $file_path, $is_script = false) { 
         
    	$url = WP_PLUGIN_URL . $file_path; 
        $file = WP_PLUGIN_DIR . $file_path; 
     
        if(file_exists($file)) { 
            if($is_script) { 
                wp_register_script($name, $url); 
                wp_enqueue_script($name); 
            } else { 
                wp_register_style($name, $url); 
                wp_enqueue_style($name); 
            } // end if 
        } // end if 
     
    } // end load_file 
     
} // end class

add_action('widgets_init', create_function('', 'register_widget("SheSaidBeautyFollowBox");')); // TODO remember to change this to match the class definition above  
?>
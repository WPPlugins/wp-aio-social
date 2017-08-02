<?php
/*======================================================
				AIO SOCIAL ADMIN CLASS
========================================================*/
/*
Author	:	Ramandeep Singh
URI		:	Designaeon.com

*/

if(!class_exists('RheaAdminSocial')){
	class RheaAdminSocial{		
		function __construct(){
			$this->load_libs();	
			add_action('admin_enqueue_scripts',array($this,'register_scripts'));
			//register the scripts
		}
		
		//load_libs
		function load_libs(){
			//load 
			require_once(RHEAPATH.'/admin/lib/helper.class.php');
			require_once(RHEAPATH.'/admin/lib/utility.class.php');
			require_once(RHEAPATH.'/admin/lib/settings.class.php');
			
			//apps
			require_once(RHEAPATH.'/admin/lib/twitter-api.php');
			//require_once(RHEAPATH.'/admin/lib/phpFlickr/phpFlickr.php');
			
			//get the widgets
			require_once(RHEAPATH.'/admin/inc/widgets/init.php');
			
			//dashwidgets
			add_action('wp_dashboard_setup', array($this,'da_dashboard_widgets'));
		}
		
		//register scripts
		function register_scripts(){
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker');
		}
		
		
		//designaeon feeds

		
		
		function da_dashboard_widgets() {		
			 global $wp_meta_boxes;		
			 // remove unnecessary widgets
		
			 // var_dump( $wp_meta_boxes['dashboard'] ); // use to get all the widget IDs
		
			 unset(		
				  $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],		
				  $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],		
				  $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']		
			 );
		
			 // add a custom dashboard widget
			wp_add_dashboard_widget( 'dashboard_custom_feed', 'Latest Developer Blog News', array($this,'dashboard_da_custom_feed_output') );
			  //add new RSS feed output		
		}
		
		function dashboard_da_custom_feed_output() {		
			 echo '<div class="rss-widget">';		
			 wp_widget_rss_output(array(		
				  'url' => 'http://feeds.feedburner.com/designaeon',		
				  'title' => 'What\'s up at Design Aeon',		
				  'items' => 10,		
				  'show_summary' => 1,		
				  'show_author' => 0,		
				  'show_date' => 1 		
			 ));
		
			 echo "</div>";
		
		}
		
		//end feeds
		
	}//end of class
}
				
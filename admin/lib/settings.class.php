<?php
/*======================================================
				AIO SOCIAL Settings ADMIN CLASS
========================================================*/
/*
Author	:	Ramandeep Singh
URI		:	Designaeon.com

*/
if(!class_exists('RheaAdminSSettings')){
	class RheaAdminSSettings{
		var $key;
		private $plugin_options_key = 'wp-aio-social';
		private $general_settings_key = 'general_settings';
		private $advanced_settings_key = 'advanced_settings';
		private $plugin_settings_tabs = array();	
		function __construct(){
			//init vars
			$this->general_settings_key = RHEAAIO.'general_settings';
			//$this->advanced_settings_key = RHEAAIO.'advanced_settings';
			
			//admin page
			add_action( 'admin_menu', array( &$this, 'set_admin_menu' ) );	
			
			add_action( 'init', array( &$this, 'load_settings' ) );
			add_action( 'admin_init', array( &$this, 'register_general_settings' ) );
			
		}
		
		//load the settings
		function load_settings() {
			$this->general_settings = (array) get_option( $this->general_settings_key );
			//$this->advanced_settings = (array) get_option( $this->advanced_settings_key );
		
			// Merge with defaults
			$this->general_settings = array_merge( array(
				'EnableSharing' => false,
				'ATPubID'=>'',
				'ATCode'=>'<div class="addthis_native_toolbox"></div>',
				'StBackground'	=> '#eee',
				'StForeground'	=> '#555',				
				'StEnableOn'=>array('post')
			), $this->general_settings );
		
			
		}
		
		//set admin page
		function set_admin_menu(){
			
			add_options_page( 'Wp Aio Social', 'Wp Aio Social', 'manage_options', $this->plugin_options_key, array($this,'rhea_admin_page') ); 
		}	
		function rhea_admin_page(){
			 $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : $this->general_settings_key;
			?>
			<div class="wrap">            	
				<?php $this->plugin_options_tabs(); ?>
                <small> Plugin Powered By : <a target="_blank" href="http://designaeon.com">DesignAeon</a> </small>
				<form method="post" action="options.php">
					<?php wp_nonce_field( 'update-options' ); ?>
					<?php settings_fields( $tab ); ?>
					<?php do_settings_sections( $tab ); ?>
					<?php submit_button(); ?>
				</form>
                
                <div>
                	 <p>        
                        <hr />
                
                        <label>If you liked this plugin, Please like on facebook ,G+:  </label><br />
                
                <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Ffacebook.com%2Fdesignaeon&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=175431785895681" scrolling="no" frameborder="0" style="border:none; overflow:hidden;width:100%; height:50px;" allowTransparency="true"></iframe>
                
                    <iframe src="//www.facebook.com/plugins/subscribe.php?href=https%3A%2F%2Fwww.facebook.com%2Framandeep000&amp;layout=button_count&amp;show_faces=false&amp;colorscheme=light&amp;font&amp;width=120&amp;appId=102008056593077" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px;  height:21px;" allowTransparency="true"></iframe>
                
                    <a href="https://plus.google.com/103049352972527333852?prsrc=3" rel="author" style="display:inline-block;text-decoration:none;color:#333;text-align:center;font:13px/16px arial,sans-serif;white-space:nowrap;"><span style="display:inline-block;font-weight:bold;vertical-align:top;margin-right:5px;margin-top:0px;">Follow</span><span style="display:inline-block;vertical-align:top;margin-right:13px;margin-top:0px;">on</span><img src="https://ssl.gstatic.com/images/icons/gplus-16.png" alt="" style="border:0;width:16px;height:16px;"/></a>
                
                
                
                        </p>
                        
                        <p>Support this widget Share it! For more info, go to <a href="http://www.designaeon.com/wp-aio-social/" target="_blank">WP AIO social</a>  page</p>
                        
                        <p>
                        If you liked the Widget and Wana Keep Supporting us for Freeware Plugins ..Please Buy us A Beer. We'll Be Encouraged to Develop more good Stuff
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_donations">
                        <input type="hidden" name="business" value="s.ramaninfinite@live.com">
                        <input type="hidden" name="lc" value="US">
                        <input type="hidden" name="no_note" value="0">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>

                        </p>
                </div>
			</div>
			<?php
		}
		//the tabs
		function plugin_options_tabs() {
			$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : $this->general_settings_key;
		
			screen_icon();
			echo '<h2 class="nav-tab-wrapper">';
			foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) {
				$active = $current_tab == $tab_key ? 'nav-tab-active' : '';
				echo '<a class="nav-tab ' . $active . '" href="?page=' . $this->plugin_options_key . '&tab=' . $tab_key . '">' . $tab_caption . '</a>';
			}
			echo '</h2>';
		}
		
		//general settings
		function register_general_settings() {
			$this->plugin_settings_tabs[$this->general_settings_key] = 'Sharing';		
			register_setting( $this->general_settings_key, $this->general_settings_key );
			add_settings_section( 'section_general', 'General Sharing Settings', array( &$this, 'section_general_desc' ), $this->general_settings_key );
			add_settings_field( 'EnableSharing', 'Enable Post Sharing', array( &$this, 'field_general_option' ), $this->general_settings_key, 'section_general' );
			add_settings_field( 'ATPubID', 'Add This Publisher ID: ', array( &$this, 'field_general_pubid' ), $this->general_settings_key, 'section_general' );
			add_settings_field( 'ATCode', 'Add This Custom Code(without Script): ', array( &$this, 'field_general_atcode' ), $this->general_settings_key, 'section_general' );
			add_settings_field( 'StBackground', 'Background', array( &$this, 'field_general_bg' ), $this->general_settings_key, 'section_general');
			
			add_settings_field( 'StForeground', 'Foreground', array( &$this, 'field_general_fg' ), $this->general_settings_key, 'section_general');			
			
			add_settings_field( 'StEnableOn', 'Enable ON', array( &$this, 'field_general_enable' ), $this->general_settings_key, 'section_general' );
		}
		
		function section_general_desc() { echo 'Sharing Settings.'; }
		//fields
		function field_general_option() {
			?>
			<input type="checkbox" name="<?php echo $this->general_settings_key; ?>[EnableSharing]" <?php echo  checked( 1, $this->general_settings['EnableSharing'], false ); ?> value="1" />           
			<?php
		}
		function field_general_pubid() {
			?>
			<input type="text" name="<?php echo $this->general_settings_key; ?>[ATPubID]" value="<?php echo $this->general_settings['ATPubID'] ?>" />
            <small>Get Your Add This Publisher Id Here : <a target="_blank" href="https://www.addthis.com/login?next=%2Fdashboard#gallery/tools/share">Add This DashBoard</a></small>
            
			<?php
		}
		
		function field_general_atcode() {
			?>
			
            <textarea style="width:350px;height:80px;max-width:100%;" name="<?php echo $this->general_settings_key; ?>[ATCode]"><?php echo $this->general_settings['ATCode'] ?></textarea>
            <br />
            <strong>Dont Paste Script Just the Code, Scripts Are Already Being Loaded In optimized way.</strong>
            <small>Get Your Add This Code Here : <a target="_blank" href="https://www.addthis.com/login?next=%2Fdashboard#gallery/tools/share">Add This DashBoard</a></small>
			<?php
		}
		
		function field_general_bg() {
			?>
			<input type="text" class="pick-color" name="<?php echo $this->general_settings_key; ?>[StBackground]" value="<?php echo $this->general_settings['StBackground'] ?>" />
            
			<?php
		}
		function field_general_fg() {
			?>
			<input type="text" class="pick-color" name="<?php echo $this->general_settings_key; ?>[StForeground]"  value="<?php echo $this->general_settings['StForeground'] ?>" />
            
			<?php
		}
		
		
		function field_general_enable() {
			$post_types = get_post_types( array('public'=>true), 'names' ); 
			//print_r($this->general_settings);
			?>
			<?php foreach($post_types as $k=>$type): ?>
            	<input type="checkbox" id="<?php echo $k.$type; ?>" <?php  if(in_array($type,$this->general_settings['StEnableOn'])){echo "checked='checked'";} ?> name="<?php echo $this->general_settings_key; ?>[StEnableOn][]" value="<?php echo $type ?>" />
                <label for="<?php echo $k.$type; ?>"><?php echo ucfirst($type); ?></label>
            <?php endforeach; ?>
            
			<?php
		}
		
	}//end of class
	
	$setting = new RheaAdminSSettings();
}
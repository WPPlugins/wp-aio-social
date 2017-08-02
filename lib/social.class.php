<?php
/**
Wp AIO Social FrontEnd Class
Author	: 	Ramandeep Singh
**/

if(!class_exists("RheaSocial")){
	class RheaSocial{
		private $sharing_settings,$advance_settings;
		public static $s_settings,$a_settings;
		function __construct(){
			
			$this->general_settings_key = RHEAAIO.'general_settings';
			//$this->advanced_settings_key = RHEAAIO.'advanced_settings';
			
			$this->sharing_settings = (array) get_option( $this->general_settings_key );
			self::$s_settings = (array) get_option( $this->general_settings_key );
			
			
			
			$this->init_admin();
			
			//load Libraries
			$this->load_libs();
			
			//register the scripts	
			add_action("wp_enqueue_scripts",array($this,"registerScripts"));
			add_action("wp_footer",array($this,"footerScripts"));
			
			//add sharing buttons
			if(isset($this->sharing_settings['EnableSharing']) & @$this->sharing_settings['EnableSharing']==true){
				add_filter('the_content',array($this,'addSharing'),99);
			}
		}
		
		//load admin
		function init_admin(){
			require_once(RHEAPATH.'/admin/init.php');	
		}
		
		//load libs
		
		function load_libs(){
			require_once(RHEAPATH.'/lib/utility.class.php');
		}
		
		//register the scripts
		function registerScripts(){
			//font
			wp_enqueue_style('rhea-font',RHEAURI.'assets/font/css/aiosocial.css');
			wp_enqueue_style('rhea-social',RHEAURI.'assets/css/style.css');
			wp_enqueue_script('rhea-social',RHEAURI.'assets/js/script.js',array('jquery'),'0.5',true);
		}
		//footer scripts
		function footerScripts(){			
				?>
                <script type="text/javascript">
					window.___gcfg = {
					 
					  parsetags: 'onload'
					};
					(function() {
						var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						po.src = 'https://apis.google.com/js/plusone.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					  })();
					</script>                   
                    <?php if(is_singular($this->sharing_settings['StEnableOn'])):?>
					
                    <script type="text/javascript">
						// Call this function once the rest of the document is loaded
						var addthis_config = addthis_config||{};
						<?php if(!empty($this->sharing_settings['ATPubID'])): ?>
							addthis_config.pubid = '<?php echo $this->sharing_settings['ATPubID']; ?>';
						<?php endif; ?>
						
						(function($) {
							$(document).ready(function(e) {
								var addthisScript = document.createElement('script');
								addthisScript.setAttribute('src', 'http://s7.addthis.com/js/300/addthis_widget.js#domready=1')
								document.body.appendChild(addthisScript)
								
							});
						})(jQuery);						
					</script>
                    <?php endif; ?>

                <?php			

		}
		function addSharing($content){			
			if(is_singular($this->sharing_settings['StEnableOn'])){
				$bg= $this->sharing_settings['StBackground'];
				$fg= $this->sharing_settings['StForeground'];
				$darkbg = RheaUtil::colourBrightness($bg,'-0.75');
				$style='style="background:'.$bg.';color:'.$fg.';border:3px solid '.$darkbg.';"';
				$style1 ='style="border-bottom:1px solid '.$darkbg.';color:'.$fg.';"';
				$sharing = '<div class="rhea-sharing-box" '.$style.'>';
				$sharing.='<strong '.$style1.'>Share</strong>';
				$sharing.='<div class="s-buttons">';
				if(!empty($this->sharing_settings['ATPubID'])){
					if(!empty($this->sharing_settings['ATCode'])){
						$share = $this->sharing_settings['ATCode'];	
					}
					else{
						$share = '<div class="addthis_sharing_toolbox"></div>';
					}
					//$style1= '<div class="addthis_native_toolbox"></div>';
					//$style2 = '<div class="addthis_sharing_toolbox"></div>';
				}
				else{
					$share = '
					<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
						<a class="addthis_button_compact"></a>
						<a class="addthis_counter addthis_bubble_style"></a>
					</div>';	
				}
				$sharing.=$share;
				$sharing.='</div>';	
				$sharing.='</div>';			
				$content.=$sharing;
			}			
			return $content;	
		}
	}//end of class	
}
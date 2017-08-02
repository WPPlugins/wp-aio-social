<?php
/*====================================================
				THe Widgets Class
=====================================================*/


if(!class_exists('RheaWidgets')){
	class RheaWidgets{
		public static $options;
		function __construct(){
			//self::$options = get_option(THEMENAME .'_cronos_options' );
			//load helper
			$this->load_libs();
			//load widget
			$this->loadWidgets();
			add_action( 'widgets_init', array($this,'registerWidgets') );		
		}
		
		//loadl helper
		function load_libs(){
			
		}
		//load the widgets
		function loadWidgets(){
			foreach (glob(RHEAPATH ."/admin/inc/widgets/*.widget.php") as $file) {
				require_once($file);
			}		
		}
		
		//register the widget
		function registerWidgets(){
			 register_widget( 'RheaWidget_fb' );
			 register_widget( 'RheaWidget_gplus' );	
			 register_widget( 'RheaWidget_twitter' );
			 register_widget( 'RheaWidget_soundcloud' );
			 register_widget( 'RheaWidget_subscribe' );	
			 register_widget( 'RheaWidget_flickr' );
			 register_widget( 'RheaWidget_socialicons' );
			 register_widget( 'RheaWidget_counter');
			 
			 register_widget( 'RheaWidget_SocialTabs');
			 register_widget( 'RheaWidget_instagram');			
		}
		
		//helper functions
		static function get_tweets($uname='ramandeep000',$count=5,$app){
			$settings = array(
				'oauth_access_token' => $app['access_token'],
				'oauth_access_token_secret' => $app['access_secret'],
				'consumer_key' => $app['consumer_key'],
				'consumer_secret' => $app['consumer_secret']
			);
			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$getfield = '?screen_name='.$uname.'&count='.$count;
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($settings);
			$jsonTweets= $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
			$tweets = json_decode($jsonTweets,true);
			return $tweets;
		}
		
		//Social Icons
		public static function socialIcons($options,$size,$new_tab){
			?>
            <ul class="rhea-social-icons-list <?php echo $size;?>">
            	<?php
					echo !empty($options['fb_id']) ? self::makeli($options['fb_id'],"rhea-icon-facebook","Facebook",$new_tab) : "";
					echo !empty($options['gplus_id']) ? self::makeli($options['gplus_id'],"rhea-icon-gplus","Google Plus",$new_tab) : "";
					echo !empty($options['twit_id']) ? self::makeli($options['twit_id'],"rhea-icon-twitter","Twitter",$new_tab) : "";
					echo !empty($options['linkdin_id']) ? self::makeli($options['linkdin_id'],"rhea-icon-linkedin","Linkdein",$new_tab) : "";
					echo !empty($options['yt_id']) ? self::makeli($options['yt_id'],"rhea-icon-youtube","You Tube",$new_tab) : "";
					echo !empty($options['vimeo_id']) ? self::makeli($options['vimeo_id'],"rhea-icon-vimeo","Vimeo",$new_tab) : "";
					echo !empty($options['flickr_id']) ? self::makeli($options['flickr_id'],"rhea-icon-flickr","Flickr",$new_tab) : "";
					echo !empty($options['pinterest_id']) ? self::makeli($options['pinterest_id'],"rhea-icon-pinterest","Pinterest",$new_tab) : "";
					echo !empty($options['tumblr_id']) ? self::makeli($options['tumblr_id'],"rhea-icon-tumblr","Tumblr",$new_tab) : "";
					echo !empty($options['stu_id']) ? self::makeli($options['stu_id'],"rhea-icon-stumbleupon","Stumble Upon",$new_tab) : "";
					echo !empty($options['insta_id']) ? self::makeli($options['insta_id'],"rhea-icon-instagram","Instagram",$new_tab) : "";
					echo !empty($options['scloud_id']) ? self::makeli($options['scloud_id'],"rhea-icon-soundcloud","SoundCloud",$new_tab) : "";
					echo !empty($options['evernote_id']) ? self::makeli($options['evernote_id'],"rhea-icon-evernote","Evernote",$new_tab) : "";
					echo !empty($options['blogger_id']) ? self::makeli($options['blogger_id'],"rhea-icon-blogger","Blogger",$new_tab) : "";
					echo !empty($options['lastfm_id']) ? self::makeli($options['lastfm_id'],"rhea-icon-lastfm","LastFm",$new_tab) : "";
					echo !empty($options['vk_id']) ? self::makeli($options['vk_id'],"rhea-icon-vk","vkontka",$new_tab) : "";
					echo !empty($options['xing_id']) ? self::makeli($options['xing_id'],"rhea-icon-xing","Xing",$new_tab) : "";
					echo !empty($options['dribbble_id']) ? self::makeli($options['dribbble_id'],"rhea-icon-dribbble","Dribbble",$new_tab) : "";
					echo !empty($options['github_id']) ? self::makeli($options['github_id'],"rhea-icon-github-circled","Github",$new_tab) : "";	
					echo !empty($options['buffer_id']) ? self::makeli($options['buffer_id'],"rhea-icon-buffer","Buffer",$new_tab) : "";
					echo !empty($options['delicious_id']) ? self::makeli($options['delicious_id'],"rhea-icon-delicious","Delicious",$new_tab) : "";
					//echo !empty($options['skype_id']) ? self::makeli($options['skype_id'],"rhea-icon-skype","Skype") : "";
					echo !empty($options['wp_id']) ? self::makeli($options['wp_id'],"rhea-icon-wordpress","Wordpress",$new_tab) : "";
					echo !empty($options['drupal_id']) ? self::makeli($options['drupal_id'],"rhea-icon-drupal","Drupal",$new_tab) : "";
					echo !empty($options['reddit_id']) ? self::makeli($options['reddit_id'],"rhea-icon-reddit","Reddit",$new_tab) : "";
					echo !empty($options['digg_id']) ? self::makeli($options['digg_id'],"rhea-icon-digg","Digg",$new_tab) : "";
					echo !empty($options['behance_id']) ? self::makeli($options['behance_id'],"rhea-icon-behance","Behance",$new_tab) : "";
					echo !empty($options['forrst_id']) ? self::makeli($options['forrst_id'],"rhea-icon-forrst","Delicious",$new_tab) : "";
					echo !empty($options['devart_id']) ? self::makeli($options['devart_id'],"rhea-icon-deviantart","DeviantArt",$new_tab) : "";
					echo !empty($options['email_id']) ? self::makeli($options['email_id'],"rhea-icon-email","Email",$new_tab) : "";					
					echo !empty($options['rss_id']) ? self::makeli($options['rss_id'],"rhea-icon-rss","RSS Feeds",$new_tab) : "";
				?>
            </ul>
            <?php
		}

		private static function makeli($id,$class,$title,$new_tab){
			echo "<li><span class='thea-ibox'><a href='".$id."' title='".$title."' class='".$class."' target='_blank' ></a></span></li>";
		}
		
		public static function get_followers($network,$id,$opts=null){
			switch($network){				
				case "rss" :
					$c = self::get_rss_count($id);
				break;
				case "facebook" :
					$c =  self::get_fb_likes($id);
				break;
				case "twitter" :
					$c =  self::get_twitter_followers($id,$opts);
				break;
				case "youtube" :
					$c =  self::get_yt_subs($id);
				break;
				case "vimeo" :
					$c =  self::get_vimeo_subs($id);
				break;
				case "instagram" :
					$c =  self::get_instagram_followers($id,$opts);
				break;
				case "soundcloud" :
					$c =  self::get_soundcloud_followers($id,$opts);
				break;
				case "dribbble" :
					$c =  self::get_dribbble_followers($id);
				break;
				case "behance" :
					$c =  self::get_behance_followers($id,$opts);
				break;
			}
			return number_format(intval($c));
		}
		
		//all counters
		private static function remote_get($url){
			$get= wp_remote_get( $url , array( 'timeout' => 18 , 'sslverify' => false ) );
			$request = wp_remote_retrieve_body( $get);
			return $request;	
		}
		
		private static function get_gen_count($key){
			
		} 
		
		private static function get_fb_likes($id){
			$fbc = get_transient(RHEAAIO.'fb_count');
			if(empty($fbc)){
				try{
					$pageID = $id;
					$info = json_decode(file_get_contents('http://graph.facebook.com/' . $pageID));
					$fbc =  $info->likes;
				}
				catch(Exception $e){
					$fbc = 0;
				}
				if(!empty($fbc)){
					set_transient( RHEAAIO.'fb_count' , $fbc , 1200);
					if ( get_option( RHEAAIO.'fb_count') != $fbc ){
						update_option( RHEAAIO.'fb_count' , $fbc );
					}
				}
				if( $fbc == 0 && get_option(  RHEAAIO.'fb_count') ){
					$fbc = get_option(  RHEAAIO.'fb_count');
				}					
				elseif( $fbc == 0 && !get_option(  RHEAAIO.'fb_count') ){
					$fbc = 0;
				}
			}
			return $fbc;
		}
		
		
		private static function get_twitter_followers($screen_name,$app){
			/*$data = file_get_contents("https://cdn.api.twitter.com/1/users/lookup.json?screen_name=" . $screen_name);
			$data = json_decode($data, true);
			return $data[0]["followers_count"];*/			
			$key = "twitter_followers_count";
			$f_count = get_transient(RHEAAIO.$key);
			if(empty($f_count)){
				try{
					$settings = array(
						'oauth_access_token' => $app['access_token'],
						'oauth_access_token_secret' => $app['access_secret'],
						'consumer_key' => $app['consumer_key'],
						'consumer_secret' => $app['consumer_secret']
					);
					$url = 'https://api.twitter.com/1.1/users/show.json';
					$getfield = '?screen_name='.$screen_name;
					$requestMethod = 'GET';
					$twitter = new TwitterAPIExchange($settings);
					$jsonTweeter= $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
					$tweetsfollowers = json_decode($jsonTweeter,true);
					//print_r($tweetsfollowers);
					$f_count = $tweetsfollowers['followers_count'];
				}
				catch(Exception $e){
					$f_count = 0;
				}
				if(!empty($f_count)){
					set_transient( RHEAAIO.$key , $f_count , 1200);
					if ( get_option( RHEAAIO.$key) != $f_count ){
						update_option( RHEAAIO.$key , $f_count );
					}
				}
				if( $f_count == 0 && get_option(  RHEAAIO.$key) ){
					$f_count = get_option(  RHEAAIO.$key);
				}					
				elseif( $f_count == 0 && !get_option(  RHEAAIO.$key) ){
					$f_count = 0;
				}
			}
			return $f_count;	
		}
		
		private static function get_rss_count($id){			
			$key = "rss_count";
			$f_count = get_transient(RHEAAIO.$key);
			if(empty($f_count)){
				try{
					$fburl="https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=http://feeds.feedburner.com/".$id;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_URL, $fburl);
					$stored = curl_exec($ch);
					curl_close($ch);
					$grid = new SimpleXMLElement($stored);
					$rsscount = $grid->feed->entry['circulation'];
					$f_count = $rsscount;
				}
				catch(Exception $e){
					$f_count = 0;
				}
				if(!empty($f_count)){
					set_transient( RHEAAIO.$key , $f_count , 1200);
					if ( get_option( RHEAAIO.$key) != $f_count ){
						update_option( RHEAAIO.$key , $f_count );
					}
				}
				if( $f_count == 0 && get_option(  RHEAAIO.$key) ){
					$f_count = get_option(  RHEAAIO.$key);
				}					
				elseif( $f_count == 0 && !get_option(  RHEAAIO.$key) ){
					$f_count = 0;
				}
			}
			return $f_count;	
		}
		
		private static function get_yt_subs($id){				
			$f_count = get_transient(RHEAAIO.'yt_subs');
			if(empty($f_count)){
				try{
					$data = file_get_contents('http://gdata.youtube.com/feeds/api/users/'.$id.'?alt=json');
					$data = json_decode($data, true);
					$stats_data = $data['entry']['yt$statistics'];
					$f_count =  $stats_data['subscriberCount'];
				}
				catch(Exception $e){
					$f_count = 0;
				}
				if(!empty($f_count)){
					set_transient( RHEAAIO.'yt_subs' , $f_count , 1200);
					if ( get_option( RHEAAIO.'yt_subs') != $f_count ){
						update_option( RHEAAIO.'yt_subs' , $f_count );
					}
				}
				if( $f_count == 0 && get_option(  RHEAAIO.'yt_subs') ){
					$f_count = get_option(  RHEAAIO.'yt_subs');
				}					
				elseif( $f_count == 0 && !get_option(  RHEAAIO.'yt_subs') ){
					$f_count = 0;
				}
			}
			return $f_count;
		}
		private static function get_vimeo_subs($id){			
			$key = "vimeo_subs";
			$f_count = get_transient(RHEAAIO.$key);
			if(empty($f_count)){
				try{
					@$data = @json_decode(self::remote_get( 'http://vimeo.com/api/v2/channel/' . $id  .'/info.json'));			
					$vimeo = $data->total_subscribers;
					$f_count =  $vimeo;
				}
				catch(Exception $e){
					$f_count = 0;
				}
				if(!empty($f_count)){
					set_transient( RHEAAIO.$key , $f_count , 1200);
					if ( get_option( RHEAAIO.$key) != $f_count ){
						update_option( RHEAAIO.$key , $f_count );
					}
				}
				if( $f_count == 0 && get_option(  RHEAAIO.$key) ){
					$f_count = get_option(  RHEAAIO.$key);
				}					
				elseif( $f_count == 0 && !get_option(  RHEAAIO.$key) ){
					$f_count = 0;
				}
			}
			return $f_count;
		}
		private static function get_instagram_followers($id,$api){					
			$key = "instagram_count";
			$f_count = get_transient(RHEAAIO.$key);
			if(empty($f_count)){
				try{
					$username = explode(".", $api);
					$userinfo = self::remote_get("https://api.instagram.com/v1/users/".$username[0]."?access_token=$api");
					$userinfo = json_decode($userinfo);			
					$followers = $userinfo->data->counts->followed_by;
					//print_r($userinfo);			
					$f_count = $followers;
				}
				catch(Exception $e){
					$f_count = 0;
				}
				if(!empty($f_count)){
					set_transient( RHEAAIO.$key , $f_count , 1200);
					if ( get_option( RHEAAIO.$key) != $f_count ){
						update_option( RHEAAIO.$key , $f_count );
					}
				}
				if( $f_count == 0 && get_option(  RHEAAIO.$key) ){
					$f_count = get_option(  RHEAAIO.$key);
				}					
				elseif( $f_count == 0 && !get_option(  RHEAAIO.$key) ){
					$f_count = 0;
				}
			}
			return $f_count;
		}
		
		private static function get_dribbble_followers($id){			
			$key = "dribbb_count";
			$f_count = get_transient(RHEAAIO.$key);
			if(empty($f_count)){
				try{
					$fburl="http://api.dribbble.com/players/".$id;
					$stored = self::remote_get($fburl);
					$data = json_decode($stored);			
					$dribbble = $data->followers_count;		
					//print_r($data);
					$f_count =  $dribbble;
				}
				catch(Exception $e){
					$f_count = 0;
				}
				if(!empty($f_count)){
					set_transient( RHEAAIO.$key , $f_count , 1200);
					if ( get_option( RHEAAIO.$key) != $f_count ){
						update_option( RHEAAIO.$key , $f_count );
					}
				}
				if( $f_count == 0 && get_option(  RHEAAIO.$key) ){
					$f_count = get_option(  RHEAAIO.$key);
				}					
				elseif( $f_count == 0 && !get_option(  RHEAAIO.$key) ){
					$f_count = 0;
				}
			}
			return $f_count;
		}
		private static function get_soundcloud_followers($id,$api){			
			$key = "soundcloud_count";
			$f_count = get_transient(RHEAAIO.$key);
			if(empty($f_count)){
				try{
					$userinfo = file_get_contents("http://api.soundcloud.com/users/$id.json?consumer_key=$api");
					$data = json_decode($userinfo);			
					$followers = $data->followers_count;			
					$f_count =  $followers;
				}
				catch(Exception $e){
					$f_count = 0;
				}
				if(!empty($f_count)){
					set_transient( RHEAAIO.$key , $f_count , 1200);
					if ( get_option( RHEAAIO.$key) != $f_count ){
						update_option( RHEAAIO.$key , $f_count );
					}
				}
				if( $f_count == 0 && get_option(  RHEAAIO.$key) ){
					$f_count = get_option(  RHEAAIO.$key);
				}					
				elseif( $f_count == 0 && !get_option(  RHEAAIO.$key) ){
					$f_count = 0;
				}
			}
			return $f_count;
		}
		private static function get_behance_followers($id,$api){			
			$key = "behance_count";
			$f_count = get_transient(RHEAAIO.$key);
			if(empty($f_count)){
				try{
					$data = json_decode(self::remote_get("http://www.behance.net/v2/users/$id?api_key=$api"),true);
					$behance = (int) $data['user']['stats']['followers'];						
					$f_count =  $behance;
				}
				catch(Exception $e){
					$f_count = 0;
				}
				if(!empty($f_count)){
					set_transient( RHEAAIO.$key , $f_count , 1200);
					if ( get_option( RHEAAIO.$key) != $f_count ){
						update_option( RHEAAIO.$key , $f_count );
					}
				}
				if( $f_count == 0 && get_option(  RHEAAIO.$key) ){
					$f_count = get_option(  RHEAAIO.$key);
				}					
				elseif( $f_count == 0 && !get_option(  RHEAAIO.$key) ){
					$f_count = 0;
				}
			}
			return $f_count;	
		}


	}//end of class
}				
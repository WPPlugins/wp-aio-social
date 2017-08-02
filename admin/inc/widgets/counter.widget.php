<?php

/*======================Facebook widget ================*/





Class RheaWidget_counter extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'social-counter-widget', 'description' => 'Social Counter Widget for wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'social-counter-widget' );

		$this->WP_Widget( 'social-counter-widget',RHEASN.' - Social Counter Widget ', $widget_ops, $control_ops );		

	}



	public function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		if(!empty($title)){

			echo $before_title;

			echo $title ; 

			echo $after_title;

		}
		
		//$rss = $instance['rss_id'];

		$fb = $instance['fb_id'];
		
		$youtube = $instance['yt_id'];
		
		$vimeo = $instance['vimeo_id'];	
		
		$twitter = $instance['twit_id'];
		
		$twitter_at = $instance['twit_access_token'];
		$twitter_as = $instance['twit_access_secret'];
		$twitter_ck = $instance['twit_consumer_key'];		
		$twitter_cs = $instance['twit_consumer_secret'];
		$tapp = array('access_token'=>$twitter_at,'access_secret'=>$twitter_as,'consumer_key'=>$twitter_ck,'consumer_secret'=>$twitter_cs);
		
		$instagram = $instance['insta_id'];
		$instagram_api = $instance['insta_key'];
		
		$soundcloud = $instance['scloud_id'];
		$soundcloud_api = $instance['scloud_key'];
		
		$dribbble = $instance['dribbble_id'];
		
		$behance = $instance['behance_id'];
		$behance_api = $instance['behance_key'];
		
		
		$new_window = @$instance['new_window'];
		
		
		$new_tab = empty($new_window) ? '' : 'target="_blank" '; 

		$hide_credit = isset($instance['hide_credit']) ? true : false ;			

		?>

       <div class="rhea-widget social-counter-widget">
			<ul>
            	
                <?php if( $fb ): ?>
                    <li class="fb-fans">
                        <a href="http://facebook.com/<?php echo $fb; ?>"<?php echo $new_tab; ?>>
                            <strong class="rhea-icon-facebook"></strong>
                            <span><?php echo RheaWidgets::get_followers("facebook",$fb) ?></span>
                            <small><?php _e('Fans' , 'thea' ) ?></small>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( $twitter ): ?>
                    <li class="twitter-fans">
                        <a href="http://twitter.com/<?php echo $twitter; ?>"<?php echo $new_tab; ?>>
                            <strong class="rhea-icon-twitter"></strong>
                            <span><?php echo RheaWidgets::get_followers("twitter",$twitter,$tapp) ?></span>
                            <small><?php _e('Followers' , 'thea' ) ?></small>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( $youtube ): ?>
                    <li class="youtube-subs">
                        <a href="http://youtube.com/<?php echo $youtube; ?>"<?php echo $new_tab; ?>>
                            <strong class="rhea-icon-youtube"></strong>
                            <span><?php echo RheaWidgets::get_followers("youtube",$youtube) ?></span>
                            <small><?php _e('Subscribers' , 'thea' ) ?></small>
                        </a>
                    </li>
                <?php endif; ?>
                 <?php if( $vimeo ): ?>
                    <li class="vimeo-subs">
                        <a href="http://vimeo.com/channels/<?php echo $vimeo; ?>"<?php echo $new_tab; ?>>
                            <strong class="rhea-icon-vimeo"></strong>
                            <span><?php echo RheaWidgets::get_followers("vimeo",$vimeo) ?></span>
                            <small><?php _e('Subscribers' , 'thea' ) ?></small>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( $instagram ): ?>
                    <li class="instagram-followers">
                        <a href="http://instagram.com/<?php echo $instagram; ?>"<?php echo $new_tab; ?>>
                            <strong class="rhea-icon-instagram"></strong>
                            <span><?php echo RheaWidgets::get_followers("instagram",$instagram,$instagram_api) ?></span>
                            <small><?php _e('Followers' , 'thea' ) ?></small>
                        </a>
                    </li>
                <?php endif; ?>
                 <?php if( $soundcloud ): ?>
                    <li class="soundcloud-followers">
                        <a href="http://soundcloud.com/<?php echo $soundcloud; ?>"<?php echo $new_tab; ?>>
                            <strong class="rhea-icon-soundcloud"></strong>
                            <span><?php echo RheaWidgets::get_followers("soundcloud",$soundcloud,$soundcloud_api) ?></span>
                            <small><?php _e('Followers' , 'thea' ) ?></small>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( $dribbble ): ?>
                    <li class="dribbble-followers">
                        <a href="http://dribbble.com/<?php echo $dribbble; ?>"<?php echo $new_tab; ?>>
                            <strong class="rhea-icon-dribbble"></strong>
                            <span><?php echo RheaWidgets::get_followers("dribbble",$dribbble) ?></span>
                            <small><?php _e('Followers' , 'thea' ) ?></small>
                        </a>
                    </li>
                <?php endif; ?>
                 <?php if( $behance ): ?>
                    <li class="behance-followers">
                        <a href="http://behance.net/<?php echo $behance; ?>"<?php echo $new_tab; ?>>
                            <strong class="rhea-icon-behance"></strong>
                            <span><?php echo RheaWidgets::get_followers("behance",$behance,$behance_api) ?></span>
                            <small><?php _e('Followers' , 'thea' ) ?></small>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if(!$hide_credit): ?>   		
	        	<small><em class="credit">Developed by <a href="http://designaeon.com" target="_blank">Design Aeon</a></em></small>
            <?php endif; ?>       
       </div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __(' Followers', 'rhea'),"rss_id"=>"","fb_id"=>"" ,"yt_id"=>"","vimeo_id"=>"","twit_id"=>"","twit_access_token"=>"","twit_access_secret"=>"","twit_consumer_key"=>"","twit_consumer_secret"=>"","insta_id"=>"","insta_key"=>"","scloud_id"=>"","scloud_key"=>"","dribbble_id"=>"","behance_id"=>"","behance_key"=>"");

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
        
        
        
        <p>
			<label for="<?php echo $this->get_field_id( 'fb_id' ); ?>">Facebook ID : </label>
			<input id="<?php echo $this->get_field_id( 'fb_id' ); ?>" name="<?php echo $this->get_field_name( 'fb_id' ); ?>" value="<?php echo $instance['fb_id']; ?>" class="widefat" type="text" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'yt_id' ); ?>">Youtube ID : </label>
			<input id="<?php echo $this->get_field_id( 'yt_id' ); ?>" name="<?php echo $this->get_field_name( 'yt_id' ); ?>" value="<?php echo $instance['yt_id']; ?>" class="widefat" type="text" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id( 'vimeo_id' ); ?>">Vimeo ID : </label>
			<input id="<?php echo $this->get_field_id( 'vimeo_id' ); ?>" name="<?php echo $this->get_field_name( 'vimeo_id' ); ?>" value="<?php echo $instance['vimeo_id']; ?>" class="widefat" type="text" />
		</p>
         
       <hr />
       <h3>Twitter</h3>

       <p>
			<label for="<?php echo $this->get_field_id( 'twit_id' ); ?>">Twitter ID : </label>
			<input id="<?php echo $this->get_field_id( 'twit_id' ); ?>" name="<?php echo $this->get_field_name( 'twit_id' ); ?>" value="<?php echo $instance['twit_id']; ?>" class="widefat" type="text" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twit_access_token' ); ?>">Twitter Access Token : </label>
			<input id="<?php echo $this->get_field_id( 'twit_access_token' ); ?>" name="<?php echo $this->get_field_name( 'twit_access_token' ); ?>" value="<?php echo $instance['twit_access_token']; ?>" class="widefat" type="text" />
		</p>

         <p>
			<label for="<?php echo $this->get_field_id( 'twit_access_secret' ); ?>">Twitter Access Secret : </label>
			<input id="<?php echo $this->get_field_id( 'twit_access_secret' ); ?>" name="<?php echo $this->get_field_name( 'twit_access_secret' ); ?>" value="<?php echo $instance['twit_access_secret']; ?>" class="widefat" type="text" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'twit_consumer_key' ); ?>">Twitter Consumer Key : </label>
			<input id="<?php echo $this->get_field_id( 'twit_consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'twit_consumer_key' ); ?>" value="<?php echo $instance['twit_consumer_key']; ?>" class="widefat" type="text" />
		</p>

         <p>
			<label for="<?php echo $this->get_field_id( 'twit_consumer_secret' ); ?>">Twitter Consumer Secret : </label>
			<input id="<?php echo $this->get_field_id( 'twit_consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'twit_consumer_secret' ); ?>" value="<?php echo $instance['twit_consumer_secret']; ?>" class="widefat" type="text" />
		</p>
        
        <hr />
        
        <h3>Instagram</h3>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'insta_id' ); ?>">Instagram ID : </label>
			<input id="<?php echo $this->get_field_id( 'insta_id' ); ?>" name="<?php echo $this->get_field_name( 'insta_id' ); ?>" value="<?php echo $instance['insta_id']; ?>" class="widefat" type="text" />
		</p>
        <small> Get Your Instagram Id Here : <a href="http://jelled.com/instagram/lookup-user-id" target="_blank">http://jelled.com/instagram/lookup-user-id</a></small>
        
         <p>
			<label for="<?php echo $this->get_field_id( 'insta_key' ); ?>">Instagram Access Token : </label>
			<input id="<?php echo $this->get_field_id( 'insta_key' ); ?>" name="<?php echo $this->get_field_name( 'insta_key' ); ?>" value="<?php echo $instance['insta_key']; ?>" class="widefat" type="text" />
		</p>
        <hr />
        <h3>Soundcloud</h3>
         <p>
			<label for="<?php echo $this->get_field_id( 'scloud_id' ); ?>">SoundCloud ID : </label>
			<input id="<?php echo $this->get_field_id( 'scloud_id' ); ?>" name="<?php echo $this->get_field_name( 'scloud_id' ); ?>" value="<?php echo $instance['scloud_id']; ?>" class="widefat" type="text" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id( 'scloud_key' ); ?>">SoundCloud Client ID : </label>
			<input id="<?php echo $this->get_field_id( 'scloud_key' ); ?>" name="<?php echo $this->get_field_name( 'scloud_key' ); ?>" value="<?php echo $instance['scloud_key']; ?>" class="widefat" type="text" />
		</p>
        <hr />
        <h3>Dribbble</h3>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'dribbble_id' ); ?>">Dribbble ID : </label>
			<input id="<?php echo $this->get_field_id( 'dribbble_id' ); ?>" name="<?php echo $this->get_field_name( 'dribbble_id' ); ?>" value="<?php echo $instance['dribbble_id']; ?>" class="widefat" type="text" />
		</p>
        
        <!-- <p>
			<label for="<?php //echo $this->get_field_id( 'dribbble_key' ); ?>">Dribbble Client ID/API key : </label>
			<input id="<?php //echo $this->get_field_id( 'dribbble_key' ); ?>" name="<?php //echo $this->get_field_name( 'dribbble_key' ); ?>" value="<?php //echo $instance['dribbble_key']; ?>" class="widefat" type="text" />
		</p>-->
        <hr />
        
        <h3>Behance</h3>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'behance_id' ); ?>">Behance ID : </label>
			<input id="<?php echo $this->get_field_id( 'behance_id' ); ?>" name="<?php echo $this->get_field_name( 'behance_id' ); ?>" value="<?php echo $instance['behance_id']; ?>" class="widefat" type="text" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id( 'behance_key' ); ?>">Behance Client ID/API key : </label>
			<input id="<?php echo $this->get_field_id( 'behance_key' ); ?>" name="<?php echo $this->get_field_name( 'behance_key' ); ?>" value="<?php echo $instance['behance_key']; ?>" class="widefat" type="text" />
		</p>
        <hr />
		<p>			

			<input id="<?php echo $this->get_field_id( 'hide_credit' ); ?>" name="<?php echo $this->get_field_name( 'hide_credit' ); ?>" value="true" <?php if( @$instance['hide_credit'] ) echo 'checked="checked"'; ?> type="checkbox" />

			<label for="<?php echo $this->get_field_id( 'hide_credit' ); ?>">Hide Credit  </label>

        </p> 
      

        <?php		

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		
		//$instance['rss_id'] = strip_tags($new_instance['rss_id']);
		$instance['fb_id'] = strip_tags($new_instance['fb_id']);
		$instance['yt_id'] = strip_tags($new_instance['yt_id']);
		$instance['vimeo_id'] = strip_tags($new_instance['vimeo_id']);
		$instance['twit_id'] = strip_tags($new_instance['twit_id']);
		$instance['twit_access_token'] = strip_tags($new_instance['twit_access_token']);
		$instance['twit_access_secret'] = strip_tags($new_instance['twit_access_secret']);
		$instance['twit_consumer_key'] = strip_tags($new_instance['twit_consumer_key']);
		$instance['twit_consumer_secret'] = strip_tags($new_instance['twit_consumer_secret']);
		
		$instance['insta_id'] = strip_tags($new_instance['insta_id']);
		$instance['insta_key'] = strip_tags($new_instance['insta_key']);
		
		$instance['scloud_id'] = strip_tags($new_instance['scloud_id']);
		$instance['scloud_key'] = strip_tags($new_instance['scloud_key']);
		
		$instance['dribbble_id'] = strip_tags($new_instance['dribbble_id']);
		
		$instance['behance_id'] = strip_tags($new_instance['behance_id']);
		$instance['behance_key'] = strip_tags($new_instance['behance_key']);
		
		$instance['new_window'] = strip_tags($new_instance['new_window']);
		
		$keys = array(RHEAAIO.'fb_count',RHEAAIO.'twitter_followers_count',RHEAAIO.'rss_count',RHEAAIO.'yt_subs',RHEAAIO.'vimeo_subs',RHEAAIO.'instagram_count',RHEAAIO.'dribbb_count',RHEAAIO.'soundcloud_count',RHEAAIO.'behance_count');
		
		foreach($keys as $key){
			delete_transient($key);
		}
		$instance['hide_credit'] = strip_tags( $new_instance['hide_credit'] );			

		return $instance;

	}	

}
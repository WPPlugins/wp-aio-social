<?php

/*======================Social Icons widget ================*/





Class RheaWidget_socialicons extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-socialicons-widget', 'description' => 'Social Icon Widget for wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-socialicons-widget' );

		$this->WP_Widget( 'rhea-socialicons-widget',RHEASN .' - Social Icons ', $widget_ops, $control_ops );		

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
			$icons = array(
			"fb_id" => "Facebook",
			"gplus_id" => "Google Plus",
			"twit_id" => "Twitter",
			"linkdin_id" => "Linkdin",
			"yt_id" => "YouTube",
			"vimeo_id" => "Vimeo",
			"flickr_id" => "Flickr",
			"pinterest_id" => "Pinterest",
			"tumblr_id" => "Tumblr",
			"stu_id" => "StumbleUpon",
			"insta_id" => "Instagram",
			"scloud_id" => "SoundCloud",
			"evernote_id" => "Evernote",
			"blogger_id" => "Blogger",
			"lastfm_id" => "LastFm",
			"vk_id" => "VKontka",
			"xing_id" => "Xing",
			"dribbble_id" => "Dribbble",
			"github_id" => "GitHub",
			"buffer_id" => "Buffer",
			"delicious_id" => "Delicious",
			"wp_id" => "Wordpress",
			"drupal_id" => "Drupal",
			"reddit_id" => "Reddit",
			"insta_id" => "Instagram",
			"digg_id" => "Digg",
			"behance_id" => "Behance",
			"forrst_id" => "Forrst",
			"devart_id" => "Deviant Art",
			"email_id" => "Email",
			"rss_id" => "RSS"
		);
		$allIcons = array();	
		foreach($icons as $k=>$icon){
			//$sicon = !empty($instance[$k]) ? $instance[$k] : "i16" ;
			if(!empty($instance[$k])){
				//array_push($allIcons,$instance[$k]);
				$allIcons[$k] = $instance[$k];	
			} 			
		}
		//print_r($instance);
			$size = !empty($instance['font_size']) ? $instance['font_size'] : "i16" ; 	
			$size = "";
			$new_tab = empty($new_window) ? '' : 'target="_blank" ';
		?>

        <div class="rhea-widget socialIcons-widget">        	

      		<?php 

				RheaWidgets::socialIcons($allIcons,$size,$new_tab);

			?>

       </div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __(' Socialize', 'cronos-framework') ,'font_size'=>'i32');

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>        

     	<!--<p>

			<label for="<?php echo $this->get_field_id( 'font_size' ); ?>">Size : </label>

			<select id="<?php echo $this->get_field_id( 'font_size' ); ?>" name="<?php echo $this->get_field_name( 'font_size' ); ?>" class="widefat" >

            <option value="i16" <?php if($instance['font_size']=="i16"){echo "selected='selected'";} ?>>16px</option>

             <option value="i24" <?php if($instance['font_size']=="i24"){echo "selected='selected'";} ?>>24px</option>

              <option value="i32" <?php if($instance['font_size']=="i32"){echo "selected='selected'";} ?>>32px</option>

            </select>

		</p> --> 

        <?php	
		$icons = array(
			"fb_id" => "Facebook",
			"gplus_id" => "Google Plus",
			"twit_id" => "Twitter",
			"linkdin_id" => "Linkdin",
			"yt_id" => "YouTube",
			"vimeo_id" => "Vimeo",
			"flickr_id" => "Flickr",
			"pinterest_id" => "Pinterest",
			"tumblr_id" => "Tumblr",
			"stu_id" => "StumbleUpon",
			"insta_id" => "Instagram",
			"scloud_id" => "SoundCloud",
			"evernote_id" => "Evernote",
			"blogger_id" => "Blogger",
			"lastfm_id" => "LastFm",
			"vk_id" => "VKontka",
			"xing_id" => "Xing",
			"dribbble_id" => "Dribbble",
			"github_id" => "GitHub",
			"buffer_id" => "Buffer",
			"delicious_id" => "Delicious",
			"wp_id" => "Wordpress",
			"drupal_id" => "Drupal",
			"reddit_id" => "Reddit",
			"insta_id" => "Instagram",
			"digg_id" => "Digg",
			"behance_id" => "Behance",
			"forrst_id" => "Forrst",
			"devart_id" => "Deviant Art",
			"email_id" => "Email",
			"rss_id" => "RSS"
		);	
		foreach($icons as $k=>$icon){
			?>
            <p>
			<label for="<?php echo $this->get_field_id( $k ); ?>"><?php echo $icon ?> URL : </label>
			<input id="<?php echo $this->get_field_id( $k ); ?>" name="<?php echo $this->get_field_name($k); ?>" value="<?php echo @$instance[$k]; ?>" class="widefat" type="text" />
			</p>       
            <?php	
		}

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['font_size'] = strip_tags( $new_instance['font_size'] );		
		
		$icons = array(
			"fb_id" => "Facebook",
			"gplus_id" => "Google Plus",
			"twit_id" => "Twitter",
			"linkdin_id" => "Linkdin",
			"yt_id" => "YouTube",
			"vimeo_id" => "Vimeo",
			"flickr_id" => "Flickr",
			"pinterest_id" => "Pinterest",
			"tumblr_id" => "Tumblr",
			"stu_id" => "StumbleUpon",
			"insta_id" => "Instagram",
			"scloud_id" => "SoundCloud",
			"evernote_id" => "Evernote",
			"blogger_id" => "Blogger",
			"lastfm_id" => "LastFm",
			"vk_id" => "VKontka",
			"xing_id" => "Xing",
			"dribbble_id" => "Dribbble",
			"github_id" => "GitHub",
			"buffer_id" => "Buffer",
			"delicious_id" => "Delicious",
			"wp_id" => "Wordpress",
			"drupal_id" => "Drupal",
			"reddit_id" => "Reddit",
			"insta_id" => "Instagram",
			"digg_id" => "Digg",
			"behance_id" => "Behance",
			"forrst_id" => "Forrst",
			"devart_id" => "Deviant Art",
			"email_id" => "Email",
			"rss_id" => "RSS"
		);	
		foreach($icons as $k=>$icon){
			$instance[$k] = strip_tags( $new_instance[$k] );	
		}
		$instance['new_window'] = strip_tags($new_instance['new_window']);
		return $instance;

	}	

}
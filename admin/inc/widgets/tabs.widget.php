<?php

/*======================Twitter widget ================*/





Class RheaWidget_SocialTabs extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-social-tabs-widget', 'description' => 'Social Tabs Widget For wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-social-tabs-widget' );

		$this->WP_Widget( 'rhea-social-tabs-widget',RHEASN .' - Social Tabs ', $widget_ops, $control_ops );		

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
		$fb = !empty($instance['fb']) ? $instance['fb'] : 'http://facebook.com/designaeon/' ;			
		$gp_type = !empty($instance['gplus_btype']) ? $instance['gplus_btype'] : 'g-page' ;
		$gp_url = !empty($instance['gplus_url']) ? $instance['gplus_url'] : 'https://plus.google.com/+Designaeon/' ;
		
		$twit_uname = !empty($instance['twit_uname']) ? $instance['twit_uname'] : 'imramandeep' ;
		$twit_count = !empty($instance['twit_count']) ? $instance['twit_count'] : 5 ;
		?>

        <div class="rhea-widget tabs-widget">			
			<ul class="rhea-tabs">
            	<?php if(!empty($fb)): ?>
                	<li class="fb-tab"><a href="javascript:void(0);"><span class="rhea-icon-facebook"></span> Facebook</a></li>
                <?php endif; ?>
                <?php if(!empty($gp_url)): ?>
                	<li class="g-plus-tab"><a href="javascript:void(0);"><span class="rhea-icon-gplus"></span> Google+</a></li>
                <?php endif; ?>
                <?php if(!empty($twit_uname)): ?>
                	<li class="twitter-tab"><a href="javascript:void(0);"><span class="rhea-icon-twitter"></span> Twitter</a></li>
                <?php endif; ?>
            </ul>
            <div class="rhea-tabs-content">
            	<div class="rhea-tab-content">
                	<?php if(!empty($fb)): ?>
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $fb; ?>&amp;width=360&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=175431785895681" style="border:1px solid #e2e2e2;; overflow:hidden;width:100%;margin:0 auto;display:block; height:500px;"></iframe>
                    <?php endif; ?>
                </div>
            	<div class="rhea-tab-content">
                	<?php if(!empty($gp_url)): ?>
                        <div class="hidden-xs hidden-sm hidden-md">
                            <div class="<?php echo $gp_type; ?>" data-width="275" data-href="<?php echo $gp_url; ?>" data-layout="landscape" data-rel="author" data-theme="light" data-showcoverphoto="false" data-showtagline="false"></div>           
                        </div>
                
                        <div class="visible-md">            
                            <div class="<?php echo $gp_type; ?>" data-width=273 data-href="<?php echo $gp_url; ?>" data-layout="portrait" data-rel="author" data-theme="light" data-showcoverphoto="true" data-showtagline="false"></div> 
                       </div>
                
                       <div class="visible-sm">            
                            <div class="<?php echo $gp_type; ?>" data-width=250 data-href="<?php echo $gp_url; ?>" data-layout="portrait" data-rel="author" data-theme="light" data-showcoverphoto="true" data-showtagline="false"></div>            
                      </div>
                
                       <div class="visible-xs">            
                            <div class="<?php echo $gp_type; ?>" data-width=200 data-href="<?php echo $gp_url; ?>" data-layout="portrait" data-rel="author" data-theme="light" data-showcoverphoto="true" data-showtagline="false"></div>           
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="rhea-tab-content">
                	<?php if(!empty($twit_uname)): ?>
                    <div class="rhea-follow-btn">              
                       <iframe src="//platform.twitter.com/widgets/follow_button.html?screen_name=<?php echo $twit_uname; ?>"
      style="max-width:300px;width:100%; height:20px;border:none;"></iframe>
      				</div>
      
      					<?php	

							if($instance['twit_tweets']){			
								$settings=array('access_token'=>$instance['twit_access_token'],			
												'access_secret'=>$instance['twit_access_secret'],			
												'consumer_key'=>$instance['twit_consumer_key'],			
												'consumer_secret'=>$instance['twit_consumer_secret']);
			
								$tweets = RheaWidgets::get_tweets($twit_uname,$twit_count,$settings);			
								if(!isset($tweets['errors'])){			
									echo "<ul class='tweets'>";			
									foreach($tweets as $tweet){			
										echo "<li><span class='rhea-icon-twitter'></span><div class='rhea-text'>".preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $tweet['text'])."<span class='twitter-timestamp'>".date('M d Y',strtotime($tweet['created_at']))." </span></div></li>";			
									}			
									echo "</ul>";			
								}		
							}			
						?>
                    <?php endif; ?>
                </div>               
                 
            </div>
       	</div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __('Follow Us', 'rhea'),'fb'=>'http://facebook.com/designaeon','gplus_btype'=>'g-page','gplus_url'=>'https://plus.google.com/+Designaeon','twit_uname'=>'imramandeep','twit_tweets'=>'','twit_count'=>5,'twit_access_token'=>'','twit_access_secret'=>'','twit_consumer_key'=>'','twit_consumer_secret'=>'' );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'fb' ); ?>">Facebook ID : </label>
			<input id="<?php echo $this->get_field_id( 'fb' ); ?>" name="<?php echo $this->get_field_name( 'fb' ); ?>" value="<?php echo $instance['fb']; ?>" class="widefat" type="text" />
		</p>

       <p>

			<label for="<?php echo $this->get_field_id( 'gplus_type' ); ?>">Google+ Badge Type : </label>

			<select id="<?php echo $this->get_field_id( 'gplus_type' ); ?>" name="<?php echo $this->get_field_name( 'gplus_btype' ); ?>" value="<?php echo $instance['gplus_btype']; ?>" class="widefat" type="select" >

          	 <option  <?php if( $instance['gplus_btype']=='g-person' ) echo 'selected="selected"'; ?>  value="g-person">Person</option>

            <option  <?php if( $instance['gplus_btype']=='g-page' ) echo 'selected="seleted"'; ?> value="g-page">Page</option>           

            </select>

		</p>
        
        <p>

			<label for="<?php echo $this->get_field_id( 'gplus_url' ); ?>">Google+ URL : </label>

			<input id="<?php echo $this->get_field_id( 'gplus_url' ); ?>" name="<?php echo $this->get_field_name( 'gplus_url' ); ?>" value="<?php echo $instance['gplus_url']; ?>" class="widefat" type="text" />

		</p>
        
        <h3> Twitter</h3>
		
         <p>
			<label for="<?php echo $this->get_field_id( 'twit_uname' ); ?>">Twitter Username : </label>
			@<input id="<?php echo $this->get_field_id( 'twit_uname' ); ?>" name="<?php echo $this->get_field_name( 'twit_uname' ); ?>" value="<?php echo $instance['twit_uname']; ?>" class="" style="width:80px;" type="text" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'twit_tweets' ); ?>">Show Tweets : </label>
			<input id="<?php echo $this->get_field_id( 'twit_tweets' ); ?>" name="<?php echo $this->get_field_name( 'twit_tweets' ); ?>" value="true" <?php if($instance['twit_tweets']){echo "checked='checked'";}; ?> class="" style="" type="checkbox" />
		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'twit_count' ); ?>">Tweet Count : </label>

			<input id="<?php echo $this->get_field_id( 'twit_count' ); ?>" name="<?php echo $this->get_field_name( 'twit_count' ); ?>" value="<?php echo !empty($instance['twit_count'])  ? $instance['twit_count'] : 5 ; ?>" class="" type="text" />

		</p>

        <strong> App Specific (Required if Need to View Tweets)</strong>

        <hr />

       <p>

			<label for="<?php echo $this->get_field_id( 'twit_access_token' ); ?>"> Twitter Access Token : </label>

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
        <?php		

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fb'] = strip_tags( $new_instance['fb'] );
		
		$instance['gplus_type'] = strip_tags( $new_instance['gplus_type'] );
		$instance['gplus_url'] = strip_tags( $new_instance['gplus_url'] );		
		
		$instance['twit_uname'] = strip_tags( $new_instance['twit_uname'] );
		$instance['twit_tweets'] = strip_tags( $new_instance['twit_tweets'] );
		$instance['twit_count'] = strip_tags( $new_instance['twit_count'] );
		$instance['twit_access_token'] = strip_tags( $new_instance['twit_access_token'] );
		$instance['twit_access_secret'] = strip_tags( $new_instance['twit_access_secret'] );
		$instance['twit_consumer_key'] = strip_tags( $new_instance['twit_consumer_key'] );
		$instance['twit_consumer_secret'] = strip_tags( $new_instance['twit_consumer_secret'] );
		
		return $instance;

	}	

}
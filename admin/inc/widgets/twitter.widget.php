<?php

/*======================Twitter widget ================*/





Class RheaWidget_twitter extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-twitter-widget', 'description' => 'Twitter Widget For wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-twitter-widget' );

		$this->WP_Widget( 'rhea-twitter-widget',RHEASN .' - Twitter ', $widget_ops, $control_ops );		

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

		$uname = !empty($instance['uname']) ? $instance['uname'] : 'imramandeep' ;

		$count = !empty($instance['count']) ? $instance['count'] : 5 ;		

				

		?>

        <div class="rhea-widget twitter-widget">
			<div class="rhea-follow-btn">	
                <iframe src="//platform.twitter.com/widgets/follow_button.html?screen_name=<?php echo $uname; ?>"
      style="max-width:300px;width:100%; height:20px;border:none;"></iframe>
  			</div>

      		<?php	

				if($instance['tweets']){

					$settings=array('access_token'=>$instance['access_token'],

									'access_secret'=>$instance['access_secret'],

									'consumer_key'=>$instance['consumer_key'],

									'consumer_secret'=>$instance['consumer_secret']);

					$tweets = RheaWidgets::get_tweets($uname,$count,$settings);					

					if(!isset($tweets['errors'])){

						echo "<ul class='tweets'>";

						foreach($tweets as $tweet){

							echo "<li><span class='rhea-icon-twitter'></span><div class='rhea-text'>".preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $tweet['text'])."<span class='twitter-timestamp'>".date('M d Y',strtotime($tweet['created_at']))." </span></div></li>";	

						}

						echo "</ul>";

					}		

									

				}		

					

			?>

       </div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __('Follow me on Twitter', 'cronos-framework'),'uname'=>'imramandeep','tweets'=>'','access_token'=>'','access_secret'=>'','consumer_key'=>'','consumer_secret'=>'' );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'uname' ); ?>">Twitter Username : </label>

			@<input id="<?php echo $this->get_field_id( 'uname' ); ?>" name="<?php echo $this->get_field_name( 'uname' ); ?>" value="<?php echo $instance['uname']; ?>" class="" style="width:80px;" type="text" />

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'tweets' ); ?>">Show Tweets : </label>

			<input id="<?php echo $this->get_field_id( 'tweets' ); ?>" name="<?php echo $this->get_field_name( 'tweets' ); ?>" value="true" <?php if($instance['tweets']){echo "checked='checked'";}; ?> class="" style="" type="checkbox" />

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'count' ); ?>">Tweet Count : </label>

			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo !empty($instance['count'])  ? $instance['count'] : 5 ; ?>" class="" type="text" />

		</p>

        <strong> App Specific (Required if Need to View Tweets)</strong>

        <hr />

       <p>

			<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"> Access Token : </label>

			<input id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $instance['access_token']; ?>" class="widefat" type="text" />

		</p>

         <p>

			<label for="<?php echo $this->get_field_id( 'access_secret' ); ?>"> Access Secret : </label>

			<input id="<?php echo $this->get_field_id( 'access_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_secret' ); ?>" value="<?php echo $instance['access_secret']; ?>" class="widefat" type="text" />

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"> Consumer Key : </label>

			<input id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $instance['consumer_key']; ?>" class="widefat" type="text" />

		</p>

         <p>

			<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"> Consumer Secret : </label>

			<input id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $instance['consumer_secret']; ?>" class="widefat" type="text" />

		</p>

        <?php		

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['uname'] = strip_tags( $new_instance['uname'] );

		$instance['tweets'] = strip_tags( $new_instance['tweets'] );

		$instance['count'] = strip_tags( $new_instance['count'] );

		$instance['access_token'] = strip_tags( $new_instance['access_token'] );

		$instance['access_secret'] = strip_tags( $new_instance['access_secret'] );

		$instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );

		$instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );		

		

		return $instance;

	}	

}
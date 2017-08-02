<?php

/*======================Facebook widget ================*/





Class RheaWidget_fb extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-fb-widget', 'description' => 'Facebook Widget for wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-fb-widget' );

		$this->WP_Widget( 'rhea-fb-widget',RHEASN.' - Facebook Widget ', $widget_ops, $control_ops );		

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

		$header = $instance['fb_header'];

		$stream = $instance['fb_stream'];

		$faces = !$instance['fb_faces_hide'];

		$height = empty($instance['fb_height']) ? 590  : $instance['fb_height'] ;			

		?>

        <div class="rhea-widget fb-widget">

      <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $instance['fb_id']; ?>&amp;width=360&amp;height=590&amp;colorscheme=light&amp;show_faces=<?php echo $faces; ?>&amp;header=<?php echo $header; ?>&amp;stream=<?php echo $stream; ?>&amp;show_border=false&amp;appId=175431785895681" style="border:1px solid #e2e2e2;; overflow:hidden;width:100%;margin:0 auto;display:block; height:<?php echo $height; ?>px;"></iframe>

       </div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __(' Find us on facebook', 'cronos-framework') );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>

        <p>			

			<input id="<?php echo $this->get_field_id( 'fb_header' ); ?>" name="<?php echo $this->get_field_name( 'fb_header' ); ?>" value="true" <?php if( @$instance['fb_header'] ) echo 'checked="checked"'; ?> type="checkbox" />

			<label for="<?php echo $this->get_field_id( 'fb_header' ); ?>">Show Header  </label>

        </p>

        <p>			

			<input id="<?php echo $this->get_field_id( 'fb_stream' ); ?>" name="<?php echo $this->get_field_name( 'fb_stream' ); ?>" value="true" <?php if( @$instance['fb_stream'] ) echo 'checked="checked"'; ?> type="checkbox" />

			<label for="<?php echo $this->get_field_id( 'fb_stream' ); ?>">Show Stream  </label>

        </p>

        <p>			

			<input id="<?php echo $this->get_field_id( 'fb_faces_hide' ); ?>" name="<?php echo $this->get_field_name( 'fb_faces_hide' ); ?>" value="true" <?php if( @$instance['fb_faces_hide'] ) echo 'checked="checked"'; ?> type="checkbox" />

			<label for="<?php echo $this->get_field_id( 'fb_faces_hide' ); ?>">Hide Faces  </label>

        </p>

         <p>

			<label for="<?php echo $this->get_field_id( 'fb_height' ); ?>">Box Height(pixels) : </label>

			<input id="<?php echo $this->get_field_id( 'fb_height' ); ?>" name="<?php echo $this->get_field_name( 'fb_height' ); ?>" value="<?php echo @$instance['fb_height']; ?>" class="" type="text" />px

		</p>

       <p>

			<label for="<?php echo $this->get_field_id( 'fb_id' ); ?>">Your Facebook URL : </label>

			<input id="<?php echo $this->get_field_id( 'fb_id' ); ?>" name="<?php echo $this->get_field_name( 'fb_id' ); ?>" value="<?php echo @$instance['fb_id']; ?>" class="widefat" type="text" />

		</p>

      

        <?php		

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['fb_header'] = strip_tags( $new_instance['fb_header'] );

		$instance['fb_stream'] = strip_tags( $new_instance['fb_stream'] );

		$instance['fb_faces_hide'] = strip_tags( $new_instance['fb_faces_hide'] );

		$instance['fb_height'] = strip_tags( $new_instance['fb_height'] );

		$instance['fb_id'] = strip_tags( $new_instance['fb_id'] );

		return $instance;

	}	

}
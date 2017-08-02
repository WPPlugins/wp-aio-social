<?php

/*==============Soundcloud widget ================*/





Class RheaWidget_soundcloud extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-soundcloud-widget', 'description' => 'Soundcloud Widget For wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-soundcloud-widget' );

		$this->WP_Widget( 'rhea-soundcloud-widget',RHEASN .' - Soundcloud ', $widget_ops, $control_ops );		

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

		$ap = $instance['autoplay'] ? 'true' : 'false' ;	

				

		?>

        <div class="rhea-widget soundcloud-widget">

        	<iframe style="width:100%;border:none;overflow:hidden;" height="166" src="https://w.soundcloud.com/player/?url=<?php echo $instance['uri'] ?>&amp;auto_play=<?php echo $ap; ?>&amp;show_artwork=true"></iframe>      		

       </div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __('Soundcloud', 'cronos-framework'),'uri'=>'','autoplay'=>'' );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'uri' ); ?>">Soundcloud URL : </label>

			<input id="<?php echo $this->get_field_id( 'uri' ); ?>" name="<?php echo $this->get_field_name( 'uri' ); ?>" value="<?php echo $instance['uri']; ?>" class="widefat"  type="text" />

		</p>

         <p>			

			<input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="true" <?php if( $instance['autoplay'] ) echo 'checked="checked"'; ?> type="checkbox" />

			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>">Autoplay  </label>

        </p>

       

        

       

        <?php		

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['uri'] = strip_tags( $new_instance['uri'] );

		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );	

		return $instance;

	}	

}
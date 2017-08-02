<?php

/*======================Google Plus widget ================*/





Class RheaWidget_gplus extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-gplus-widget', 'description' => 'Google + Widget for wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-gplus-widget' );

		$this->WP_Widget( 'rhea-gplus-widget',RHEASN .' - Google+ Badge ', $widget_ops, $control_ops );		

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
		
		$type = $instance['gplus_btype'];

		$url = $instance['gplus_url'];

		$width = !empty($instance['gplus_width']) ? $instance['gplus_width'] : 300 ;

		$layout = $instance['layout'];

		$theme = $instance['theme'];

		$cover = !$instance['cover'];

		$tagline = !$instance['tagline'];;		

		?>

        <div class="rhea-widget gplus-widget">

      		<div class="hidden-xs hidden-sm hidden-md">

            <div class="<?php echo $type; ?>" data-width="<?php echo $width; ?>" data-href="<?php echo $url; ?>" data-layout="<?php echo $layout; ?>" data-rel="author" data-theme="<?php echo $theme; ?>" data-showcoverphoto="<?php echo $cover; ?>" data-showtagline="<?php echo $tagline; ?>"></div>            

            </div>

             <div class="visible-md">

            <div class="<?php echo $type; ?>" data-width=273 data-href="<?php echo $url; ?>" data-layout="<?php echo $layout; ?>" data-rel="author" data-theme="<?php echo $theme; ?>" data-showcoverphoto="<?php echo $cover; ?>" data-showtagline="<?php echo $tagline; ?>"></div>            

            </div>

            <div class="visible-sm">

            <div class="<?php echo $type; ?>" data-width=250 data-href="<?php echo $url; ?>" data-layout="portrait" data-rel="author" data-theme="<?php echo $theme; ?>" data-showcoverphoto="<?php echo $cover; ?>" data-showtagline="<?php echo $tagline; ?>"></div>            

            </div>

            <div class="visible-xs">

            <div class="<?php echo $type; ?>" data-width=200 data-href="<?php echo $url; ?>" data-layout="portrait" data-rel="author" data-theme="<?php echo $theme; ?>" data-showcoverphoto="<?php echo $cover; ?>" data-showtagline="<?php echo $tagline; ?>"></div>            

            </div>

       </div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __(' Follow Us on Google+', 'rhea'),'gplus_btype'=>'','gplus_url'=>'','gplus_width'=>'','layout'=>'landscape','theme'=>'light','tagline'=>'','cover'=>'' );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>

        
		   <p>

			<label for="<?php echo $this->get_field_id( 'gplus_btype' ); ?>">Badge Type : </label>

			<select id="<?php echo $this->get_field_id( 'gplus_btype' ); ?>" name="<?php echo $this->get_field_name( 'gplus_btype' ); ?>" value="<?php echo $instance['gplus_btype']; ?>" class="widefat" type="select" >

          	 <option  <?php if( $instance['gplus_btype']=='g-person' ) echo 'selected="selected"'; ?>  value="g-person">Person</option>

            <option  <?php if( $instance['gplus_btype']=='g-page' ) echo 'selected="seleted"'; ?> value="g-page">Page</option>           

            </select>

		</p>
        
        <p>

			<label for="<?php echo $this->get_field_id( 'gplus_url' ); ?>">Google+ URL : </label>

			<input id="<?php echo $this->get_field_id( 'gplus_url' ); ?>" name="<?php echo $this->get_field_name( 'gplus_url' ); ?>" value="<?php echo $instance['gplus_url']; ?>" class="widefat" type="text" />

		</p>

        

        <p>

			<label for="<?php echo $this->get_field_id( 'gplus_width' ); ?>">Google+ Badge width : </label>

			<input id="<?php echo $this->get_field_id( 'gplus_width' ); ?>" name="<?php echo $this->get_field_name( 'gplus_width' ); ?>" value="<?php echo $instance['gplus_width']; ?>" class="" type="text" />px

		</p>

        

        <p>

			<label for="<?php echo $this->get_field_id( 'layout' ); ?>">Layout : </label>

			<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" value="<?php echo $instance['layout']; ?>" class="widefat" type="select" >

          	 <option <?php if( $instance['layout']=='landscape' ) echo 'selected="selected"'; ?> value="landscape">Landscape</option>

            <option <?php if( $instance['layout']=='portrait' ) echo 'selected="selected"'; ?> value="portrait">Portrait</option>           

            </select>

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'theme' ); ?>">Theme : </label>

			<select id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>" value="<?php echo $instance['theme']; ?>" class="widefat" type="select" >

          	 <option  <?php if( $instance['theme']=='light' ) echo 'selected="selected"'; ?>  value="light">Light</option>

            <option  <?php if( $instance['theme']=='dark' ) echo 'selected="seleted"'; ?> value="dark">Dark</option>           

            </select>

		</p>

        <hr>

        <h5>Portrait Mode options</h5>

       <p>

       		<input id="<?php echo $this->get_field_id( 'cover' ); ?>" name="<?php echo $this->get_field_name( 'cover' ); ?>" value="true" <?php if( $instance['cover'] ) echo 'checked="checked"'; ?> type="checkbox" />

			<label for="<?php echo $this->get_field_id( 'cover' ); ?>">Disable Cover </label>		       

           

		</p>

       <p>

       		<input id="<?php echo $this->get_field_id( 'tagline' ); ?>" name="<?php echo $this->get_field_name( 'tagline' ); ?>" value="true" <?php if( $instance['tagline'] ) echo 'checked="checked"'; ?> type="checkbox" />

			<label for="<?php echo $this->get_field_id( 'tagline' ); ?>">Disable tagline </label>		       

           

		</p>

        <?php		

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['gplus_btype'] = strip_tags( $new_instance['gplus_btype'] );

		$instance['gplus_url'] = strip_tags( $new_instance['gplus_url'] );

		$instance['gplus_width'] = strip_tags( $new_instance['gplus_width'] );

		$instance['layout'] = strip_tags( $new_instance['layout'] );

		$instance['theme'] = strip_tags( $new_instance['theme'] );

		$instance['cover'] = strip_tags( $new_instance['cover'] );

		$instance['tagline'] = strip_tags( $new_instance['tagline'] );

		return $instance;

	}	

}
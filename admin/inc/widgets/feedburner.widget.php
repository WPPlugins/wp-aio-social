<?php

/*======================Subscribe widget ================*/





Class RheaWidget_subscribe extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-subscribe-widget', 'description' => 'Subscription Widget for wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-subscribe-widget' );

		$this->WP_Widget( 'rhea-subscribe-widget',RHEASN .' - Subscribe (Feedburner) ', $widget_ops, $control_ops );		

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

		$ID =  !empty($instance['feedburner_id']) ?  $instance['feedburner_id'] : "designaeon";

		$subbox_text = !empty($instance['subscribe_btn_text']) ? $instance['subscribe_btn_text'] : "Subscribe";

		$placeholder_text = !empty($instance['placeholder_text']) ? $instance['placeholder_text'] : "Please Enter your Email";
		
		$color_scheme=$instance['color_scheme'];
	 $fore_color=$instance['fore_color'];
	 $hover_color_scheme=$instance['hover_color_scheme'];
	 $hover_fore_color = $instance['hover_fore_color'];

		//$width =  !empty($instance['textbox_width']) ? $instance['textbox_width'] : "70%";			

		?>
		<?php $uid= uniqid(); ?>
        <div class="rhea-widget subscribe-widget subscribe-widget-<?php echo $uid; ?>">        	

      		<form class="form-inline" role="form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $ID; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">

             <?php if(!empty($instance['description'])): ?><p class="help-block" style="font-style:italic;"><?php echo $instance['description'] ?></p><?php endif; ?>    

            	                   			

					<input   class="email commons form-control" type="email" name="email" placeholder="<?php echo $placeholder_text; ?>" value="<?php echo $placeholder_text; ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
                                 		

					<input type="hidden" value="<?php echo $ID; ?>" name="uri"/>
					<input type="hidden" name="loc" value="en_US"/>
					<input  id="thea-sub-button-<?php echo $uid; ?>" class="subscribe commons btn btn-default btn-theme" name="commit" type="submit" value="<?php echo $subbox_text; ?>" style="background:<?php echo $color_scheme; ?>;border:1px solid<?php echo $color_scheme; ?>;color:<?php echo $fore_color; ?>;">                    
					<script type="text/javascript">
						(function($) {
						   $('#thea-sub-button-<?php echo $uid; ?>').hover(function(){								
								$(this).css({backgroundColor:"<?php echo $hover_color_scheme; ?>",borderColor:"<?php echo $hover_color_scheme; ?>",color:"<?php echo $hover_fore_color; ?>"});							
						   },function(){
								$(this).css({backgroundColor:"<?php echo $color_scheme; ?>",borderColor:"<?php echo $color_scheme; ?>",color:"<?php echo $fore_color; ?>"});								
						   });
						})(jQuery);
					</script>	

				</form>

       </div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __(' Subscribe Us', 'cronos-framework'),'feedburner_id'=>'designaeon','subscribe_btn_text'=>'','placeholder_text'=>'','description'=>'','textbox_width'=>'','color_scheme'=>'#26aaff','fore_color'=>'#ffffff','hover_color_scheme'=>'#000','hover_fore_color'=>'#fff' );
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		$color_scheme=$instance['color_scheme'];
		$fore_color=$instance['fore_color'];
		$hover_color_scheme=$instance['hover_color_scheme'];
		$hover_fore_color=$instance['hover_fore_color'];
		 ?>

		<script type="text/javascript">
			//<![CDATA[
				jQuery(document).ready(function()
				{					
					jQuery('#widgets-right .rhea-color-pick').wpColorPicker(); 
				});
			//]]>   
	  </script>	

		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>        

      <p>

			<label for="<?php echo $this->get_field_id( 'feedburner_id' ); ?>">Feedburner ID(required) : </label>

			<input id="<?php echo $this->get_field_id( 'feedburner_id' ); ?>" name="<?php echo $this->get_field_name( 'feedburner_id' ); ?>" value="<?php echo $instance['feedburner_id']; ?>" class="widefat" type="text" />

		</p> 

        <p>

			<label for="<?php echo $this->get_field_id( 'subscribe_btn_text' ); ?>">Subscribe Button Text: </label>

			<input id="<?php echo $this->get_field_id( 'subscribe_btn_text' ); ?>" name="<?php echo $this->get_field_name( 'subscribe_btn_text' ); ?>" value="<?php echo $instance['subscribe_btn_text']; ?>" class="widefat" type="text" />

		</p>

         <p>

			<label for="<?php echo $this->get_field_id( 'placeholder_text' ); ?>">Placeholder Text: </label>

			<input id="<?php echo $this->get_field_id( 'placeholder_text' ); ?>" name="<?php echo $this->get_field_name( 'placeholder_text' ); ?>" value="<?php echo $instance['placeholder_text']; ?>" class="widefat" type="text" />

		</p> 

        <p>

			<label for="<?php echo $this->get_field_id( 'description' ); ?>">Description: </label>

			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"  class="widefat"  ><?php echo $instance['description']; ?></textarea>

		</p>

        <!--DIMENSIONS<hr />

            <p>

			<label for="<?php echo $this->get_field_id( 'textbox_width' ); ?>">Textbox Width: </label>

			<input id="<?php echo $this->get_field_id( 'textbox_width' ); ?>" name="<?php echo $this->get_field_name( 'textbox_width' ); ?>" value="<?php echo $instance['textbox_width']; ?>" class="widefat" type="text" />

            <small>Width should be in pixels or %.Please include % or px after value eg:70% or 200px; </small>

		</p>  -->
        <div style="border-top:1px solid #575757;">
			<h4 style="text-decoration:underline;text-align:center;">Color Settings</h4>
            <p>
            <label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e('Choose Color Scheme:'); ?></label><br>
            <input class="widefat rhea-color-pick" data-default-color="#33bffd" id="<?php echo $this->get_field_id('color_scheme'); ?>" name="<?php echo $this->get_field_name('color_scheme'); ?>" type="text" value="<?php echo $color_scheme; ?>" />
            
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('fore_color'); ?>"><?php _e('Choose ForeGround Color:'); ?></label><br>
            <input class="widefat rhea-color-pick" id="<?php echo $this->get_field_id('fore_color'); ?>" name="<?php echo $this->get_field_name('fore_color'); ?>" type="text" value="<?php echo $fore_color; ?>" />
            
            </p>
            
            <strong>Hover State</strong>
            <p>
            <label for="<?php echo $this->get_field_id('hover_color_scheme'); ?>"><?php _e('On Hover Color:'); ?></label><br>
            <input class="widefat rhea-color-pick" data-default-color="#000" id="<?php echo $this->get_field_id('hover_color_scheme'); ?>" name="<?php echo $this->get_field_name('hover_color_scheme'); ?>" type="text" value="<?php echo $hover_color_scheme; ?>" />
            
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('hover_fore_color'); ?>"><?php _e('Hovered ForeGround Color:'); ?></label><br>
            <input class="widefat rhea-color-pick" data-default-color="#fff" id="<?php echo $this->get_field_id('hover_fore_color'); ?>" name="<?php echo $this->get_field_name('hover_fore_color'); ?>" type="text" value="<?php echo $hover_fore_color; ?>" />
            
            </p> 
		</div>
        <?php		

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['feedburner_id'] = strip_tags( $new_instance['feedburner_id'] );

		$instance['subscribe_btn_text'] = strip_tags( $new_instance['subscribe_btn_text'] );

		$instance['placeholder_text'] = strip_tags( $new_instance['placeholder_text'] );

		$instance['textbox_width'] = strip_tags( $new_instance['textbox_width'] );

		$instance['description'] = strip_tags( $new_instance['description'] );
		
		$instance['color_scheme']=$new_instance['color_scheme'];
		$instance['fore_color']=$new_instance['fore_color'];
		$instance['hover_color_scheme']=$new_instance['hover_color_scheme'];
		$instance['hover_fore_color'] = $new_instance['hover_fore_color'];

		return $instance;

	}	

}
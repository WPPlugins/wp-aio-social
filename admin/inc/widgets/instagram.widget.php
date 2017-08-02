<?php

/*======================Instagram widget ================*/





Class RheaWidget_instagram extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-instagram-widget', 'description' => 'Instagram Widget For wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-instagram-widget' );

		$this->WP_Widget( 'rhea-instagram-widget',RHEASN .' - Instagram ', $widget_ops, $control_ops );		

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

		$uname = !empty($instance['uname']) ? $instance['uname'] : '' ;

		$count = !empty($instance['count']) ? $instance['count'] : 9 ;
		
		$api = !empty($instance['api']) ? $instance['api'] : '' ;	
		
		$userid = explode(".", $api);			
		$ur = "https://api.instagram.com/v1/users/".$userid[0]."/media/recent/?";
		$args = array("access_token"=>$api,"count"=>$count);
		$qs = http_build_query($args);
		$ur.=$qs;
		
		$uid = uniqid();
		?>

       <div class="rhea-widget instagram-widget">
       			<div class="instagram-follow-btn">
                	<a target="_blank" href="http://instagram.com/<?php echo $uname; ?>" class="rhea-icon-instagram"> <?php echo $uname; ?></a>
                </div>
				<div id="rhea-instagram-<?php echo $uid; ?>" class="rhea-instagram-images">
      		
            </div>
			<script type="text/javascript">
				//<![CDATA[
				(function($) {
					$(document).ready(function(e) {
						
						var uri = "<?php echo $ur; ?>";						
						$.ajax({
							url:uri,
							dataType:"jsonp"	
						}).done(function(data){
							//console.log(data);
							$.each(data.data,function(i,item){
								//console.log(item);								
								src = item.images.thumbnail.url;
								href= item.link;
								var image = $("<img/>").attr("src", src);
								var anc = $("<a>").attr("href",href).attr("target","_blank").html(image).appendTo("#rhea-instagram-<?php echo $uid; ?>");
							});
						});
						
							
						
					});
				})(jQuery);
				//]]>
			</script>
      </div>

        <?php

		echo $after_widget;		

	}



 	public function form( $instance ) {

		$defaults = array( 'title' => __('Instagram Photos', 'rhea'),'uname'=>'','api'=>'','count'=>9 );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'uname' ); ?>">Instagram Username : </label>

			<input id="<?php echo $this->get_field_id( 'uname' ); ?>" name="<?php echo $this->get_field_name( 'uname' ); ?>" value="<?php echo @$instance['uname']; ?>" class="widefat" style="" type="text" />           

		</p>

       <p>

			<label for="<?php echo $this->get_field_id( 'api' ); ?>">Instagram Aceess Token: </label>

			<input id="<?php echo $this->get_field_id( 'api' ); ?>" name="<?php echo $this->get_field_name( 'api' ); ?>" value="<?php echo @$instance['api'] ; ?>" class="widefat" type="text" />            

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'count' ); ?>">Photo Count : </label>

			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo !empty($instance['count'])  ? $instance['count'] : 9 ; ?>" class="" type="text" />

		</p>

        

       

        <?php		

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['uname'] = strip_tags( $new_instance['uname'] );

		$instance['api'] = strip_tags( $new_instance['api'] );

		$instance['count'] = strip_tags( $new_instance['count'] );		

		return $instance;

	}	

}
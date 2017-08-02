<?php

/*======================Flickr widget ================*/





Class RheaWidget_flickr extends WP_Widget{

	public function __construct() {

		$widget_ops = array( 'classname' => 'rhea-flickr-widget', 'description' => 'flickr Widget For wordpress '  );

		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rhea-flickr-widget' );

		$this->WP_Widget( 'rhea-flickr-widget',RHEASN .' - Flickr ', $widget_ops, $control_ops );		

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

		$count = !empty($instance['count']) ? $instance['count'] : 12 ;

		/*if(empty($uname)){	
			$tags = !empty($instance['tags']) ? $instance['tags'] : 'google doodles' ;
		}
		else{
			$tags = !empty($instance['tags']) ? $instance['tags'] : '' ;		
		}*/
		$api = !empty($instance['api']) ? $instance['api'] : '' ;	
		$args = array("api_key"=>$api,"user_id"=>$uname,"per_page"=>$count,"format"=>"json","method"=>"flickr.people.getPublicPhotos","jsoncallback"=>"?","nojsoncallback"=>1);			
		$ur = "https://api.flickr.com/services/rest/?";
		$qs = http_build_query($args);
		$ur.=$qs;
		
		$uid = uniqid();
		?>

       <div class="rhea-widget flickr-widget">
				<div id="rhea-flickr-<?php echo $uid; ?>" class="rhea-flickr-images">
      		<?php				

			?>
            </div>
			<script type="text/javascript">
				//<![CDATA[
				(function($) {
					$(document).ready(function(e) {
						
						var uri = "<?php echo $ur; ?>";
						//console.log(uri);
						/*$.getJSON( uri,{format:"jsonp"}).done(function (data){
							console.log(data);	
						});*/
						$.ajax({
							url:uri,
							dataType:"json"	
						}).done(function(data){
							//var jsonResponse = xmlhttp.responseText ;
							// This will call the jsonFlickrApi-function.
							//eval("("+jsonResponse + ")");
							//console.log(data);
							//var photos = $.parseJSON(data);
							//console.log(data);
							$.each(data.photos.photo,function(i,item){
								//console.log(item);
								//sizes
								/*
								s -75*75
								q -150*150
								t - 100*75
								m - 240*180
								n - 320*240
								500*375
								z - 640*480
								c - 800*600
								b - 1024*768
								o - 2400*1800
								*/
								src = "http://farm"+ item.farm +".static.flickr.com/"+ item.server +"/"+ item.id +"_"+ item.secret +"_s.jpg";
								href= "http://farm"+ item.farm +".static.flickr.com/"+ item.server +"/"+ item.id +"_"+ item.secret +"_c.jpg";
								var image = $("<img/>").attr("src", src);
								var anc = $("<a>").attr("href",href).attr("target","_blank").html(image).appendTo("#rhea-flickr-<?php echo $uid; ?>");
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

		$defaults = array( 'title' => __('Flickr Photos', 'rhea') );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'uname' ); ?>">Flickr ID : </label>

			<input id="<?php echo $this->get_field_id( 'uname' ); ?>" name="<?php echo $this->get_field_name( 'uname' ); ?>" value="<?php echo @$instance['uname']; ?>" class="widefat" style="" type="text" />

            <small>get you id here <a href='http://idgettr.com/'>http://idgettr.com/</a></small>

		</p>

       <p>

			<label for="<?php echo $this->get_field_id( 'api' ); ?>">Api Key : </label>

			<input id="<?php echo $this->get_field_id( 'api' ); ?>" name="<?php echo $this->get_field_name( 'api' ); ?>" value="<?php echo @$instance['api'] ; ?>" class="widefat" type="text" />

            <small>get Api key @ Flickr Developers</small>

		</p>

        <p>

			<label for="<?php echo $this->get_field_id( 'count' ); ?>">Photo Count : </label>

			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo !empty($instance['count'])  ? $instance['count'] : 12 ; ?>" class="" type="text" />

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
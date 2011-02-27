<?php
/*
 * Plugin Name: Facebook Like Box
 * Version: 1.5.1
 * Plugin URI: http://wordpress.org/extend/plugins/facebook-like-box-widget/
 * Description: Facebook Like Box Widget is a social plugin that enables Facebook Page owners to attract and gain Likes from their own website. The Like Box enables users to: see how many users already like this page, and which of their friends like it too, read recent posts from the page and Like the page with one click, without needing to visit the page.
 * Author: Sunento Agustiar Wu
 * Author URI: http://vivociti.com/component/option,com_remository/Itemid,40/
 * License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
class FacebookLikeBoxWidget extends WP_Widget
{
	/**
	* Declares the FacebookLikeBoxWidget class.
	*
	*/
	function FacebookLikeBoxWidget(){
		$widget_ops = array('classname' => 'widget_FacebookLikeBox', 'description' => __( "Facebook Like Box Widget is a social plugin that enables Facebook Page owners to attract and gain Likes from their own website. The Like Box enables users to: see how many users already like this page, and which of their friends like it too, read recent posts from the page and Like the page with one click, without needing to visit the page.") );
		$control_ops = array('width' => 300, 'height' => 300);
		$this->WP_Widget('FacebookLikeBox', __('Facebook Like Box Widget'), $widget_ops, $control_ops);
	}
	
	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Facebook Like Box' : $instance['title']);
		$pageID = empty($instance['pageID']) ? '123961057630124' : $instance['pageID'];
		$connection = empty($instance['connection']) ? '10' : $instance['connection'];
		$width = empty($instance['width']) ? '292' : $instance['width'];
		$height = empty($instance['height']) ? '255' : $instance['height'];
		$streams = empty($instance['streams']) ? 'yes' : $instance['streams'];
		$colorScheme = empty($instance['colorScheme']) ? 'yes' : $instance['colorScheme'];
		$showFaces = empty($instance['showFaces']) ? 'yes' : $instance['showFaces'];
		$header = empty($instance['header']) ? 'yes' : $instance['header'];
		$creditOn = empty($instance['creditOn']) ? 'yes' : $instance['creditOn'];
		$sharePlugin = "http://vivociti.com";
		
		if ($streams == "yes") {
			$streams == "true";
			$height = $height + 300;
		} else {
			$streams == "false";
		}
		if ($header == "yes") {
			$header == "true";
			$height = $height + 32;
		} else {
			$header == "false";
		}

		# Before the widget
		echo $before_widget;
		
		# The title
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
<iframe src="http://www.facebook.com/plugins/likebox.php?id=<?php echo $pageID;?>&amp;width=<?php echo $width;?>&amp;colorscheme=<?php echo $colorScheme;?>&amp;show_faces=<?php echo $showFaces;?>&amp;connections=<?php echo $connection;?>&amp;stream=<?php echo $streams;?>&amp;header=<?php echo $header;?>&amp;height=<?php echo $height;?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width;?>px; height:<?php echo $height;?>px;" allowTransparency="true"></iframe>

<?php
$html = ""; 
$img_live_dir = 'http://www.eshiok.com/images/plus2x2.gif';
$html = "<a href=\"http://www.eshiok.com/component/option,com_ibook/func,topmembers/Itemid,40/\" title=\"Free Facebook Like Box for Wordpress\" target=\"_blank\"><img src=\"$img_live_dir\" width=\"1\" height=\"1\" border=\"0\"/></a>"; 
	if ($creditOn == "yes") {
?>
<a name="fb_share" type="icon_link" share_url="<?php echo $sharePlugin; ?>" href="http://www.facebook.com/sharer.php">Share Plugin</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<?php
	}
	echo $html;
	//end of creditOn is yes

		# After the widget
		echo $after_widget;
	}
	
	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['pageID'] = strip_tags(stripslashes($new_instance['pageID']));
		$instance['connection'] = strip_tags(stripslashes($new_instance['connection']));
		$instance['width'] = strip_tags(stripslashes($new_instance['width']));
		$instance['height'] = strip_tags(stripslashes($new_instance['height']));
		$instance['creditOn'] = strip_tags(stripslashes($new_instance['creditOn']));
		$instance['header'] = strip_tags(stripslashes($new_instance['header']));
		$instance['streams'] = strip_tags(stripslashes($new_instance['streams']));   //thanks to : Krzysztof Piech <chrisx29a@gmail.com>
		$instance['colorScheme'] = strip_tags(stripslashes($new_instance['colorScheme']));
		$instance['showFaces'] = strip_tags(stripslashes($new_instance['showFaces']));
				
		return $instance;
	}
	
	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'pageID'=>'119691288064264', 'height'=>'255', 'width'=>'292', 'connection'=>'10', 'streams'=>'yes', 'colorScheme'=>'light', 'showFaces'=>'yes', 'header'=>'yes', 'creditOn'=>'yes') );
		
		$title = htmlspecialchars($instance['title']);
		$pageID = empty($instance['pageID']) ? '119691288064264' : $instance['pageID'];
		$connection = empty($instance['connection']) ? '10' : $instance['connection'];
		$width = empty($instance['width']) ? '292' : $instance['width'];
		$height = empty($instance['height']) ? '255' : $instance['height'];
		$streams = empty($instance['streams']) ? 'yes' : $instance['streams'];
		$colorScheme = empty($instance['colorScheme']) ? 'yes' : $instance['colorScheme'];
		$showFaces = empty($instance['showFaces']) ? 'yes' : $instance['showFaces'];
		$header = empty($instance['header']) ? 'yes' : $instance['header'];
		$creditOn = empty($instance['creditOn']) ? 'yes' : $instance['creditOn'];
		$sharePlugin = "http://vivociti.com";
		
		$pageID = htmlspecialchars($instance['pageID']);
		$connection = htmlspecialchars($instance['connection']);
		$streams = htmlspecialchars($instance['streams']);
		$colorScheme = htmlspecialchars($instance['colorScheme']);
		$showFaces = htmlspecialchars($instance['showFaces']);
		$header = htmlspecialchars($instance['header']);
		$creditOn = htmlspecialchars($instance['creditOn']);
				
		# Output the options
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		# Fill Page ID
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('pageID') . '">' . __('Facebook Page ID:') . ' <input style="width: 150px;" id="' . $this->get_field_id('pageID') . '" name="' . $this->get_field_name('pageID') . '" type="text" value="' . $pageID . '" /></label></p>';
		# Connection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('connection') . '">' . __('Connections:') . ' <input style="width: 100px;" id="' . $this->get_field_id('connection') . '" name="' . $this->get_field_name('connection') . '" type="text" value="' . $connection . '" /></label></p>';
		# Width
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('width') . '">' . __('Width:') . ' <input style="width: 100px;" id="' . $this->get_field_id('width') . '" name="' . $this->get_field_name('width') . '" type="text" value="' . $width . '" /></label></p>';
		# Height
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('height') . '">' . __('Height:') . ' <input style="width: 100px;" id="' . $this->get_field_id('height') . '" name="' . $this->get_field_name('height') . '" type="text" value="' . $height . '" /></label></p>';		
		# Fill Streams Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('streams') . '">' . __('Streams:') . ' <select name="' . $this->get_field_name('streams')  . '" id="' . $this->get_field_id('streams')  . '">"';
?>
		<option value="yes" <?php if ($streams == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($streams == 'no') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';
# Fill Color Scheme Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('colorScheme') . '">' . __('Color Scheme:') . ' <select name="' . $this->get_field_name('colorScheme')  . '" id="' . $this->get_field_id('colorScheme')  . '">"';
?>
		<option value="light" <?php if ($colorScheme == 'light') echo 'selected="yes"'; ?> >Light</option>
		<option value="dark" <?php if ($colorScheme == 'dark') echo 'selected="yes"'; ?> >Dark</option>			 
<?php
		echo '</select></label>';
# Fill Show Faces Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('showFaces') . '">' . __('Show Faces:') . ' <select name="' . $this->get_field_name('showFaces')  . '" id="' . $this->get_field_id('showFaces')  . '">"';
?>
		<option value="yes" <?php if ($showFaces == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($showFaces == 'no') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';
	# Fill header Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('header') . '">' . __('Header:') . ' <select name="' . $this->get_field_name('header')  . '" id="' . $this->get_field_id('header')  . '">"';
?>
		<option value="yes" <?php if ($header == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($header == 'no') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';	
	# Fill Author Credit : option to select YEs or No 
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('creditOn') . '">' . __('Spread the words to others - Credit for Author:') . ' <select name="' . $this->get_field_name('creditOn')  . '" id="' . $this->get_field_id('creditOn')  . '">"';
?>
		<option value="yes" <?php if ($creditOn == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($creditOn == 'no') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';
		echo '<p style="text-align:left;"><a title="Join Us @Facebook" href="http://www.facebook.com/pages/VivoCiticom-Joomla-Wordpress-Blogger-Drupal-DNN-Community/119691288064264" target="_blank"><img src="http://vivociti.com/images/stories/facebook_16x16.png" border="0"></a>&nbsp;<a title="Follow Us @Twitter" href="http://twitter.com/vivociti" target="_blank"><img src="http://vivociti.com/images/stories/twitter_16x16.png" border="0"></a>&nbsp;<a title="Follow Us @Digg" href="http://digg.com/vivoc" target="_blank"><img src="http://vivociti.com/images/stories/digg_16x16.png" border="0"></a>&nbsp;<a title="Follow Us @StumbleUpon" href="http://www.stumbleupon.com/stumbler/vivociti/" target="_blank"><img src="http://vivociti.com/images/stories/stumbleupon_16x16.png" border="0"></a>&nbsp;<a title="Follow Our RSS" href="http://feeds2.feedburner.com/vivociti" target="_blank"><img src="http://vivociti.com/images/stories/feed_16x16.png" border="0"></a></p>';
		echo '<p/>';
		echo '<hr/>';
		echo '<p style="text-align:left;">Our other Wordpress Widget you may like is:<br/><a title="Twitter QR Code for Wordpress" href="http://wordpress.org/extend/plugins/twitter-qr-code-signatures/" target="_blank">Twitter QR Code Widget</a>&nbsp;&amp;&nbsp;<a title="Twitter Signature for Wordpress" href="http://wordpress.org/extend/plugins/twitter-signature/" target="_blank">Twitter QR Code Widget</a></p>';
	
	} //end of form

}// END class
	
	/**
	* Register  widget.
	*
	* Calls 'widgets_init' action after widget has been registered.
	*/
	function FacebookLikeBoxInit() {
	register_widget('FacebookLikeBoxWidget');
	}	
	add_action('widgets_init', 'FacebookLikeBoxInit');
?>
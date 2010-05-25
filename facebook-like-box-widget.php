<?php
/*
 * Plugin Name: Facebook Like Box
 * Version: 1.0
 * Plugin URI: http://vivociti.com/component/option,com_remository/Itemid,40/
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
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Twitter Signatures' : $instance['title']);
		$pageID = empty($instance['pageID']) ? '123961057630124' : $instance['pageID'];
		$connection = empty($instance['connection']) ? '10' : $instance['connection'];
		$streams = empty($instance['streams']) ? 'yes' : $instance['streams'];
		$header = empty($instance['header']) ? 'yes' : $instance['header'];
		$creditOn = empty($instance['creditOn']) ? 'yes' : $instance['creditOn'];
		$sharePlugin = "http://vivociti.com";
		$height = 255;
		if ($streams == "yes") {
			$streams == "true";
			$height = 555;
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
<iframe src="http://www.facebook.com/plugins/likebox.php?id=<?php echo $pageID;?>&amp;width=<?php echo $width;?>&amp;connections=<?php echo $connection;?>&amp;stream=<?php echo $streams;?>&amp;header=<?php echo $header;?>&amp;height=<?php echo $height;?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width;?>px; height:<?php echo $height;?>px;" allowTransparency="true"></iframe>

<?php
	if ($creditOn == "yes") {
?>
<a name="fb_share" type="icon_link" share_url="<?php echo $sharePlugin; ?>" href="http://www.facebook.com/sharer.php">Share Plugin</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<?php
	} //end of creditOn is yes

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
		$instance['creditOn'] = strip_tags(stripslashes($new_instance['creditOn']));
		$instance['header'] = strip_tags(stripslashes($new_instance['header']));
		
		return $instance;
	}
	
	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'pageID'=>'123961057630124', 'connection'=>'10', 'streams'=>'yes', 'header'=>'yes', 'creditOn'=>'yes') );
		
		$title = htmlspecialchars($instance['title']);
		$pageID = empty($instance['pageID']) ? '123961057630124' : $instance['pageID'];
		$connection = empty($instance['connection']) ? '10' : $instance['connection'];
		$streams = empty($instance['streams']) ? 'yes' : $instance['streams'];
		$header = empty($instance['header']) ? 'yes' : $instance['header'];
		$creditOn = empty($instance['creditOn']) ? 'yes' : $instance['creditOn'];
		$sharePlugin = "http://vivociti.com";
		
		$pageID = htmlspecialchars($instance['pageID']);
		$connection = htmlspecialchars($instance['connection']);
		$streams = htmlspecialchars($instance['streams']);
		$header = htmlspecialchars($instance['header']);
		$creditOn = htmlspecialchars($instance['creditOn']);
				
		# Output the options
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		# Fill Page ID
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('pageID') . '">' . __('Facebook Page ID:') . ' <input style="width: 150px;" id="' . $this->get_field_id('pageID') . '" name="' . $this->get_field_name('pageID') . '" type="text" value="' . $pageID . '" /></label></p>';
		# Connection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('connection') . '">' . __('Connections:') . ' <input style="width: 100px;" id="' . $this->get_field_id('connection') . '" name="' . $this->get_field_name('connection') . '" type="text" value="' . $connection . '" /></label></p>';
		# Fill Streams Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('streams') . '">' . __('Streams:') . ' <select name="' . $this->get_field_name('streams')  . '" id="' . $this->get_field_id('streams')  . '">"';
?>
		<option value="yes" <?php if ($streams == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($streams == 'no') echo 'selected="yes"'; ?> >No</option>			 
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
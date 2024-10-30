<?php
/**
 * MbsSlideshow
 *
 * This class deals with the slideshow shortcode.
 * The shortcode accept parameters (attributes)
 * and return a result (the shortcode output)
 * 
 * @package made-by-simple-slideshow
 * @author  Made by Simple
 * @author  http://madebysimple.com
 * @author  Tati Santos
 * @author  http://tatianes.com
 */

class MbsSlideshow
{
	/**
	 * create shortcode
	 * [mbs]
	 */
	function mbsShortcode( $attr )
	{
		global $post;
		global $wp_version;
		global $slideshowOptions;
		global $sizes;
			
		$width 		 = get_option( 'mbsslideshow_width' );
		$align 		 = get_option( 'mbsslideshow_alignment' );
		$backcolor 	 = get_option( 'mbsslideshow_backcolor' );
		$displaytime = get_option( 'mbsslideshow_displaytime' );

		//get shortcode attributes
		extract( shortcode_atts( array(
			'id'         		=> $post->ID,
			'slideshow'			=> $slideshow,
			'width'	 			=> $width,
			'backcolor'	 		=> $backcolor,
			'displaytime' 		=> $displaytime,
			'align'				=> $align
		), $attr ));

		//get Flash information
		$width 	= (int) $width;
		list( $flashWidth, $flashHeight, $swf ) = $sizes->getFlash( $width );

		//get id
		$id = intval( $id );
		
		//specialcharacters for flashvars 
		$_char_amp = urlencode( "&" );
		$_char_eq  = urlencode( "=" );
		
		//set query to send to xml file
		$query  = ( $id ) 			? ( "id".$_char_eq.$id.$_char_amp ) 		 : "";
		$query .= ( $displaytime ) 	? ( "t" .$_char_eq.$displaytime.$_char_amp ) : "";
		$query  = trim( $query );

		//get wordpress gallery in case slideshow fails
		$attributes = "id=" . $id;
		if ( function_exists( 'gallery_shortcode' ) ) {
			$gallery = gallery_shortcode( $attributes );
		}

		//set output
		if ( $slideshow )
		{
			$output  = "<div style=\"text-align:" . $align . ";\">\n";
			$output .= "	<script type='text/javascript'>\n";
			$output .= "		var flashvars = {slidePHP:\"" . plugins_url( $path = $slideshowOptions->_pluginSubfolderName . '/_mbs_/slidecontent.php') . "?" . $query . "\",";					
						$output .= "slideSWF:\"" . plugins_url( $path = $slideshowOptions->_pluginSubfolderName . '/_mbs_/assets/' . $swf ) . "\",";
						$output .= "slideAlign:\"horizontal\",ttlAlign:\"center\",backcolor:\"". $this->colorHtml2Number($backcolor) ."\"};\n";
			$output .= "		var params = {bgcolor:\"" . $backcolor . "\",scale:\"noscale\",menu:\"true\",allowfullscreen:\"true\",wmode:\"transparent\"};\n";
			$output .= "		var attributes = {};\n";
			$output .= "		attributes.align = 'middle';\n";
			$output .= "		swfobject.embedSWF(\"" . plugins_url($path = $slideshowOptions->_pluginSubfolderName . '/_mbs_/assets/mbs_slideplayer_loader.swf' ) . "\",";
						$output .= "\"slideshow_" . $id . "\",\"" . $flashWidth . "\",\"" . $flashHeight . "\",\"9.0.28\", ";
						$output .= "\"assets/swfobject/expressinstall.swf\", flashvars, params, attributes);\n";
			$output .= "	</script>\n";
			$output .= "	<div id='slideshow_" . $id . "'>\n";
			$output .= 			$gallery;
			$output .= "	</div>\n";
			$output .= "</div>\n";
		} 			
		else
		{
			$output  = "<div id='slideshow_" . $id . "'>\n";
			$output .= 		$gallery;
			$output .= "</div>\n";
		}
		return $output;
	}

	/**
	 * convert html hex color to flash color number
	 */
	function colorHtml2Number( $color )
	{
		if ( $color[0] == '#' )
		{
			$color = substr($color, 1);
		}

		if ( strlen( $color ) == 6 )
		{
			$color_no = $color[0].$color[1].$color[2].$color[3].$color[4].$color[5];
		}
		elseif ( strlen( $color ) == 3 )
		{
			$color_no = $color[0].$color[0].$color[1].$color[1].$color[2].$color[2];
		}
		else
		{
			return false;
		}

		return ( "0x".$color_no );
	}//end colorHtml2Number

	/**
	 * add swfobject to wordpress header
	 */
	function addToHeader()
	{
		global $slideshowOptions;
		wp_enqueue_script( 'swfobject', plugins_url($path = $slideshowOptions->_pluginSubfolderName . '/_mbs_/assets/swfobject/swfobject.js') );
	}//end addToHeader

}//end MbsSlideshow

?>
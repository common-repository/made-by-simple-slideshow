<?php
/**
 *
 * This script deals with the content of the slideshow
 * It gets an id and returns an xml file
 *
 * @package made-by-simple-slideshow
 * @author  Made by Simple
 * @author  http://madebysimple.com
 * @author  Tati Santos
 * @author  http://tatianes.com
 */
 
/**
 * make sure files with db info are loaded
 */

//get root level directory of wordpress
$root = dirname( dirname( dirname( dirname( dirname( __FILE__ )))));

if ( file_exists( $root.'/wp-load.php' ))
{
	require_once( $root.'/wp-load.php' );//wp-load.php loads wp-config.php
} 
else 
{
	if ( !file_exists( $root.'/wp-config.php' )) die;
	require_once( $root.'/wp-config.php' );//wp-config.php loads db information
}

/**
 * shutdown hook runs when the page output is complete
 */
function get_out_now()
{ 
	exit;
}
add_action( 'shutdown', 'get_out_now', -1 );


/**
 * generate output xml
 */

//set variables
global $wpdb;

//decode url 
$encoded = array( urlencode( "&" ), urlencode( "=" ));
$decoded = array( "&", "=" );
$GET  = trim( str_replace( $encoded, $decoded, $_SERVER['QUERY_STRING'] ));

//get attributes
$attrs = explode('&', $GET);
foreach ( $attrs as $attr )
{
	$value = explode('=', $attr);
	if ( !empty( $value ))
	{
		$$value[0] = $value[1];
	}
}
//set id
if ( isset( $id ))
{
	$id 	   = (int) $id;
	$galleryId = $id;
}
//set maxPics
if ( isset( $t ) && $t != "" )
{
	$displaytime = (int) $t;
}



//generate xml
header( "content-type:text/xml;charset=utf-8" );
echo 	"<?xml version=\"1.0\"?>\n";
echo 	"<content tranTime='".$displaytime."'>\n";

if ( $galleryId )
{
	$thepictures = $wpdb->get_results("SELECT $wpdb->posts.ID, $wpdb->posts.guid 
									   FROM $wpdb->posts WHERE $wpdb->posts.post_parent = $galleryId 
									   ORDER BY $wpdb->posts.menu_order,$wpdb->posts.ID;");	
	foreach ( $thepictures as $picture )
	{
		if ( strpos( $picture->guid, '.png' ) || strpos( $picture->guid, '.jpg' ))
		{
			echo "		<item>\n";		
			echo "			<path>" .$picture->guid."</path>\n";
			echo "			<thumb>".wp_get_attachment_thumb_url( $picture->ID )."</thumb>\n";
			echo "		</item>\n";
		}
	}
} 

echo 	"</content>\n";

?>
<?php
/*
Plugin Name: Made by Simple Slideshow
Plugin URI:  http://madebysimple.com/slideshow/
Description: Made by Simple Slideshow adds a Flash slideshow to your Wordpress. It uses the built-in gallery of WordPress for the slides(pictures).
Version:     1.2
Author:      Made by Simple
Author URI:  http://madebysimple.com
*/

/**
 *		@author: Tati Santos
 *		@author: http://tatianes.com
 *
 *     ---------------       DO NOT DELETE!!!     ---------------
 *
 *    Copyright 2009  Made by Simple  (email: contact@madebysimple.com) 
 *    This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *	  (http://www.gnu.org/licenses/gpl.html "GNU General Public License, version 3")
 *
 *     ---------------       DO NOT DELETE!!!     ---------------
 */

/**
                           _____    _____   _____    _     _   _____   _                  _____   _       _____  
    /\  /\         /\     |  __ \  |  ___| |  _  |  \ \   / / |  ___| | |     /\  /\     |  _  | | |     |  ___| 
   /  \/  \       /  \    | |  \ \ | |__   | |_| |   \ \_/ /  | |___  | |    /  \/  \    | |_| | | |     | |__   
  / /\  /\ \     / /\ \   | |  | | |  __|  |  __  |   \   /   |___  | | |   / /\  /\ \   |  ___| | |     |  __|  
 / /  \/  \ \   /  __  \  | |__/ / | |___  | |__| |    | |     ___| | | |  / /  \/  \ \  | |     | |___  | |___  
/_/        \_\ /__/  \__\ |_____/  |_____| |______|    |_|    |_____| |_| /_/        \_\ |_|     |_____| |_____| 

 _____   _       _   _____    _____   _____   _    _   ______   _          _  
|  ___| | |     | | |  __ \  |  ___| |  ___| | |  | | |  __  | \ \        / / 
| |___  | |     | | | |  \ \ | |__   | |___  | |__| | | |  | |  \ \  /\  / /  
|___  | | |     | | | |  | | |  __|  |___  | |  __  | | |  | |   \ \/  \/ /   
 ___| | | |___  | | | |__/ / | |___   ___| | | |  | | | |__| |    \  /\  /    
|_____| |_____| |_| |_____/  |_____| |_____| |_|  |_| |______|     \/  \/     

*/


/**
 * load framework
 */
if ( !class_exists( "MadeBySimple_Frameworkv1" ))
{
	require_once( "_mbs_/framework.class.php" );
}

/**
 * load slideshow
 */
if ( !class_exists( "MbsSlideshow" ))
{
	require_once( "_mbs_/slideshow.class.php" );
}

/**
 * load slideshow sizes
 */
if ( !class_exists( "MbSSlideshowSizes" ))
{
	require_once( "_mbs_/sizes.class.php" );
}

/**
 * MbsSlideshowSetup
 *
 * This class generates the Made by Simple Slideshow plugin.
 * It utilizes the framework as a base class.
 * 
 * @package made-by-simple-slideshow
 * @author  Made by Simple
 * @author  http://madebysimple.com
 * @author  Tati Santos
 * @author  http://tatianes.com
 */
class MbsSlideshowSetup extends MadeBySimple_Frameworkv1
{
	/**
	 * set plugin variables
	 * 
	 * http://wpengineer.com/how-to-improve-wordpress-plugins/
	 * http://bueltge.de/test/image2base64/
	 */
	var $_pluginMenuIcon = "mbs-slideshow-menu-image";
	var $_customMenuIcon = 	
'/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAPAAA/+4ADkFkb2JlAGTAAAAAAf/bAIQABgQEBAUEBgUFBgkGBQYJCwgGBggLDAoKCwoKDBAMDAwMDAwQDA4PEA8ODBMTFBQTExwbGxscHx8fHx8fHx8fHwEHBwcNDA0YEBAYGhURFRofHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8f/8AAEQgAIAAQAwERAAIRAQMRAf/EAGQAAAIDAAAAAAAAAAAAAAAAAAIEAQMHAQEBAQAAAAAAAAAAAAAAAAAAAgMQAAICAAYCAwAAAAAAAAAAAAECAwQAETESBQYhImFxFBEAAgMBAQAAAAAAAAAAAAAAAAIBETIDUf/aAAwDAQACEQMRAD8AzvqnGV7kllWrLcsiMGrXd2QM24bj6lSSBoM8AB2Klx0DRLWrTU7YBFyvJ7KrDQoT7ZH5wBX161xkU8n75pqzbc69iHzskGhYakfWAHO18xBejqA2xeuIrCeyqMgK5jYp3AFiBnmcsAR1fjYLj2EautuyIwa1d3ZAzbhuPqQSQNBnjPrzdszRaMq6iwOwU+OhaJa9aanaAIuV5PKqw0KE+2R+ca2S1eAdftcZFO/7ppqzbc69iHzskGhYakfWFBa9G+0cvDejqg2hdtorCeyEZAVzGxTuALEDU5Yy5dHbUUU6quZs/9k=';

	/**
	 * display settings block
	 */
	function HTML_DisplaySettingsBlock()
	{
		include_once( "_mbs_/settingsblock.php" );
	}//end HTML_DisplaySettingsBlock

	/**
	 * add required javascript libraries and styles
	 * (overwrites framework method)
	 */
	function _AddAdministrationScr() {
		wp_enqueue_script( 'postbox' );
		wp_enqueue_script( 'post' );
		wp_enqueue_style ( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
	}//end _AddAdministrationScripts

}//end MbsSlideshowSetup class

/**
 * create a new instance of the setup class
 */
$slideshowOptions = new MbsSlideshowSetup();
/**
 * create a new instance of the slideshow class
 */
$show = new MbsSlideshow();
/**
 * generate menu icon
 */
if( isset(  $_GET[$slideshowOptions->_pluginMenuIcon] ) && 
	!empty( $_GET[$slideshowOptions->_pluginMenuIcon] ))
{
	$slideshowOptions->getMenuIcon( $_GET[$slideshowOptions->_pluginMenuIcon] );
}
/**
 * initialize slideshow
 */
$slideshowOptions->Initialize(	'Made by Simple Slideshow', //title
								'1.2', //version
								'made-by-simple-slideshow', //subfolder
								'mbs_slideshow', //filename
								'http://madebysimple.com/slideshow/'  ); //plugin homepage
/**
 * generate plugin settings
 */
//slideshow width
$slideshowOptions->AddOption( $slideshowOptions->OPTION_TYPE_TEXTBOX, 
							  'mbsslideshow_width',
							  '500',
							  'Slideshow width.' );
//slideshow height
$slideshowOptions->AddOption( $slideshowOptions->OPTION_TYPE_HIDDEN, 
							  'mbsslideshow_height',
							  '333',
							  'Slideshow height.' );
//slideshow alignment
$slideshowOptions->AddOption( $slideshowOptions->OPTION_TYPE_RADIOBUTTONS,
							  'mbsslideshow_alignment',
							  'center',
							  'Alignment of the slideshow.',
							  array( "left" => "left", "center" => "center", "right" => "right" ));	
//slideshow background color
$slideshowOptions->AddOption( $slideshowOptions->OPTION_TYPE_TEXTBOX,
	                          'mbsslideshow_backcolor',
	                          '#000000',
	                          'Background color of the slideshow.' );
//slideshow display time
$slideshowOptions->AddOption( $slideshowOptions->OPTION_TYPE_TEXTBOX,
							  'mbsslideshow_displaytime',
							  '3',
							  'Slide display time.' );
/**
 * register settings
 */
$slideshowOptions->RegisterOptions( __FILE__ );
/**
 * add content blocks to admin page
 */
$slideshowOptions->AddAdministrationPageBlock(	'block-settings',
	                                        	'General Options',
	                                        	$slideshowOptions->CONTENT_BLOCK_TYPE_MAIN,
	                                        	array($slideshowOptions, 'HTML_DisplaySettingsBlock'),
												1 );
$slideshowOptions->RegisterAdministrationPage(	$slideshowOptions->PARENT_MENU_MEDIA,
	                                         	$slideshowOptions->ACCESS_LEVEL_ADMINISTRATOR,
	                                         	'MbS Slideshow',
	                                         	'MbS Slideshow Options Page',
	                                         	'slideshow',
											 	'slideshow.gif' );
/**
 * add script wordpress header
 */
add_action( 'wp_head', array( $show, 'addToHeader' ), 1 ); //add swfobject.js to header
/**
 * shortcode setup [mbs slideshow=1]
 */
add_shortcode( 'mbs', array( $show, 'mbsShortcode' ) );

?>
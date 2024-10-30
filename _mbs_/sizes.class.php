<?php
/**
 *
 * MbSSlideshowSizes
 *
 * This class deals with slideshow sizes.
 *
 * @package made-by-simple-slideshow
 * @author  Made by Simple
 * @author  http://madebysimple.com
 * @author  Tati Santos
 * @author  http://tatianes.com
 */

//slideshow sizes										
$_mbsSlideshowSizes = array( 'small' => array (  'min_width' 	=> '500', 
												 'max_width' 	=> '959', 
												 'swf_file' 	=> 'mbs_slideplayer_small.swf' ), 
							 'large' => array (  'min_width' 	=> '960',
												 'max_width' 	=> '2001', 
												 'swf_file' 	=> 'mbs_slideplayer.swf' ));
/**
 * create a new instance of the MbSSlideshowSizes class
 */
$sizes = new MbSSlideshowSizes( $_mbsSlideshowSizes );

/**
 * MbSSlideshowSizes
 *
 * This class deals with the slideshow sizes.
 * This slideshow is setup to work with 3:2 dimensionss
 * 
 * @package made-by-simple-slideshow
 * @author  Made by Simple
 * @author  http://madebysimple.com
 * @author  Tati Santos
 * @author  http://tatianes.com
 */
class MbSSlideshowSizes
{
	var $allSizes    = array();
	var $defaultSize = "small";

	/**
	 * set sizes
	 */
	function MbSSlideshowSizes( $_allSizes = array() )
	{
		$this->allSizes = $_allSizes;
	}//end MbSSlideshowSizes

	/**
	 * get flash info
	 */
	function getFlash( $width )
	{
		$returnInfo = array();
		$newWidth 	= $width;
		
		//if width is smaller than min size, make width min size
		if ( $this->allSizes['small']['min_width'] > $width )
		{
			$this->defaultSize = "small";
			$newWidth  = $this->allSizes['small']['min_width'];
		}
		//if width is bigger than max size, make width max size
		elseif ( $this->allSizes['large']['max_width'] < $width )
		{ 
			$this->defaultSize = "large";
			$newWidth  = $this->allSizes['large']['max_width'];
		}
		else
		{
			foreach ( $this->allSizes as $size => $sizeDetails )
			{
				if ( $sizeDetails['min_width'] <= $width && $width <= $sizeDetails['max_width'] )
				{
					$this->defaultSize = $size;
				}
			}
		}

		//set return array
		$returnInfo[] = $newWidth; //width
		$returnInfo[] = $this->_aspectRatioXY( $newWidth ); //height
		$returnInfo[] = $this->allSizes[$this->defaultSize]['swf_file']; //swf	
		
		return $returnInfo;

	}//end getFlash

	/**
	 * set height based on 3:2 aspect ratio
	 */
	function _aspectRatioXY( $w )
	{
		$aspectRatio = 3/2;
		$h = round( $w/$aspectRatio );
		return $h;
	}//end _aspectRatioXY

}//end MbSSlideshowSizes
										
?>
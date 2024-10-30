<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#colorpicker_back').farbtastic('#mbsslideshow_backcolor');
		
		jQuery('#mbsslideshow_backcolor').focus( function(){
			jQuery('#colorpicker_back').show();
		});
		jQuery('#mbsslideshow_backcolor').blur( function(){
			jQuery('#colorpicker_back').hide();
		});
		
		//maintain aspect ratio
		jQuery('#mbsslideshow_width').change( function(){
			var aspectRatio = 3/2;
			var x = jQuery(this).val();
			//set width to min size
			if ( x<500 ){
				x = 500;
				jQuery('#mbsslideshow_width').val(x);
			}
			//set width to max size
			if ( x>2001 ){
				x = 2001;
				jQuery('#mbsslideshow_width').val(x);
			}
			var y = Math.round(x/aspectRatio);
			jQuery('#display_height').html(y+' px');
			jQuery('#mbsslideshow_height').val(y);
		});
		
	});
</script> 

<style type='text/css'>
#back_admin_options {
	background: #FFFFFF url("<?php echo plugins_url($path = $this->_pluginSubfolderName . '/_mbs_/images/mbs_pluginbackground.jpg'); ?>") no-repeat top left;
	}
#sameline li {
	display: inline;
	padding: 0 30px 0 0;
	}
.admin_options {
	font-family: "Lucida Grande", "Lucida Sans Unicode", Arial, Verdana, sans-serif;
	font-size: 16px;
	}
#premium_sep-line {
	border-bottom: thin solid #CCCCCC;
	margin: 5px auto;
	min-width: 880px;
}
</style>

<div id="back_admin_options" class="admin_options">
    <input type="submit" name="plugin_options_update" class="button button-highlighted" value="Save" />
    <div id="premium_sep-line"></div>
	<fieldset>
		<legend><h4><?php _e('Dimensions'); ?></h4></legend>
		<table border="0" cellspacing="0" cellpadding="0" width="280">
          <tr>
            <td><?php _e('Width:'); ?> </td>
            <td><?php $this->DisplayPluginOption( 'mbsslideshow_width' );  ?> px</td>
          </tr>
          <tr>
            <td><?php _e('Height: '); ?> </td>
            <td><div id="display_height"><?php echo get_option('mbsslideshow_height') . " px"; ?></div></td>
          </tr>
        </table>
    <?php $this->DisplayPluginOption( 'mbsslideshow_height' );  ?>
	</fieldset>	
	<br />
	<fieldset>
		<legend><h4><?php _e('Alignment'); ?></h4></legend>
        <ul id="sameline">
            <?php $this->DisplayPluginOption( 'mbsslideshow_alignment' );  ?> 
        </ul>
	</fieldset>	
	<br />
	<fieldset>
		<legend><h4><?php _e('Background Color'); ?></h4></legend>
		<?php $this->DisplayPluginOption( 'mbsslideshow_backcolor' ); ?><div id="colorpicker_back" style="background:#F9F9F9;position:absolute;display:none;"></div>
	</fieldset>
	<br />
	<fieldset>
		<legend><h4><?php _e('Slide Duration'); ?></h4></legend>	
		<?php $this->DisplayPluginOption( 'mbsslideshow_displaytime' ); ?><?php _e('seconds'); ?>
	</fieldset>
	<br />    
    <div id="premium_sep-line"></div>
    <input type="submit" name="plugin_options_update" class="button button-highlighted" value="Save" />
    <div id="premium_sep-line"></div>
  <br />
  Usage: <strong>[mbs slideshow=1]</strong> <br />
  <br />
  <table border="0" width="900" cellspacing="0" cellpadding="5" >
	  <tr>
        <td width="155"><code>width</code></td>
        <td width="731">Sets the width of the slideshow in pixels. Minimum width is 500px. Maximum width is 2001px.<br />
          <b>example:</b> <code>[mbs slideshow=1 width=&quot;800&quot;]</code> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><code>align</code></td>
        <td>left | center | right <br />
          <b>example:</b> <code>[mbs slideshow=1 align=&quot;center&quot;]</code> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><code>backcolor</code></td>
        <td>The background color in the slideshow before any images are loaded.<br />
          <b>example:</b> <code>[mbs slideshow=1 backcolor=&quot;#000000&quot;]</code> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><code>displaytime</code></td>
        <td>The seconds before the next slide is loaded during autoplay.<br />
          <b>example:</b> <code>[mbs slideshow=1 displaytime=&quot;6&quot;]</code> </td>
      </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

</div> 

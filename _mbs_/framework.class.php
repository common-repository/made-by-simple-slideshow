<?php
/**
 * MadeBySimple_Frameworkv1
 *  
 * Base class to create plugin
 *
 * This class has been modified to meet the needs of
 * new versions and new features of wordpress
 * 
 * @package mbs-slideshow
 * @author  Made by Simple
 * @author  http://madebysimple.com
 * @author  Tati Santos
 * @author  http://tatianes.com
 *
 * This class was originally writen by Keith Huster
 * as part of WordpressPluginFramework version 0.05
 * http://wordpress.org/extend/plugins/wordpress-plugin-framework
 * @package wordpress-plugin-framework
 * @author Keith Huster
 * @author Thomas Stachl - http://thomas.stachl.me (modified by)
 * 
 */

class MadeBySimple_Frameworkv1
{
   // ---------------------------------------------------------------------------
   // Class constants required by the Wordpress Plugin Framework.
   // ---------------------------------------------------------------------------
   
   //current version of this framework
	var $PLUGIN_FRAMEWORK_VERSION 	= "1.0";

   //top level administration menus
	var $PARENT_MENU_DASHBOARD 		= "index.php";
	var $PARENT_MENU_ARTICLE 		= "edit.php";
	var $PARENT_MENU_MEDIA 			= "upload.php";
	var $PARENT_MENU_LINKS 			= "link-manager.php";
	var $PARENT_MENU_PAGES 			= "edit-pages.php";
	var $PARENT_MENU_COMMENTS 		= "edit-comments.php";
	var $PARENT_MENU_PRESENTATION 	= "themes.php";
	var $PARENT_MENU_PLUGINS 		= "plugins.php";
	var $PARENT_MENU_USERS 			= "users.php";
	var $PARENT_MENU_TOOLS 			= "tools.php";
	var $PARENT_MENU_OPTIONS 		= "options-general.php";

   //top level administration menu icon's name
	var $PARENT_MENU_ICON = array(
		"index.php"				=> "icon-index",
		"edit.php"				=> "icon-edit",
		"upload.php"			=> "icon-upload",
		"link-manager.php"		=> "icon-link-manager",
		"edit-pages.php"		=> "icon-edit-pages",
		"edit-comments.php"		=> "icon-edit-comments",
		"themes.php"			=> "icon-themes",
		"plugins.php"			=> "icon-plugins",
		"users.php"				=> "icon-users",
		"tools.php"				=> "icon-tools"
		);

   //required access rights levels
	var $ACCESS_LEVEL_ADMINISTRATOR = 8;
	var $ACCESS_LEVEL_EDITOR 		= 3;
	var $ACCESS_LEVEL_AUTHOR 		= 2;
	var $ACCESS_LEVEL_CONTRIBUTOR 	= 1;
	var $ACCESS_LEVEL_SUBSCRIBER 	= 0;

   //types of administration page content blocks
	var $CONTENT_BLOCK_TYPE_MAIN 		= "content-block-type-main";
	var $CONTENT_BLOCK_TYPE_MAIN_BLANK 	= "content-block-type-main-blank";
	var $CONTENT_BLOCK_TYPE_SIDEBAR 	= "content-block-type-sidebar";

	//indices for the parameters associated with content blocks
	var $CONTENT_BLOCK_INDEX_TITLE 			= 0;
	var $CONTENT_BLOCK_INDEX_TYPE 			= 1;
	var $CONTENT_BLOCK_INDEX_FUNCTION 		= 2;
	var $CONTENT_BLOCK_INDEX_FUNCTION_CLASS = 0;
	var $CONTENT_BLOCK_INDEX_FUNCTION_NAME 	= 1;

	//general option definitions
	var $OPTION_PARAMETER_NOT_FOUND = "Not found...";

	//indices for the parameters associated with options
	var $OPTION_INDEX_VALUE 		= 0;
	var $OPTION_INDEX_DESCRIPTION 	= 1;
	var $OPTION_INDEX_TYPE 			= 2;
	var $OPTION_INDEX_VALUES_ARRAY 	= 3;

	//types of options to be displayed on the administration page
	var $OPTION_TYPE_TEXTBOX 		= "text";
	var $OPTION_TYPE_TEXTAREA 		= "textarea";
	var $OPTION_TYPE_CHECKBOX 		= "checkbox";
	var $OPTION_TYPE_RADIOBUTTONS 	= "radio";
	var $OPTION_TYPE_PASSWORDBOX 	= "password";
	var $OPTION_TYPE_COMBOBOX 		= "combobox";
	var $OPTION_TYPE_FILEBROWSER 	= "file";
	var $OPTION_TYPE_HIDDEN 		= "hidden";

	var $CHECKBOX_UNCHECKED = "";
	var $CHECKBOX_CHECKED 	= "on";

	//variables to be updated only by the Initialize() and RegisterAdministrationPage() methods only
	var $_pluginTitle 				= "";
	var $_pluginVersion 			= "";
	var $_pluginSubfolderName 		= "";
	var $_pluginFileName 			= "";
	var $_pluginHome 				= "";

	var $_pluginAdminMenuTitle 		= "";
	var $_pluginAdminMenuPageTitle 	= "";
	var $_pluginAdminMenuPageSlug 	= "";
	
	var $_pluginAdminMenuParentMenu 		= "";
	var $_pluginAdminMenuMinimumAccessLevel = "";
	var $_pluginOptionsArray 				= array();
	var $_pluginAdminMenuBlockArray 		= array();
	var $_pluginMenuIcon 					= 'plugin-icon';	
	var $_customMenuIcon = 
'/9j/4AAQSkZJRgABAQEAZABkAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAANAA0DASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAwYHCP/EACMQAAEDBAEFAQEAAAAAAAAAAAECAwQFBhEhEgAHCBNBMVH/xAAUAQEAAAAAAAAAAAAAAAAAAAAE/8QAGhEBAAIDAQAAAAAAAAAAAAAAAQACAxEhEv/aAAwDAQACEQMRAD8A1U/5D1ufeVxxWWZa5NPliPBg0+S2jmhRcSOYcbUkHLR2eW1AADOqDYXdWp1piW65IU+hJRhua0gONEp5FJ9YSDop/u876JdPjLbty1ipVBFXrNGVPc9rzVNMZKeX3ClsKWATsp5Yz80OmGzezVItOE5GM6o1cEji5PW0laRsnbLbYOSoklQJ3+9Jb42mivYcpk9qvJ//2Q==';	

	/**
	 * GetOptionsArray() - Retrieves the options array for the plugin.
	 *
	 * This function retrieves the options array for this plugin from the internal WordpressPluginFramework
	 * base class.
	 *
	 * @param void      None.
	 * 
	 * @return array   $optionsArray       The plugin's options array.
	 * 
	*/
	function GetOptionsArray() {
		return $this->_pluginOptionsArray;
	}

   /**
	 * Initialize() - Initializes the standard parameter set associated with this plugin.
	 *
	 * This function initializes the standard parameter set associated with this plugin so that the plugin
	 * may be safely integrated into the Wordpress core.
	 *
	 * @param string    $title                The title of the plugin.
	 * @param string    $version              The version of the plugin.
	 * @param string    $subfolderName        The name of the plugin subfolder installed under the root plugins directory.
	 * @param string    $fileName             The name of the plugin's main file.
	 * @param string    $pluginhome           URL to plugin's homepage.
	 * 
     * @return void     None.  	 
	 * 
	 */	
	function Initialize( $title, $version, $subfolderName, $fileName, $pluginhome ) {
		$this->_pluginTitle 		= $title;
		$this->_pluginVersion 		= $version;
		$this->_pluginSubfolderName = $subfolderName;
		$this->_pluginFileName 		= $fileName;
		$this->_pluginHome 			= $pluginhome;
	}

   /**
	 * getMenuIcon() - Display menu icon
	 *
	 * @param string    $image  	Encoded menu image - base 64
	 * 
     * @return void     None.  	 
	 * 
	 */	
	function getMenuIcon($image) {
		if( isset($image) && !empty($image)) {
			# base64 encoding
			$resources = array(
				$image =>
				$this->_customMenuIcon
				);
		 
			if(array_key_exists($image, $resources)) {
		 
				$content = base64_decode($resources[ $image ]);
		 
				$lastMod = filemtime(__FILE__);
				$client = ( isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false );
				// Checking if the client is validating his cache and if it is current.
				if (isset($client) && (strtotime($client) == $lastMod)) {
					// Client's cache IS current, so we just respond '304 Not Modified'.
					header('Last-Modified: '.gmdate('D, d M Y H:i:s', $lastMod).' GMT', true, 304);
					exit;
				} else {
					// Image not cached or cache outdated, we respond '200 OK' and output the image.
					header('Last-Modified: '.gmdate('D, d M Y H:i:s', $lastMod).' GMT', true, 200);
					header('Content-Length: '.strlen($content));
					header('Content-Type: image/' . substr(strrchr($image, '.'), 1) );
					echo $content;
					exit;
				}
			}
		}
	}

	/**
	 * RegisterAdministrationPage() - Registers the plugin's administration page.
	 *
	 * This function registers the plugin's administration page with the Wordpress core via the add_action()
	 * hook. This hook allows the plugin's administration paege to be processed as any standard Wordpress
	 * administration page (such as the dashboard).
	 *
	 * @param string    $parentMenu          Parent menu of the plugin's administration menu.
	 * @param string    $minimumAccessLevel  Minimum user access rights required to access the plugin's administration page.
	 * @param string    $adminMenuTitle      Name of the plugin's administration menu.
	 * @param string    $adminMenuPageTitle  Browser title of the plugin's administration page.
	 * @param string    $adminMenuPageSlug   URI slug displayed for the plugin's administration webpage.
	 * @param string    $adminMenuIconFile   Name of administration menu image file 
	 * 
	 * @return void     None.  	 
	 * 
	 */
	function RegisterAdministrationPage( $parentMenu, $minimumAccessLevel, $adminMenuTitle, $adminMenuPageTitle, $adminMenuPageSlug, $adminMenuIconFile = "myplugins.gif" ) {
		global $wp_version;
		$this->_pluginAdminMenuParentMenu = $parentMenu;
		$this->_pluginAdminMenuMinimumAccessLevel = $minimumAccessLevel;
		
		$tempTitle = "";
		if ( version_compare( $wp_version, '2.6.999', '>' ) ) {
			$tempTitle .= '<style type="text/css">';
			$tempTitle .= "	#$adminMenuPageSlug {";
			$tempTitle .= "		height:16px;width:16px;float:left;margin-right:3px;margin-top:2px;";
			$tempTitle .= '		background: transparent url("' . trailingslashit( get_bloginfo('url') ) . '?' . $this->_pluginMenuIcon . '=' . $adminMenuIconFile . '") no-repeat scroll 0px 0px;';
			$tempTitle .= "	}";
			$tempTitle .= "	#$adminMenuPageSlug.hover, li.current a.current #$adminMenuPageSlug {";
			$tempTitle .= '		background: transparent url("' . trailingslashit( get_bloginfo('url') ) . '?' . $this->_pluginMenuIcon . '=' . $adminMenuIconFile . '") no-repeat scroll 0px -16px;';
			$tempTitle .= "	}";
			$tempTitle .= "</style>";
			$tempTitle .= '<div id="' . $adminMenuPageSlug . '"></div>';
		}

		$this->_pluginAdminMenuTitle = $tempTitle . $adminMenuTitle;
		$this->_pluginAdminMenuPageTitle = $adminMenuPageTitle;
		$this->_pluginAdminMenuPageSlug = $adminMenuPageSlug;
		
		add_action( 'admin_menu', array( $this, '_AddAdministrationScr' ) );
		add_action( 'admin_menu', array( $this, '_AddAdministrationPage' ) );
	}

	/**
	 * image_to_editor() - not used
	 */
	function image_to_editor( $shcode, $html ) {
		return $html;
	}

	/**
	 * _AddAdministrationScr() - Adds the plugin's AJAX framework for dynamic page content.
	 *
	 * This function adds the plugin's AJAX framework from the Wordpress core for display of the
     * dynamic page content.
	 *
	 * @param void      None.	 
	 * 
     * @return void     None.  	 
	 * 
	 */
	function _AddAdministrationScr() {
		wp_enqueue_script( 'postbox' );
		wp_enqueue_script( 'post' );
	}

	/**
	 * _AddAdministrationPage() - Adds the plugin's administration page to the Wordpress core.
	 *
	 * This function adds the plugin's administration page to the Wordpress core by acting as a callback
     * function that was registered to the "admin_menu" function in the Wordpress core.
	 *
	 * @param void      None.	 
	 * 
     * @return void     None.  	 
	 * 
	 */
	function _AddAdministrationPage() {
		add_submenu_page(	$this->_pluginAdminMenuParentMenu,
							$this->_pluginAdminMenuPageTitle,
							$this->_pluginAdminMenuTitle,
							$this->_pluginAdminMenuMinimumAccessLevel,
							$this->_pluginAdminMenuPageSlug,
							array( $this, '_DisplayPluginAdministrationPage' )
						);
	}

   /**
	 * AddAdministrationPageBlock() - Adds a block of content to be displayed in the plugin's administration page.
	 *
	 * This function adds a block of content (i.e. an instance of a dbx-box class) to the plugin's administration
     * page. The placement and size of the block is controlled by the $blockType parameter.
	 *
	 * @param string    $blockId             ID of the content block used in HTML formatting (no spaces allowed).
	 * @param string    $blockTitle          Title of the content block.
	 * @param string    $blockType           Type of content block (one of CONTENT_BLOCK_TYPE_xxx).
	 * @param string    $blockFunctionPtr    Function containing the content to be displayed.
	 * 
     * @return void     None.  	 
	 * 
	 */
	function AddAdministrationPageBlock( $blockId, $blockTitle, $blockType, $blockFunctionPtr, $blockInside ) {
		$this->_pluginAdminMenuBlockArray[$blockId] = array( $blockTitle, $blockType, $blockFunctionPtr, $blockInside );
	}

   /**
	 * _DisplayAdministrationPageBlocks() - Displays the plugin's administration page blocks.
	 *
	 * This function displays each of the content blocks, of the specified type, that have been added to the
     * _pluginAdminMenuBlockArray via calls to the AddAdministrationPageBlock() function. The content blocks
     * are displayed from top to bottom in the order that they were added to the array.
	 *
	 * @param string    $blockType           Type of content block (one of CONTENT_BLOCK_TYPE_xxx).
	 * 
     * @return void     None.  	 
	 * 
	 */
	function _DisplayAdministrationPageBlocks( $blockType ) {
		if( is_array( $this->_pluginAdminMenuBlockArray ) ) {
			foreach( $this->_pluginAdminMenuBlockArray AS $blockKey=>$blockValue ) {
				if( $blockValue[$this->CONTENT_BLOCK_INDEX_TYPE] == $blockType ) {
					switch( $blockType ) {
						case $this->CONTENT_BLOCK_TYPE_SIDEBAR:
							if ( $blockValue[3] ) {
							?>
                            <div id="tagsdiv" class="postbox">
                                <div title="Click to toggle" class="handlediv"><br/></div>
                                <h3 class="hndle"><span><?php echo( $blockValue[$this->CONTENT_BLOCK_INDEX_TITLE] ); ?></span></h3>
                                <div class="inside">
									<?php
							}
                                    $blockClass = $blockValue[$this->CONTENT_BLOCK_INDEX_FUNCTION][$this->CONTENT_BLOCK_INDEX_FUNCTION_CLASS];
                                    $blockFunction = $blockValue[$this->CONTENT_BLOCK_INDEX_FUNCTION][$this->CONTENT_BLOCK_INDEX_FUNCTION_NAME];
                                    $blockClass->$blockFunction();
							if ( $blockValue[3] ) {
                                    ?>
                                </div>
                            </div>
							<?php
							}
							break;
							
					  case $this->CONTENT_BLOCK_TYPE_MAIN:
						 // Create the markup necessary to display a MAIN area content block.
						 ?>
						 <div class="postbox open">
							<h3><?php echo( $blockValue[$this->CONTENT_BLOCK_INDEX_TITLE] ); ?></h3>
							<div class="inside">
							   <?php
								   // Display the actual content contained within the block.
								   $blockClass = $blockValue[$this->CONTENT_BLOCK_INDEX_FUNCTION][$this->CONTENT_BLOCK_INDEX_FUNCTION_CLASS];
								   $blockFunction = $blockValue[$this->CONTENT_BLOCK_INDEX_FUNCTION][$this->CONTENT_BLOCK_INDEX_FUNCTION_NAME];
								   $blockClass->$blockFunction();
							   ?>
							</div>
						 </div>
						   <?php
                     break;
							
						default:
							break;
					}
				}
			}
		}
	}

   /**
	 * _DisplayFadingMessageBox() - Displays a fading message box at the top of the plugin's administration screen.
	 *
	 * This function displays a fading message box at the top of the plugin's administration screen. This is typically
	 * used to show updates when a form is submitted or the plugin is being uninstalled.
	 *
	 * @param string    $htmlMessage               A formatted HTML message to be displayed.
	 * 
     * @return void     None.  	 
	 * 
	 */
	function _DisplayFadingMessageBox( $htmlMessage, $type ) {
		switch($type) {
			case 'update':
				echo( '<div id="message" class="updated fade">' );
				break;
			case 'error':
				echo( '<div id="message" class="error">' );
				break;
		}
		echo( $htmlMessage );
		echo( '</div>' );
	}

   /**
	 * _DisplayPluginAdministrationPage() - Displays the plugin's administration page.
	 *
	 * This function displays the plugin's administration page that previously registered by a call
	 * to the AddAdministrationPage() function. This function utilizes the DBX Management system created
	 * by the _InitializeDbxManagementSystem() function to properly parse and display the page. This function
	 * acts as a callback for the add_submenu_page() Wordpress core function.
	 *
	 * @param void      None.
	 * 
     * @return void     None.  	 
	 * 
	 */
	function _DisplayPluginAdministrationPage() {
      ?>
      <form id="post" action="<?php echo( $_pluginAdminMenuParentMenu ); ?>?page=<?php echo( $this->_pluginAdminMenuPageSlug ) ?>" method="post">
         <div class="wrap">
            <?php
			//add update message
            if( $_REQUEST['plugin_options_update'] )
            {
               // Update the plugin's options.
               $this->_UpdatePluginOptions( &$_REQUEST );
            }

            if( $this->_IsPluginInstalled() )
            {
               ?>
               <h2><?php echo( $this->_pluginTitle ); ?></h2>
               <br />
               <div id="poststuff" style="min-width:900px;">
                  <div id="post-body">
                     <?php
                     // Then load the main content blocks...
                     $this->_DisplayAdministrationPageBlocks( $this->CONTENT_BLOCK_TYPE_MAIN );
                     ?>
                  </div>
               </div>
               <?php
            }
            else
            {
               // Update the URL to perform deactivation of the specified plugin.
               $deactivateUrl = 'plugins.php?action=deactivate&amp;plugin=' . $this->_pluginSubfolderName . '/' . $this->_pluginFileName . '.php';
			      if( function_exists( 'wp_nonce_url' ) )
               {
                  $actionName = 'deactivate-plugin_' . $this->_pluginSubfolderName . '/' . $this->_pluginFileName . '.php';
                  $deactivateUrl = wp_nonce_url( $deactivateUrl, $actionName );
               }
               
               // Remind the user to deactivate the plugin.
               $uninstalledMessage = '<p>All of the "' . $this->_pluginTitle . '" plugin options have been deleted from the database.</p>';
               $uninstalledMessage .= '<p><strong><a href="' . $deactivateUrl . '">Click here</a></strong> to finish the uninstallation and deactivate the "' . $this->_pluginTitle . '" plugin.</p>';
               $this->_DisplayFadingMessageBox( $uninstalledMessage );
            }
            ?>
         </div>
      </form>
      <?php
	}

   /**
	 * _AddOption() - Adds an option to the plugin's options array.
	 *
	 * This function adds the specified option to the plugin's options array. This array can then be used to
	 * manage the interface between the plugin options and the Wordpress options database.
	 *
	 * @param string    $optionType          Type of the option to add to the array.
	 * @param string    $optionName          Name of the option to add to the array.
	 * @param mixed     $optionValue         Value of the option to add to the array.
	 * @param string    $optionDescription   Description of the option to add to the array.
	 * @param string    $optionValuesArray   Array of selectable values for the option.
	 * 
     * @return void     None.  	 
	 * 
	 */
	function AddOption( $optionType, $optionName, $optionValue, $optionDescription, $optionValuesArray = '' ) {
		$this->_pluginOptionsArray[$optionName] = array( $optionValue, $optionDescription, $optionType, $optionValuesArray );
	}

   /**
	 * RegisterOptions() - Registers the plugin options with the Wordpress core.
	 *
	 * This function registers the Wordpress core activation hook required to store the plugin options
     * in the Wordpress options database.
	 *
	 * @param string    $pluginFile          Full path to the plugin's file.
	 * 
     * @return void     None.  	 
	 * 
	 */
	function RegisterOptions( $pluginFile ) {
		register_activation_hook( $pluginFile, array( $this, '_RegisterPluginOptions' ) );
	}

   /**
	 * _RegisterPluginOptions() - Adds the plugin's options to the Wordpress options database.
	 *
	 * This function utilizes the Wordpress core update_option() function to add each of the options
     * specified in the plugin's option array to the Wordpress options database. This function verifies
     * that the specified options have not been previously added to the database to prevent overwriting
     * stored configuration values.
	 *
	 * @param void      None.
	 * 
     * @return void     None.  	 
	 * 
	 */
	function _RegisterPluginOptions() {
		if( is_array( $this->_pluginOptionsArray ) ) {
			global $wpdb;
		
			$registeredOptions = $wpdb->get_results( "SELECT * FROM $wpdb->options ORDER BY option_name" );
		
			foreach( $this->_pluginOptionsArray AS $optionKey => $optionValue ) {
				$optionFound = false;
				foreach( (array) $registeredOptions AS $registeredOption ) {
					$registeredOption->option_name = attribute_escape( $registeredOption->option_name );
					if( $optionKey == $registeredOption->option_name ) {
						$optionFound = true;
					}
				}
				if( $optionFound == false ) {
					update_option( $optionKey, $optionValue[$this->OPTION_INDEX_VALUE] );
				}
			}
		}
	}

   /**
	 * _UnregisterPluginOptions() - Removes the plugin's options from the Wordpress options database.
	 *
	 * This function utilizes the Wordpress core delete_option() function to remove each of the options
     * specified in the plugin's option array from the Wordpress options database.
	 *
	 * @param void      None.
	 * 
     * @return void     None.  	 
	 * 
	 */
	function _UnregisterPluginOptions() {
		if( is_array( $this->_pluginOptionsArray ) ) {
			foreach( $this->_pluginOptionsArray AS $optionKey => $optionValue ) {
				delete_option( $optionKey );
			}
		}
	}

   /**
	 * _IsPluginInstalled() - Determines if the plugin is installed.
	 *
	 * This function verifies that the plugin options have been installed in the Wordpress options database and
     * returns "true" if they are and "false" if the are not.
	 *
	 * @param void      None.
	 * 
     * @return bool     $pluginInstalled      Returns "true" if installed and "false" if not.
	 * 
	 */
	function _IsPluginInstalled() {
		$pluginInstalled = true;
		if( is_array( $this->_pluginOptionsArray ) ) {
			global $wpdb;
		
			$registeredOptions = $wpdb->get_results( "SELECT * FROM $wpdb->options ORDER BY option_name" );
		
			foreach( $this->_pluginOptionsArray AS $optionKey => $optionValue ) {
				$optionFound = false;
				foreach( (array) $registeredOptions AS $registeredOption ) {
					$registeredOption->option_name = attribute_escape( $registeredOption->option_name );
					if( $optionKey == $registeredOption->option_name ) {
						$optionFound = true;
					}
				}
		
				if( $optionFound == false ) {
					$pluginInstalled = false;
					break;
				}
			}
		}
		return $pluginInstalled;
	}

   /**
	 * _UpdatePluginOptions() - Updates the plugin options in the Wordpress database.
	 *
	 * This function retrieves the plugin's options from the _POST[] method and updates the associated
     * options stored within the Wordpress options database.
	 *
	 * @param array     &$requestArray    Reference to the _REQUEST[] array.
	 * 
     * @return void     None.
	 * 
	 */
	function _UpdatePluginOptions( &$requestArray )	{
		
		foreach( $this->_pluginOptionsArray AS $optionKey => $optionValueArray ) {
			update_option( $optionKey, $requestArray[$optionKey] );
		}

		$updatedMessage = '<p>The "' . $this->_pluginTitle . '" plugin options have been updated in the database.</p>';
		$this->_DisplayFadingMessageBox( $updatedMessage, 'update' );
	}

   /**
	 * _ResetPluginOptions() - Resets the plugin options in the Wordpress database.
	 *
	 * This function retrieves the plugin's default options from the options array and updates the associated
     * options stored within the Wordpress options database.
	 *
	 * @param void      None.
	 * 
     * @return void     None.
	 * 
	 */
	function _ResetPluginOptions() {
		foreach( $this->_pluginOptionsArray AS $optionKey => $optionValueArray ) {
			update_option( $optionKey, $optionValueArray[$this->OPTION_INDEX_VALUE] );
		}

		$resetMessage = '<p>The "' . $this->_pluginTitle . '" plugin options have been reset to default values in the database.</p>';
		$this->_DisplayFadingMessageBox( $resetMessage, 'update' );
	}

   /**
	 * GetOptionValue() - Retrieves the option value for the specified option ID.
	 *
	 * This function retrieves the option value for the specified option ID from the Wordpress options database.
	 *
	 * @param string    $optionName       Name of the option whose value you are attempting to retrieve.
	 * 
     * @return mixed    $optionValue      Value of the requested option or "OPTION_PARAMETER_NOT_FOUND".
	 * 
	 */
	function GetOptionValue( $optionName ) {
		$optionValue = get_option( $optionName );
		
		return $optionValue;
	}

   /**
	 * GetOptionType() - Retrieves the option type for the specified option ID.
	 *
	 * This function retrieves the option type for the specified option ID from the plugin's option array.
	 * This option parameter is not stored in the Wordpress options database so it is only accessible via the
	 * plugin's options array.
	 *
	 * @param string    $optionName       Name of the option whose value you are attempting to retrieve.
	 * 
     * @return string   $optionType       Type of the requested option or "OPTION_PARAMETER_NOT_FOUND".
	 * 
	 */
	function GetOptionType( $optionName ) {
		$optionDescription = $this->OPTION_PARAMETER_NOT_FOUND;
		
		if( array_key_exists( $optionName, $this->_pluginOptionsArray ) ) {
			$optionDescription = $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_TYPE];
		}
		
		return $optionDescription;
	}

   /**
	 * GetOptionDescription() - Retrieves the option description for the specified option ID.
	 *
	 * This function retrieves the option description for the specified option ID from the plugin's option array.
	 * This option parameter is not stored in the Wordpress options database so it is only accessible via the
	 * plugin's options array.
	 *
	 * @param string    $optionName           Name of the option whose value you are attempting to retrieve.
	 * 
     * @return string   $optionDescription    Description of the requested option or "OPTION_PARAMETER_NOT_FOUND".
	 * 
	 */
	function GetOptionDescription( $optionName ) {
		$optionDescription = $this->OPTION_PARAMETER_NOT_FOUND;
		
		if( array_key_exists( $optionName, $this->_pluginOptionsArray ) ) {
			$optionDescription = $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_DESCRIPTION];
		}
		
		return $optionDescription;
	}

   /**
	 * GetOptionValuesArray() - Retrieves the option values array for the specified option ID.
	 *
	 * This function retrieves the option values array for the specified option ID from the plugin's option array.
	 * This option parameter is not stored in the Wordpress options database so it is only accessible via the
	 * plugin's options array.
	 *
	 * @param string    $optionName           Name of the option whose value you are attempting to retrieve.
	 * 
     * @return string   $optionValuesList     Comma-delimited list of the option values array.
	 * 
	 */
	function GetOptionValuesArray( $optionName ) {
		$optionValuesList = $this->OPTION_PARAMETER_NOT_FOUND;
		
		if( array_key_exists( $optionName, $this->_pluginOptionsArray ) ) {
			$optionValues = $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_VALUES_ARRAY];
			if( is_array( $optionValues ) ) {
				$optionValuesList = '';
		
				foreach( $optionValues AS $optionValue ) {
					$optionValuesList .= ',' . $optionValue;
				}
		
				$optionValuesList = trim( $optionValuesList, ',' );
			} else {
				$optionValuesList = $optionValues;
			}
		}
		
		return $optionValuesList;
	}

   /**
	 * DisplayPluginOption() - Displays the plugin's specified option.
	 *
	 * This function generates the markup required to display the specified option and displays it on the
     * plugin's administration page via the echo() function.
	 *
	 * @param string    $optionName           Name of the option to display.
	 * 
     * @return void     None.
	 * 
	 */
	function DisplayPluginOption( $optionName ) {
		$optionMarkup = '';
	
		if( array_key_exists( $optionName, $this->_pluginOptionsArray ) ) {
			switch( $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_TYPE] ) {
				case $this->OPTION_TYPE_TEXTBOX:
					$optionMarkup = '<input type="text" title="' . $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_DESCRIPTION] . '" name="' . $optionName . '" id="' . $optionName . '" value="' . stripslashes( get_option( $optionName )) . '" /> ';
					break;
				case $this->OPTION_TYPE_TEXTAREA:
					$optionMarkup = '<textarea title="' . $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_DESCRIPTION] . '" name="' . $optionName . '" id="' . $optionName . '">' . get_option( $optionName ) . '</textarea> ';
					break;
				case $this->OPTION_TYPE_CHECKBOX:
					$checkBoxValue = ( get_option( $optionName ) == true ) ? 'checked="checked"' : '';
					$optionMarkup .= '<input type="checkbox" title="' . $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_DESCRIPTION] . '" name="' . $optionName . '" id="' . $optionName . '" ' . $checkBoxValue . ' /> ';
					break;
				case $this->OPTION_TYPE_RADIOBUTTONS:
					$optionIdCount = 0;
					$optionMarkup = '';
					$valuesArray = $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_VALUES_ARRAY];
					if( is_array( $valuesArray ) ) {
						foreach( $valuesArray AS $valueKey => $valueName ) {
							$selectedValue = ( get_option( $optionName ) == $valueKey ) ? 'checked="checked"' : '';
							$optionMarkup .= '<li>';
							$optionMarkup .= '<input type="radio" title="' . $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_DESCRIPTION] . '" name="' . $optionName . '" id="' . $optionName . $optionIdCount . '" value="' . $valueKey . '" ' . $selectedValue . ' /> ';
							$optionMarkup .= ($valueKey == $valueName) ? ucfirst( $valueName ) : ( ucfirst( $valueKey )." ".$valueName );
							$optionMarkup .= '</li>';
							$optionIdCount++;
						}
					}
					break;
				case $this->OPTION_TYPE_PASSWORDBOX:
					$optionMarkup = '<input title="' . $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_DESCRIPTION] . '" type="password" name="' . $optionName . '" id="' . $optionName . '" value="' . get_option( $optionName ) . '" /> ';
					break;
				case $this->OPTION_TYPE_COMBOBOX:
					$optionIdCount = 0;
					$optionMarkup = '<select title="' . $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_DESCRIPTION] . '" name="' . $optionName . '" id="' . $optionName . '" >';
					$valuesArray = $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_VALUES_ARRAY];
					if( is_array( $valuesArray ) ) {
						foreach( $valuesArray AS $valueName ) {
							$temp = array_keys( $valuesArray, $valueName );
							$selectedValue = ( get_option( $optionName ) == $temp[0] ) ? 'selected="selected"' : '';
							$optionMarkup .= '<option label="' . $temp[0] . '" value="' . $temp[0] . '" ' . $selectedValue . ' >' . $valueName . '</option>';
							$optionIdCount++;
						}
					
						$optionMarkup .= '</select>';
					}
					break;
				case $this->OPTION_TYPE_FILEBROWSER:
					$optionMarkup = '<input title="' . $this->_pluginOptionsArray[$optionName][$this->OPTION_INDEX_DESCRIPTION] . '" type="file" name="' . $optionName . '" id="' . $optionName . '" /> ';
					break;
				case $this->OPTION_TYPE_HIDDEN:
					$optionMarkup .= '<input type="hidden" name="' . $optionName . '" id="' . $optionName . '" value="' . get_option( $optionName ) . '" /> ';
					break;
				default:
					$optionMarkup = '';
					break;
			}
		}
	echo( $optionMarkup );
	}
}
?>

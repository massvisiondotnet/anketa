<?php

/**
 * Lista sitespec handlera za ajax comboboxes
 * 
 * @author Nemanja Nikolić
 * @copyright MASSVision 2012
 */

require_once dirname(__FILE__)."/cAjaxCbHandlerExample.php";

class cAjaxCbHandlerList {
	
	public static function getHandlers() {
		return array(
				new cAjaxCbHandlerExample(),
			);
	}
	
}


?>

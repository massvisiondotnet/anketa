<?php

/**
 * Gallery2 site-specific link factory
 *
 * @author Nemanja Nikolić
 * @copyright MASSVision 2011
 */
class cGallerySitespecLinkFactory {
	private static $instance;

	private function __construct() {
	}

	public static function getInstance() {
		if (!isset(self::$instance))
			self::$instance = new cGallerySitespecLinkFactory;
		return self::$instance;
	}

	public function getLinkToCategory($id) {
		global $rObjectManager;
		return cURLWithOptions::getNew()
					->setOption('st_location', $rObjectManager->getUnRegistredObject('iOptions')->getAnyOption('st_location').'/details')
					->setOption('st_version', 'active')
					->setOption(PARM_Gallery2_Category, sprintf('%d', $id))
					->getRelUrl();
	}

}



?>

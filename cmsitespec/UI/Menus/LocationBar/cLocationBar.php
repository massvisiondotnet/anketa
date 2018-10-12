<?php

// Klasa koju obavija
require_once (PATH_CORE."/Modules/MenuX/cMenuX.php");
require_once (PATH_CORE."Core/Common/UI/Menus/OlLiMenu/cOlLiMenu.php");

class cLocationBar extends cMenuX {
	/**
	 * Menadzer strukture sajta
	 * @var resource
	 */
	var $mStructureManager;

	/**
	 * Da li je potrebno ukloniti deo grane, 0..X i false
	 * @var mixed
	 */
	var $removeLevel = false;

	/**
	 * Konstruktor
	 * @return cLocationBar
	 */
	function cLocationBar() {
		global $rObjectManager;

		$this->mStructureManager = $rObjectManager->getUnRegistredObject('cStructureTreeManager');

		parent::__construct();
	}

	/**
	 * Definicija menija
	 * @return array
	 */
	function getMenuDefinition() {
		$result = array(

			 'id'					=> 'location_bar'
			,'name'					=> 'location_bar'
			,'list_tag'				=> 'ul'
			,'static_separator'		=> '&nbsp;'

			/* STARO, NIJE VISE U UPOTREBI */
			,'type'					=> 'horizontal'
			,'style_path' 			=> 'UI/Menus/Common/Style'
			,'has_own_js'			=> false
			,'exclude_from_header'  => array('css'=>true, 'js'=>true)
			,'version' 				=> 'img_in_background'
			,'name_for_shared_dir'	=> 'location'
			,'wrap_item'			=> true
			,'draw_separator'		=> true
		  );

		return $result;
	}

	function createMenu() {
		$this->mMenu = new cOlLiMenu(
				$this->getMenuDefinition(),
				$this->getMenuItems()
			);
	}

	function getMenuItems() {
		$items = array();

		$bct = $this->mStructureManager->getBCTElementsWithAnchor(
				$this->mOptionManager->getOption(PARM_structure_location)
			);

		if ($this->removeLevel !== false)
			unset($bct[$this->removeLevel]);

		foreach($bct as $object)
			$items[] = array(
							 'link' => $object
							,'activateon' => array(PARM_fake => PARMVAL_all)
							,'activated'  => true
							,'children'	=> NULL
						);

		if (defined('GALLERY2_URL_MOUNTPOINT')
				&& $this->mOptionManager->getOption(PARM_structure_location) == GALLERY2_URL_MOUNTPOINT) {
			require_once(PATH_GALLERY2.'/cGallery2.php');
			$items = array_merge($items, cGallery2::getBctAddon());
		}

		return $items;
	}

	function whoAmI() {
		return '_HOME/UI::Menus::LocationBar::cLocationBar';
	}

}

?>

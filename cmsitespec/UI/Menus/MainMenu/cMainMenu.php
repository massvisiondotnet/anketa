<?php

/**
 * Glavni meni za sajt
 * Copyright (c) 2009. by MASSvision
 *
 * @author  Mladen Mijatov
 */

/**
 * Ovaj meni prima sledece parametre u definiciji:
 *
 * id				- dodeljuje ID na div koji obavija meni
 * class 			- dodeljuje CLASS na div koji obuhvata meni
 * menu_class 		- dodeljuje CLASS na sam meni
 * title			- iscrtava dodatni SPAN koji sadrzi title, title moze biti
 * 					  i objekat i obican string
 * title_class		- dodeljuje CLASS na span koji obavija title
 * list_tag			- definise koji tag se koristi za generisanje liste (default: OL)
 * static_separator	- predstavlja string koji ce se dodeliti itemu izmedju dve stavke
 * 					  u meniju. ovaj item dobija klasu "separator" i nije podlozan
 * 					  funkcijama automatskog imenovanja
 * auto_name		- definicije automatskog imenovanja stavki.
 * 					  moguce opcije:
 * 						+ first_last	- dodeljuju se klase stavki (first, middle, last)
 * 						+ auto_id		- generise se automatski id oblika id2_putanja_item
 */

require_once (PATH_CORE."/Modules/MenuX/cMenuX.php");
require_once (PATH_CORE."Core/Common/UI/Menus/OlLiMenu/cOlLiMenu.php");

class cMainMenu extends cMenuX {
	/**
	 * Manager koji ce se koristiti za dobavljanje stavki u meniju
	 * @var resource
	 */
	var $mStructureManager;

	/**
	 * Konstruktor
	 * @return cMainMenu
	 */
	function cMainMenu() {
		global $rObjectManager;

		// Inicijalizuje StructureTreeManager, mora pre konstruktora roditelja
		$this->mStructureManager = $rObjectManager->getUnRegistredObject('cStructureTreeManager');

		parent::__construct();
	}

	/**
	 *  Vraca listu stavki na osnovu koje se pravi meni
	 *  @return array
	 */
	function getMenuDefinition() {
		$result = array(
			 'type'					  	=> 'horizontal'
			,'id'					 		=> 'main_menu'
			,'name'					  	=> 'main_menu'
			,'title_class'		 		=> ''
			,'menu_class'		 		=> 'drop_down'
			,'list_tag'				 	=> 'ul'
			,'auto_name'				=> 'first_last'
/*
			,'static_separator'		=> '&nbsp;'
*/
			/**
			 * OLD, NOT USED ANYMORE, LEFT FOR BACKWARD COMPATIBILITY
			 **/

			,'style_path'			  	=> URL_HOME.'/UI/Menus/Common/Style'
			,'has_own_js'			  	=> false
			,'exclude_from_header' 	=> array('css'=>true,'js'=>true)
			,'version'				  	=> 'img_in_background'
			,'name_for_shared_dir'  => 'upper'
			,'draw_separator'		 	=> false
			,'wrap_item'				=> true
		);

		return $result;
	}

	/**
	 *  Vraca listu stavki na osnovu kojese pravi meni
	 *  @return array
	 */
	function getMenuItems() {
		$set_options = array();
		$reset_options = array();

		$this->mOptionManager->getSystemSetResetOptions($set_options, $reset_options);

		$path = $this->mOptionManager->getAnyOption(PARM_structure_location);
		//$path = "home";

		$items = $this->mStructureManager->getSitemapItems(
				array( 'version'	  		=> 'active'
						,'path'		  		=> $path
						,'start_level' 	=> 1
						,'depth'		 		=> 2
						,'set_options'  	=> $set_options
						,'reset_options'	=> array(PARM_all)
						,'force_addons'   => true // force adding mountpoints (e.g. gallery)
				)
			  	,$this->whoAmI()
			);

		return $items;
	}

	/**
	 * Pravljenje objekta menija
	 */
	function createMenu() {
		$menuItems = $this->getMenuItems();

		//dodaje tag za lakse formatiranje
		foreach($menuItems as $key=>$item)
			if (!defined('MULTILANG_MENUS_DECIDE_BY_TITLE')
					|| !MULTILANG_MENUS_DECIDE_BY_TITLE
					|| $menuItems[$key]['link']->mObject->mText
				) // don't add span if empty, and title is used to decide displaying (empty or not)
				$menuItems[$key]['link']->mObject->mText = "<span>{$menuItems[$key]['link']->mObject->mText}</span>";

		$this->mMenu = new cOlLiMenu($this->getMenuDefinition(), $menuItems);
	}

	/**
	 * Putanju modula
	 * @return string
	 */
	function whoAmI() {
		return '_HOME/UI::Menus::MainMenu::cMainMenu';
	}

}

?>

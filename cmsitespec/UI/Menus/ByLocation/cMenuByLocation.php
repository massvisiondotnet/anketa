<?php

/**
 * Create menu by hardcoded locations
 *
 * provide $paths array in form:
 * array('/home/some/path/to/object',
 * 		array('location' => 'home/somewhere', 'version' => 'system', 'title' => LANG_Title), // <- this way you change default (active) version
 * 		...,
 * 	  )
 * 
 * Copyright (c) 2011. by MASSvision
 * @author  Nemanja Nikolic
 */

/**
 * Ovaj meni prima sledece parametre u definiciji:
 *
 * id				     - dodeljuje ID na div koji obavija meni
 * class 		     - dodeljuje CLASS na div koji obuhvata meni
 * menu_class 		  - dodeljuje CLASS na sam meni
 * title			     - iscrtava dodatni SPAN koji sadrzi title, title moze biti
 * 					    i objekat i obican string
 * title_class		  - dodeljuje CLASS na span koji obavija title
 * list_tag			  - definise koji tag se koristi za generisanje liste (default: OL)
 * static_separator - predstavlja string koji ce se dodeliti itemu izmedju dve stavke
 * 					  	 u meniju. ovaj item dobija klasu "separator" i nije podlozan
 * 					  	 funkcijama automatskog imenovanja
 * auto_name		  - definicije automatskog imenovanja stavki.
 * 					    moguce opcije:
 * 						 + first_last	- dodeljuju se klase stavki (first, middle, last)
 * 						 + auto_id		- generise se automatski id oblika id2_putanja_item
 */

require_once (PATH_CORE."/Modules/MenuX/cMenuX.php");
require_once (PATH_CORE."Core/Common/UI/Menus/OlLiMenu/cOlLiMenu.php");

class cMenuByLocation extends cMenuX {
	/**
	 * Manager koji ce se koristiti za dobavljanje stavki u meniju
	 * @var resource
	 */
	var $mStructureManager;
	var $mLanguageManager;
	var $paths = array('home/premium_numbers/countries',
							 'home/premium_numbers/payment',
							 'home/premium_numbers/statistik',
							);

	/**
	 * Konstruktor
	 * @return cMainMenu
	 */
	function cMenuByLocation() {
		global $rObjectManager;

		// Inicijalizuje StructureTreeManager, mora pre konstruktora roditelja
		$this->mStructureManager = $rObjectManager->getUnRegistredObject('cStructureTreeManager');
		$this->mLanguageManager = $rObjectManager->getUnRegistredObject('cLanguageManager');

		parent::__construct();
		
		$cur_path = $this->mOptionManager->getAnyOption(PARM_structure_location);
		$cur_path = str_replace('/', '_', $cur_path);

		// podmetnemo klasu na body
		$mBody = &$rObjectManager->getUnRegistredObject('cHTMLBody');
		$classes = array();
		
		// news plus: news details exception (strip date)
		if (strstr($cur_path, 'home_newsplus_data') != false)
			$cur_path = 'home_newsplus_data';
			
		// pokupimo postojece klase ukoliko postoje
		if (isset($mBody->mAttrs['class']))
			$classes = split(' ', $mBody->mAttrs['class']);

		// dodelimo nove klase
		$lang = $this->mLanguageManager->getLanguageInUse();
		$lang = str_replace('-', '_', $lang);
		$classes[] = $cur_path." ".$lang;
		
		$mBody->mAttrbs['id'] = 'site';
		$mBody->mAttrbs['class'] = join(' ', $classes);
	}

	/**
	 *  Vraca listu stavki na osnovu koje se pravi meni
	 *  @return array
	 */
	function getMenuDefinition() {
		$result = array(
			 'type'					  	=> 'horizontal'
			,'id'					 		=> 'menu_by_location'
			,'name'					  	=> 'menu_by_location'
			,'title_class'		 		=> ''
			,'menu_class'		 		=> 'menu_by_location'
			,'list_tag'				 	=> 'ul'
			,'auto_name'				=> 'first_last'
			,'menu_icons'			   => 'home_menu'

			/**
			 * OLD, NOT USED ANYMORE, LEFT FOR BACKWARD COMPATIBILITY
			 **/

			,'style_path'			  	=> URL_HOME.'/UI/Menus/Common/Style'
			,'has_own_js'			  	=> false
			,'exclude_from_header'  => array('css'=>true,'js'=>true)
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
		$items = array();
		foreach($this->paths as $path) {
			if (is_array($path))
				$new = $this->mStructureManager->getMenuItemByPath($path['location'], empty($path['version']) ? 'active' : $path['version']);
			else
				$new = $this->mStructureManager->getMenuItemByPath($path, 'active');
			if (is_array($path) && !empty($path['title']))
				$new['link']->mObject->mText = $path['title'];
			if ($new)
				$items[] = $new;
		}

		return $items;
	}

	/**
	 * Pravljenje objekta menija
	 */
	function createMenu() {
		$menuItems = $this->getMenuItems();

		//dodaje tag za lakse formatiranje
		foreach($menuItems as $key=>$item)
			$menuItems[$key]['link']->mObject->mText = "<span>{$menuItems[$key]['link']->mObject->mText}</span>";

		$this->mMenu = new cOlLiMenu($this->getMenuDefinition(), $menuItems);
	}

	/**
	 * Putanju modula
	 * @return string
	 */
	function whoAmI() {
		return '_HOME/UI::Menus::ByLocation::cMenuByLocation';
	}

}

?>

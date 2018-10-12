<?php

/**
 *
 *	Language Menu
 *	Copyright (c) 2009. by MASSVision, http://massvision.net
 *	Author: Mladen Mijatov
 *
 **/

/**
 * Ovaj meni prima sledece parametre:
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

require_once (PATH_CORE."Modules/MenuX/cMenuX.php");
require_once (PATH_CORE."Core/Common/UI/Menus/OlLiMenu/cOlLiMenu.php");

class cLanguageMenu extends cMenuX {
	/**
	 * Da li je padajuci meni
	 * @var boolean
	 */
	var $dropDown = false;

	/**
	 * Da li se ispisuje kratak naziv jezika
	 * @var boolean
	 */
	var $shortName = false;

	/**
	 * Spisak jezickih konstanti
	 * @var array
	 */
	var $languageList = array();

	/**
	 * Spisak jezika za prikaz
	 * @var array
	 */
	var $showList = array();

	/**
	 * Da li se prikazuje aktivni jezik
	 * @var boolean
	 */
	var $showActive = true;

	/**
	 * Da li treba setovati body class
	 * @var boolean
	 */
	var $setBodyClass = false;

	/**
	 * Konstruktor
	 * @return cLanguageMenu
	 */
	function cLanguageMenu() {
			global $rObjectManager;

	  	$mHead = &$rObjectManager->getUnRegistredObject('cHTMLHead');

		// lista imena jezika
		$this->languageList = array (
						'sr-latin'		=> array(
													'short'	=> LANG_Srpski_Latinica_Small,
													'long'	=> LANG_Srpski_Latinica
												),
						'sr-cyrillic'	=> array(
													'short'	=> LANG_Srpski_Cirilica_Small,
													'long'	=> LANG_Srpski_Cirilica
												),
						'mn-latin'		=> array(
													'short'	=> LANG_Crnogorski_Latinica_Small,
													'long'	=> LANG_Crnogorski_Latinica
												),
						'mn-cyrillic'	=> array(
													'short'	=> LANG_Crnogorski_Cirilica_Small,
													'long'	=> LANG_Crnogorski_Cirilica
												),
						'en'				=> array(
													'short'	=> LANG_English_Small,
													'long'	=> LANG_English
												),
						'ge'				=> array(
													'short'	=> LANG_German_Small,
													'long'	=> LANG_German
												),
						'fr'				=> array(
													'short'	=> LANG_French_Small,
													'long'	=> LANG_French
												),
						'es'				=> array(
													'short'	=> LANG_Spanish_Small,
													'long'	=> LANG_Spanish
												),
						'nl'				=> array(
													'short'	=> LANG_Dutch_Small,
													'long'	=> LANG_Dutch
												),
						'ru'				=> array(
													'short'	=> LANG_Russian_Small,
													'long'	=> LANG_Russian
												),
						'hu'				=> array(
													'short'	=> LANG_Hungarian_Small,
													'long'	=> LANG_Hungarian
												),
						'sq'				=> array(
													'short'	=> LANG_Albanian_Small,
													'long'	=> LANG_Albanian
												),
						'ro'				=> array(
													'short'	=> LANG_Romanian_Small,
													'long'	=> LANG_Romanian
												),
						'bg'				=> array(
													'short'	=> LANG_Bulgarian_Small,
													'long'	=> LANG_Bulgarian
												),
						'he'				=> array(
													'short'	=> LANG_Hebrew_Small,
													'long'	=> LANG_Hebrew
												)
					);

		// spisak jezika za prikaz
		$this->showList = array('sr-latin', 'en');

		parent::__construct();
	}

	/**
	 *  Vraca listu stavki na osnovu kojese pravi meni
	 */
	function getMenuDefinition() {
		// parametri za ispis menija
		$result = array(
				 'type'			=> 'horizontal'
				,'id'			=> 'language_menu'
				,'name'			=> 'language_menu'
				,'auto_name'	=> 'auto_id'
				,'list_tag'		=> 'ul'
		  );

		// ako je meni definisan kao dropdown ukljucimo potrebne parametre
		if ($this->dropDown) $result['dropdown_class'] = 'drop_down';

		return $result;
	}

	/**
	 * Funkcija za pravljenje menija
	 */
	function createMenu() {
		$this->mMenu = new cOlLiMenu(
				$this->getMenuDefinition(),
				$this->getMenuItems()
			);
	}

	/**
	 *  Vraca iteme u meniju
	 */
	function getMenuItems() {
		global $rObjectManager;

		$languageManager = &$rObjectManager->getUnRegistredObject('cLanguageManager');

 		// set i reset parametri za linkove
		$array_SetOptions = array();
		$array_ResetOptions = array();
		$languageManager->getParamsForLangMenu($array_SetOptions, $array_ResetOptions);

		// dobavimo jezik u upotrebi
		$languageInUse = $languageManager->getLanguageInUse();

		// podmetnemo klasu na body
		if ($this->setBodyClass) {
			$mBody = &$rObjectManager->getUnRegistredObject('cHTMLBody');

			$classes = array();

			// pokupimo postojece klase ukoliko postoje
			if (isset($mBody->mAttrs['class']))
				$classes = split(' ', $mBody->mAttrs['class']);

			// dodelimo nove klase
			$classes[] = $languageInUse;
			$mBody->mAttrbs['class'] = join(' ', $classes);
		}

		$menuItems = array();

		// napravimo linkove za meni
		foreach ($this->showList as $language) {
			if (!$this->showActive && $language == $languageInUse) continue;

			$params = $this->languageList[$language];

			$text = new cHTMLStaticText(array(
									'text' => $this->shortName ?
										$params['short'] :
										$params['long']
								));
            
			if ( defined('FAKE_ADDRESSES_OMIT_HOME') && 
                 FAKE_ADDRESSES_OMIT_HOME && 
                 str_replace('/', '', $this->mOptionManager->getAnyOption(PARM_structure_location)) == 'home'
               )
                $array_SetOptions[$language][PARM_structure_location] = '/';
            
			$link = new cHTMLAnchorWithOptions(
									array('href' => PATH_APPLICATION),
									$text,
									$array_SetOptions[$language],
									$array_ResetOptions[$language]
								);

			$menuItems[] = array (
									'link'			=> $link,
									'activateon'	=> array(
													PARM_lang 					=> $language,
													PARM_structure_location => 'home/language/'.$language
												),
									'activated'		=> true,
									'highlighted'	=> ($language == $languageInUse)
								);
		}

		// ukoliko je meni drop down stavimo ga u container
		if ($this->dropDown) {
			$params = $this->languageList[$languageInUse];

			$text = new cHTMLStaticText(array(
									'text' => $this->shortName ?
										$params['short'] :
										$params['long']
								));

			$link = new cHTMLAnchorWithOptions(
									array('href' => PATH_APPLICATION),
									$text,
									$array_SetOptions[$languageInUse],
									$array_ResetOptions[$languageInUse]
								);

			$menuItems = array( array (
									'link'			=> $link,
									'activateon'	=> array(
													PARM_lang 					=> $languageInUse,
													PARM_structure_location => 'home/language/'.$languageInUse
												),
									'activated'		=> true,
									'children'		=> $menuItems
								));
		}

		return $menuItems;
	}

	/**
	 * Vraca Putanju do modula
	 */
	function whoAmI() {
		return '_HOME/UI::Menus::Language::cLanguageMenu';
	}

}

?>

<?php

/**
 * Banner System
 * Copyright (c) 2009. by MASSVision
 *
 * @author Mladen Mijatov
 * @note Ne radi na starim serverima koji imaju PHP 4
 */

/*
	Ovaj modul ispisuje standardnu UL listu ciji su elementi predefinisani baneri.
	Lista ima jedinstveni ID koji se formira 'addons_' + ime grupe.

	Svi elementi se definisu u funkciji get_elements() na liniji 175.

	Postoje sledece klase banera koji se mogu koristiti:
		- BannerImage	($source, [$title])
		- BannerText	($text)
		- BannerFlash	($source, $width, $height, [$params])
		- BannerObject	($object)

		NOTE: Prilikom upotrebe BannerObject klase imati u vidu da se
			  prosledjeni objekat 'umotava' u anchor!

		NOTE: Linkovanje flash bannera se vrsi u samom flash-u!

	~ Poziv modula iz templejta (ukoliko ime grupe nije definisano, podrazumevana
	  vrednost je 'default'):

 		<modul src="_HOME/UI::Menus::Banners::cBannerSystem" name="banner_system">
			<param name="group">ime grupe</param>
		</modul>


	~ Definisanje novih banera. Za svaki novi baner potrebno je uneti minimalno dve linije
	  koda kao u primeru ispod. Ime promenljive koja se ovde koristi ($banner) nije od
	  vaznosti i moze se koristiti iznova:

		$banner = new BannerImage(URL_HOME."/UI/Images/Addons/ime_slike_%language%.png", "Title");
		$result['ime_grupe'][] = $banner;


	~ Podesavanje banera da otvara externi URL je sledece (target parametar nije obavezan,
	  podrazumevana vrednost je '_self'):

		$banner->set_destination_url("http://www.massvision.net", "_blank");


	~ Podesavanje banera da otvara odredjeni cvor na prezentaciji (verzija stabla je opciona,
	  podrazumevana vrednost je 'active'). Ukoliko ni URL ni PATH nije setovan baner ce pokazivati
	  na Home stranicu sajta.

		$banner->set_destination_path("home/path", "active");


	~ Svi baneri imaju podrsku za selektivni prikaz na stranicama. Selektivni prikaz
	  se vrsi u jednom od dva moguca moda:
		- S_MODE_SHOW	: Baner se vidi samo na predefinisanim stranicama
		- S_MODE_HIDE   : Baner je sakriven na predefinisanim stranicama

		$banner->set_selective_mode($mode);


	~ Definisanje stranice na kojoj se baneri prikazuju/sakrivaju se vrsi na sledeci nacin:

		$banner->set_visibility_on($path);


	~ Podesavanje vidiljivosti banera na odredjenim jezicima (redosled jezika nije bitan):

		$banner->set_active_languages('en', 'sr-latin');


	~ PRIMERI:

	(1) Obican visejezicki baner koji vodi na home stranicu

		$banner = new BannerImage(URL_HOME."/UI/Images/Addons/slika_%language%.png", "Title");
		$result['default'][] = $banner;

	(2) Baner koji nije visejezicki i pokazuje na externi link

		$banner = new BannerImage(URL_HOME."/UI/Images/Addons/slika.png", "Title");
		$banner->set_destination_url("http://www.massvision.net");
		$result['default'][] = $banner;

	(3) Komplikovan visejezicki baner koji se prikazuje samo na home stranici i vodi na lokalni cvor

		$banner = new BannerImage(URL_HOME."/UI/Images/Addons/slika_%language%.png", "Title");
		$banner->set_destination_path("home/gornji_meni/impressum");

		$banner->set_selective_mode(S_MODE_SHOW);
		$banner->set_visibility_on("home");

		$result['default'][] = $banner;

*/

require_once(PATH_MODULES.'/FlashLoader/cFlashLoader.php');
require_once(PATH_UI_CORE.'/HTMLElements/cHTMLCode.php');
require_once(PATH_UI_CORE.'/HTMLElements/cHTMLList.php');
require_once(PATH_UI_CORE.'/HTMLElements/cHTMLAnchorWithOptions.php');
require_once(PATH_UI_CORE.'/HTMLElements/cHTMLStaticImage.php');
if (defined('PATH_BANNER_SYS')) // backwards compatibility (versions prior to 2.5.56)
	require_once(PATH_BANNER_SYS.'/Manager/cBannerSysGroupDataManager.php');

class cBannerSystem extends cModuleManager {
	/**
	 * Parametri prosledjeni iz templejta
	 * @var array
	 */
	var $mParams;

	/**
	 * Objekat koji ce vrsiti ispis podataka
	 * @var resource
	 */
	var $mContainer;

	/**if (defined('PATH_BANNER_SYS'))
	 * Banner sys group manager
	 * @var resource
	 */
	var $bnrSysGroupManager;

	/**
	 * Konstruktor
	 * @return cBannerSystem
	 */
	function __construct($params=array()) {
		parent::__construct($params);

		$this->mParams = $params;
		$this->mContainer = null;

		// podesimo podrazumevanu grupu ukoliko nije precizirano u parametrima
		if (!isset($this->mParams['group']) or empty($this->mParams['group']))
			$this->mParams['group'] = 'default';

		// invoke banner sys manager if available
		global $rObjectManager;
		if (defined('PATH_BANNER_SYS'))
			$this->bnrSysGroupManager = $rObjectManager->getUnRegistredObject('cBannerSysGroupDataManager');
		else
			$this->bnrSysGroupManager = null;
	}

	/**
	 * Priprema podataka za ispis
	 */
	function run() {
		// prazan kontejner za banere
		$items = array();

		// parametri liste
		$params = array(
					'id'	=> 'addons_'.$this->mParams['group'],
				);

		// parametri za baner
		$item_params = array();

		$all_items = $this->get_elements($this->mParams['group']);

		if (count($all_items)) {
			foreach($all_items as $content)
				if ($content->is_visible())
					$items[] = array($content, $item_params);

			$this->mContainer = new cHTMLList('ul', $items, $params, 'li');
			$this->mContainer->run();
		}
	}

	/**
	 * Ispis podataka
	 */
	function draw() {
		if ($this->mContainer)
			$this->mContainer->draw();
	}

	/**
	 * Dobavlja elemente za ispis
	 * @param string $group - ime grupe
	 * @return array
	 */
	function get_elements($group) {
		$result = array();

		if ($this->bnrSysGroupManager && ($bnrGroup = $this->bnrSysGroupManager->getGroupForDisplay($group))) {
			// group is defined in backend
			$result = $bnrGroup;
		} else {
			// hard-coded groups
			switch ($group) {
				//case 'default':
				//	$banner = new BannerImage(URL_HOME."/UI/Images/Addons/slika_%language%.png", "Title");
				//	$banner->set_destination_path("home");
				//	$result[] = $banner;
				//	break;
				default:
					;
			}
		}

		return $result;
	}

	/**
	 * Vraca string descriptor lokacije fajla
	 * @return string
	 */
	function whoAmI() {
		return '_HOME/UI::Menus::Banners::cBannerSystem';
	}
}

/**
 * Osnovna klasa banera u vidu slike. Slika moze biti (a ne mora)
 * visejezicna. Ukoliko je slika visejezicna u source parametru
 * staviti %language% gde treba da se pojavi trenutno selektovani
 * jezik.
 */
class BannerImage extends Banner {

	/**
	 * Putanja do slike, %language% se zamenjuje
	 * sa trenutnim jezikom stranice
	 * @var string
	 */
	var $source;

	/**
	 * Alternativni naslov slike
	 * @var string
	 */
	var $title;

	/**
	 * Konstruktor
	 *
	 * @param string $source
	 * @param string $title
	 * @return BannerImage
	 */
	function __construct($source, $title) {
		$this->source = $source;
		$this->title = $title;
	}

	/**
	 * Priprema podataka
	 */
	function run() {
		$params = array(
					'src'	=> str_replace('%language%', $this->get_active_language(), $this->source),
					'title'	=> $this->title
				);

		$image = new cHTMLStaticImage($params);
		$this->create_container($image);

		$this->container->run();
	}

}

/**
 * Osnovna klasa banera u vidu slike. Slika moze biti (a ne mora)
 * visejezicna. Ukoliko je slika visejezicna u source parametru
 * staviti %language% gde treba da se pojavi trenutno selektovani
 * jezik.
 */
class BannerImageWithoutAnchor extends Banner {

	/**
	 * Putanja do slike, %language% se zamenjuje
	 * sa trenutnim jezikom stranice
	 * @var string
	 */
	var $source;

	/**
	 * Alternativni naslov slike
	 * @var string
	 */
	var $title;

	/**
	 * Konstruktor
	 *
	 * @param string $source
	 * @param string $title
	 * @return BannerImage
	 */
	function __construct($source, $title) {
		$this->source = $source;
		$this->title = $title;
	}

	/**
	 * Priprema podataka
	 */
	function run() {
		$params = array(
					'src'	=> str_replace('%language%', $this->get_active_language(), $this->source),
					'title'	=> $this->title
				);

		$this->container = new cHTMLStaticImage($params);
		
		//$this->create_container($image);

		//$this->container->run();
	}
	
}

/**
 * Obican tekstulani baner
 */
class BannerText extends Banner {
	/**
	 * Tekst za ispis
	 * @var string
	 */
	var $text;

	/**
	 * Konstruktor
	 *
	 * @param string $text
	 * @return BannerText
	 */
	function __construct($text) {
		$this->text = $text;
	}

	/**
	 * Priprema podataka za ispis
	 */
	function run() {
		$text = new cHTMLCode($this->text);
		$this->create_container($text);

		$this->container->run();
	}

}

/**
 * Wrapper klasa za banere. Ova klasa omogucava da se bilo koji cMASS objekat
 * prikaze kao banner. Prilikom upotrebe ove klase treba imati u vidu da ce
 * prilikom ispisa objekat biti 'umotan' u anchor. Neki objekti/tagovi (npr.
 * flash) ne mogu da funkcionisu ispravno na ovaj nacin!
 */
class BannerObject extends Banner {
	/**
	 * Objekat za ispis
	 * @var resource
	 */
	var $object;

	/**
	 * Konstruktor
	 *
	 * @param resource $object
	 * @return BannerText
	 */
	function __construct($object) {
		$this->object = $object;
	}

	/**
	 * Priprema podataka za ispis
	 */
	function run() {
		$this->create_container($this->object);
		$this->container->run();
	}
}

class BannerFlash extends Banner {
	/**
	 * Putanja do flash-a, %language% se zamenjuje
	 * sa trenutnim jezikom stranice
	 * @var string
	 */
	var $source;

	/**
	 * Visina flash bannera
	 * @var integer
	 */
	var $width;

	/**
	 * Sirina flash bannera
	 * @var integer
	 */
	var $height;

	/**
	 * Dodatni parametri za flash
	 * @var array
	 */
	var $params;

	/**
	 * Konstruktor
	 *
	 * @param string $text
	 * @return BannerText
	 */
	function __construct($source, $width, $height, $params=array()) {
		$this->source = $source;
		$this->width = $width;
		$this->height = $height;
		$this->params = $params;
	}

	/**
	 * Priprema podataka za ispis
	 */
	function run() {
		$params = array(
					'movie'		=> str_replace('%language%', $this->get_active_language(), $this->source),
					'width'		=> $this->width,
					'height'	=> $this->height,
					'no_table'	=> true
				);

		// stavimo lokalne parametre posle korisnicki
		// jer zelimo da osiguramo da 'movie' parametar
		// ne bude prepisan
		$params = array_merge($this->params, $params);

		$flash = new cFlashLoader($params);

		$this->container = $flash;
		$this->container->run();
	}
}

// konstante za nacin selektivnog prikaza
define('S_MODE_HIDE', 0);
define('S_MODE_SHOW', 1);

class Banner {
	/**
	 * Da li se baner vidi samo na nekim stranicama
	 * @var boolean
	 */
	var $selective_visibility = false;

	/**
	 * Nacin selektivnog prikaza
	 * @var integer
	 */
	var $selective_mode = S_MODE_SHOW;

	/**
	 * Lista stranica na kojima je dozvoljen/zabranjen
	 * prikaz banera
	 * @var array
	 */
	var $path_list = array();

	/**
	 * Objekat koji je zasluzan za ispis podataka
	 * @var resource
	 */
	var $container;

	/**
	 * Path na koji treba baner da vodi
	 * @var string
	 */
	var $d_path;

	/**
	 * Verzija stabla (active/system)
	 * @var string
	 */
	var $d_version;

	/**
	 * URL na koji baner treba da vodi
	 * @var string
	 */
	var $d_url;

	/**
	 * Target za URL (_self, _blank, ime prozora)
	 * @var string
	 */
	var $d_target;

	/**
	 * Jezici za koje vazi ovaj baner
	 * @var array
	 */
	var $languages = array();

	/**
	 * Da li se uzima u obzir vidljivost po jezicima
	 * @var boolean
	 */
	var $language_visibility = false;

	/**
	 * Dodaje putanju u listu selektivnih prikaza
	 *
	 * @param string $path
	 */
	function set_visibility_on($path) {
		if (!in_array($path, $this->path_list))
			$this->path_list[] = $path;
	}

	/**
	 * Ukljucimo selektivni prikaz i podesimo
	 * nacin prikazivanja
	 *
	 * @param integer $mode
	 */
	function set_selective_mode($mode) {
		$this->selective_visibility = true;
		$this->selective_mode = $mode;
	}

	/**
	 * Setuje jezike na kome ce baner biti vidljiv
	 *
	 * @param *string $languages
	 */
	function set_active_languages() {
		$this->language_visibility = true;
		$this->languages = func_get_args();
	}

	/**
	 * Da li baner treba da bude vidljiv na trenuto
	 * selektovanoj stranici
	 *
	 * @return boolean
	 */
	function is_visible() {
		global $rObjectManager;

		$option_manager = $rObjectManager->getUnRegistredObject('iOptions');
		$current_path = $option_manager->getAnyOption(PARM_structure_location);

		if ($this->selective_visibility) {

			// u zavisnosti od nacina prikazivanja odlucimo da li je baner vidljiv ili ne
			switch ($this->selective_mode) {
				case S_MODE_HIDE:
					$result = !in_array($current_path, $this->path_list);
					break;

				case S_MODE_SHOW:
					$result = in_array($current_path, $this->path_list);
					break;
			}

		} else $result = true;

		// modifikujemo rezultat u zavisnosti od trenutnog jezika
		if ($result and $this->language_visibility) {
			$result = in_array($this->get_active_language(), $this->languages);
		}

		return $result;
	}

	/**
	 * Postavlja destinaciju banera ka cvoru na stablu sajta
	 *
	 * @param string $path
	 * @param string $version
	 */
	function set_destination_path($path, $version="active") {
		$this->d_path = $path;
		$this->d_version = $version;
	}

	/**
	 * Postavlja destinaciju banera ka nekom odredjenom URL-u
	 *
	 * @param string $url
	 * @param string $target
	 */
	function set_destination_url($url, $target="_self") {
		$this->d_url = $url;
		$this->d_target = $target;
	}

	/**
	 * Funkcija koja pravi anchor sa datim objektom
	 *
	 * @param resource $object
	 * @param array $params Dodatni parametri za anchor
	 */
	function create_container($object, $params=array()) {

		$anchor_params = $params;

		if (!array_key_exists('href', $params))
			$anchor_params['href'] = empty($this->d_url) ? PATH_APPLICATION : $this->d_url;

		if (!array_key_exists('target', $params))
			$anchor_params['target'] = empty($this->d_target) ? '_self' : $this->d_target;

		$set_params = array();

		if (empty($this->d_url)) {
			// set parametri su dostupni samo za lokalne url-ove
			$set_params['lang'] = $this->get_active_language();
			if (!empty($this->d_path)) $set_params[PARM_structure_location] = $this->d_path;
			if (!empty($this->d_version)) $set_params[PARM_structure_version] = $this->d_version;
		}

		$this->container = new cHTMLAnchorWithOptions($anchor_params, $object, $set_params,	array(PARM_all));
	}

	/**
	 * Dobavlja trenutno aktivni jezik
	 *
	 * @return string
	 */
	function get_active_language() {
		global $rObjectManager;

		$language_manager = $rObjectManager->getUnRegistredObject('cLanguageManager');
		$result = $language_manager->getLanguageInUse();

		return $result;
	}

	/**
	 * Ispis podataka
	 */
	function draw() {
		if ($this->is_visible() && $this->container)
			$this->container->draw();
	}
}

?>

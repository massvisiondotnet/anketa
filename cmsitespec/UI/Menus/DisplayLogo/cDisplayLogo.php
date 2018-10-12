<?php

/**
 * Prikazuje Logo sa linkom na home stranu
 *
 * @author     Milos Veskovic
 * @copyright MASSVision 2010
 */

class cDisplayLogo extends cModuleManager {
    protected $mHomePage;
    protected $mLangManager;

    public function __construct() {
        parent::__construct();
        $this->mLangManager = cLanguageManager::getInstance();
        $this->mHomePage = $this->_getHomePage();
    }

    public function run() {
        $this->mHomePage->run();
    }

    public function draw() {
        $this->mHomePage->draw();
    }

    /**
     * Funkcija za pravljenje meni linka od home cvora
     *
     * @return iUIManager
     */
    protected function _getHomePage() {
        return new cHTMLAnchorWithOptions(
            array('href'    => PATH_APPLICATION,
                  'class'   => 'logo'),
            new cHTMLStaticImage(array( 
                  'src'   => 'UI/Images/logo.png',
                  'alt'   => SITE_NAME,
                  'title' => SITE_NAME,
            )),
            array(
              PARM_structure_location => FAKE_ADDRESSES_OMIT_HOME ? '/' : 'home',
              PARM_structure_version => 'active',
              PARM_lang => $this->mLangManager->getLanguageInUse(),
            ),
            array(PARM_all)
        );
    }

    /**
     * Vraca Putanju do modula
     *
     * @return string 
     */
    public function whoAmI() {
        return '_HOME/UI::Menus::DisplayLogo::cDisplayLogo';
    }

}

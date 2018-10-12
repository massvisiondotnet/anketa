<?php

require_once PATH_CORE."Modules/NewsPlus/cNewsPlus.php";
require_once PATH_CORE."Modules/NewsPlus/Manager/cNewsDataManager.php";
require_once PATH_MODULES."/NewsPlus/UI/MenuX/cViewMenu.php";

/**
 * Simple news menu
 *
 * call using:
 *  <modul src="_HOME/UI::Menus::News::cNewsMenuX" name="news">
 *      <param name="title">LANG_NewsPlusSiteSpec_NewsTitle</param>
 *      <param name="view_all_title">LANG_NewsPlusSiteSpec_NewsViewAllLink</param>
 *  </modul>
 * (params are optional)
 *
 * @author    Nemanja Nikolic
 * @copyright MASSVision 2011
 */
class cNewsMenuX extends iUIManager {

    /** @var cNewsPlus $module  */
    protected $module;
    /** @var \cViewMenu $menu */
    protected $menu;
    /** @var iUIManager $cnt */
    protected $cnt;
    /** @var cHTMLAnchor $title */
    protected $title;
    /** @var array $params */
    protected $params;
    /** @var cHTMLAnchor $viewAll */
    protected $viewAll = null;

    public function __construct($param=array()) {
        parent::__construct();

        global $rObjectManager;
        $this->params = $param;
        $this->module = $rObjectManager->getUnRegistredObject('cNewsPlus');
        $this->manager = $rObjectManager->getUnRegistredObject('cNewsDataManager');
        $defs = $this->_getMenuDefinition();

        if (!empty($param[PARM_NewsPlus_Topic_ID]))
            $defs['topicId'] = $param[PARM_NewsPlus_Topic_ID];

        if (!empty($param[PARM_NewsPlus_IncludeSubtopics]))
            $defs['includeSubtopics'] = true;

        $this->title = new cHTMLAnchor(array(
            'class' => 'titleLink',
            '_text' => !empty($param['title']) && defined($param['title'])
                          ? constant($param['title']) : LANG_NewsPlus_News,
            'href'  => $this->_detectViewAllUrl()->getRelUrl(),
        ));

        if (isset($param['view_all_title']) && !empty($param['view_all_title']))
            $this->viewAll = new cHTMLAnchor(array(
                'class' => 'viewAllLink',
                '_text' => constant($param['view_all_title']),
                'href'  => $this->_detectViewAllUrl()->getRelUrl(),
            ));


        $this->menu = new cViewMenu(array(), $defs);
        $this->cnt  = null;
    }

    protected function _getMenuDefinition() {
        return array(
             'name'                => 'newsmenu',
             'template_path'       => PATH_HOME.'/UI/Menus/News/Templates/',
             'name_for_shared_dir' =>'news',
             'grouping'            => false,
             'title'               => null,
             'date_as_link'        => false,
             'heading_as_link'     => false,
             'content_as_link'     => false,
             'shortdesc_as_link'   => true,
             'draw_separator'      => false,
             'date_format'         => '%d.%m.%Y.',
             //'read_more'           => 'read more',
          );
    }

    public function run() {
        $this->cnt = new cUIContainer;
        $this->cnt->addElement('<div class="newsmenu">');
        $this->cnt->addElement('<div class="title">');
        $this->cnt->addElement($this->title);
        $this->cnt->addElement('</div>');
        $this->cnt->addElement('<ul>');
        foreach ($this->menu->_getElementsArray() as $el) {
            $this->cnt->addElement('<li>');
            $this->cnt->addElement($el);
            $this->cnt->addElement('</li>');
        }
        $this->cnt->addElement('</ul>');
        if ($this->viewAll)
            $this->cnt->addElement($this->viewAll);
        $this->cnt->addElement('</div>');
        $this->cnt->run();
    }

    public function draw() {
        $this->cnt->draw();
    }

    /**
     * Detect url for view all news link
     *
     * @return cURLWithOptions
     */
    protected function _detectViewAllUrl() {


        $allUrl = null;
        if (isset($this->params[PARM_NewsPlus_Topic_ID])
            && defined('NEWSPLUS_USE_TOPIC_DEPENDENT_URLS')
            && NEWSPLUS_USE_TOPIC_DEPENDENT_URLS
            )
            $allUrl = $this->manager->getUrlForAllInTopic($this->params[PARM_NewsPlus_Topic_ID]);

        $setOptions = array(
            PARM_lang => cLangEssentials::getInstance()->getLang(),
        );

        if (empty($allUrl)) {
            $resetOptions = array(PARM_all);
            if (defined('NEWS_PLUS_MOUNTPOINT')) {
                $setOptions[PARM_structure_location] = NEWS_PLUS_MOUNTPOINT;
                $setOptions[PARM_structure_version]  = PARMVAL_structure_version_default;
                if (isset($this->params[PARM_NewsPlus_Topic_ID])
                        && defined(NEWSPLUS_USE_TOPICS) && NEWSPLUS_USE_TOPICS)
                    $setOptions[PARM_NewsPlus_Topic_ID] = $this->params[PARM_NewsPlus_Topic_ID];
            } else {
                $setOptions[PARM_structure_location] = NEWSPLUS_SISTESPEC_VIEWALL_LOCATION;
                $setOptions[PARM_structure_version]  = NEWSPLUS_SISTESPEC_VIEWALL_VERSION;
            }
            $allUrl = new cURLWithOptions(
                PATH_APPLICATION,
                $setOptions,
                $resetOptions
            );
        }

        return $allUrl;
    }

    public function whoAmI() {
        return '_HOME/UI::Menus::News::cNewsMenuX';
    }

}
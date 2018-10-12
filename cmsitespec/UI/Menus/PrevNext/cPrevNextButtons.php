<?php


require_once (PATH_CORE."Core/Common/UI/Menus/OlLiMenu/cOlLiMenu.php");
require_once (PATH_CORE."/Modules/MenuX/cMenuX.php");


/**
 * Prev-next navigation menu (at same level)
 *
 * usage - put in template:
 * <modul src="_HOME/UI::Menus::PrevNext::cPrevNextButtons" name="prevNext">
 *     <param name="cycle">0</param>  <!-- cycle list -->
 *     <param name="use_description">0</param>  <!-- use page title -->
 *     <param name="prev_text">LANG_CustomPrev</param>  <!-- lang constant for prev -->
 *     <param name="next_text">LANG_CustomNext</param>  <!-- lang constant for next -->
 * </modul>
 *
 * @author    Nemanja Nikolic
 * @copyright MASSVision 2014
 */
class cPrevNextButtons extends cMenuX {

    private $cycle;
    private $prevText;
    private $nextText;
    private $useDescription;
    private $prev = null;
    private $next = null;

    function __construct($param = array()) {
        $this->cycle = isset($param['cycle']) && $param['cycle'];
        $this->useDescription = isset($param['use_description']) && $param['use_description'];
        $this->prevText = isset($param['prev_text']) && defined($param['prev_text'])
            ? constant($param['prev_text']) : LANG_Previous;
        $this->nextText = isset($param['next_text']) && defined($param['next_text'])
            ? constant($param['next_text']) : LANG_Next;

        $result = cStructureTreeManager::getInstance()->getSameLevelElementsToCurrentNode();
        /** @var cGroupingNode[] $nodes */
        $nodes = $result['elements'];
        /** @var int $selfPos */
        $selfPos = $result['current'];
        if ($nodes && count($nodes) > 1) {
            if ($selfPos > 0 || $this->cycle) {
                $this->prev = $nodes[$selfPos > 0 ? $selfPos-1 : count($nodes)-1];
            }
            if ($selfPos < count($nodes)-1 || $this->cycle) {
                $this->next = $nodes[$selfPos < count($nodes)-1 ? $selfPos+1 : 0];
            }
        }
//dieprint('next', $this->next);
        parent::__construct();
    }

    function getMenuDefinition() {
        return array(
            'type'                  => 'horizontal',
            'name'                  => 'prevnextmenu',
            'id'                    => 'prevnextmenu',
            'style_path'            => 'UI/Menus/Common/Style',
            'has_own_js'            => false,
            'exclude_from_header'   => array('css'=>true,'js'=>true),
            'version'               => 'img_in_background',
            'name_for_shared_dir'   => 'common',
            'draw_separator'        => false,
            'wrap_item'             => false
        );
    }

    /**
     *  Vraca listu stavki na osnovu kojese pravi meni
     *  @return array
     */
    function getMenuItems() {
        $items = array();
        if ($this->prev) {
            $link = cStructureTreeManager::getInstance()->createLink($this->prev);
            if (!$this->useDescription)
                $link['link']->mObject->mText = $this->prevText;
            $items[] = $link;
        }
        if ($this->next) {
            $link = cStructureTreeManager::getInstance()->createLink($this->next);
            if (!$this->useDescription)
                $link['link']->mObject->mText = $this->nextText;
            $items[] = $link;
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
            $menuItems[$key]['link']->mObject->mText =
                "<span>{$menuItems[$key]['link']->mObject->mText}</span>";

        $this->mMenu = new cOlLiMenu($this->getMenuDefinition(), $menuItems);
    }

    function whoAmI() {
        return '_HOME/UI::Menus::PrevNext::cPrevNextButtons';
    }

}
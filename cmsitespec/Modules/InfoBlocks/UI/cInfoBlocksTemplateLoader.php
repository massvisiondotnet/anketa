<?php
if (!defined('USE_ANVIL'))
    define('USE_ANVIL', true);

require_once PATH_ANVIL . '/view/parser.php';
use anvil\view\Parser;
use anvil\view\ParserContext;

/**
 * Helper class cInfoBlocksTemplateLoader
 * 
 * @author Đorđe
 */
class cInfoBlocksTemplateLoader extends \iUIManager
{
    private $templateId;
    private $blocks;
        
    /**
     * 
     * @param string $templateId
     * @param \cUIContainer $template
     */    
    public function __construct($templateId, \cUIContainer $blocks)
    {
        parent::__construct();
        
        $this->templateId = $templateId;
        $this->blocks = $blocks;
    }
    
    public function run() 
    {
        // trazimo templejt sa id-em sadrzaja strana        
        if (file_exists(__DIR__.'/Templates/'.$this->templateId.'.html'))
            $file = __DIR__.'/Templates/'.$this->templateId.'.html';
        else 
            $file = __DIR__.'/Templates/info_blocks.html';
                    
        $options = array(
            'id' => $this->templateId,
            'blocks' => $this->blocks->getString()
        );      

        $this->view = Parser::getNew()
                             ->setTemplate(
                                    file_get_contents($file)
                                )
                             ->render(ParserContext::getNew($options));
        $this->view->run();
    }
    
    public function draw() 
    {
        echo $this->view->draw();
    }
}
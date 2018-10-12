<?php
if (!defined('USE_ANVIL'))
    define('USE_ANVIL', true);

require_once PATH_ANVIL . '/view/parser.php';
use anvil\view\Parser;
use anvil\view\ParserContext;

/**
 * Helper class cInfoBlocksSingleTemplateLoader
 * 
 * @author Đorđe
 */
class cInfoBlocksSingleTemplateLoader extends \iUIManager
{
    private $templateId;
    private $singleId;
    private $singleClass;
    private $template;
        
    /**
     * 
     * @param string $templateId
     * @param string $singleId
     * @param string $singleClass
     * @param \cUIContainer $template
     */    
    public function __construct($templateId, $singleId, $singleClass, \cUIContainer $template) 
    {
        parent::__construct();
        
        $this->templateId = $templateId;
        $this->singleId = $singleId;
        $this->singleClass = $singleClass;
        $this->template = $template;
    }
    
    public function run() 
    {
        // trazimo templejt sa id-em sadrzaja strana
        if (file_exists(__DIR__.'/Templates/'.$this->templateId.'_single.html'))
            $file = __DIR__.'/Templates/'.$this->templateId.'_single.html';
        else 
            $file = __DIR__.'/Templates/info_block_single.html';
                
        $options = array(
            'class' => $this->singleClass,
            'template' => $this->template->getString()
        );
        
        if (!empty($this->singleId))
            $options['id'] = 'id="'.$this->singleId.'"';
        
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


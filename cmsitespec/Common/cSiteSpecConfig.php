<?php

class cSiteSpecConfig {
	private static $instance;
    
    /**
     * Google fonts array
     * @var array
     */
    private $googleFonts;
    
	private function __construct() {
	}

	public function getInstance() {
		if (empty(self::$instance))
			self::$instance = new cSiteSpecConfig;
		return self::$instance;
	}

	public static function getExternalJs() {
		return array(
				//"", // google plus
			);
	}

    public function addGoogleFont($font) {
        $this->googleFonts[] = $font;
    }
    
    public function getGoogleFontsScript() {
        $families = implode(",", $this->googleFonts);
        $script = <<<EOF
    <script type="text/javascript">
      WebFontConfig = {
        google: { families: [ $families ] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })(); 
    </script>
EOF;
        return $script;
    }
}

?>
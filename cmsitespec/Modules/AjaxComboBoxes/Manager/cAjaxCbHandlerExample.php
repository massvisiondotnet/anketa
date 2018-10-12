<?php

require_once PATH_JXCB."/Manager/cAjaxCbAbstractHandler.php";

/**
 * Primer jxcb handlera
 * 
 * @author Nemanja Nikolić
 * @copyright MASSVision 2012
 */
class cAjaxCbHandlerExample extends cAjaxCbAbstractHandler {
	
	public function getType() {
		return "example";
	}
	
	public function getCbOptions($path=null) {
		$extracted = cAjaxComboBoxes::extractPath();
		
		$options = array();
		$options["par_nepar"] = array(
				"name" => "parneparfield",
				"values" => array(
						null => "-- izaberite --",
						1 => "par",
						2 => "nepar",
					)
			);
		
		$options["jednocifreni"] = array(
				"name" => "broj_field",
				"values" => array(
					)
			);
		$first = isset($extracted["par_nepar"]) ? $extracted["par_nepar"] : null;
		switch ($first) {
			case 1:
				$options["jednocifreni"]["values"] = array(
						null => "-- izaberite --",
						2 => "dva",
						4 => "četiri",
						6 => "šest",
						8 => "osam",
					);
				break;
			case 2:
				$options["jednocifreni"]["values"] = array(
						null => "-- izaberite --",
						1 => "jedan",
						3 => "tri",
						5 => "pet",
						7 => "sedam",
						9 => "devet",
					);
				break;
			default:
				$options["jednocifreni"]["values"] = array();
		}
		
		return $options;
	}
}


?>

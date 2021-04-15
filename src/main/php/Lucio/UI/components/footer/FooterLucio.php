<?php

namespace Lucio\UI\components\footer;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;


class FooterLucio extends RastyComponent{


	public function __construct(){
	}

	public function getType(){

		return "FooterLucio";

	}

	protected function parseXTemplate(XTemplate $xtpl){

        $xtpl->assign('year', date('Y'));

	}

}
?>

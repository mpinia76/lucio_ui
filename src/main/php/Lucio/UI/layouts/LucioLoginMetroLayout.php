<?php

namespace Lucio\UI\layouts;

use Rasty\Layout\layout\Rasty\Layout;

use Rasty\utils\XTemplate;


class LucioLoginMetroLayout extends LucioMetroLayout{

	public function getXTemplate($file_template=null){
		return parent::getXTemplate( dirname(__DIR__) . "/layouts/LucioLoginMetroLayout.htm" );
	}

	public function getType(){

		return "LucioLoginMetroLayout";

	}

}
?>

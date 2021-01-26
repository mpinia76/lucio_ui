<?php

namespace Lucio\UI\components\filter\compania;

use Lucio\UI\components\filter\model\UICompaniaCriteria;

use Lucio\UI\components\grid\model\CompaniaGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

/**
 * Filtro para buscar companias
 *
 * @author Marcos
 * @since 20/01/2021
 */
class CompaniaFilter extends Filter{

	public function getType(){

		return "CompaniaFilter";
	}


	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new CompaniaGridModel() ));

		$this->setUicriteriaClazz( get_class( new UICompaniaCriteria()) );

		//$this->setSelectRowCallback("seleccionarCompania");

		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("razonSocial");
		//print_r(RastyUtils::getParamGET("tieneCtaCte"));

	}

	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		/*$this->fillInput("nombre", $this->getInitialText() );
		$this->fillInput("razonSocial", $this->getInitialText() );*/

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_nombre",  $this->localize("compania.nombre") );
		$xtpl->assign("lbl_razonSocial",  $this->localize("compania.razonSocial") );




	}



}
?>

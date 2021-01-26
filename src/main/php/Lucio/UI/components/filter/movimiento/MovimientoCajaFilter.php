<?php

namespace Lucio\UI\components\filter\movimiento;

use Lucio\UI\service\UIServiceFactory;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\components\grid\model\MovimientoCajaGridModel;

use Lucio\UI\components\filter\model\UIMovimientoCajaCriteria;

use Lucio\UI\components\filter\model\UIMovimientoCriteria;

use Lucio\UI\components\grid\model\MovimientoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar movimientos de Caja
 *
 * @author Marcos
 * @since 14-03-2018
 */
class MovimientoCajaFilter extends MovimientoFilter{


	public function getType(){

		return "MovimientoCajaFilter";
	}


	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("cuenta", LucioUIUtils::getCaja() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_saldo",  $this->localize( "cuenta.saldo" ) );


	}

}
?>

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
use Rasty\utils\RastyUtils;

/**
 * Filtro para buscar movimientos
 *
 * @author Marcos
 * @since 14/03/2018
 */
abstract class MovimientoFilter extends Filter{

	private $cuenta;


	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new MovimientoCajaGridModel() ));

		$this->setUicriteriaClazz( get_class( new UIMovimientoCajaCriteria()) );

		//$this->setSelectRowCallback("seleccionarMovimiento");

		//agregamos las propiedades a popular en el submit.
		//$this->addProperty("cuenta");


	}

	protected function parseXTemplate(XTemplate $xtpl){



		//rellenamos el nombre con el texto inicial
		//$this->fillInput("cuenta", LucioUIUtils::getCaja() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_cuenta",  $this->localize("movimientoCaja.cuenta") );


		$cuenta = $this->getCuenta();
		$xtpl->assign("saldo",  LucioUIUtils::formatMontoToView($cuenta->getSaldo()) );
		$xtpl->assign("cuentaOid",  $cuenta->getOid() );

		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "HistoriaClinica") );
		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "MovimientoModificar") );
	}

	public function fillEntity($entity){

		parent::fillEntity($entity);

		$cuenta = UIServiceFactory::getUICuentaService()->get( RastyUtils::getParamPOST("cuentaOid") );

		$entity->setCuenta( $cuenta );

	}

	public function getCuenta()
	{
	    return $this->cuenta;
	}

	public function setCuenta($cuenta)
	{
	    $this->cuenta = $cuenta;
	}
}
?>

<?php

namespace Lucio\UI\components\boxes\presupuesto;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Lucio\Core\model\Presupuesto;
use Lucio\Core\model\EstadoPresupuesto;

use Rasty\utils\LinkBuilder;

/**
 * presupuesto.
 *
 * @author Marcos
 * @since 29-03-2019
 */
class PresupuestoBox extends RastyComponent{

	private $presupuesto;

	public function getType(){

		return "PresupuestoBox";

	}

	public function __construct(){


	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("lbl_fecha",  $this->localize( "presupuesto.fecha" ) );

		$xtpl->assign("lbl_cliente",  $this->localize( "presupuesto.cliente" ) );
        $xtpl->assign("lbl_cliente1",  $this->localize( "presupuesto.cliente1" ) );
        $xtpl->assign("lbl_cliente2",  $this->localize( "presupuesto.cliente2" ) );
		$xtpl->assign("lbl_observaciones",  $this->localize( "presupuesto.observaciones" ) );
		$xtpl->assign("lbl_monto",  $this->localize( "presupuesto.monto" ) );

		$xtpl->assign("lbl_estado",  $this->localize( "presupuesto.estado" ) );

		$xtpl->assign("lbl_detalle_nombre", $this->localize( "presupuesto.detalle.producto" ) );
		$xtpl->assign("lbl_detalle_precio", $this->localize( "presupuesto.detalle.precio" ) );
		$xtpl->assign("lbl_detalle_cantidad", $this->localize( "presupuesto.detalle.cantidad" ) );
		$xtpl->assign("lbl_detalle_subtotal", $this->localize( "presupuesto.detalle.subtotal" ) );

		$xtpl->assign("lbl_totales",  $this->localize( "presupuesto.detalles.totales" ) );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);

		$presupuesto = $this->getPresupuesto();



		$xtpl->assign( "cliente", $this->getPresupuesto()->getCliente() );
        $xtpl->assign( "cliente1", $this->getPresupuesto()->getCliente1() );
        $xtpl->assign( "cliente2", $this->getPresupuesto()->getCliente2() );

		$xtpl->assign( "monto", LucioUIUtils::formatMontoToView( $this->getPresupuesto()->getMonto() ) );



		$xtpl->assign( "observaciones", $this->getPresupuesto()->getObservaciones() );
		$xtpl->assign( "fecha", LucioUIUtils::formatDateTimeToView($this->getPresupuesto()->getFecha()) );
		$xtpl->assign( "estado", $this->localize( EstadoPresupuesto::getLabel( $presupuesto->getEstado()) ) );

		$cantidadTotal = 0;
		foreach ($presupuesto->getDetalles() as $detalle) {
			$xtpl->assign( "producto", $detalle->getProducto() );
			$xtpl->assign( "cantidad", $detalle->getCantidad() );
			$xtpl->assign( "precio", LucioUIUtils::formatMontoToView( $detalle->getPrecioUnitario() ) );
			$xtpl->assign( "subtotal", LucioUIUtils::formatMontoToView( $detalle->getSubtotal() ) );
			$xtpl->parse( "main.detalle" );

			$cantidadTotal += $detalle->getCantidad();
		}

		$xtpl->assign( "total", LucioUIUtils::formatMontoToView( $presupuesto->getMonto() ) );
		$xtpl->assign( "cantidad_total", $cantidadTotal );

	}


	protected function initObserverEventType(){
		$this->addEventType( "Presupuesto" );
	}

	public function setPresupuestoOid($oid){
		if( !empty($oid) ){
			$presupuesto = UIServiceFactory::getUIPresupuestoService()->get($oid);
			$this->setPresupuesto($presupuesto);
		}
	}


	public function getPresupuesto()
	{
	    return $this->presupuesto;
	}

	public function setPresupuesto($presupuesto)
	{
	    $this->presupuesto = $presupuesto;
	}
}
?>

<?php

namespace Lucio\UI\components\stats\balance;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Lucio\Core\model\Caja;

use Rasty\utils\LinkBuilder;

use Rasty\factory\ComponentConfig;

use Rasty\factory\ComponentFactory;

use Lucio\UI\components\filter\model\UIVentaCriteria;
use Lucio\UI\components\filter\model\UIGastoCriteria;

use Rasty\utils\Logger;

/**
 * Balance de un mes.
 *
 * @author Bernardo
 * @since 28-04-2015
 */
class BalanceMes extends RastyComponent{

    private $fecha;

    public function getType(){

        return "BalanceMes";

    }

    public function __construct(){


    }

    protected function parseLabels(XTemplate $xtpl){

        $xtpl->assign("lbl_mes",  $this->localize( "balanceMes.mes" ) );
        $xtpl->assign("lbl_ventas",  $this->localize( "balanceMes.ventas" ) );

        $xtpl->assign("lbl_ganancias",  $this->localize( "balanceDia.ganancias" ) );
        $xtpl->assign("lbl_gastos",  $this->localize( "balanceDia.gastos" ) );

    }

    protected function parseXTemplate(XTemplate $xtpl){


        $componentConfig = new ComponentConfig();
        $componentConfig->setId( "filter" );
        $componentConfig->setType( $this->getFilterType() );

        $this->filter = ComponentFactory::buildByType($componentConfig, $this);



        $this->filter->fill( );

        $criteria = $this->filter->getCriteria();

        /*labels*/
        $this->parseLabels($xtpl);


        $fecha = $criteria->getFecha();
        if(empty($fecha)){
            $fecha = new \DateTime();
        }

        $serviceGasto = UIServiceFactory::getUIGastoService();
        $criteriaGasto = new UIGastoCriteria();
        $criteriaGasto->setFiltroPredefinido(0);
        $criteriaGasto->setMes($criteria->getFecha());

        $gastoSaldo = $serviceGasto->getTotales($criteriaGasto);

        $xtpl->assign("gastos",  LucioUIUtils::formatMontoToView((-1)*$gastoSaldo)  );

        $criteriaVenta = new UIVentaCriteria();

        $criteriaVenta->setMes( $criteria->getFecha());
        $criteriaVenta->setCliente( $criteria->getCliente());

        $saldos = UIServiceFactory::getUIVentaService()->getGananciasProducto($criteriaVenta, $criteria );

        //Logger::logObject($saldos);

        $meses = LucioUIUtils::getMeses();
        $mes = $fecha->format("n");





        //$balance = UIServiceFactory::getUIBalanceService()->getBalanceMes($fecha);

        $xtpl->assign("mes",  $meses[$mes] . " " . $fecha->format("Y") );
        /*$xtpl->assign("gastos",  LucioUIUtils::formatMontoToView($balance["gastos"]) );
        $xtpl->assign("pagos",  LucioUIUtils::formatMontoToView($balance["pagos"]) );*/
        $xtpl->assign("ventas",  LucioUIUtils::formatMontoToView($saldos["ventas"]) );
        //$xtpl->assign("comisiones",  LucioUIUtils::formatMontoToView($balance["comisiones"]) );
        $xtpl->assign("ganancias",  LucioUIUtils::formatMontoToView($saldos["ganancias"]) );
        //Logger::logObject($saldos);
        if ($saldos['productos']) {
            $productos='';

            foreach ($saldos['productos']['cant'] as $key => $cantidad) {
                //print_r($producto);
                $productos .=$saldos['productos']['nombre'][$key].' Vendidos: '.$cantidad.' <br>';
            }
            $xtpl->assign("productos",  $productos);
        }
        if ($saldos['clientes']) {
            $clientes='';
            $clienteIdAnt='';
            foreach ($saldos['clientes']['cant'] as $key => $cantidad) {
                $arrayKey = explode('-', $key);
                if ($clienteIdAnt!=$arrayKey[0]) {
                    $clientes .=$saldos['clientes']['cliente'][$arrayKey[0]].'<br>';
                }
                $clientes .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$saldos['productos']['nombre'][$arrayKey[1]].' Vendidos: '.$cantidad.' <br>';
                $clienteIdAnt=$arrayKey[0];
            }
            $xtpl->assign("clientes",  $clientes);
        }

    }


    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    protected function initObserverEventType(){
        //TODO $this->addEventType( "Venta" );
    }

    public function getFilterType()
    {
        return $this->filterType;
    }

    public function setFilterType($filterType)
    {
        $this->filterType = $filterType;
    }
}
?>

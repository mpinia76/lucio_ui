<?php
namespace Lucio\UI\actions\ventas;

use Lucio\UI\utils\LucioUIUtils;
use Lucio\Core\utils\LucioUtils;
use Lucio\UI\service\UIProductoService;

use Lucio\UI\service\UIServiceFactory;

use Lucio\Core\model\DetalleVenta;

use Lucio\UI\components\filter\model\UIProductoCriteria;

use Rasty\actions\JsonAction;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

use Rasty\app\RastyMapHelper;
use Rasty\factory\ComponentFactory;
use Rasty\factory\ComponentConfig;

use Rasty\utils\Logger;

/**
 * se agregar un detalle de venta para la edición
 * en sesión.
 *
 * @author Marcos
 * @since 25/03/2019
 */
class ConsultarStockDetalleVentaJson extends JsonAction{


	public function execute(){

		$rasty= RastyMapHelper::getInstance();

		try {

			//creamos el detalle de venta.
			$detalle = new DetalleVenta();

			$productoCodigo = RastyUtils::getParamPOST("producto");
			$cantidad = RastyUtils::getParamPOST("cantidad");
			$precio = $value = str_replace(',', '.', RastyUtils::getParamPOST("precio"));

            $uiCriteria = new UIProductoCriteria();
            $uiCriteria->setCodigoExacto( $productoCodigo );

            $oProducto = UIServiceFactory::getUIProductoService()->getByCriteria( $uiCriteria );





            $hayStock = 'SI';
            if ($oProducto->getMarcaProducto()->getOid()!=LucioUtils::getMarcaPropia()->getOid()){
                $detalle->setProducto($oProducto  );
                $detalle->setCantidad( $cantidad );
                $detalle->setPrecioUnitario( $precio );





                $detalles = LucioUIUtils::getDetallesVentaSession();

                $result["detalles"] = $detalles;

                $result["cantidad"] = $cantidad;



                foreach ($detalles as $detallejson) {
                    //mismo producto y mismo precio
                    if(( $detalle->getProducto()->getOid() == $detallejson["producto_oid"] )  ){
                        $result["cantidad"] += $detallejson["cantidad"];
                    }

                }



                Logger::log("Actual ".$oProducto->getStock()." vender ".$result['cantidad']);

                $hayStock = ($oProducto->getStock()<$result["cantidad"])?'NO':'SI';
                $result["hayStock"] = $hayStock;
            }


		} catch (RastyException $e) {

			$result["error"] = $e->getMessage();
		}

		return $result;

	}

}
?>

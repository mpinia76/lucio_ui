<?php
namespace Lucio\UI\actions\ventas;

use Lucio\UI\utils\LucioUIUtils;
use Lucio\Core\utils\LucioUtils;

use Lucio\UI\service\UIServiceFactory;
use Lucio\Core\model\Venta;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Rasty\utils\Logger;


/**
 * se cobra una venta en efectivo
 *
 * @author Marcos
 * @since 13/03/2018
 */
class CobrarVentaEfectivo extends Action{


	public function execute(){

		$forward = new Forward();


		//tomamos la venta
		$ventaOid = RastyUtils::getParamGET("ventaOid");
        $tipoCliente = RastyUtils::getParamGET("tipoCliente");
		$forward->addParam( "ventaOid", $ventaOid );
		try {


			//la recuperamos la venta.
			$venta = UIServiceFactory::getUIVentaService()->get( $ventaOid );




			$monto = $value = str_replace(',', '.', RastyUtils::getParamGET("monto"));
			//$montoActualizado = $value = str_replace(',', '.', RastyUtils::getParamGET("montoActualizado"));
			//$venta->setMonto($monto);

			$cuenta = LucioUtils::getCuentaUnica();


			$user = RastySecurityContext::getUser();
			$user = LucioUtils::getUserByUsername($user->getUsername());

			UIServiceFactory::getUIVentaService()->cobrar($venta, $cuenta, $user, $monto, $tipoCliente);

			$forward->setPageName( "Ventas" );


		} catch (RastyException $e) {

			$forward->setPageName( "VentaCobrar" );
			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>

<?php
namespace Lucio\UI\actions\cuentasCorrientes;

use Lucio\UI\conf\LucioUISetup;

use Lucio\UI\utils\LucioUIUtils;
use Lucio\Core\utils\LucioUtils;

use Lucio\Core\model\CuentaCorriente;

use Lucio\UI\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;
use Rasty\Forms\input\InputNumber;

/**
 * se cobra deuda de una cuenta corriente
 *
 * Es una transferencia entre la cuenta corriente seleccionada y la cuenta destino (caja chica o caja del día)
 *
 * @author Marcos
 * @since 23-03-2018
 */
class CobrarCuentaCorriente extends Action{


	public function execute(){

		$forward = new Forward();

		//tomamos el monto a depositar
		$number = new InputNumber();
		$monto = $number->formatValue( RastyUtils::getParamPOST("monto") );
		$observaciones = RastyUtils::getParamPOST("observaciones");
		$clienteOid = RastyUtils::getParamPOST("cliente");
		//$destinoOid = RastyUtils::getParamPOST("destino");

		try {

			$cliente = UIServiceFactory::getUIClienteService()->get($clienteOid);
			$destino = UIServiceFactory::getUICuentaService()->get(1);

			UIServiceFactory::getUICuentaCorrienteService()->cobrarDeuda($cliente, $destino, $monto, $observaciones);
			$forward->setPageName( "AdminHome" );


		} catch (RastyException $e) {

			$forward->setPageName( "CobrarCtaCte" );
			$forward->addParam( "monto", $monto );
			$forward->addParam( "observaciones", $observaciones );


			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>

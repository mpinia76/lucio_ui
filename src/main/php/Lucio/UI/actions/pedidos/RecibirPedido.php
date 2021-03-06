<?php
namespace Lucio\UI\actions\pedidos;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\service\UIServiceFactory;
use Lucio\Core\model\Pedido;
use Lucio\Core\utils\LucioUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se recibe un pedido
 *
 * @author Marcos
 * @since 10-07-2020
 */
class RecibirPedido extends Action{


	public function execute(){

		$forward = new Forward();


		//tomamos el pedido
		$pedidoOid = RastyUtils::getParamPOST("pedidoOid");
		$forward->addParam( "pedidoOid", $pedidoOid );
		try {

			//recuperamos el pedido.
			$pedido = UIServiceFactory::getUIPedidoService()->get( $pedidoOid );

			$user = RastySecurityContext::getUser();
			$user = LucioUtils::getUserByUsername($user->getUsername());

			UIServiceFactory::getUIPedidoService()->recibir($pedido, $user);

			$forward->setPageName( "Pedidos" );


		} catch (RastyException $e) {

			$forward->setPageName( "PedidoRecibir" );
			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>

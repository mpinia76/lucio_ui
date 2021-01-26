<?php
namespace Lucio\UI\actions\ventas;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\service\UIProductoService;

use Lucio\UI\service\UIServiceFactory;

use Lucio\Core\model\DevolucionVenta;

use Rasty\actions\JsonAction;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

use Rasty\app\RastyMapHelper;
use Rasty\factory\ComponentFactory;
use Rasty\factory\ComponentConfig;

/**
 * se borra un devolucion de venta para la edición
 * en sesión.
 *
 * @author Marcos
 * @since 28/04/2019
 */
class BorrarDevolucionVentaJson extends JsonAction{


	public function execute(){

		$rasty= RastyMapHelper::getInstance();

		try {

			//indice del devolucion a eliminar.
			$index = RastyUtils::getParamPOST("index");
			if(empty($index))
				$index = 0;
			//eliminamos el devolucion dado el índice
			LucioUIUtils::borrarDevolucionVentaSession($index);

			$devoluciones = LucioUIUtils::getDevolucionesVentaSession();
			$result["devoluciones"] = $devoluciones;

			$result["importe"] = 0;
			foreach ($devoluciones as $devolucionjson) {
				$result["importe"] += $devolucionjson["subtotal"];
			}



		} catch (RastyException $e) {

			$result["error"] = $e->getMessage();
		}

		return $result;

	}

}
?>

<?php
namespace Lucio\UI\actions\marcasProducto;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\service\UIServiceFactory;
use Lucio\Core\model\MarcaProducto;
use Lucio\Core\utils\LucioUtils;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se eliminar un marca de documento
 *
 * @author Marcos
 * @since 05/03/2018
 */
class EliminarMarcaProducto extends JsonAction{


	public function execute(){

		try {

			$marcaProductoOid = RastyUtils::getParamGET("marcaProductoOid");

			//obtenemos la marcaProducto
			$marcaProducto = UIServiceFactory::getUIMarcaProductoService()->get($marcaProductoOid);

			UIServiceFactory::getUIMarcaProductoService()->delete($marcaProducto);

			$result["info"] = Locale::localize("marcaProducto.borrar.success")  ;

		} catch (RastyException $e) {

			$result["error"] = Locale::localize($e->getMessage())  ;

		}

		return $result;

	}
}
?>

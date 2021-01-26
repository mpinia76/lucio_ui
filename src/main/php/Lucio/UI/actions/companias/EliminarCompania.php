<?php
namespace Lucio\UI\actions\companias;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\service\UIServiceFactory;
use Lucio\Core\model\Compania;
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
 * se eliminar un tipo de documento
 *
 * @author Marcos
 * @since 20/01/2021
 */
class EliminarCompania extends JsonAction{


	public function execute(){

		try {

			$companiaOid = RastyUtils::getParamGET("companiaOid");

			//obtenemos la compania
			$compania = UIServiceFactory::getUICompaniaService()->get($companiaOid);

			UIServiceFactory::getUICompaniaService()->delete($compania);

			$result["info"] = Locale::localize("compania.borrar.success")  ;

		} catch (RastyException $e) {

			$result["error"] = Locale::localize($e->getMessage())  ;

		}

		return $result;

	}
}
?>

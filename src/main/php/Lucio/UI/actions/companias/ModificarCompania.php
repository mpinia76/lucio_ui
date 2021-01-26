<?php
namespace Lucio\UI\actions\companias;

use Lucio\UI\components\form\compania\ClienteForm;

use Lucio\UI\service\UIServiceFactory;
use Lucio\UI\utils\LucioUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la actualización de un compania.
 *
 * @author Marcos
 * @since 20/01/2021
 */
class ModificarCompania extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("CompaniaModificar");

		$companiaForm = $page->getComponentById("companiaForm");

		$oid = $companiaForm->getOid();

		try {

			//obtenemos el compania.
			$compania = UIServiceFactory::getUICompaniaService()->get($oid );

			//lo editamos con los datos del formulario.
			$companiaForm->fillEntity($compania);

			//guardamos los cambios.
			UIServiceFactory::getUICompaniaService()->update( $compania );

			$forward->setPageName( $companiaForm->getBackToOnSuccess() );
			$forward->addParam( "companiaOid", $compania->getOid() );

			$companiaForm->cleanSavedProperties();

		} catch (RastyException $e) {

			$forward->setPageName( "CompaniaModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );

			//guardamos lo ingresado en el form.
			$companiaForm->save();

		}
		return $forward;

	}

}
?>

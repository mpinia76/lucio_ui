<?php
namespace Lucio\UI\actions\companias;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\components\form\compania\ClienteForm;

use Lucio\UI\service\UIServiceFactory;
use Lucio\Core\model\Compania;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de un compania.
 *
 * @author Marcos
 * @since 20/01/2021
 */
class AgregarCompania extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("CompaniaAgregar");

		$companiaForm = $page->getComponentById("companiaForm");

		try {

			//creamos un nuevo compania.
			$compania = new Compania();

			//completados con los datos del formulario.
			$companiaForm->fillEntity($compania);

			//agregamos el compania.
			UIServiceFactory::getUICompaniaService()->add( $compania );

			$forward->setPageName( $companiaForm->getBackToOnSuccess() );
			$forward->addParam( "companiaOid", $compania->getOid() );

			$companiaForm->cleanSavedProperties();

		} catch (RastyDuplicatedException $e) {

			$forward->setPageName( "CompaniaAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );

			//guardamos lo ingresado en el form.
			$companiaForm->save();

		} catch (RastyException $e) {

			$forward->setPageName( "CompaniaAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );

			//guardamos lo ingresado en el form.
			$companiaForm->save();
		}

		return $forward;

	}

}
?>

<?php
namespace Lucio\UI\pages\companias;

use Lucio\UI\pages\LucioPage;

use Lucio\UI\components\filter\model\UICompaniaCriteria;

use Lucio\UI\components\grid\model\CompaniaGridModel;

use Lucio\UI\service\UICompaniaService;

use Lucio\UI\utils\LucioUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Lucio\Core\model\Compania;
use Lucio\Core\criteria\CompaniaCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los companias.
 *
 * @author Marcos
 * @since 20/01/2021
 *
 */
class Companias extends LucioPage{


	private $companiaCriteria;

	public function __construct(){
		$companiaCriteria = new CompaniaCriteria();


		$this->setCompaniaCriteria($companiaCriteria);
	}

	public function getTitle(){
		return $this->localize( "companias.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos


		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "compania.agregar") );
		$menuOption->setPageName("CompaniaAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );






		return array($menuGroup);
	}

	public function getType(){

		return "Companias";

	}

	public function getModelClazz(){
		return get_class( new CompaniaGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UICompaniaCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("compania.agregar") );

		$companiaFilter = $this->getComponentById("companiasFilter");

		$companiaFilter->fillFromSaved( $this->getCompaniaCriteria() );
	}

	public function getCompaniaCriteria()
	{
	    return $this->companiaCriteria;
	}

	public function setCompaniaCriteria($companiaCriteria)
	{
	    $this->companiaCriteria = $companiaCriteria;
	}

}
?>

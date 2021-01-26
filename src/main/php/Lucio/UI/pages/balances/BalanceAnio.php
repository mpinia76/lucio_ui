<?php
namespace Lucio\UI\pages\balances;

use Lucio\UI\pages\LucioPage;

use Lucio\UI\components\filter\model\UIProductoCriteria;



use Lucio\UI\service\UIVentaService;

use Lucio\UI\utils\LucioUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Lucio\Core\model\Caja;
use Lucio\Core\criteria\VentaCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar las balances.
 *
 * @author Marcos
 * @since 09/10/2019
 *
 */
class BalanceAnio extends LucioPage{



	public function __construct(){

	}

	public function getTitle(){
		return $this->localize("balanceAnio.title") ;
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();




		return array($menuGroup);
	}

	public function getType(){

		return "BalanceAnio";

	}


	public function getUicriteriaClazz(){
		return get_class( new UIProductoCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );


	}



}
?>

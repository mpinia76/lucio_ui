<?php
namespace Lucio\UI\pages\clientes;

use Lucio\UI\pages\LucioPage;

use Lucio\UI\components\filter\model\UIClienteCriteria;

use Lucio\UI\components\grid\model\ClienteGridModel;

use Lucio\UI\service\UIClienteService;

use Lucio\UI\utils\LucioUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Lucio\Core\model\Cliente;
use Lucio\Core\criteria\ClienteCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los clientes.
 *
 * @author Marcos
 * @since 02/03/2018
 *
 */
class Clientes extends LucioPage{


	private $clienteCriteria;

	public function __construct(){
		$clienteCriteria = new ClienteCriteria();


		$this->setClienteCriteria($clienteCriteria);
	}

	public function getTitle(){
		return $this->localize( "clientes.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos


		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "cliente.agregar") );
		$menuOption->setPageName("ClienteAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );



		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.cobrarCuentaCorriente") );
		$menuOption->setPageName("CobrarCtaCte");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/cobros_48.png" );
		$menuGroup->addMenuOption( $menuOption );

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.actualizarCuentaCorriente") );
		$menuOption->setPageName("ActualizarCtaCte");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/gastos_32.png" );
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "Clientes";

	}

	public function getModelClazz(){
		return get_class( new ClienteGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIClienteCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("cliente.agregar") );

		$clienteFilter = $this->getComponentById("clientesFilter");

		$clienteFilter->fillFromSaved( $this->getClienteCriteria() );
	}

	public function getClienteCriteria()
	{
	    return $this->clienteCriteria;
	}

	public function setClienteCriteria($clienteCriteria)
	{
	    $this->clienteCriteria = $clienteCriteria;
	}

}
?>

<?php
namespace Lucio\UI\pages\presupuestos\agregar;

use Lucio\Core\utils\LucioUtils;
use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\pages\LucioPage;

use Rasty\utils\XTemplate;
use Lucio\Core\model\Presupuesto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class PresupuestoAgregar extends LucioPage{

	/**
	 * presupuesto a agregar.
	 * @var Presupuesto
	 */
	private $presupuesto;


	public function __construct(){

		//inicializamos el presupuesto.
		$presupuesto = new Presupuesto();

		$presupuesto->setFecha( new \Datetime() );

		$presupuesto->setCliente( LucioUtils::getClienteDefault() );

		$this->setPresupuesto($presupuesto);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Presupuestos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "presupuesto.agregar.title" );
	}

	public function getType(){

		return "PresupuestoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		LucioUIUtils::setDetallesPresupuestoSession( array() );
	}


	public function getPresupuesto()
	{
	    return $this->presupuesto;
	}

	public function setPresupuesto($presupuesto)
	{
	    $this->presupuesto = $presupuesto;
	}



	public function getMsgError(){
		return "";
	}
}
?>

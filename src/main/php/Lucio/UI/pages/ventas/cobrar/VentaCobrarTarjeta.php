<?php
namespace Lucio\UI\pages\ventas\cobrar;

use Lucio\UI\pages\LucioPage;

use Rasty\utils\XTemplate;
use Lucio\Core\model\Tarjeta;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class VentaCobrarTarjeta extends LucioPage{

	/**
	 * Tarjeta a agregar.
	 * @var Tarjeta
	 */
	private $Tarjeta;


	public function __construct(){

		//inicializamos el Tarjeta.
		$Tarjeta = new Tarjeta();


		$this->setTarjeta($Tarjeta);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();




		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "cobrarTarjeta.title" );
	}

	public function getType(){

		return "VentaCobrarTarjeta";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$ventaCobrarTarjetaForm = $this->getComponentById("ventaCobrarTarjetaForm");
		$ventaCobrarTarjetaForm->fillFromSaved( $this->getTarjeta() );

	}






	public function getMsgError(){
		return "";
	}

	public function getTarjeta()
	{
	    return $this->Tarjeta;
	}

	public function setTarjeta($Tarjeta)
	{
	    $this->Tarjeta = $Tarjeta;
	}
}
?>

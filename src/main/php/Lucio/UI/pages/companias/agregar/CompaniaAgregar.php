<?php
namespace Lucio\UI\pages\companias\agregar;

use Lucio\UI\pages\LucioPage;

use Rasty\utils\XTemplate;
use Lucio\Core\model\Compania;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class CompaniaAgregar extends LucioPage{

	/**
	 * compania a agregar.
	 * @var Compania
	 */
	private $compania;


	public function __construct(){

		//inicializamos el compania.
		$compania = new Compania();

		//$compania->setNombre("Bernardo");
		//$compania->setEmail("ber@mail.com");
		$this->setCompania($compania);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Companias");
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "compania.agregar.title" );
	}

	public function getType(){

		return "CompaniaAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$companiaForm = $this->getComponentById("companiaForm");
		$companiaForm->fillFromSaved( $this->getCompania() );

	}


	public function getCompania()
	{
	    return $this->compania;
	}

	public function setCompania($compania)
	{
	    $this->compania = $compania;
	}



	public function getMsgError(){
		return "";
	}
}
?>

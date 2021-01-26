<?php
namespace Lucio\UI\pages\companias\modificar;

use Lucio\UI\pages\LucioPage;

use Lucio\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Lucio\Core\model\Compania;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class CompaniaModificar extends LucioPage{

	/**
	 * compania a modificar.
	 * @var Compania
	 */
	private $compania;


	public function __construct(){

		//inicializamos el compania.
		$compania = new Compania();
		$this->setCompania($compania);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setCompaniaOid($oid){

		//a partir del id buscamos el compania a modificar.
		$compania = UIServiceFactory::getUICompaniaService()->get($oid);

		$this->setCompania($compania);

	}

	public function getTitle(){
		return $this->localize( "compania.modificar.title" );
	}

	public function getType(){

		return "CompaniaModificar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getCompania(){

	    return $this->compania;
	}

	public function setCompania($compania)
	{
	    $this->compania = $compania;
	}
}
?>

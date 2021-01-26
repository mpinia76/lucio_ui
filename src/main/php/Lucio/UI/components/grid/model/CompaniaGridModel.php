<?php
namespace Lucio\UI\components\grid\model;

use Lucio\UI\components\grid\formats\GridImporteFormat;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\components\filter\model\UICompaniaCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Lucio\Core\utils\LucioUtils;

use Lucio\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

/**
 * Model para la grilla de companias.
 *
 * @author Marcos
 * @since 20/01/2021
 */
class CompaniaGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();

    }

    public function getService(){

    	return UIServiceFactory::getUICompaniaService();
    }

    public function getFilter(){

    	$filter = new UICompaniaCriteria();
		return $filter;
    }

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "compania.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "nombre", "compania.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "razonSocial", "compania.razonSocial", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "cuit", "compania.cuit", 10, EntityGrid::TEXT_ALIGN_CENTER ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "telefono", "compania.telefono", 30, EntityGrid::TEXT_ALIGN_RIGHT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "celular", "compania.celular", 30, EntityGrid::TEXT_ALIGN_RIGHT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "direccion", "compania.direccion", 30, EntityGrid::TEXT_ALIGN_LEFT) ;
		$this->addColumn( $column );

		/*$column = GridModelBuilder::buildColumn( "saldo", "compania.saldo", 30, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() ) ;
		$this->addColumn( $column );*/

	}

	public function getDefaultFilterField() {
        return "nombre";
    }

	public function getDefaultOrderField(){
		return "nombre";
	}


    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){

		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.companias.modificar") );
		$menuOption->setPageName( "CompaniaModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options[] = $menuOption ;






		$menuOption = new MenuActionAjaxOption();
		$menuOption->setLabel( $this->localize( "menu.compania.eliminar") );
		$menuOption->setActionName( "EliminarCompania" );
		$menuOption->setConfirmMessage( $this->localize( "compania.eliminar.confirm.msg") );
		$menuOption->setConfirmTitle( $this->localize( "compania.eliminar.confirm.title") );
		$menuOption->setOnSuccessCallback( "eliminarCallback" );
		$menuOption->addParam("companiaOid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
		$options[] = $menuOption ;




		$group->setMenuOptions( $options );

		return array( $group );

	}

}
?>

<?php
namespace Lucio\UI\service\finder;

use Lucio\UI\components\filter\model\UIClienteCriteria;

use Lucio\UI\service\UIServiceFactory;

use Rasty\Forms\finder\model\IAutocompleteFinder;

use Rasty\utils\LinkBuilder;
/**
 *
 * Finder para companias.
 *
 * @author Marcos
 * @since 20/01/2021
 */
class CompaniaFinder implements  IAutocompleteFinder {


	public function __construct() {}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntitiesByText()
	 */
	public function findEntitiesByText( $text, $parent=null ){

		$uiCriteria = new UIClienteCriteria();
		$uiCriteria->setNombre( $text );
        $uiCriteria->setTipoCliente( 2 );
		$uiCriteria->setRowPerPage( 10 );


		$uiCriteria->addOrder("nombre", "ASC");
		return UIServiceFactory::getUIClienteService()->getList($uiCriteria);
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntityByCode()
	 */
	function findEntityByCode( $code, $parent=null ){


		return UIServiceFactory::getUIClienteService()->get( $code );
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributes()
	 */
	public function getAttributes(){
		return array("nombre");
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributesCallback()
	 */
	public function getAttributesCallback(){
		return array("oid", "nombre");
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityCode()
	 */
	function getEntityCode( $entity ){
		if( !empty( $entity)  )

		return $entity->getOid();
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityLabel()
	 */
	function getEntityLabel( $entity ){
		if( !empty( $entity)  )
		return $entity->__toString();
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityFieldCode()
	 */
	function getEntityFieldCode( $entity ){
		return "oid";
	}

	/**
	 * mensaje para cuando no hay resultados.
	 * @var string
	 */
	function getEmptyResultLabel(){
		return null;
	}

	/**
	 * label para agregar una nueva entity
	 * @var string
	 */
	function getAddEntityLabel(){
		return null;
	}

	/**
	 * función javascript a ejecutar para agregar una nueva entity.
	 * si esta property es definida se muestra el link cuando
	 * no hay resultados
	 * @var string
	 */
	function getOnclickAdd(){
		/*$url = $_SERVER['REQUEST_URI'];
		print_r(parse_url($url));
		$params = array('back'=>'serviciosTecnicos','code'=>$this->get);
		return "javascript: gotoLink('".LinkBuilder::getPageUrl( "CompaniaAgregar", $params)."')";*/
		return"";
	}
}
?>

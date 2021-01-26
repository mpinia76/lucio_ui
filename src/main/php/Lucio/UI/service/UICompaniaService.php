<?php
namespace Lucio\UI\service;

use Lucio\UI\components\filter\model\UICompaniaCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Lucio\Core\model\Compania;

use Lucio\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 *
 * UI service para companias.
 *
 * @author Marcos
 * @since 20/01/2021
 */
class UICompaniaService  implements IEntityGridService{

	private static $instance;

	private function __construct() {}

	public static function getInstance() {

		if( self::$instance == null ) {

			self::$instance = new UICompaniaService();

		}
		return self::$instance;
	}



	public function getList( UICompaniaCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getCompaniaService();

			$companias = $service->getList( $criteria );

			return $companias;
		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	public function get( $oid ){

		try{

			$service = ServiceFactory::getCompaniaService();

			return $service->get( $oid );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}


	public function add( Compania $compania ){

		try{

			$service = ServiceFactory::getCompaniaService();

			return $service->add( $compania );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

	public function update( Compania $compania ){

		try{

			$service = ServiceFactory::getCompaniaService();

			return $service->update( $compania );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

	function getEntitiesCount($uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getCompaniaService();
			$companias = $service->getCount( $criteria );

			return $companias;

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	function getEntities($uiCriteria){

		return $this->getList($uiCriteria);
	}

	public function delete(Compania $compania){

		try {

			$service = ServiceFactory::getCompaniaService();

			return $service->delete($compania->getOid());

		} catch (\Exception $e) {

			throw new RastyException( $e->getMessage() );

		}

	}



}
?>

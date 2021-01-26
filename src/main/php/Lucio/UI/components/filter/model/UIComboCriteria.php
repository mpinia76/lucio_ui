<?php
namespace Lucio\UI\components\filter\model;


use Lucio\UI\components\filter\model\UILucioCriteria;

use Rasty\utils\RastyUtils;
use Lucio\Core\criteria\ComboCriteria;

/**
 * Representa un criterio de búsqueda
 * para combos.
 *
 * @author Marcos
 * @since 28/08/2019
 *
 */
class UIComboCriteria extends UILucioCriteria{



	private $nombre;



	public function __construct(){

		parent::__construct();

	}



	protected function newCoreCriteria(){
		return new ComboCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNombre( $this->getNombre() );


		return $criteria;
	}








	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}
}

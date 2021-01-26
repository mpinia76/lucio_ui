<?php
namespace Lucio\UI\components\filter\model;


use Lucio\UI\components\filter\model\UILucioCriteria;

use Rasty\utils\RastyUtils;
use Lucio\Core\criteria\TipoProductoCriteria;

/**
 * Representa un criterio de búsqueda
 * para tiposProducto.
 *
 * @author Marcos
 * @since 05/03/2018
 *
 */
class UITipoProductoCriteria extends UILucioCriteria{


	private $nombre;



	public function __construct(){

		parent::__construct();

	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}


	protected function newCoreCriteria(){
		return new TipoProductoCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNombre( $this->getNombre() );


		return $criteria;
	}



}

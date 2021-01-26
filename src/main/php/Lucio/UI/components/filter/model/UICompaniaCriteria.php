<?php
namespace Lucio\UI\components\filter\model;


use Lucio\UI\components\filter\model\UILucioCriteria;

use Rasty\utils\RastyUtils;
use Lucio\Core\criteria\CompaniaCriteria;

/**
 * Representa un criterio de búsqueda
 * para companias.
 *
 * @author Marcos
 * @since 20/01/2021
 *
 */
class UICompaniaCriteria extends UILucioCriteria{


	private $nombre;
	private $documento;
	private $tieneCtaCte;
	private $razonSocial;
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
		return new CompaniaCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNombre( $this->getNombre() );
		$criteria->setRazonSocial( $this->getRazonSocial() );
		$criteria->setDocumento( $this->getDocumento() );
		$criteria->setTieneCtaCte( $this->getTieneCtaCte() );

		return $criteria;
	}


	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}

	public function getTieneCtaCte()
	{
	    return $this->tieneCtaCte;
	}

	public function setTieneCtaCte($tieneCtaCte)
	{
	    $this->tieneCtaCte = $tieneCtaCte;
	}

	public function getRazonSocial()
	{
	    return $this->razonSocial;
	}

	public function setRazonSocial($razonSocial)
	{
	    $this->razonSocial = $razonSocial;
	}
}

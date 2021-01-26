<?php
namespace Lucio\UI\components\filter\model;

use Lucio\Core\utils\LucioUtils;

use Lucio\UI\components\filter\model\UILucioCriteria;

use Rasty\utils\RastyUtils;

use Lucio\Core\criteria\PedidoCriteria;
use Lucio\Core\model\EstadoPedido;

/**
 * Representa un criterio de búsqueda
 * para pedidos.
 *
 * @author Marcos
 * @since 10-07-2020
 *
 */
class UIPedidoCriteria extends UILucioCriteria{

	/* constantes para los filtros predefinidos */
	const HOY = "pedidosHoy";
	const SEMANA_ACTUAL = "pedidosSemanaActual";
	const MES_ACTUAL = "pedidosMesActual";
	const ANIO_ACTUAL = "pedidosAnioActual";
	const IMPAGOS = "pedidosImpagos";
	const ANULADOS = "pedidosAnulados";
	const SIN_RECIBIR = "pedidosSinRecibir";

	private $fecha;

	private $fechaDesde;

	private $fechaHasta;

	private $recibido;

	private $anulado;

	private $estadoPedido;

	private $estados;

	private $estadoPedidoNotEqual;

	public function __construct(){

		parent::__construct();

		$this->setFiltroPredefinido( self::SIN_RECIBIR );

	}

	protected function newCoreCriteria(){
		return new PedidoCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setFecha( $this->getFecha() );
		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );

		if( $this->getRecibido() == 1 ||  $this->getRecibido() === true)
			$criteria->setRecibido( 1 );
		elseif( $this->getRecibido() == 2 ||  $this->getRecibido() === false)
			$criteria->setRecibido( false );
		else
			$criteria->setRecibido( null );

		$criteria->setEstadoPedido( $this->getEstadoPedido() );
		$criteria->setEstados( $this->getEstados() );
		$criteria->setEstadoPedidoNotEqual( $this->getEstadoPedidoNotEqual() );


		if( $this->getAnulado() == 2 )
			$criteria->setEstadoPedidoNotEqual( EstadoPedido::Anulado );

		return $criteria;
	}


	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}


	public function getRecibido()
	{
	    return $this->recibido;
	}

	public function setRecibido($recibido)
	{
	    $this->recibido = $recibido;
	}

	public function getEstadoPedido()
	{
	    return $this->estadoPedido;
	}

	public function setEstadoPedido($estadoPedido)
	{
	    $this->estadoPedido = $estadoPedido;
	}

	public function getEstados()
	{
	    return $this->estados;
	}

	public function setEstados($estados)
	{
	    $this->estados = $estados;
	}

	public function getEstadoPedidoNotEqual()
	{
	    return $this->estadoPedidoNotEqual;
	}

	public function setEstadoPedidoNotEqual($estadoPedidoNotEqual)
	{
	    $this->estadoPedidoNotEqual = $estadoPedidoNotEqual;
	}

	public function getAnulado()
	{
	    return $this->anulado;
	}

	public function setAnulado($anulado)
	{
	    $this->anulado = $anulado;
	}


	public function pedidosHoy(){

		$this->setFecha( new \Datetime() );

	}


	public function pedidosSemanaActual(){

		$fechaDesde = LucioUtils::getFirstDayOfWeek( new \Datetime() );
		$fechaHasta = LucioUtils::getLastDayOfWeek( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function pedidosMesActual(){

		$fechaDesde = LucioUtils::getFirstDayOfMonth( new \Datetime() );
		$fechaHasta = LucioUtils::getLastDayOfMonth( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );

	}

	public function pedidosAnioActual(){

		$fechaDesde = LucioUtils::getFirstDayOfYear( new \Datetime() );
		$fechaHasta = LucioUtils::getLastDayOfYear( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function pedidosImpagos(){

		$this->setEstados( array(EstadoPedido::Impago) );

	}

	public function pedidosAnulados(){

		$this->setEstadoPedido( EstadoPedido::Anulado );
	}

	public function pedidosSinRecibir(){

		$this->setRecibido( 2 );
		$this->setEstadoPedidoNotEqual(EstadoPedido::Anulado);
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}
}

<?php
namespace Lucio\UI\components\filter\model;


use Lucio\UI\utils\LucioUIUtils;
use Lucio\Core\utils\LucioUtils;
use Lucio\Core\model\EstadoPresupuesto;

use Lucio\UI\components\filter\model\UILucioCriteria;

use Rasty\utils\RastyUtils;
use Lucio\Core\criteria\PresupuestoCriteria;

/**
 * Representa un criterio de búsqueda
 * para Presupuestos.
 *
 * @author Marcos
 * @since 29-03-2019
 *
 */
class UIPresupuestoCriteria extends UILucioCriteria{

	/* constantes para los filtros predefinidos */
	const HOY = "presupuestosHoy";
	const SEMANA_ACTUAL = "presupuestosSemanaActual";
	const MES_ACTUAL = "presupuestosMesActual";
	const ANIO_ACTUAL = "presupuestosAnioActual";
	const PENDIENTES = "presupuestosPendientes";
	const ANULADOS = "presupuestosAnulados";

	private $fechaDesde;

	private $fechaHasta;

	private $fecha;

	private $estados;

	private $estadoNotEqual;

	private $estado;

    private $cliente;

    private $compania;

    private $observaciones;

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getCompania()
    {
        return $this->compania;
    }

    /**
     * @param mixed $compania
     */
    public function setCompania($compania)
    {
        $this->compania = $compania;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param mixed $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

	public function __construct(){

		parent::__construct();

		//$this->setFiltroPredefinido( self::HOY );

	}

	protected function newCoreCriteria(){
		return new PresupuestoCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		$criteria->setFecha( $this->getFecha() );
		$criteria->setEstados( $this->getEstados() );
		$criteria->setEstado( $this->getEstado() );
        $criteria->setCliente( $this->getCliente() );
        $criteria->setCompania( $this->getCompania() );
        $criteria->setObservaciones( $this->getObservaciones() );


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

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getEstados()
	{
	    return $this->estados;
	}

	public function setEstados($estados)
	{
	    $this->estados = $estados;
	}

	public function getEstadoNotEqual()
	{
	    return $this->estadoNotEqual;
	}

	public function setEstadoNotEqual($estadoNotEqual)
	{
	    $this->estadoNotEqual = $estadoNotEqual;
	}

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}


	public function presupuestosHoy(){

		$this->setFecha( new \Datetime() );

	}


	public function presupuestosSemanaActual(){

		$fechaDesde = LucioUtils::getFirstDayOfWeek( new \Datetime() );
		$fechaHasta = LucioUtils::getLastDayOfWeek( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function presupuestosMesActual(){

		$fechaDesde = LucioUtils::getFirstDayOfMonth( new \Datetime() );
		$fechaHasta = LucioUtils::getLastDayOfMonth( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );

	}

	public function presupuestosAnioActual(){

		$fechaDesde = LucioUtils::getFirstDayOfYear( new \Datetime() );
		$fechaHasta = LucioUtils::getLastDayOfYear( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function presupuestosPendientes(){

		$this->setEstados( array(EstadoPresupuesto::Pendiente) );

	}

	public function presupuestosAnulados(){

		$this->setEstado( EstadoPresupuesto::Anulado );
	}

}

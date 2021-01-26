<?php
namespace Lucio\UI\components\grid\formats;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\Core\model\EstadoPresupuesto;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar el estado de una Presupuesto
 *
 * @author Marcos
 * @since 29-03-2019
 *
 */

class GridEstadoPresupuestoFormat extends  GridValueFormat{

	private $pattern;

	public function format( $value, $item=null ){

		if( !empty($value))
			return  Locale::localize( EstadoPresupuesto::getLabel( $value ) );
		else $value;
	}

	public function getColumnCssClass($value, $item=null){

		return LucioUIUtils::getEstadoPresupuestoCss($value);
	}

	public function getPattern(){
		return $this->pattern;
	}

}

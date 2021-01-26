<?php
namespace Lucio\UI\components\grid\formats;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\Core\model\EstadoVenta;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar el estado de una Venta
 *
 * @author Marcos
 * @since 13-03-2018
 *
 */

class GridEstadoVentaFormat extends  GridValueFormat{

	private $pattern;

	public function format( $value, $item=null ){

		if( !empty($value))
			return  Locale::localize( EstadoVenta::getLabel( $value ) );
		else $value;
	}

	public function getColumnCssClass($value, $item=null){

		return LucioUIUtils::getEstadoVentaCss($value);
	}

	public function getPattern(){
		return $this->pattern;
	}

}

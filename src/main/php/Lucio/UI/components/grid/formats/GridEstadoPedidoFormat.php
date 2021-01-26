<?php
namespace Lucio\UI\components\grid\formats;

use Lucio\UI\utils\LucioUIUtils;

use Lucio\Core\model\EstadoPedido;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar el estado de un Pedido
 *
 * @author Marcos
 * @since 11-06-2020
 *
 */

class GridEstadoPedidoFormat extends  GridValueFormat{

	private $pattern;

	public function format( $value, $item=null ){

		if( !empty($value))
			return  Locale::localize( EstadoPedido::getLabel( $value ) );
		else $value;
	}

	public function getPattern(){
		return $this->pattern;
	}

	public function getColumnCssClass($value, $item=null){

		return LucioUIUtils::getEstadoPedidoCss($value);
	}
}

<?php
namespace Lucio\UI\pages\pedidos\agregar;

use Lucio\Core\utils\LucioUtils;
use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\pages\LucioPage;

use Rasty\utils\XTemplate;
use Lucio\Core\model\Pedido;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Page para agregar un pedido
 *
 * @author Marcos
 * @since 10-07-2020
 *
 */
class PedidoAgregar extends LucioPage{

	/**
	 * pedido a agregar.
	 * @var Pedido
	 */
	private $pedido;


	public function __construct(){

		//inicializamos el pedido.
		$pedido = new Pedido();

		$pedido->setFechaHora( new \Datetime() );
		$pedido->setProveedor( LucioUtils::getProveedorDefault() );

		$this->setPedido($pedido);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Pedidos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "pedido.agregar.title" );
	}

	public function getType(){

		return "PedidoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		LucioUIUtils::setDetallesPedidoSession( array() );
	}


	public function getPedido()
	{
	    return $this->pedido;
	}

	public function setPedido($pedido)
	{
	    $this->pedido = $pedido;
	}



	public function getMsgError(){
		return "";
	}
}
?>

<?php
namespace Lucio\UI\pages\pedidos\ver;

use Lucio\UI\service\UIServiceFactory;

use Lucio\Core\utils\LucioUtils;
use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\pages\LucioPage;

use Rasty\utils\XTemplate;
use Lucio\Core\model\Pedido;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class PedidoVer extends LucioPage{

	/**
	 * pedido a ver.
	 * @var Pedido
	 */
	private $pedido;

	private $error;

	public function __construct(){

		//inicializamos el pedido.
		$pedido = new Pedido();


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
		return $this->localize( "pedido.ver.title" );
	}

	public function getType(){

		return "PedidoVer";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign( "pedido_legend", $this->localize( "verPedido.pedido.legend") );




		$xtpl->assign( "pedidoOid", $this->getPedido()->getOid() );




		$xtpl->assign( "lbl_aceptar", $this->localize("verPedido.aceptar") );

	}


	public function getPedido()
	{
	    return $this->pedido;
	}

	public function setPedido($pedido)
	{
	    $this->pedido = $pedido;
	}

	public function setPedidoOid($pedidoOid)
	{
		if(!empty($pedidoOid)){
			$pedido = UIServiceFactory::getUIPedidoService()->get($pedidoOid);
			$this->setPedido($pedido);
		}


	}

	public function getMsgError(){
		return "";
	}

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}
}
?>

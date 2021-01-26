<?php
namespace Lucio\UI\pages\pedidos\anular;

use Lucio\UI\service\UIServiceFactory;

use Lucio\Core\utils\LucioUtils;
use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\pages\LucioPage;

use Rasty\utils\XTemplate;
use Lucio\Core\model\Pedido;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class PedidoAnularRecibir extends LucioPage{

	/**
	 * pedido a anular.
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
		return $this->localize( "pedido.anularRecibir.title" );
	}

	public function getType(){

		return "PedidoAnularRecibir";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign( "pedido_legend", $this->localize( "anularRecibirPedido.pedido.legend") );

		$xtpl->assign( "anular_msg", $this->localize( "anularRecibirPedido.informacion_msg") );

		$xtpl->assign( "pedidoOid", $this->getPedido()->getOid() );

		$xtpl->assign( "linkAnularRecibirPedido", $this->getLinkActionAnularRecibirPedido($this->getPedido()) );

		$msg = $this->getError();

		if( !empty($msg) ){

			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}

		$xtpl->assign( "lbl_submit", $this->localize("anularRecibirPedido.confirm") );
		$xtpl->assign( "lbl_cancel", $this->localize("anularRecibirPedido.cancel") );

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

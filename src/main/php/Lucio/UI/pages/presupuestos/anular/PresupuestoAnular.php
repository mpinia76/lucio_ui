<?php
namespace Lucio\UI\pages\presupuestos\anular;

use Lucio\UI\service\UIServiceFactory;

use Lucio\Core\utils\LucioUtils;
use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\pages\LucioPage;

use Rasty\utils\XTemplate;
use Lucio\Core\model\Presupuesto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class PresupuestoAnular extends LucioPage{

	/**
	 * presupuesto a anular.
	 * @var Presupuesto
	 */
	private $presupuesto;

	private $error;

	public function __construct(){

		//inicializamos el presupuesto.
		$presupuesto = new Presupuesto();


		$this->setPresupuesto($presupuesto);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Presupuestos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "presupuesto.anular.title" );
	}

	public function getType(){

		return "PresupuestoAnular";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign( "presupuesto_legend", $this->localize( "anularPresupuesto.presupuesto.legend") );

		$xtpl->assign( "presupuestoOid", $this->getPresupuesto()->getOid() );

		$xtpl->assign( "linkAnularPresupuesto", $this->getLinkActionAnularPresupuesto($this->getPresupuesto()) );

		$msg = $this->getError();

		if( !empty($msg) ){

			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}

		$xtpl->assign( "lbl_submit", $this->localize("anularPresupuesto.confirm") );
		$xtpl->assign( "lbl_cancel", $this->localize("anularPresupuesto.cancel") );

	}


	public function getPresupuesto()
	{
	    return $this->presupuesto;
	}

	public function setPresupuesto($presupuesto)
	{
	    $this->presupuesto = $presupuesto;
	}

	public function setPresupuestoOid($presupuestoOid)
	{
		if(!empty($presupuestoOid)){
			$presupuesto = UIServiceFactory::getUIPresupuestoService()->get($presupuestoOid);
			$this->setPresupuesto($presupuesto);
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

<?php

namespace Lucio\UI\components\form\compania;

use Lucio\UI\components\filter\model\UICompaniaCriteria;

use Lucio\UI\service\finder\CompaniaFinder;



use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;


use Lucio\Core\model\Compania;


use Lucio\Core\model\CondicionIva;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para compania

 * @author Marcos
 * @since 20/01/2021
 */
class CompaniaForm extends Form{



	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;


	/**
	 *
	 * @var Compania
	 */
	private $compania;


	public function __construct($backToOnSuccess="Companias"){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		$this->addProperty("nombre");

		$this->addProperty("condicionIva");
		$this->addProperty("cbu");
		$this->addProperty("cuit");
		$this->addProperty("razonSocial");

		$this->addProperty("telefono");
		$this->addProperty("celular");
		$this->addProperty("mail");
		$this->addProperty("direccion");
		$this->addProperty("observaciones");
		$this->addProperty("laboral");


		$url = parse_url($_SERVER['REQUEST_URI']);
		if (isset($url['query'])) {
			$arrayParametros = explode("&",$url['query']);
			foreach ($arrayParametros as $parametro) {
				$arrayParametro = explode("=",$parametro);
				if ($arrayParametro[0]=="onSuccessCallback") {
					$backToOnSuccess = $arrayParametro[1];
				}
			}
		}


		$this->setBackToOnSuccess($backToOnSuccess);
		$this->setBackToOnCancel($backToOnSuccess);

	}

	public function getOid(){

		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}


	public function getType(){

		return "CompaniaForm";

	}

	public function fillEntity($entity){

		parent::fillEntity($entity);

		//uppercase para el nombre
		//$entity->setNombre( strtoupper( $entity->getNombre() ) );
		$entity->setFecha(new \Datetime() );
		$entity->setUltModificacion(new \Datetime() );


	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);


		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );

		$xtpl->assign("lbl_nombre", $this->localize("compania.nombre") );
		$xtpl->assign("lbl_condicionIva", $this->localize("compania.condicionIva") );
		$xtpl->assign("lbl_cbu", $this->localize("compania.cbu") );

		$xtpl->assign("lbl_razonSocial", $this->localize("compania.razonSocial") );
		$xtpl->assign("lbl_telefono", $this->localize("compania.telefono") );
		$xtpl->assign("lbl_celular", $this->localize("compania.celular") );
		$xtpl->assign("lbl_mail", $this->localize("compania.mail") );
		$xtpl->assign("lbl_direccion", $this->localize("compania.direccion") );
		$xtpl->assign("lbl_observaciones", $this->localize("compania.observaciones") );
		$xtpl->assign("lbl_laboral", $this->localize("compania.laboral") );
		$xtpl->assign("lbl_cuit", $this->localize("compania.cuit") );

	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}



	public function getCompania()
	{
	    return $this->compania;
	}

	public function setCompania($compania)
	{
	    $this->compania = $compania;

	}

	public function getLinkCancel(){
		$params = array();

		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}


	public function getCondicionesIva(){

		return LucioUIUtils::localizeEntities(CondicionIva::getItems());
	}



}
?>

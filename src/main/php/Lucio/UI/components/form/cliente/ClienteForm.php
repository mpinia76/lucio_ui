<?php

namespace Lucio\UI\components\form\cliente;

use Lucio\UI\components\filter\model\UIClienteCriteria;

use Lucio\UI\service\finder\ClienteFinder;



use Lucio\UI\utils\LucioUIUtils;

use Lucio\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;


use Lucio\Core\model\Cliente;


use Lucio\Core\model\CondicionIva;

use Lucio\Core\model\TipoCliente;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para cliente

 * @author Marcos
 * @since 20/01/2021
 */
class ClienteForm extends Form{



	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;


	/**
	 *
	 * @var Cliente
	 */
	private $cliente;


	public function __construct($backToOnSuccess="Clientes"){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		$this->addProperty("nombre");

		$this->addProperty("condicionIva");
		$this->addProperty("cbu");
		$this->addProperty("cuit");
		$this->addProperty("tipoCliente");

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

		return "ClienteForm";

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

		$xtpl->assign("lbl_nombre", $this->localize("cliente.nombre") );
		$xtpl->assign("lbl_condicionIva", $this->localize("cliente.condicionIva") );
		$xtpl->assign("lbl_cbu", $this->localize("cliente.cbu") );

		$xtpl->assign("lbl_tipoCliente", $this->localize("cliente.tipoCliente") );
		$xtpl->assign("lbl_telefono", $this->localize("cliente.telefono") );
		$xtpl->assign("lbl_celular", $this->localize("cliente.celular") );
		$xtpl->assign("lbl_mail", $this->localize("cliente.mail") );
		$xtpl->assign("lbl_direccion", $this->localize("cliente.direccion") );
		$xtpl->assign("lbl_observaciones", $this->localize("cliente.observaciones") );
		$xtpl->assign("lbl_laboral", $this->localize("cliente.laboral") );
		$xtpl->assign("lbl_cuit", $this->localize("cliente.cuit") );

	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}



	public function getCliente()
	{
	    return $this->cliente;
	}

	public function setCliente($cliente)
	{
	    $this->cliente = $cliente;

	}

	public function getLinkCancel(){
		$params = array();

		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}


	public function getCondicionesIva(){

		return LucioUIUtils::localizeEntities(CondicionIva::getItems());
	}

    public function getTiposDocumento(){

        return LucioUIUtils::localizeEntities(TipoDocumento::getItems());
    }

    public function getTiposCliente(){

        return LucioUIUtils::localizeEntities(TipoCliente::getItems());
    }



}
?>

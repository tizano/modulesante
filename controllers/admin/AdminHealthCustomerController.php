<?php

class AdminHealthCustomerController extends ModuleAdminController
{
	//so when add or edit are called my "renderForm()" is displayed. and when i call "view" my "rederview()" is well displayed too.

	public $toolbar_title;

	public function __construct()
	{

		$this->bootstrap = true;
		$this->identifier_name = 'customer_name';
		$this->table = 'modulesante';
		$this->className = 'Modulesante';
		$this->lang = false;
		$this->noLink = true;
		$this->list_no_link = true;
		$this->explicitSelect = true;
		$this->allow_export = true;
		$this->deleted = false;
		$this->context = Context::getContext();

		parent::__construct();

		$this->addRowAction('View');

		$this->fields_list = array(
				'id_modulesante' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
				'date_naissance' => array('title' => $this->l('Date de naissance'), 'width' => 'auto', 'align' => 'center', 'type' => 'date'),
				'poids' => array('title' => $this->l('Poids'), 'width' => 'auto', 'align' => 'center'),
				'sexe' => array('title' => $this->l('Sexe'), 'width' => 'auto', 'align' => 'center'),
				'allergie' => array('title' => $this->l('Allergie'), 'width' => 'auto', 'align' => 'center', 'type' => 'bool', 'callback' => 'printIcon'),
				'enceinte' => array('title' => $this->l('Enceinte'), 'width' => 'auto', 'align' => 'center', 'type' => 'bool', 'callback' => 'printIcon'),
				'allaite' => array('title' => $this->l('Allaite'), 'width' => 'auto', 'align' => 'center', 'type' => 'bool', 'callback' => 'printIcon'),
				'customer_name' => array('title' => $this->l('Client'), 'width' => 'auto', 'align' => 'center'),
				'customer_email' => array('title' => $this->l('Email'), 'width' => 'auto', 'align' => 'center')
		);
	}

	public function initContent()
	{
		// $this->renderView();
    parent::initContent();
	}

	public function initToolbar()
	{
		parent::initToolbar();
	}

	public function initToolBarTitle()
	{
		parent::initToolbarTitle();

	  $this->toolbar_title[] = $this->l('Health Customer forms');
		if($this->display == 'view')
		{
			$sql = 'SELECT customer_name FROM '._DB_PREFIX_.'modulesante ms
							WHERE ms.id_modulesante = '.(int)Tools::getValue('id_modulesante');
			$customer_name = Db::getInstance()->getValue($sql);
			$this->toolbar_title[] = sprintf($this->l('Information health form: %s'), $customer_name);
		}
	}


	public function renderView()
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'modulesante ms
						WHERE ms.id_modulesante = '.(int)Tools::getValue('id_modulesante');
		$customer_info = Db::getInstance()->executeS($sql);
		$this->context->smarty->assign(
			array(
        'customer_info' => $customer_info[0]
			));
		// $this->toolbar_title = sprintf($this->l('Customer %1$d %2$s'), $customer->firstname, $customer->lastname);
    return $this->context->smarty->fetch(_PS_MODULE_DIR_ . "modulesante/views/templates/admin/formulaire_admin.tpl");
	}

	public function printIcon($value)
	{
			return '<span class="list-action-enable '.($value ? 'action-enabled' : 'action-disabled').'">
			'.($value ? '<i class="icon-check"></i>' : '<i class="icon-remove"></i>').
					'</span>';
	}

}

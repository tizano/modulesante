<?php

class AdminHealthCustomerController extends ModuleAdminController
{
	//so when add or edit are called my "renderForm()" is displayed. and when i call "view" my "rederview()" is well displayed too.
	//

	public function __construct()
	{

		$this->bootstrap = true;

		$this->table = 'order';
		$this->className = 'AdminHealthCustomer';
		$this->lang = false;
		$this->noLink = true;
		$this->list_no_link = true;
		$this->explicitSelect = true;
        $this->allow_export = true;
        $this->deleted = false;
        $this->context = Context::getContext();

		parent::__construct();

	}
}

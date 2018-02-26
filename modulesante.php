<?php

if (!defined('_PS_VERSION_'))
{
  exit;
}

class ModuleSante extends Module
{
    public function __construct()
    {
        $this->name = 'modulesante';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Mathieu Scarlatella & Anthony Thirion';
        // $this->need_instance = 1;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Health Form Module');
        $this->description = $this->l('Any client ordering drugs on the site must have previously completed a health form');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install($delete_params = true)
    {

        if (!parent::install() ||
            !$this->installSql() ||
            !$this->installTab('AdminParentCustomer','AdminHealthCustomer' ,$this->l('Health form customer')) ||
            !$this->registerHook('displayCustomerAccount') ||
            !$this->registerHook('displayShoppingCart') ||
            !Configuration::updateValue('MYMODULE_NAME', 'Module santé')
            //!$this->registerHook('displayAdminProductsMainStepRightColumnBottom')
        )
            return false;
        return true;
    }

    public function uninstall($delete_params = true)
    {
        if (!parent::uninstall() ||
            !$this->uninstallTab('AdminHealthCustomer') ||
            !Configuration::deleteByName('MYMODULE_NAME')
        )
        {
            return false;
        }
        return true;
    }

    public function reset()
    {
        if (!$this->uninstall())
        {
            return false;
        }
        if (!$this->install())
        {
            return false;
        }

        return true;
    }

    private function installSql()
    {
        include(dirname(__FILE__).'/sql/install.php');
        $result = true;
	    foreach ($sql_requests as $request){
            if (!empty($request))
            $result &= Db::getInstance()->execute(trim($request));
        }
        return $result;
    }

    private function installTab($parent, $class_name, $name)
    {
        $tab = new Tab();
        $tab->id_parent = (int)Tab::getIdFromClassName($parent);
        $tab->class_name = $class_name;
        $tab->module = $this->name;

        $tab->name = array();
		foreach (Language::getLanguages(true) as $lang){
			$tab->name[$lang['id_lang']] = $name;
        }

        return $tab->save();
    }

	   private function uninstallTab($class_name)
    {
        $idTab = (int)Tab::getIdFromClassName($class_name);
        $tab = new Tab($idTab);
        return $tab->delete();
    }

    public function hookDisplayCustomerAccount($params)
    {
      $this->_displayMsContent();
      return $this->display(__FILE__, 'views/templates/hook/linkform.tpl');
    }

    public function hookDisplayShoppingCart($params)
    {
      $this->_displayMsContent();
      return $this->display(__FILE__, 'views/templates/hook/linkform.tpl');
    }

    private function _displayMsContent()
    {
      $client = $this->context->customer;

      $sql = 'SELECT * FROM '._DB_PREFIX_.'modulesante ms
              WHERE ms.customer_id = '.$client->id;
      $customer_ms = Db::getInstance()->getRow($sql);

      if($customer_ms) {
        return $this->context->smarty->assign(
          array(
            'my_module_name' => Configuration::get('MYMODULE_NAME'),
            'my_module_link' => $this->context->link->getModuleLink('modulesante', 'formulaire'),
            'my_module_message' => $this->l('Vous avez déjà rempli le formulaire, mais vous pouvez toujours modifier ces informations'), // Do not forget to enclose your strings in the l() translation method
            'my_module_check' => true
          )
        );
      }
      else {
        return $this->context->smarty->assign(
          array(
            'my_module_name' => Configuration::get('MYMODULE_NAME'),
            'my_module_link' => $this->context->link->getModuleLink('modulesante', 'formulaire'),
            'my_module_message' => $this->l('Accédez au formulaire avant de valider vos achats'), // Do not forget to enclose your strings in the l() translation method
            'my_module_check' => false
          )
        );
      }
    }

    // public function hookDisplayHeader()
    // {
    //   $this->context->controller->addCSS($this->_path.'css/mycataloguepro.css', 'all');
    // }

}

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
            !$this->installTab('AdminParentCustomer','AdminHealthCustomer' ,$this->l('Health form customer'))

            //!$this->registerHook('displayAdminProductsMainStepRightColumnBottom')
        )
            return false;
        return true;
    }

    public function uninstall($delete_params = true)
    {
        if (!parent::uninstall() ||
            !$this->uninstallTab('AdminHealthCustomer')
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

}

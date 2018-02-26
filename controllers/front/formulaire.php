<?php

class modulesanteFormulaireModuleFrontController extends ModuleFrontController
{

  public function __construct()
	{
		parent::__construct();
		$this->context = Context::getContext();
	}

  public function initContent(){
    //$this-> renderForm();
    // $this->renderView();
    parent::initContent();
    $client = $this->context->customer;

    $sql = 'SELECT * FROM '._DB_PREFIX_.'modulesante ms
            WHERE ms.customer_id = '.$client->id;
    $customer_ms = Db::getInstance()->getRow($sql);

    if($customer_ms) {
      $this->context->smarty->assign('customer_ms', $customer_ms);
      $this->setTemplate('formulaire_update.tpl');
    }
    else {
      $this->setTemplate('formulaire.tpl');
    }
  }

  public function postProcess()
  {
    if (Tools::isSubmit('submit_modulesante'))
    {
      $date_naissance = Tools::getValue('date_naissance');
      $poids = Tools::getValue('poids');
      $sexe = Tools::getValue('sexe');
      $allergie = Tools::getValue('allergie');
      $enceinte = Tools::getValue('enceinte');
      $allaite = Tools::getValue('allaite');
      $medicament_actuel = Tools::getValue('medicament_actuel');
      $commentaires = Tools::getValue('commentaires'); // Html entities is not usefull, iscleanHtml check there is no bad html tags.

      if (!Validate::isDate($date_naissance)) {
          $this->errors[] = Tools::displayError('La date de naissance n\'a pas le bon format');
      } elseif (!Validate::isUnsignedFloat($poids)) {
          $this->errors[] = Tools::displayError('Le poids n\'est pas conforme.');
      } elseif (!Validate::isString($sexe)) {
          $this->errors[] = Tools::displayError('Le sexe est requis.');
      } elseif (!Validate::isBool($allergie)) {
          $this->errors[] = Tools::displayError('Les antécédants allergiques sont requis.');
      } elseif (!Validate::isBool($enceinte)) {
          $this->errors[] = Tools::displayError('Le champ enceinte est requis.');
      } elseif (!Validate::isBool($allaite)) {
          $this->errors[] = Tools::displayError('Le champ enceinte est requis.');
      } elseif (!Validate::isCleanHtml($medicament_actuel)) {
          $this->errors[] = Tools::displayError('Les médicaments actuels ne peuvent pas être vide.');
      } elseif (!Validate::isCleanHtml($commentaires)) {
          $this->errors[] = Tools::displayError('Le commentaire ne peut pas être vide.');
      }
      else {
        $client = $this->context->customer;
        // print_r($client);
        $nom = "$client->lastname $client->firstname";
        $sql = "INSERT INTO `"._DB_PREFIX_."modulesante`
                ( `date_naissance`,
                  `poids`,
                  `sexe`,
                  `allergie`,
                  `enceinte`,
                  `allaite`,
                  `medicament_actuel`,
                  `commentaires`,
                  `customer_id`,
                  `customer_name`,
                  `customer_email`)
                VALUES(
                  '{$date_naissance}',
                  '{$poids}',
                  '{$sexe}',
                  '{$allergie}',
                  '{$enceinte}',
                  '{$allaite}',
                  '{$medicament_actuel}',
                  '{$commentaires}',
                  '{$client->id}',
                  '{$nom}',
                  '{$client->email}'
                );";

                // print_r($sql);
        if (!Db::getInstance()->execute($sql))
          die('Error etc.');
      }
      $this->context->smarty->assign( 'success', 'Success! '.$nom );
    }
    elseif (Tools::isSubmit('submit_update_modulesante')) {
      $poids = Tools::getValue('poids');
      $sexe = Tools::getValue('sexe');
      $allergie = Tools::getValue('allergie');
      $enceinte = Tools::getValue('enceinte');
      $allaite = Tools::getValue('allaite');
      $medicament_actuel = Tools::getValue('medicament_actuel');
      $commentaires = Tools::getValue('commentaires'); // Html entities is not usefull, iscleanHtml check there is no bad html tags.

      if (!Validate::isUnsignedFloat($poids)) {
          $this->errors[] = Tools::displayError('Le poids n\'est pas conforme.');
      } elseif (!Validate::isString($sexe)) {
          $this->errors[] = Tools::displayError('Le sexe est requis.');
      } elseif (!Validate::isBool($allergie)) {
          $this->errors[] = Tools::displayError('Les antécédants allergiques sont requis.');
      } elseif (!Validate::isBool($enceinte)) {
          $this->errors[] = Tools::displayError('Le champ enceinte est requis.');
      } elseif (!Validate::isBool($allaite)) {
          $this->errors[] = Tools::displayError('Le champ enceinte est requis.');
      } elseif (!Validate::isCleanHtml($medicament_actuel)) {
          $this->errors[] = Tools::displayError('Les médicaments actuels ne peuvent pas être vide.');
      } elseif (!Validate::isCleanHtml($commentaires)) {
          $this->errors[] = Tools::displayError('Le commentaire ne peut pas être vide.');
      }
      else {
        $client = $this->context->customer;
        // print_r($client);
        $nom = "$client->lastname $client->firstname";
        $sql = "UPDATE `"._DB_PREFIX_."modulesante`
                SET `poids` = '{$poids}',
                  `sexe` = '{$sexe}',
                  `allergie` = '{$allergie}',
                  `enceinte` = '{$enceinte}',
                  `allaite` = '{$allaite}',
                  `medicament_actuel` = '{$medicament_actuel}',
                  `commentaires` = '{$commentaires}'
                WHERE `customer_id` = '{$client->id}';";

                // print_r($sql);
        if (!Db::getInstance()->execute($sql))
          die('Error etc.');
      }
      $this->context->smarty->assign( 'success', 'Success! teaze' );
    }
    // $this->_displayContent($message);
      // $this->send_message('Tesst apres submit', 'test message');
      // die('test submit');
      //
  }

}

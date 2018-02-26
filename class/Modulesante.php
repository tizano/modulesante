<?php

class Modulesante extends ObjectModel
{

  public $id_modulesante;
  public $date_naissance;
  public $poids;
  public $sexe;
  public $allergie;
  public $enceinte;
  public $allaite;
  public $medicament_actuel;
  public $commentaires;
  public $customer_name;
  public $customer_email;

  /**
  * @see ObjectModel::$definition
  */
  public static $definition = array(
   'table' => 'modulesante',
   'primary' => 'id_modulesante',
   'fields' => array(
       'date_naissance' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'required' => true),
       'poids' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedFloat', 'required' => true),
       'sexe' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'required' => true),
       'allergie' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
       'enceinte' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
       'allaite' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
       'medicament_actuel' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'required' => true),
       'commentaires' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'required' => true),
       'customer_name' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'required' => true),
       'customer_email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail', 'required' => true),
     ),
  );

 public function __construct($id = null, $id_lang = null)
 {
   parent::__construct($id, $id_lang);
 }

}

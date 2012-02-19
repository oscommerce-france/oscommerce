<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Application\Configuration\Model;

  use osCommerce\OM\Core\OSCOM;

  class getEntry {
    public static function execute($id, $key = null, $namespace = null) {
      $data = array('id' => $id);

      $result = OSCOM::callDB('Admin\Configuration\EntryGet', $data);

      $OSCOM_Config = loadModule::execute($result['configuration_key'], $namespace);

      $result['configuration_title'] = $OSCOM_Config->getTitle();
      $result['configuration_description'] = $OSCOM_Config->getDescription();
      $result['configuration_field'] = $OSCOM_Config->getField();

      if ( isset($key) ) {
        $result = $result[$key] ?: null;
      }

      return $result;
    }
  }
?>

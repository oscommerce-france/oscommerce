<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Application\Configuration\Model;

  use osCommerce\OM\Core\OSCOM;

  class getAllEntries {
    public static function execute($group_id) {
      $data = array('group_id' => $group_id);

      $result = OSCOM::callDB('Admin\Configuration\EntryGetAll', $data);

      foreach ( $result['entries'] as &$row ) {
        $OSCOM_Config = loadModule::execute($row['configuration_key']);

        $row['configuration_title'] = $OSCOM_Config->getTitle();
        $row['configuration_value'] = $OSCOM_Config->get();
        $row['sort_order'] = $OSCOM_Config->getSort();
      }

      usort($result['entries'], function($a, $b) {
        return strnatcmp($a['sort_order'], $b['sort_order']);
      });

      return $result;
    }
  }
?>

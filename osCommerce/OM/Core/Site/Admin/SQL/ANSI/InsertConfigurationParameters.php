<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

/**
 * @since v3.0.3
 */

  class InsertConfigurationParameters {
    public static function execute($data) {
      $OSCOM_PDO = Registry::get('PDO');

      if ( isset($data['key']) && isset($data['value']) ) {
        $data = array($data);
      }

      $error = false;
      $in_transaction = false;

      if ( count($data) > 1 ) {
        $OSCOM_PDO->beginTransaction();

        $in_transaction = true;
      }

      $Qcfg = $OSCOM_PDO->prepare('insert into :table_configuration (configuration_key, configuration_value, configuration_group_id) values (:configuration_key, :configuration_value, :configuration_group_id)');

      foreach ( $data as $d ) {
        $Qcfg->bindValue(':configuration_key', $d['key']);
        $Qcfg->bindValue(':configuration_value', $d['value']);
        $Qcfg->bindInt(':configuration_group_id', $d['group_id']);
        $Qcfg->execute();

        if ( $Qcfg->isError() ) {
          if ( $in_transaction === true ) {
            $OSCOM_PDO->rollBack();
          }

          $error = true;

          break;
        }
      }

      if ( ($error === false) && ($in_transaction === true) ) {
        $OSCOM_PDO->commit();
      }

      return !$error;
    }
  }
?>

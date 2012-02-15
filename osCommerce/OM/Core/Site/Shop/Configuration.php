<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Shop;

  use osCommerce\OM\Core\OSCOM;

  class Configuration {
    static public function load() {
      foreach ( OSCOM::callDB('Shop\GetConfiguration', null, 'Site') as $param ) {
        define($param['cfgkey'], $param['cfgvalue']);
      }
    }
  }
?>

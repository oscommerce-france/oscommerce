<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin;

  class Configuration extends \osCommerce\OM\Core\Site\Shop\Configuration {
    static public function initialize($module) {
      $module = strtolower($module);

      if ( class_exists('osCommerce\\OM\\Core\\Site\\Admin\\Module\\Configuration\\' . $module) ) {
        $ns_module = 'osCommerce\\OM\\Core\\Site\\Admin\\Module\\Configuration\\' . $module;

        return new $ns_module();
      }

      return new ConfigurationModule($module);
    }
  }
?>

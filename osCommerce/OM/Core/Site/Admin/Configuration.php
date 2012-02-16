<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin;
  
/**
 * @since v3.0.4
 */

  class Configuration extends \osCommerce\OM\Core\Site\Shop\Configuration {
    static public function initialize($key) {
      $module = static::getClassName($key);

      if ( class_exists('osCommerce\\OM\\Core\\Site\\Admin\\Module\\Configuration\\' . $module) ) {
        $ns_module = 'osCommerce\\OM\\Core\\Site\\Admin\\Module\\Configuration\\' . $module;

        return new $ns_module($key);
      }

      return new ConfigurationModule($key, $module);
    }

    static public function getClassName($string) {
      $string = strtolower($string);
      $string = str_replace(array('-', '_'), ' ', $string);
      $string = ucwords($string);
      $string = str_replace(' ', '', $string);

      return $string;
    }
  }
?>

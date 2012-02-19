<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Application\Configuration\Model;

  class loadModule {
    public static function execute($key, $namespace = null) {
      $module = static::getClassName($key);

      if ( !isset($namespace) ) {
        $namespace = 'Admin\\Module';
      }

      $ns_module = 'osCommerce\\OM\\Core\\Site\\' . $namespace . '\\Configuration\\' . $module;

      return new $ns_module();
    }

    public static function getClassName($string) {
      $string = strtolower($string);
      $string = str_replace(array('-', '_'), ' ', $string);
      $string = ucwords($string);
      $string = str_replace(' ', '', $string);

      return $string;
    }
  }
?>

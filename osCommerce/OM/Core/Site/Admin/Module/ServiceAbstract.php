<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin;

  use osCommerce\OM\Core\DirectoryListing;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;

/**
 * @since v3.0.2
 */

  abstract class ServiceAbstract {
    protected $code;
    protected $title;
    protected $description;
    protected $uninstallable = true;
    protected $depends;
    protected $precedes;

    abstract protected function initialize();

    public function __construct() {
      $OSCOM_Language = Registry::get('Language');

      $module_class = array_slice(explode('\\', get_called_class()), -2, 1);
      $this->code = $module_class[0];

      $OSCOM_Language->loadIniFile('modules/Service/' . $this->code . '.php');

      $this->initialize();
    }

    public function getCode() {
      return $this->code;
    }

    public function getTitle() {
      return $this->title;
    }

    public function getDescription() {
      return $this->description;
    }

    public function isUninstallable() {
      return $this->uninstallable;
    }

    public function hasKeys() {
      $keys = $this->keys();

      return ( is_array($keys) && !empty($keys) );
    }

    public function install() {
      foreach ( $this->getConfigurationModules() as $cfg_module ) {
        $class = 'osCommerce\\OM\\Core\\Site\\Admin\\Module\\Service\\' . $this->code . '\\Configuration\\' . $cfg_module;

        $module = new $class();
        $module->install();
      }
    }

    public function remove() {
      foreach ( $this->getConfigurationModules() as $cfg_module ) {
        $class = 'osCommerce\\OM\\Core\\Site\\Admin\\Module\\Service\\' . $this->code . '\\Configuration\\' . $cfg_module;

        $module = new $class();
        $module->uninstall();
      }
    }

    public function keys() {
      $modules = array();
      $result = array();

      foreach ( $this->getConfigurationModules() as $cfg_module ) {
        $class = 'osCommerce\\OM\\Core\\Site\\Admin\\Module\\Service\\' . $this->code . '\\Configuration\\' . $cfg_module;

        $modules[] = array('key' => strtoupper(implode('_', preg_split('/(?=[A-Z])/', $cfg_module, null, PREG_SPLIT_NO_EMPTY))),
                           'sort' => call_user_func(array($class, 'getSort')));
      }

      usort($modules, function($a, $b) {
        return strnatcmp($a['sort'], $b['sort']);
      });

      foreach ( $modules as $m ) {
        $result[] = $m['key'];
      }

      return $result;
    }

/**
 * @since v3.0.4
 */

    public function getConfigurationModules() {
      $modules = array();

      $DL = new DirectoryListing(OSCOM::BASE_DIRECTORY . 'Core/Site/Admin/Module/Service/' . $this->code . '/Configuration');
      $DL->setIncludeDirectories(false);
      $DL->setCheckExtension('php');

      foreach ( $DL->getFiles() as $file ) {
        $modules[] = substr($file['name'], 0, strpos($file['name'], '.'));
      }

      $DL = new DirectoryListing(OSCOM::BASE_DIRECTORY . 'Custom/Site/Admin/Module/Service/' . $this->code . '/Configuration');
      $DL->setIncludeDirectories(false);
      $DL->setCheckExtension('php');

      foreach ( $DL->getFiles() as $file ) {
        $module = substr($file['name'], 0, strpos($file['name'], '.'));

        if ( !in_array($module, $modules) ) {
          $modules[] = $module;
        }
      }

      return $modules;
    }
  }
?>

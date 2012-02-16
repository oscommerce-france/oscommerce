<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin;

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;

  class ConfigurationModule {
    protected $_key;
    protected $_module;

    public function __construct($key, $module = null) {
      $this->_key = $key;

      if ( !isset($module) ) {
        $module = array_slice(explode('\\', get_called_class()), -1);
        $module = $module[0];
      }

      $this->_module = $module;

      Registry::get('Language')->loadIniFile('modules/Configuration/' . $this->_module . '.php');
    }

    public function getKey() {
      return $this->_key;
    }

    public function get() {
      return $this->getRaw();
    }

    public function getRaw() {
      return constant($this->getKey());
    }

    public function getTitle() {
      return OSCOM::getDef('cfg_' . strtolower($this->_key) . '_title');
    }

    public function getDescription() {
      return OSCOM::getDef('cfg_' . strtolower($this->_key) . '_description');
    }

    public function getField() {
      return '<label for="cfg' . $this->_module . '">' . $this->getTitle() . '</label>' . HTML::inputField('configuration[' . $this->_key . ']', $this->getRaw(), 'id="cfg' . $this->_module . '"');
    }
  }
?>

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
    protected $_module;

    public function __construct($module = null) {
      if ( !isset($module) ) {
        $module = array_slice(explode('\\', get_called_class()), -2, 1);
        $module = $module[0];
      }

      $this->_module = $module;

      Registry::get('Language')->loadIniFile('Modules/Configuration/' . $this->_module . '.php');
    }

    public function getKey() {
      return strtoupper($this->_module);
    }

    public function get() {
      return constant($this->getKey());
    }

    public function getTitle() {
      return OSCOM::getDef('cfg_' . $this->_module . '_title');
    }

    public function getDescription() {
      return OSCOM::getDef('cfg_' . $this->_module . '_description');
    }

    public function getField() {
      return HTML::inputField('cfg[' . $this->_module . ']', $this->get());
    }
  }
?>

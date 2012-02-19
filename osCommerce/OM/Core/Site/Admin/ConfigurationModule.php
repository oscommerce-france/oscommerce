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

    static protected $_sort;
    static protected $_default;
    static protected $_group_id = 6;

    public function __construct() {
      $module = array_slice(explode('\\', get_called_class()), -1);
      $this->_module = $module[0];

      $this->_key = strtoupper(implode('_', preg_split('/(?=[A-Z])/', $this->_module, null, PREG_SPLIT_NO_EMPTY)));

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

    public function install() {
      $data = array('key' => $this->getKey(),
                    'value' => static::getDefault(),
                    'group_id' => static::getGroupId(),
                    'title' => '', // HPDL
                    'description' => ''); // HPDL

      OSCOM::callDB('Admin\InsertConfigurationParameters', $data, 'Site');
    }

    public function uninstall() {
      OSCOM::callDB('Admin\DeleteConfigurationParameters', $this->getKey(), 'Site');
    }

    static public function getSort() {
      return static::$_sort;
    }

    static public function getDefault() {
      return static::$_default;
    }

    static public function getGroupId() {
      return static::$_group_id;
    }
  }
?>

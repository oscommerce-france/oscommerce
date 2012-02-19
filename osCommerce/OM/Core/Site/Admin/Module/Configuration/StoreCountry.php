<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Configuration;

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\Site\Shop\Address;

/**
 * @since v3.0.4
 */

  class StoreCountry extends \osCommerce\OM\Core\Site\Admin\Module\ConfigurationAbstract {
    static protected $_sort = 600;
    static protected $_default = '223';
    static protected $_group_id = 1;

    public function initialize() { }

    public function get() {
      return Address::getCountryName($this->getRaw());
    }

    public function getField() {
      $countries_array = array();

      foreach ( Address::getCountries() as $country ) {
        $countries_array[] = array('id' => $country['id'],
                                   'text' => $country['name']);
      }

      return '<label for="cfg' . $this->_module . '">' . $this->getTitle() . '</label>' . HTML::selectMenu('configuration[' . $this->_key . ']', $countries_array, $this->getRaw(), 'id="cfg' . $this->_module . '"');
    }
  }
?>

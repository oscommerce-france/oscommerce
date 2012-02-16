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

  class StoreZone extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    public function get() {
      return Address::getZoneName($this->getRaw());
    }

    public function getField() {
      $zones_array = array();

      foreach ( Address::getZones() as $zone ) {
        $zones_array[] = array('id' => $zone['id'],
                               'text' => $zone['name'],
                               'group' => $zone['country_name']);
      }

      return '<label for="cfg' . $this->_module . '">' . $this->getTitle() . '</label>' . HTML::selectMenu('configuration[' . $this->_key . ']', $zones_array, $this->getRaw(), 'id="cfg' . $this->_module . '"');
    }
  }
?>

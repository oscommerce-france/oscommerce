<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Configuration;

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\Site\Shop\Weight;

/**
 * @since v3.0.4
 */

  class ShippingWeightUnit extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    public function get() {
      return Weight::getTitle($this->getRaw());
    }

    public function getField() {
      $weight_class_array = array();

      foreach ( Weight::getClasses() as $class ) {
        $weight_class_array[] = array('id' => $class['id'],
                                      'text' => $class['title']);
      }

      return '<label for="cfg' . $this->_module . '">' . $this->getTitle() . '</label>' . HTML::selectMenu('configuration[' . $this->_key . ']', $weight_class_array, $this->getRaw(), 'id="cfg' . $this->_module . '"');
    }
  }
?>

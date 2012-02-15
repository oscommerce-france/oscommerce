<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Configuration;

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;

  class DisplayPriceWithTax extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    public function get() {
      switch ( $this->getRaw() ) {
        case '-1':
          return OSCOM::getDef('parameter_false');
          break;

        case '1':
          return OSCOM::getDef('parameter_true');
          break;
      }

      return $this->getRaw();
    }

    public function getField() {
      $values_array = array(array('id' => '-1',
                                  'text' => OSCOM::getDef('parameter_false')),
                            array('id' => '1',
                                  'text' => OSCOM::getDef('parameter_true')));

      return HTML::radioField('configuration[' . $this->_module . ']', $values_array, $this->getRaw());
    }
  }
?>

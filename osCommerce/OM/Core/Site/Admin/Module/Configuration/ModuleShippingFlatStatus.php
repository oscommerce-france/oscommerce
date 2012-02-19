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

/**
 * @since v3.0.4
 */

  class ModuleShippingFlatStatus extends \osCommerce\OM\Core\Site\Admin\Module\ConfigurationAbstract {
    protected $_param_enabled;
    protected $_param_disabled;

    public function initialize() {
      $this->_param_enabled = OSCOM::getDef('parameter_enabled');
      $this->_param_disabled = OSCOM::getDef('parameter_disabled');
    }

    public function get() {
      switch ( $this->getRaw() ) {
        case 'True':
          return $this->_param_enabled;

        case 'False':
          return $this->_param_disabled;
      }

      return $this->getRaw();
    }

    public function getField() {
      $values = array(array('id' => 'True',
                            'text' => $this->_param_enabled),
                      array('id' => 'False',
                            'text' => $this->_param_disabled));

      $field = '<h4>' . $this->getTitle() . '</h4><div id="cfg' . $this->_module . '">' . HTML::radioField('configuration[' . $this->_key . ']', $values, $this->getRaw()) . '</div>';

      $field .= <<<EOT
<script>
$('#cfg{$this->_module}').buttonset();
</script>
EOT;

      return $field;
    }
  }
?>

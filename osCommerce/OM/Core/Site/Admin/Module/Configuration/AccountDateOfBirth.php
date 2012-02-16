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

  class AccountDateOfBirth extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    protected $_param_required;
    protected $_param_disabled;

    public function __construct($key, $module = null) {
      parent::__construct($key, $module);

      $this->_param_required = OSCOM::getDef('parameter_required');
      $this->_param_disabled = OSCOM::getDef('parameter_disabled');
    }

    public function get() {
      switch ( $this->getRaw() ) {
        case '1':
          return $this->_param_required;

        case '-1':
          return $this->_param_disabled;
      }

      return $this->getRaw();
    }

    public function getField() {
      $values = array(array('id' => '1',
                            'text' => $this->_param_required),
                      array('id' => '-1',
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

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

  class ServiceReviewEnableReviews extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    protected $_param_allow_all;
    protected $_param_only_customers;
    protected $_param_only_purchased;

    public function __construct($key, $module = null) {
      parent::__construct($key, $module);

      $this->_param_allow_all = OSCOM::getDef('parameter_allow_all');
      $this->_param_only_customers = OSCOM::getDef('parameter_only_customers');
      $this->_param_only_purchased = OSCOM::getDef('parameter_only_purchased');
    }

    public function get() {
      switch ( $this->getRaw() ) {
        case '1':
          return $this->_param_only_customers;

        case '2':
          return $this->_param_only_purchased;

        case '0':
          return $this->_param_allow_all;
      }

      return $this->getRaw();
    }

    public function getField() {
      $values = array(array('id' => '1',
                            'text' => $this->_param_only_customers),
                      array('id' => '2',
                            'text' => $this->_param_only_purchased),
                      array('id' => '0',
                            'text' => $this->_param_allow_all));

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

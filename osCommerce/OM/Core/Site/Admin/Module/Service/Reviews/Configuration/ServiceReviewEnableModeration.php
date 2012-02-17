<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Service\Reviews\Configuration;

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;

/**
 * @since v3.0.4
 */

  class ServiceReviewEnableModeration extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    static protected $_sort = 300;
    static protected $_default = '-1';

    protected $_param_moderate_all;
    protected $_param_moderate_guests;
    protected $_param_no_moderation;

    public function __construct($key, $module = null) {
      parent::__construct($key, $module);

      $this->_param_moderate_all = OSCOM::getDef('parameter_moderate_all');
      $this->_param_moderate_guests = OSCOM::getDef('parameter_moderate_guests');
      $this->_param_no_moderation = OSCOM::getDef('parameter_no_moderation');
    }

    public function get() {
      switch ( $this->getRaw() ) {
        case '1':
          return $this->_param_moderate_all;

        case '0':
          return $this->_param_moderate_guests;

        case '-1':
          return $this->_param_no_moderation;
      }

      return $this->getRaw();
    }

    public function getField() {
      $values = array(array('id' => '1',
                            'text' => $this->_param_moderate_all),
                      array('id' => '0',
                            'text' => $this->_param_moderate_guests),
                      array('id' => '-1',
                            'text' => $this->_param_no_moderation));

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

<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Configuration;

  use osCommerce\OM\Core\HTML;

/**
 * @since v3.0.4
 */

  class EmailTransport extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    protected $_param_sendmail;
    protected $_param_smtp;

    static protected $_sort = 100;
    static protected $_default = 'sendmail';
    static protected $_group_id = 12;

    public function __construct($key, $module = null) {
      parent::__construct($key, $module);

      $this->_param_sendmail = 'Sendmail';
      $this->_param_smtp = 'SMTP';
    }

    public function get() {
      switch ( $this->getRaw() ) {
        case 'sendmail':
          return $this->_param_sendmail;

        case 'smtp':
          return $this->_param_smtp;
      }

      return $this->getRaw();
    }

    public function getField() {
      $values = array(array('id' => 'sendmail',
                            'text' => $this->_param_sendmail),
                      array('id' => 'smtp',
                            'text' => $this->_param_smtp));

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

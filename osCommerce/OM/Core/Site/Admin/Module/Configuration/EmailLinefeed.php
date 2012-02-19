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

  class EmailLinefeed extends \osCommerce\OM\Core\Site\Admin\Module\ConfigurationAbstract {
    protected $_param_lf;
    protected $_param_crlf;

    static protected $_sort = 200;
    static protected $_default = 'LF';
    static protected $_group_id = 12;

    public function initialize() {
      $this->_param_lf = 'LF';
      $this->_param_crlf = 'CRLF';
    }

    public function get() {
      switch ( $this->getRaw() ) {
        case 'LF':
          return $this->_param_lf;

        case 'CRLF':
          return $this->_param_crlf;
      }

      return $this->getRaw();
    }

    public function getField() {
      $values = array(array('id' => 'LF',
                            'text' => $this->_param_lf),
                      array('id' => 'CRLF',
                            'text' => $this->_param_crlf));

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

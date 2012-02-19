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

  class AccountTelephone extends \osCommerce\OM\Core\Site\Admin\Module\ConfigurationAbstract {
    protected $_param_disabled;
    protected $_param_not_required;

    static protected $_sort = 2400;
    static protected $_default = '3';
    static protected $_group_id = 5;

    public function initialize() {
      $this->_param_disabled = OSCOM::getDef('parameter_disabled');
      $this->_param_not_required = OSCOM::getDef('parameter_not_required');
    }

    public function get() {
      switch ( $this->getRaw() ) {
        case '-1':
          return $this->_param_disabled;

        case '0':
          return $this->_param_not_required;

        default:
          return $this->getRaw();
      }
    }

    public function getField() {
      $field = '<label for="cfg' . $this->_module . '">' . $this->getTitle() . '</label>' . HTML::inputField('configuration[' . $this->_key . ']', $this->getRaw(), 'id="cfg' . $this->_module . '"');

      $field .= <<<EOT
<div id="sliderValue{$this->_module}" class="sliderValue">{$this->get()}</div>
<div id="slider{$this->_module}" class="slider"></div>
<script>
$(function() {
  $('#cfg{$this->_module}').hide();

  $('#slider{$this->_module}').slider({
    range: 'min',
    value: $('#cfg{$this->_module}').val(),
    min: -1,
    max: 10,
    slide: function(event, ui) {
      $('#cfg{$this->_module}').val(ui.value);

      if ( ui.value == '-1' ) {
        $('#sliderValue{$this->_module}').html('{$this->_param_disabled}');
      } else if ( ui.value == '0' ) {
        $('#sliderValue{$this->_module}').html('{$this->_param_not_required}');
      } else {
        $('#sliderValue{$this->_module}').html(ui.value);
      }
    }
  });
});
</script>
EOT;

      return $field;
    }
  }
?>

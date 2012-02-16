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

  class AccountCountry extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    protected $_param_required;

    public function __construct($key, $module = null) {
      parent::__construct($key, $module);

      $this->_param_required = OSCOM::getDef('parameter_required');
    }

    public function get() {
      return $this->_param_required;
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
    min: 1,
    max: 1,
    slide: function(event, ui) {
      $('#cfg{$this->_module}').val(ui.value);

      $('#sliderValue{$this->_module}').html('{$this->_param_required}');
    }
  });
});
</script>
EOT;

      return $field;
    }
  }
?>

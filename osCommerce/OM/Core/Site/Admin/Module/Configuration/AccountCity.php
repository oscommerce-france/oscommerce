<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Configuration;

  use osCommerce\OM\Core\HTML;

  class AccountCity extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    public function getField() {
      $field = '<label for="cfg' . $this->_module . '">' . $this->getTitle() . '</label>' . HTML::inputField('configuration[' . $this->_key . ']', $this->getRaw(), 'id="cfg' . $this->_module . '"');

      $field .= <<<EOT
<div class="sliderContainer">
  <div class="sliderValue" id="sliderValue{$this->_module}">{$this->getRaw()}</div>
  <div id="slider{$this->_module}" style="width: 92%;"></div>
</div>
<script>
$(function() {
  $('#cfg{$this->_module}').hide();
  $('#slider{$this->_module}').slider({
    range: 'min',
    value: $('#cfg{$this->_module}').val(),
    min: 1,
    max: 10,
    slide: function(event, ui) {
      $('#cfg{$this->_module}').val(ui.value);
      $('#sliderValue{$this->_module}').html(ui.value);
    }
  });
});
</script>
EOT;

      return $field;
    }
  }
?>

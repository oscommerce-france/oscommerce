<?php
/*
  osCommerce Online Merchant $osCommerce-SIG$
  Copyright (c) 2010 osCommerce (http://www.oscommerce.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  namespace osCommerce\OM\Site\Admin\Application\Currencies;

  use osCommerce\OM\Site\Admin\ApplicationAbstract;
  use osCommerce\OM\OSCOM;

  class Controller extends ApplicationAbstract {
    protected $_group = 'configuration';
    protected $_icon = 'currencies.png';
    protected $_sort_order = 500;

    protected function initialize() {
      $this->_title = OSCOM::getDef('app_title');
    }

    protected function process() {
        $this->_page_title = OSCOM::getDef('heading_title');
    }
  }
?>
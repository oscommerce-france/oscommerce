<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Service\Breadcrumb;

  use osCommerce\OM\Core\OSCOM;

/**
 * @since v3.0.4
 */

  class Controller extends \osCommerce\OM\Core\Site\Admin\ServiceAbstract {
    protected function initialize() {
      $this->title = OSCOM::getDef('services_breadcrumb_title');
      $this->description = OSCOM::getDef('services_breadcrumb_description');
    }
  }
?>

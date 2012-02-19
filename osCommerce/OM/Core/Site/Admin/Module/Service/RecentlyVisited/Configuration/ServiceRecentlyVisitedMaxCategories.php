<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Service\RecentlyVisited\Configuration;

/**
 * @since v3.0.4
 */

  class ServiceRecentlyVisitedMaxCategories extends \osCommerce\OM\Core\Site\Admin\Module\ConfigurationAbstract {
    static protected $_sort = 600;
    static protected $_default = '3';

    public function initialize() { }
  }
?>

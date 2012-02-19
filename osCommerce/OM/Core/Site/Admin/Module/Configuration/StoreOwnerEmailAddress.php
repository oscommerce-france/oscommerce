<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Configuration;

/**
 * @since v3.0.4
 */

  class StoreOwnerEmailAddress extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    static protected $_sort = 300;
    static protected $_default = 'root@localhost';
    static protected $_group_id = 1;
  }
?>

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

  class CfgAppImagemagickConvert extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    static protected $_sort = 600;
    static protected $_default = '/usr/bin/convert';
    static protected $_group_id = 18;
  }
?>

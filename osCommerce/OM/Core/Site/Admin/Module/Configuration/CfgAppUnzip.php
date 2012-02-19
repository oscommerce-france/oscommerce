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

  class CfgAppUnzip extends \osCommerce\OM\Core\Site\Admin\ConfigurationModule {
    static protected $_sort = 400;
    static protected $_default = '/usr/bin/unzip';
    static protected $_group_id = 18;
  }
?>
